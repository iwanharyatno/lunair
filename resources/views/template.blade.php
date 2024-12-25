<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        body {
            padding-top: 70px; /* Sesuaikan dengan tinggi navbar */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg- shadow-sm" style="background-color:pink ;">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="icon me-2" src="/img/sitaara-icon.png" alt="Sitaara" style="height: 40px;"> ELYSEIA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-dark" id="navbarNav" >
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/catalogue">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">Tentang Kami</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari produk..." aria-label="Search">
                        <button class="btn btn-outline-primary rounded-pill" type="submit">Cari</button>
                    </form>
                    <a href="{{ route('product.cart') }}" class="btn btn-danger ms-3 rounded-pill">
                        <i class="bi bi-cart"></i> Cart
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="bg-light p-3 text-center text-secondary">
        <small>&copy; 2024 Lunair.</small>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>

</html>
