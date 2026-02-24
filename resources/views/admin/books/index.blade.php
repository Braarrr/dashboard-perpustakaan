@extends('layouts.app')

@section('title', 'Admin - Manage Books')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="mb-1">Manajemen Koleksi Buku</h2>
        <p class="text-muted">Kelola data buku, kategori, dan ketersediaan stok.</p>
    </div>
    <a href="{{ route('books.create') }}" class="btn-premium">
        <i class="bi bi-plus-lg"></i> Tambah Buku Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 premium-card mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="premium-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-muted small text-uppercase fw-bold">Buku</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Info Detail</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Kategori</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Status</th>
                    <th class="py-3 text-end pe-4 text-muted small text-uppercase fw-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td class="ps-4 py-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 overflow-hidden" style="width: 50px; height: 70px;">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 h-100 object-fit-cover shadow-sm">
                                    @else
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-book text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $book->title }}</div>
                                    <div class="text-muted small">ID: {{ $book->book_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-dark">{{ $book->author }}</div>
                            <div class="text-muted small">{{ $book->publisher }} ({{ $book->year }})</div>
                        </td>
                        <td>
                            <span class="badge-premium bg-soft-primary">
                                {{ $book->category ? $book->category->name : 'N/A' }}
                            </span>
                        </td>
                        <td>
                            @if(!$book->is_borrowed)
                                <span class="badge-premium bg-soft-success">Tersedia</span>
                            @else
                                <span class="badge-premium bg-soft-danger">Dipinjam</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light text-danger btn-sm rounded-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">Belum ada koleksi buku.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
