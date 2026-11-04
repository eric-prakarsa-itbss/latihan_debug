@extends('layouts.app')

@section('title', isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}</h1>
                <p class="page-subtitle">
                    {{ isset($mahasiswa) ? 'Perbarui informasi data mahasiswa.' : 'Masukkan data mahasiswa baru ke dalam sistem.' }}
                </p>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card card-custom">
            <div class="card-header-custom d-flex align-items-center gap-2">
                <i class="bi {{ isset($mahasiswa) ? 'bi-pencil-square' : 'bi-person-plus-fill' }} text-primary fs-5"></i>
                <span class="fw-semibold text-dark">
                    Form Edit Mahasiswa
                </span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{route('mahasiswa.update', $mahasiswa->id)}}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="NIM" class="form-label">NIM <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input
                                type="text"
                                id="NIM"
                                name="NIM"
                                class="form-control @error('NIM') is-invalid @enderror"
                                value="{{ old('NIM', $mahasiswa->NIM ?? '') }}"
                                placeholder="Contoh: 230101001"
                                required
                                autofocus
                            >
                            @error('NIM')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $mahasiswa->name ?? '') }}"
                                placeholder="Masukkan nama lengkap mahasiswa"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label d-block">Jurusan <span class="text-danger">*</span></label>
                        @php
                            $selectedJurusan = old('jurusan', $mahasiswa->jurusan ?? 'Bisnis Digital');
                            $jurusanOptions = [
                                'Bisnis Digital',
                                'Kewirausahaan',
                                'Sistem dan Teknologi Informasi',
                            ];
                        @endphp
                        <div class="d-flex flex-column gap-2 pt-1">
                            @foreach ($jurusanOptions as $option)
                                <label class="form-check p-3 border rounded-3 d-flex align-items-center gap-2 m-0" style="cursor: pointer;">
                                    <input
                                        class="form-check-input mt-0 ms-0"
                                        type="radio"
                                        name="jurusan"
                                        value="{{ $option }}"
                                        {{ $selectedJurusan === $option ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="fw-medium text-dark">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('jurusan')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4 text-secondary opacity-25">

                    <div class="d-flex justify-content-end gap-2">
                        @if(isset($mahasiswa))
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-light border">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        @else
                            <button type="reset" class="btn btn-light border">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle"></i> {{ isset($mahasiswa) ? 'Simpan Perubahan' : 'Simpan Mahasiswa' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
