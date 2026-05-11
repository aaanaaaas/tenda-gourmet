@extends('layouts.app')
@section('titol', 'Gestió del compte')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-person-circle"></i> Gestió del compte</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('compte.update') }}">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Dades d'accés</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom d'usuari</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correu</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipus de compte</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->tipus) }}" disabled>
                        <small class="text-muted">Només un administrador pot canviar el tipus.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">Dades personals</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="nom_complet" class="form-control" value="{{ old('nom_complet', $user->nom_complet) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" maxlength="9" class="form-control" value="{{ old('dni', $user->dni) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telèfon</label>
                        <input type="text" name="telefon" maxlength="9" class="form-control" value="{{ old('telefon', $user->telefon) }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Direcció</label>
                        <input type="text" name="direccio" class="form-control" value="{{ old('direccio', $user->direccio) }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Població</label>
                        <input type="text" name="poblacio" class="form-control" value="{{ old('poblacio', $user->poblacio) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Codi Postal</label>
                        <input type="text" name="codi_postal" maxlength="5" class="form-control" value="{{ old('codi_postal', $user->codi_postal) }}">
                    </div>
                </div>
            </div>
        </div>

        @if($user->esEmpresa())
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">Dades de facturació (empresa)</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">CIF</label>
                            <input type="text" name="cif" maxlength="9" class="form-control" value="{{ old('cif', $user->cif) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Raó social</label>
                            <input type="text" name="rao_social" class="form-control" value="{{ old('rao_social', $user->rao_social) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Direcció facturació</label>
                            <input type="text" name="direccio_fact" class="form-control" value="{{ old('direccio_fact', $user->direccio_fact) }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Població facturació</label>
                            <input type="text" name="poblacio_fact" class="form-control" value="{{ old('poblacio_fact', $user->poblacio_fact) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CP facturació</label>
                            <input type="text" name="codi_postal_fact" maxlength="5" class="form-control" value="{{ old('codi_postal_fact', $user->codi_postal_fact) }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <button class="btn btn-warning btn-lg"><i class="bi bi-check-circle"></i> Guardar canvis</button>
    </form>
</div>
@endsection
