@extends('layouts.app')
@section('titol', $titol)

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inici</a></li>
            <li class="breadcrumb-item active">{{ $titol }}</li>
        </ol>
    </nav>

    <div class="row">
        {{-- Filtres laterals (seccions) --}}
        <aside class="col-md-3 mb-4">
            <h5>Seccions</h5>
            <ul class="list-group">
                @foreach($seccions as $s)
                    <a href="{{ route('seccio', $s->slug) }}" class="list-group-item list-group-item-action">
                        {{ $s->nom }}
                    </a>
                @endforeach
            </ul>
        </aside>

        {{-- Llista productes --}}
        <div class="col-md-9">
            <h1 class="mb-4">{{ $titol }}</h1>

            @if($productes->count() === 0)
                <div class="alert alert-info">No s'han trobat productes.</div>
            @else
                <div class="row">
                    @foreach($productes as $p)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card card-producte h-100">
                                @if($p->imatge)
                                    <img src="{{ asset('storage/' . $p->imatge) }}" class="card-img-top" alt="{{ $p->nom }}">
                                @else
                                    <div class="producte-placeholder"><i class="bi bi-basket"></i></div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    @if($p->destacat)<span class="badge badge-destacat mb-2 align-self-start">Destacat</span>@endif
                                    <h5 class="card-title">{{ $p->nom }}</h5>
                                    <p class="card-text small text-muted flex-grow-1">{{ Str::limit($p->descripcio, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="preu">{{ number_format($p->preu, 2) }} €</span>
                                        <a href="{{ route('producte', $p->id) }}" class="btn btn-sm btn-outline-dark">Detalls</a>
                                    </div>
                                    <form action="{{ route('cistella.afegir', $p->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm w-100">
                                            <i class="bi bi-cart-plus"></i> Afegir a la cistella
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $productes->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
