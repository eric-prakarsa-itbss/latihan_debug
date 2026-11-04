@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div>
        <h1 class="page-title">Index Mahasiswa</h1>
    </div>
    <div>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i> Tambah Mahasiswa
        </a>
    </div>
</div>

<div class="card card-custom overflow-hidden">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-people-fill text-primary fs-5"></i>
            <span class="fw-semibold text-dark">Daftar Mahasiswa</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 70px;">No</th>
                    <th scope="col" style="width: 200px;">NIM</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col" class="text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                    <tr>
                        <td class="text-muted fw-medium">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge-barcode">
                                {{ $mahasiswa->NIM }}
                            </span>
                        </td>
                        <td class="fw-semibold text-dark">{{ $mahasiswa->name }}</td>
                        <td>
                            <span class="badge bg-info-subtle text-info-emphasis rounded-pill px-3 py-2 fw-medium">
                                {{ $mahasiswa->jurusan }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa {{ $mahasiswa->name }}?')">
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
                        <td colspan="5" class="text-center py-5">
                            <div class="py-3">
                                <i class="bi bi-people fs-1 text-secondary opacity-50 d-block mb-3"></i>
                                <h6 class="fw-semibold text-dark mb-1">Belum ada data mahasiswa</h6>
                                <p class="text-muted small mb-3">Silakan tambahkan data mahasiswa baru untuk mulai mengelola data.</p>
                                <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary">
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
