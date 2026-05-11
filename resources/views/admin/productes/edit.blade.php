@extends('layouts.app')
@section('titol', $producte->exists ? 'Editar producte' : 'Nou producte')

@section('content')
<div class="container my-4">
    <h1>{{ $producte->exists ? 'Editar producte' : 'Nou producte' }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    @endif

    <form method="POST"
          action="{{ $producte->exists ? route('admin.producte.update', $producte->id) : route('admin.producte.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($producte->exists) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $producte->nom) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripció *</label>
            <textarea name="descripcio" class="form-control" rows="4" required>{{ old('descripcio', $producte->descripcio) }}</textarea>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Preu (€) *</label>
                <input type="number" step="0.01" name="preu" class="form-control" value="{{ old('preu', $producte->preu) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Stock *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $producte->stock ?? 50) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Secció *</label>
                <select name="seccio_id" class="form-select" required>
                    @foreach($seccions as $s)
                        <option value="{{ $s->id }}" @selected(old('seccio_id', $producte->seccio_id) == $s->id)>{{ $s->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-check mt-3">
            <input type="checkbox" name="destacat" class="form-check-input" id="destacat" @checked(old('destacat', $producte->destacat))>
            <label class="form-check-label" for="destacat">Producte destacat</label>
        </div>
        <div class="mb-3 mt-3">
            <label class="form-label">Imatge</label>
            <input type="file" name="imatge" class="form-control" accept="image/*">
            @if($producte->imatge)
                <img src="{{ asset('storage/' . $producte->imatge) }}" class="mt-2 rounded" style="max-width:150px">
            @endif
        </div>
        <button class="btn btn-warning"><i class="bi bi-check-circle"></i> Guardar</button>
        <a href="{{ route('admin.productes') }}" class="btn btn-outline-dark">Cancel·lar</a>
    </form>
</div>
@endsection
