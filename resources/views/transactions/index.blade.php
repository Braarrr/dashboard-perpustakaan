@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="mb-1">Riwayat Transaksi</h2>
        <p class="text-muted">Pantau aktivitas peminjaman dan pengembalian buku.</p>
    </div>
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
                    @if (Auth::user()->role == 'admin')
                        <th class="py-3 text-muted small text-uppercase fw-bold">Peminjam</th>
                    @endif
                    <th class="py-3 text-muted small text-uppercase fw-bold">Tanggal Pinjam</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Tanggal Kembali</th>
                    <th class="py-3 text-center text-muted small text-uppercase fw-bold">Status</th>
                    <th class="py-3 text-end pe-4 text-muted small text-uppercase fw-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="ps-4 py-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-soft-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $transaction->book->title }}</div>
                                    <div class="text-muted small">{{ $transaction->book->book_code }}</div>
                                </div>
                            </div>
                        </td>
                        
                        @if (Auth::user()->role == 'admin')
                            <td>
                                <div class="fw-medium">{{ $transaction->user->name }}</div>
                                <div class="text-muted small">{{ $transaction->user->username }}</div>
                            </td>
                        @endif

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-event text-muted"></i>
                                <span>{{ $transaction->borrowed_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        
                        <td>
                            @if($transaction->returned_at)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar-check text-success"></i>
                                    <span>{{ $transaction->returned_at->format('d M Y') }}</span>
                                </div>
                            @else
                                <span class="text-muted small italic">Belum kembali</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if ($transaction->status === 'borrowed')
                                <span class="badge-premium bg-soft-warning">Sedang Dipinjam</span>
                            @else
                                <span class="badge-premium bg-soft-success">Selesai</span>
                            @endif
                        </td>

                        <td class="text-end pe-4">
                            @if ($transaction->status === 'borrowed')
                                <form action="{{ route('transactions.return', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-light btn-sm rounded-pill px-3 disabled" disabled>Selesai</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role == 'admin' ? '6' : '5' }}" class="text-center py-5">
                            <i class="bi bi-clock-history fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">Tidak ada riwayat transaksi.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection