@extends('layouts.app')

@section('title', 'Isi / Ubah Kehadiran Mahasiswa')

@push('styles')
<style>
    .absensi-card {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
    }

    .table-absensi {
        margin-bottom: 0;
        border-collapse: collapse;
        width: 100%;
    }

    .table-absensi thead th {
        background-color: #ffffff;
        color: #334155;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: top;
    }

    .table-absensi tbody tr:nth-child(odd) td {
        background-color: #ffffff;
    }

    .table-absensi tbody tr:nth-child(even) td {
        background-color: #f4f6fa;
    }

    .table-absensi tbody td {
        padding: 0.85rem 1.25rem;
        vertical-align: middle;
        border-bottom: 1px solid #eef2f6;
        font-size: 0.85rem;
    }

    .mhs-name {
        font-weight: 600;
        color: #1e293b;
        text-transform: uppercase;
        font-size: 0.82rem;
        line-height: 1.3;
    }

    .mhs-nim {
        color: #64748b;
        font-size: 0.78rem;
        line-height: 1.2;
    }

    .badge-kehadiran {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        font-size: 0.72rem;
        font-weight: 600;
        border-radius: 4px;
        text-align: center;
        min-width: 48px;
    }

    .badge-hadir {
        background-color: #d1fae5;
        color: #10b981;
    }

    .badge-absen {
        background-color: #fee2e2;
        color: #ef4444;
    }

    .badge-izin {
        background-color: #dbeafe;
        color: #3b82f6;
    }

    .badge-sakit {
        background-color: #fef3c7;
        color: #d97706;
    }

    .status-radio-group {
        display: inline-flex;
        align-items: center;
        gap: 0.85rem;
    }

    .status-radio-item {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        cursor: pointer;
        font-size: 0.82rem;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0;
        user-select: none;
    }

    .status-radio-item input[type="radio"] {
        width: 16px;
        height: 16px;
        margin: 0;
        cursor: pointer;
        accent-color: #2563eb;
    }
</style>
@endpush

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div>
        <h1 class="page-title">Ubah Kehadiran Mahasiswa</h1>
        <p class="page-subtitle">Pilih tanggal dan mata kuliah untuk mengisi atau mengubah status kehadiran mahasiswa.</p>
    </div>
    <div>
        <a href="{{ route('absensi.index', ['tanggal_absensi' => $selectedTanggal, 'matakuliah_id' => $selectedMatkulId]) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Rekap
        </a>
    </div>
</div>

<form method="POST" action="{{ route('absensi.store') }}" id="absensiForm">
    @csrf

    <!-- Filter Bar: DatePicker & ComboBox Nama MK -->
    <div class="absensi-card p-3 p-md-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tanggal_absensi" class="form-label">Tanggal Absensi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input
                        type="date"
                        id="tanggal_absensi"
                        name="tanggal_absensi"
                        class="form-control"
                        value="{{ $selectedTanggal }}"
                        onchange="filterCreateAbsensi()"
                        required
                    >
                </div>
            </div>

            <div class="col-md-5">
                <label for="matakuliah_id" class="form-label">Nama Mata Kuliah</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-journal-bookmark"></i></span>
                    <select
                        id="matakuliah_id"
                        name="matakuliah_id"
                        class="form-select"
                        onchange="filterCreateAbsensi()"
                        required
                    >
                        @forelse ($matkuls as $matkul)
                            <option value="{{ $matkul->id }}" {{ (string) $selectedMatkulId === (string) $matkul->id ? 'selected' : '' }}>
                                {{ $matkul->kode }} - {{ $matkul->nama_matakuliah }}
                            </option>
                        @empty
                            <option value="">-- Belum ada Mata Kuliah --</option>
                        @endforelse
                    </select>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-md-end gap-2">
                <button type="submit" class="btn btn-primary w-100" {{ $matkuls->isEmpty() || $mahasiswas->isEmpty() ? 'disabled' : '' }}>
                    <i class="bi bi-check2-circle"></i> Simpan Kehadiran
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel Ubah Kehadiran -->
    <div class="absensi-card overflow-hidden">
        <div class="table-responsive">
            <table class="table-absensi">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th>Mahasiswa</th>
                        <th class="text-center" style="width: 240px;">Kehadiran</th>
                        <th style="width: 260px;">
                            <div class="mb-2">Status</div>
                            <div class="status-radio-group">
                                @foreach (['H', 'A', 'I', 'S'] as $st)
                                    <label class="status-radio-item">
                                        <input
                                            type="radio"
                                            name="select_all_status"
                                            value="{{ $st }}"
                                            onclick="selectAllStatus('{{ $st }}')"
                                        >
                                        <span>{{ $st }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $index => $mahasiswa)
                        @php
                            $record = $absensis->get($mahasiswa->id);
                            $currentStatus = $record?->status_absen;
                        @endphp
                        <tr>
                            <td class="text-center text-secondary fw-medium">{{ $index + 1 }}</td>
                            <td>
                                <div class="mhs-name">{{ $mahasiswa->name }}</div>
                                <div class="mhs-nim">{{ $mahasiswa->NIM }}</div>
                            </td>
                            <td class="text-center" id="kehadiran-cell-{{ $mahasiswa->id }}">
                                @if ($currentStatus === 'H')
                                    <span class="badge-kehadiran badge-hadir">Hadir</span>
                                @elseif ($currentStatus === 'A')
                                    <span class="badge-kehadiran badge-absen">Absen</span>
                                @elseif ($currentStatus === 'I')
                                    <span class="badge-kehadiran badge-izin">Izin</span>
                                @elseif ($currentStatus === 'S')
                                    <span class="badge-kehadiran badge-sakit">Sakit</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="status-radio-group">
                                    @foreach (['H', 'A', 'I', 'S'] as $st)
                                        <label class="status-radio-item">
                                            <input
                                                type="radio"
                                                class="student-status-radio"
                                                data-mhs-id="{{ $mahasiswa->id }}"
                                                name="status[{{ $mahasiswa->id }}]"
                                                value="{{ $st }}"
                                                onchange="updateBadge('{{ $mahasiswa->id }}', '{{ $st }}')"
                                                {{ $currentStatus === $st ? 'checked' : '' }}
                                            >
                                            <span>{{ $st }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                Belum ada data mahasiswa. Silakan tambahkan mahasiswa terlebih dahulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    function filterCreateAbsensi() {
        const tanggal = document.getElementById('tanggal_absensi').value;
        const matkulId = document.getElementById('matakuliah_id').value;
        const url = new URL("{{ route('absensi.create') }}", window.location.origin);
        if (tanggal) url.searchParams.set('tanggal_absensi', tanggal);
        if (matkulId) url.searchParams.set('matakuliah_id', matkulId);
        window.location.href = url.toString();
    }

    function updateBadge(mhsId, status) {
        const cell = document.getElementById('kehadiran-cell-' + mhsId);
        if (!cell) return;

        const map = {
            'H': '<span class="badge-kehadiran badge-hadir">Hadir</span>',
            'A': '<span class="badge-kehadiran badge-absen">Absen</span>',
            'I': '<span class="badge-kehadiran badge-izin">Izin</span>',
            'S': '<span class="badge-kehadiran badge-sakit">Sakit</span>'
        };

        cell.innerHTML = map[status] || '<span class="text-muted">-</span>';
    }

    function selectAllStatus(status) {
        document.querySelectorAll('.student-status-radio[value="' + status + '"]').forEach(function (radio) {
            radio.checked = true;
            updateBadge(radio.getAttribute('data-mhs-id'), status);
        });
    }
</script>
@endpush
