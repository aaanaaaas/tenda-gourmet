<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Tenda Gourmet') — Tenda Gourmet</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5.3 (apartat 17) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

{{-- =========== CAPÇALERA (apartat 1) =========== --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        {{-- Logo/Imatge que porta a inici --}}
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-basket-fill text-warning"></i> Tenda Gourmet
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            {{-- Seccions dinàmiques --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inici</a></li>
                @foreach(\App\Models\Seccio::all() as $s)
                    <li class="nav-item"><a class="nav-link" href="{{ route('seccio', $s->slug) }}">{{ $s->nom }}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('contacte') }}">Contacte</a></li>
            </ul>

            {{-- Cercador --}}
            <form class="d-flex me-3" action="{{ route('cerca') }}" method="GET">
                <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Cerca productes..." value="{{ request('q') }}">
                <button class="btn btn-sm btn-warning" type="submit"><i class="bi bi-search"></i></button>
            </form>

            {{-- Cistella --}}
            <a href="{{ route('cistella.mostrar') }}" class="btn btn-outline-light btn-sm position-relative me-2">
                <i class="bi bi-cart3"></i>
                @php $totalCart = \App\Http\Controllers\CistellaController::totalArticles(); @endphp
                @if($totalCart > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                        {{ $totalCart }}
                    </span>
                @endif
            </a>

            {{-- Menu usuari --}}
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Log in</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registre</a></li>
                @endguest
                @auth
                    @if(auth()->user()->esAdmin())
                        <li class="nav-item"><a class="nav-link text-warning" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear-fill"></i> Administració</a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('compte.edit') }}">Gestió del compte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Missatges flash --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

{{-- =========== CONTINGUT =========== --}}
<main class="flex-grow-1">
    @yield('content')
</main>

{{-- =========== PEU DE PÀGINA (apartat 2) =========== --}}
<footer class="bg-dark text-light mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="bi bi-basket-fill text-warning"></i> Tenda Gourmet</h5>
                <p class="small">Els millors productes gourmet de Lliçà d'Amunt.</p>
                <p class="small mb-0"><strong>Tenda Gourmet © 2026</strong></p>
            </div>
            <div class="col-md-4">
                <h6>Enllaços</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('contacte') }}" class="text-light">Contacte</a></li>
                    <li><a href="{{ route('cookies') }}" class="text-light">Política de cookies i protecció de dades</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Autors</h6>
                <p class="small mb-0">
                    <em>[El teu nom] — CFGS ASIX Ciberseguretat</em><br>
                    Institut de Lliçà — 2026
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
