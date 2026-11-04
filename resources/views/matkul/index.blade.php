@extends('layouts.app')

@section('title', 'Daftar Mata Kuliah')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div>
        <h1 class="page-title">Index Mata Kuliah</h1>
    </div>
    <div>
        <a href="{{ route('matkul.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
        </a>
    </div>
</div>

<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-journal-bookmark-fill text-primary fs-5"></i>
            <span class="fw-semibold text-dark">Daftar Mata Kuliah</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 70px;">No</th>
                    <th scope="col" style="width: 220px;">Kode Mata Kuliah</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col" class="text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matkuls as $index => $matkul)
                    <tr>
                        <td class="text-muted fw-medium">{{ $index + 1 }}</td>
                        <td>
                            <span class="badge bg-primary text-white">
                                {{ $matkul->kode }}
                            </span>
                        </td>
                        <td class="fw-semibold text-dark">{{ $matkul->nama_matakuliah }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('matkul.edit', $matkul->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('matkul.destroy', $matkul->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah {{ $matkul->nama_matakuliah }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="py-3">
                                <i class="bi bi-journal-x fs-1 text-secondary opacity-50 d-block mb-3"></i>
                                <h6 class="fw-semibold text-dark mb-1">Belum ada data mata kuliah</h6>
                                <p class="text-muted small mb-3">Silakan tambahkan mata kuliah baru untuk mulai mengelola data.</p>
                                <a href="{{ route('matkul.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
