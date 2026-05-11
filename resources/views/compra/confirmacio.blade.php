@extends('layouts.app')
@section('titol', 'Compra confirmada')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <i class="bi bi-check-circle-fill text-success" style="font-size:5rem"></i>
            <h1 class="mt-3">Gràcies per la teva compra!</h1>
            <p class="lead">La teva comanda <strong>#{{ $comanda->id }}</strong> s'ha registrat correctament.</p>
            <p>T'hem enviat un correu de confirmació a la teva adreça.</p>

            <div class="card mt-4 text-start">
                <div class="card-header bg-dark text-white">Detall de la comanda</div>
                <div class="card-body">
                    <p><strong>Enviament a:</strong><br>
                        {{ $comanda->nom_complet }}<br>
                        {{ $comanda->direccio }}<br>
                        {{ $comanda->codi_postal }} {{ $comanda->poblacio }}<br>
                        Telèfon: {{ $comanda->telefon }}
                    </p>
                    <table class="table">
                        <thead><tr><th>Producte</th><th>Q</th><th>Preu</th></tr></thead>
                        <tbody>
                            @foreach($comanda->productes as $p)
                                <tr>
                                    <td>{{ $p['nom'] }}</td>
                                    <td>{{ $p['quantitat'] }}</td>
                                    <td>{{ number_format($p['preu'] * $p['quantitat'], 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr><th colspan="2">TOTAL</th><th class="preu">{{ number_format($comanda->total, 2) }} €</th></tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <a href="{{ route('home') }}" class="btn btn-warning mt-4">Tornar a la botiga</a>
        </div>
    </div>
</div>
@endsection
