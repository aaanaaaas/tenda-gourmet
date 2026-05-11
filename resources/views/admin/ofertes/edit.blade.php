@extends('layouts.app')
@section('titol', $oferta->exists ? 'Editar oferta' : 'Nova oferta')

@section('content')
<div class="container my-4">
    <h1>{{ $oferta->exists ? 'Editar oferta' : 'Nova oferta' }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    @endif

    <form method="POST"
          action="{{ $oferta->exists ? route('admin.oferta.update', $oferta->id) : route('admin.oferta.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($oferta->exists) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $oferta->nom) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Missatge *</label>
            <textarea name="missatge" class="form-control" rows="3" required>{{ old('missatge', $oferta->missatge) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imatge</label>
            <input type="file" name="imatge" class="form-control" accept="image/*">
            @if($oferta->imatge)
                <img src="{{ asset('storage/' . $oferta->imatge) }}" class="mt-2 rounded" style="max-width:200px">
            @endif
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="activa" class="form-check-input" id="activa" @checked(old('activa', $oferta->activa ?? true))>
            <label class="form-check-label" for="activa">Activa</label>
        </div>

        <button class="btn btn-warning">Guardar</button>
        <a href="{{ route('admin.ofertes') }}" class="btn btn-outline-dark">Cancel·lar</a>
    </form>
</div>
@endsection
