@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('books.index') }}" class="btn btn-light rounded-circle p-2" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="mb-0">Edit Buku</h2>
        </div>

        <div class="premium-card p-4 p-md-5">
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-12 text-center mb-4">
                        <div class="d-inline-block position-relative">
                            <div class="rounded-4 overflow-hidden shadow" style="width: 140px; height: 200px; background: #f1f5f9;">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 h-100 object-fit-cover" id="preview-img">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-book fs-1"></i>
                                    </div>
                                @endif
                            </div>
                            <label class="btn btn-sm btn-dark position-absolute bottom-0 end-0 rounded-circle p-2" style="transform: translate(25%, 25%);">
                                <i class="bi bi-camera"></i>
                                <input type="file" name="cover_image" class="d-none" accept="image/*">
                            </label>
                        </div>
                        <div class="mt-2 small text-muted">Ganti cover buku</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kode Buku</label>
                        <input type="text" name="book_code" class="form-control rounded-3 p-2 @error('book_code') is-invalid @enderror" value="{{ old('book_code', $book->book_code) }}" required>
                        @error('book_code') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category_id" class="form-select rounded-3 p-2 @error('category_id') is-invalid @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Judul Buku</label>
                        <input type="text" name="title" class="form-control rounded-3 p-2 @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}" required>
                        @error('title') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text" name="author" class="form-control rounded-3 p-2 @error('author') is-invalid @enderror" value="{{ old('author', $book->author) }}" required>
                        @error('author') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Penerbit</label>
                        <input type="text" name="publisher" class="form-control rounded-3 p-2 @error('publisher') is-invalid @enderror" value="{{ old('publisher', $book->publisher) }}" required>
                        @error('publisher') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" name="year" class="form-control rounded-3 p-2 @error('year') is-invalid @enderror" value="{{ old('year', $book->year) }}" required>
                        @error('year') <div class="invalid-feedback text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top d-flex gap-3">
                    <a href="{{ route('books.index') }}" class="btn btn-light rounded-pill px-4 fw-bold flex-grow-1">Batal</a>
                    <button type="submit" class="btn-premium rounded-pill px-4 fw-bold flex-grow-1 justify-content-center">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection