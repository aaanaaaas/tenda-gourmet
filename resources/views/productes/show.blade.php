@extends('layouts.app')
@section('titol', $producte->nom)

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inici</a></li>
            <li class="breadcrumb-item"><a href="{{ route('seccio', $producte->seccio->slug) }}">{{ $producte->seccio->nom }}</a></li>
            <li class="breadcrumb-item active">{{ $producte->nom }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            @if($producte->imatge)
                <img src="{{ asset('storage/' . $producte->imatge) }}" class="img-fluid rounded shadow" alt="{{ $producte->nom }}">
            @else
                <div class="producte-placeholder rounded" style="height:400px;font-size:6rem">
                    <i class="bi bi-basket"></i>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            @if($producte->destacat)<span class="badge badge-destacat mb-2">Destacat</span>@endif
            <h1>{{ $producte->nom }}</h1>
            <p class="text-muted">Secció: {{ $producte->seccio->nom }}</p>
            <p class="lead">{{ $producte->descripcio }}</p>
            <div class="preu mb-4" style="font-size:2rem">{{ number_format($producte->preu, 2) }} €</div>

            <form action="{{ route('cistella.afegir', $producte->id) }}" method="POST">
                @csrf
                <div class="input-group mb-3" style="max-width:250px">
                    <input type="number" name="quantitat" value="1" min="1" max="{{ $producte->stock }}" class="form-control">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-cart-plus"></i> Afegir
                    </button>
                </div>
            </form>
            <small class="text-muted">Stock disponible: {{ $producte->stock }}</small>
        </div>
    </div>
</div>
@endsection
