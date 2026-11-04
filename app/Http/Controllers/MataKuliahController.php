<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('matkul.index', ['matkuls' => Matakuliah::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matkul.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:255|unique:matakuliah,kode',
            'nama_matakuliah' => 'required|string|max:255',
        ]);

        Matakuliah::create($validated);

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('matkul.edit', ['matkul' => Matakuliah::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $matkul = Matakuliah::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:255|unique:matakuliah,kode,' . $matkul->id,
            'nama_matakuliah' => 'required|string|max:255',
        ]);

        $matkul->update($validated);

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matkul = Matakuliah::findOrFail($id);
        $matkul->delete();

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
