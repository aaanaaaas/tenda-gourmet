@extends('layouts.app')
@section('titol', 'Gestió productes')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-basket-fill"></i> Productes</h1>
        <a href="{{ route('admin.producte.create') }}" class="btn btn-warning"><i class="bi bi-plus-circle"></i> Nou producte</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nom</th><th>Secció</th><th>Preu</th><th>Destacat</th><th>Stock</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($productes as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nom }}</td>
                    <td>{{ $p->seccio->nom }}</td>
                    <td>{{ number_format($p->preu, 2) }} €</td>
                    <td>@if($p->destacat)<span class="badge bg-warning text-dark">Sí</span>@else No @endif</td>
                    <td>{{ $p->stock }}</td>
                    <td>
                        <a href="{{ route('admin.producte.edit', $p->id) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.producte.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Segur que vols eliminar?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $productes->links() }}
</div>
@endsection
