@extends('layouts.app')
@section('titol', 'Editar usuari')

@section('content')
<div class="container my-4">
    <h1>Editar usuari</h1>

    @if($errors->any())
        <div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    @endif

    <form method="POST" action="{{ route('admin.usuari.update', $usuari->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $usuari->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correu</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $usuari->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipus d'usuari</label>
            <select name="tipus" class="form-select" required>
                <option value="particular" @selected($usuari->tipus == 'particular')>Particular</option>
                <option value="empresa" @selected($usuari->tipus == 'empresa')>Empresa</option>
                <option value="admin" @selected($usuari->tipus == 'admin')>Administrador</option>
            </select>
        </div>

        <button class="btn btn-warning">Guardar</button>
        <a href="{{ route('admin.usuaris') }}" class="btn btn-outline-dark">Cancel·lar</a>
    </form>
</div>
@endsection
