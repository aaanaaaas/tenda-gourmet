@extends('layouts.app')
@section('titol', 'Crear compte')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4"><i class="bi bi-person-plus-fill"></i> Crear compte</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom d'usuari</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correu</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Clau</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                            <small class="text-muted">Mínim 6 caràcters</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirma clau</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Crear compte</button>
                    </form>

                    <hr>
                    <p class="text-center small mb-0">
                        Ja tens compte? <a href="{{ route('login') }}">Inicia sessió</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
