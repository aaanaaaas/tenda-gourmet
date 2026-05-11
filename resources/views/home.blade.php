@extends('layouts.app')
@section('titol', 'Inici')

@section('content')
<div class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Sabors autèntics de Lliçà d'Amunt</h1>
        <p class="lead">Productes gourmet seleccionats, directament del productor a la teva taula.</p>
    </div>
</div>

<div class="container">
    {{-- Ofertes vigents --}}
    @if($ofertes->count() > 0)
        <section class="mb-5">
            <h2 class="mb-4"><i class="bi bi-tag-fill text-warning"></i> Ofertes vigents</h2>
            <div class="row">
                @foreach($ofertes as $oferta)
                    <div class="col-md-4 mb-3">
                        <div class="oferta-card">
                            <h4>{{ $oferta->nom }}</h4>
                            <p class="mb-0">{{ $oferta->missatge }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Productes destacats --}}
    <section class="mb-5">
        <h2 class="mb-4"><i class="bi bi-star-fill text-warning"></i> Productes destacats</h2>
        <div class="row">
            @foreach($destacats as $p)
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="card card-producte h-100">
                        @if($p->imatge)
                            <img src="{{ asset('storage/' . $p->imatge) }}" class="card-img-top" alt="{{ $p->nom }}">
                        @else
                            <div class="producte-placeholder">
                                <i class="bi bi-basket"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <span class="badge badge-destacat mb-2">Destacat</span>
                            <h5 class="card-title">{{ $p->nom }}</h5>
                            <p class="card-text small text-muted">{{ Str::limit($p->descripcio, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="preu">{{ number_format($p->preu, 2) }} €</span>
                                <a href="{{ route('producte', $p->id) }}" class="btn btn-sm btn-warning">Veure</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Seccions --}}
    <section class="mb-5">
        <h2 class="mb-4"><i class="bi bi-grid-fill"></i> Les nostres seccions</h2>
        <div class="row">
            @foreach($seccions as $s)
                <div class="col-md-4 col-lg-2 mb-3">
                    <a href="{{ route('seccio', $s->slug) }}" class="text-decoration-none">
                        <div class="card text-center p-3 h-100">
                            <i class="bi bi-basket2-fill text-warning" style="font-size:2rem"></i>
                            <h6 class="mt-2 mb-0">{{ $s->nom }}</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
