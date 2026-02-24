@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('books.index') }}" class="btn btn-light rounded-circle p-2" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="mb-0">Tambah Buku</h2>
        </div>

        <div class="premium-card p-4 p-md-5">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Cover Buku</label>
                        <div class="border-3 border-dashed rounded-4 p-5 text-center bg-light" id="drop-area" style="border-style: dashed !important; border-color: #cbd5e1 !important;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                            <div class="mt-2 text-muted">Klik atau seret gambar ke sini</div>
                            <div class="small text-muted mt-1">PNG, JPG atau WEBP (Maks. 2MB)</div>
                            <input type="file" name="cover_image" class="form-control mt-3" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kode Buku</label>
                        <input type="text" name="book_code" class="form-control rounded-3 p-2 @error('book_code') is-invalid @enderror" value="{{ old('book_code') }}" placeholder="Contoh: BK-001" required>
                        @error('book_code') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category_id" class="form-select rounded-3 p-2 @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Buku</label>
                        <input type="text" name="title" class="form-control rounded-3 p-2 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Masukkan judul lengkap" required>
                        @error('title') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text" name="author" class="form-control rounded-3 p-2 @error('author') is-invalid @enderror" value="{{ old('author') }}" placeholder="Nama penulis" required>
                        @error('author') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Penerbit</label>
                        <input type="text" name="publisher" class="form-control rounded-3 p-2 @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}" placeholder="Nama penerbit" required>
                        @error('publisher') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" name="year" class="form-control rounded-3 p-2 @error('year') is-invalid @enderror" value="{{ old('year', date('Y')) }}" placeholder="YYYY" required>
                        @error('year') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top">
                    <button type="submit" class="btn-premium w-100 justify-content-center">
                        <i class="bi bi-save me-2"></i> Simpan Data Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection