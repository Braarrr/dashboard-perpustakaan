<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Modern Library</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom Modern CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --secondary-gradient: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(255, 255, 255, 0.4);
            --card-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 5px 15px -5px rgba(0, 0, 0, 0.02);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
        }

        .premium-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .premium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .btn-premium {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-premium:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .glass-navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
            padding: 16px 0;
            z-index: 1000;
        }

        .nav-link {
            font-weight: 500;
            color: #64748b !important;
            padding: 10px 20px !important;
            border-radius: 12px;
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            color: #6366f1 !important;
            background: rgba(99, 102, 241, 0.08);
        }

        /* Badge custom */
        .badge-premium {
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Catalog Card specific */
        .book-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-cover-wrapper {
            width: 100%;
            height: 320px;
            position: relative;
            background: #f1f5f9;
        }

        .book-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .book-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            opacity: 0;
            transition: var(--transition);
        }

        .book-card:hover .book-overlay {
            opacity: 1;
        }

        .book-content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Utils */
        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bg-soft-primary { background-color: rgba(99, 102, 241, 0.1); color: #6366f1; }
        .bg-soft-success { background-color: rgba(34, 197, 94, 0.1); color: #22c55e; }
        .bg-soft-warning { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .bg-soft-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    </style>
    @yield('styles')
</head>

<body>
    @include('layouts.navbar')
    <main class="container py-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>

</html>