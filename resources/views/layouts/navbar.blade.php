<nav class="navbar navbar-expand-lg glass-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="{{ route('books.index') }}">
            <span class="bg-primary text-white p-2 rounded-3 me-2">
                <i class="bi bi-book"></i>
            </span>
            Lib-Core
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                        Katalog Buku
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                        Riwayat Pinjam
                    </a>
                </li>

                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            Kelola Anggota
                        </a>
                    </li>
                @endif
            </ul>

            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-lg-flex flex-column text-end">
                    <span class="fw-bold small">{{ Auth::user()->name }}</span>
                    <span class="text-muted" style="font-size: 0.7rem;">
                        {{ Auth::user()->role == 'admin' ? 'Administrator System' : Auth::user()->major . ' - ' . Auth::user()->class }}
                    </span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
