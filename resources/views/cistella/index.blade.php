@extends('layouts.app')
@section('titol', 'Cistella')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-cart3"></i> La teva cistella</h1>

    @if(empty($productes))
        <div class="alert alert-info">
            La cistella està buida. <a href="{{ route('home') }}">Torna a la botiga</a>.
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producte</th>
                        <th>Preu</th>
                        <th>Quantitat</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productes as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['producte']->nom }}</strong>
                            </td>
                            <td>{{ number_format($item['producte']->preu, 2) }} €</td>
                            <td>
                                <form action="{{ route('cistella.actualitzar', $item['producte']->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    <input type="number" name="quantitat" value="{{ $item['quantitat'] }}" min="0" class="form-control form-control-sm" style="width:80px">
                                    <button class="btn btn-sm btn-outline-dark"><i class="bi bi-arrow-clockwise"></i></button>
                                </form>
                            </td>
                            <td><strong>{{ number_format($item['subtotal'], 2) }} €</strong></td>
                            <td>
                                <form action="{{ route('cistella.treure', $item['producte']->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th class="preu">{{ number_format($total, 2) }} €</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('cistella.buidar') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger"><i class="bi bi-x-circle"></i> Buidar cistella</button>
            </form>

            @auth
                <a href="{{ route('compra.checkout') }}" class="btn btn-warning btn-lg">
                    Finalitzar compra <i class="bi bi-arrow-right"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                    Inicia sessió per comprar
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
