@extends('layouts.app')
@section('titol', 'Gestió ofertes')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-tag-fill"></i> Ofertes</h1>
        <a href="{{ route('admin.oferta.create') }}" class="btn btn-warning"><i class="bi bi-plus-circle"></i> Nova oferta</a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nom</th><th>Missatge</th><th>Activa</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($ofertes as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->nom }}</td>
                    <td>{{ Str::limit($o->missatge, 60) }}</td>
                    <td>@if($o->activa)<span class="badge bg-success">Sí</span>@else<span class="badge bg-secondary">No</span>@endif</td>
                    <td>
                        <a href="{{ route('admin.oferta.edit', $o->id) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.oferta.destroy', $o->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Segur?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $ofertes->links() }}
</div>
@endsection
