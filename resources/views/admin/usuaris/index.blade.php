@extends('layouts.app')
@section('titol', 'Gestió usuaris')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-people-fill"></i> Usuaris</h1>

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr><th>ID</th><th>Nom</th><th>Correu</th><th>Tipus</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($usuaris as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        @if($u->tipus == 'admin')
                            <span class="badge bg-danger">Admin</span>
                        @elseif($u->tipus == 'empresa')
                            <span class="badge bg-primary">Empresa</span>
                        @else
                            <span class="badge bg-secondary">Particular</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.usuari.edit', $u->id) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i> Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $usuaris->links() }}
</div>
@endsection
