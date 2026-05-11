@extends('layouts.app')
@section('titol', 'Administració')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-gear-fill"></i> Panell d'administració</h1>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="bi bi-people-fill text-warning" style="font-size:3rem"></i>
                <h2>{{ $nUsuaris }}</h2>
                <p class="text-muted">Usuaris registrats</p>
                <a href="{{ route('admin.usuaris') }}" class="btn btn-outline-dark btn-sm">Gestionar</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="bi bi-basket-fill text-warning" style="font-size:3rem"></i>
                <h2>{{ $nProductes }}</h2>
                <p class="text-muted">Productes</p>
                <a href="{{ route('admin.productes') }}" class="btn btn-outline-dark btn-sm">Gestionar</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="bi bi-tag-fill text-warning" style="font-size:3rem"></i>
                <h2>{{ $nOfertes }}</h2>
                <p class="text-muted">Ofertes</p>
                <a href="{{ route('admin.ofertes') }}" class="btn btn-outline-dark btn-sm">Gestionar</a>
            </div>
        </div>
    </div>
</div>
@endsection
