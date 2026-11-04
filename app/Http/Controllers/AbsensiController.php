<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Absensi;
use App\Models\Mahasiswa;

class AbsensiController extends Controller
{
    /**
     * Display the attendance list (read-only view, cannot override here).
     */
    public function index(Request $request)
    {
        $matkuls = Matakuliah::orderBy('nama_matakuliah')->get();
        $mahasiswas = Mahasiswa::orderBy('NIM')->get();

        $selectedTanggal = $request->input('tanggal_absensi', date('Y-m-d'));
        $selectedMatkulId = $request->input('matakuliah_id', $matkuls->first()?->id);

        $absensis = collect();
        if ($selectedMatkulId && $selectedTanggal) {
            $absensis = Absensi::where('matakuliah_id', (string) $selectedMatkulId)
                ->where('tanggal_absensi', $selectedTanggal)
                ->get()
                ->keyBy('mahasiswa_id');
        }

        return view('absensi.index', [
            'matkuls' => $matkuls,
            'mahasiswas' => $mahasiswas,
            'absensis' => $absensis,
            'selectedTanggal' => $selectedTanggal,
            'selectedMatkulId' => $selectedMatkulId,
        ]);
    }

    /**
     * Show the form for filling / changing attendance.
     */
    public function create(Request $request)
    {
        $matkuls = Matakuliah::orderBy('nama_matakuliah')->get();
        $mahasiswas = Mahasiswa::orderBy('NIM')->get();

        $selectedTanggal = $request->input('tanggal_absensi', date('Y-m-d'));
        $selectedMatkulId = $request->input('matakuliah_id', $matkuls->first()?->id);

        $absensis = collect();
        if ($selectedMatkulId && $selectedTanggal) {
            $absensis = Absensi::where('matakuliah_id', (string) $selectedMatkulId)
                ->where('tanggal_absensi', $selectedTanggal)
                ->get()
                ->keyBy('mahasiswa_id');
        }

        return view('absensi.create', [
            'matkuls' => $matkuls,
            'mahasiswas' => $mahasiswas,
            'absensis' => $absensis,
            'selectedTanggal' => $selectedTanggal,
            'selectedMatkulId' => $selectedMatkulId,
        ]);
    }

    /**
     * Store or update attendance records from the create/ubah page.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'matakuliah_id' => 'required',
            'status' => 'nullable|array',
            'status.*' => 'nullable|in:H,A,I,S',
        ]);

        $statuses = $request->input('status', []);

        foreach ($statuses as $mahasiswaId => $statusAbsen) {
            if (in_array($statusAbsen, ['H', 'A', 'I', 'S'])) {
                Absensi::updateOrCreate(
                    [
                        'mahasiswa_id' => (string) $mahasiswaId,
                        'matakuliah_id' => (string) $request->matakuliah_id,
                        'tanggal_absensi' => $request->tanggal_absensi,
                    ],
                    [
                        'status_absen' => $statusAbsen,
                    ]
                );
            }
        }

        return redirect()
            ->route('absensi.index', [
                'tanggal_absensi' => $request->tanggal_absensi,
                'matakuliah_id' => $request->matakuliah_id,
            ])
            ->with('success', 'Data kehadiran berhasil disimpan.');
    }
}
