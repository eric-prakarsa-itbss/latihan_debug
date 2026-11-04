@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Edit Mata Kuliah</h1>
            </div>
            <a href="{{ route('matkul.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square text-primary fs-5"></i>
                <span class="fw-semibold text-dark">Perbarui Data Mata Kuliah</span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('matkul.update', $matkul->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="kode" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-hash"></i></span>
                            <input
                                type="text"
                                id="kode"
                                name="kode"
                                class="form-control @error('kode') is-invalid @enderror"
                                value="{{ old('kode', $matkul->kode) }}"
                                placeholder="Contoh: ST1020"
                                required
                                autofocus
                            >
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="nama_matakuliah" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-book"></i></span>
                            <input
                                type="text"
                                id="nama_matakuliah"
                                name="nama_matakuliah"
                                class="form-control @error('nama_matakuliah') is-invalid @enderror"
                                value="{{ old('nama_matakuliah', $matkul->nama_matakuliah) }}"
                                placeholder="Contoh: Pemrograman Web Lanjutan"
                                required
                            >
                            @error('nama_matakuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 text-secondary opacity-25">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('matkul.index') }}" class="btn btn-light border">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
