@extends('layouts.app')
@section('titol', 'Recuperar clau')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4"><i class="bi bi-key-fill"></i> Recuperar clau</h2>
                    <p class="text-muted small text-center">Introdueix el teu correu i et enviarem una clau nova.</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('forgot') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Correu</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Enviar clau nova</button>
                    </form>
                    <hr>
                    <p class="text-center small"><a href="{{ route('login') }}">Tornar a inici de sessió</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
