@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="mb-1">Manajemen Pengguna</h2>
        <p class="text-muted">Kelola data anggota dan administrator sistem.</p>
    </div>
    @if (Auth::user()->role === 'admin')
        <a href="{{ route('users.create') }}" class="btn-premium">
            <i class="bi bi-person-plus"></i> Tambah User Baru
        </a>
    @endif
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
                    <th class="ps-4 py-3 text-muted small text-uppercase fw-bold">NIS / ID</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Nama Pengguna</th>
                    <th class="py-3 text-muted small text-uppercase fw-bold">Kelas & Jurusan</th>
                    <th class="py-3 text-center text-muted small text-uppercase fw-bold">Role</th>
                    <th class="py-3 text-end pe-4 text-muted small text-uppercase fw-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="ps-4 py-4">
                            <span class="fw-bold">{{ $user->school_id }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                            <div class="text-muted small">{{ $user->username }}</div>
                        </td>
                        <td>
                            @if($user->role === 'member')
                                <div class="text-dark">{{ $user->class }}</div>
                                <div class="text-muted small">{{ $user->major }}</div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($user->role === 'admin')
                                <span class="badge-premium bg-soft-primary">Admin</span>
                            @else
                                <span class="badge-premium bg-soft-success">Member</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-light btn-sm rounded-3">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                @if (Auth::id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-light text-danger btn-sm rounded-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <p class="text-muted">Belum ada data pengguna.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection