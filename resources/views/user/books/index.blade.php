@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="mb-5 text-center">
    <h1 class="display-5 mb-2">Jelajahi Dunia Lewat <span class="text-gradient">Buku</span></h1>
    <p class="text-muted max-w-2xl mx-auto">Temukan ribuan koleksi buku digital dan fisik kami. Pinjam dengan mudah dan mulai petualanganmu hari ini.</p>
</div>

<div class="row g-4">
    <div class="col-lg-3">
        <div class="premium-card p-4 sticky-top" style="top: 100px;">
            <h5 class="mb-4">Filter Kategori</h5>
            <div class="d-flex flex-column gap-2">
                <a href="#" class="nav-link active">Semua Buku</a>
                @foreach($categories as $category)
                    <a href="#" class="nav-link">{{ $category->name }}</a>
                @endforeach
            </div>
            
            <hr class="my-4 text-muted">
            
            <h5 class="mb-3">Cari Buku</h5>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-light border-0 shadow-none" placeholder="Judul atau penulis...">
            </div>
        </div>
    </div>
    
    <div class="col-lg-9">
        <div class="row g-4">
            @forelse($books as $book)
                <div class="col-md-6 col-xl-4">
                    <div class="premium-card book-card">
                        <div class="book-cover-wrapper">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover-img">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-book fs-1 mb-2"></i>
                                    <span>No Cover Available</span>
                                </div>
                            @endif
                            
                            <div class="book-overlay d-flex align-items-center justify-content-center">
                                @if(!$book->is_borrowed)
                                    <form method="POST" action="{{ route('transactions.borrow', $book->id) }}">
                                        @csrf
                                        <button class="btn btn-light rounded-pill px-4 fw-bold">
                                            <i class="bi bi-bookmark-plus me-2"></i> Pinjam Sekarang
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary rounded-pill px-4 fw-bold disabled" disabled>
                                        <i class="bi bi-x-circle me-2"></i> Sedang Dipinjam
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div class="book-content">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge-premium bg-soft-primary small">
                                    {{ $book->category ? $book->category->name : 'Umum' }}
                                </span>
                                @if(!$book->is_borrowed)
                                    <span class="text-success small fw-bold">
                                        <i class="bi bi-check2-circle"></i> Tersedia
                                    </span>
                                @endif
                            </div>
                            
                            <h5 class="mb-1 text-truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                            <p class="text-muted small mb-4">Oleh <span class="fw-medium text-dark">{{ $book->author }}</span></p>
                            
                            <div class="mt-auto d-flex align-items-center justify-content-between pt-3 border-top">
                                <span class="text-muted small">{{ $book->year }}</span>
                                <span class="text-muted small">{{ $book->publisher }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://illustrations.popsy.co/gray/empty-box.svg" style="max-height: 200px;" class="mb-4">
                    <h3>Ops! Katalog Kosong</h3>
                    <p class="text-muted">Maaf, kami belum memiliki koleksi buku untuk saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
