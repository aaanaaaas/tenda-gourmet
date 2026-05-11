@extends('layouts.app')
@section('titol', 'Iniciar sessió')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4"><i class="bi bi-box-arrow-in-right"></i> Iniciar sessió</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Correu electrònic</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Clau</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Recorda'm</label>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Entrar</button>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('forgot') }}" class="small">He oblidat la clau</a><br>
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm mt-2">Registra't com a client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
