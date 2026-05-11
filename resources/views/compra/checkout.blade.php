@extends('layouts.app')
@section('titol', 'Finalitzar compra')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-credit-card"></i> Finalitzar compra</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">Dades d'enviament</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('compra.processar') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nom complet *</label>
                                <input type="text" name="nom_complet" class="form-control" required
                                       value="{{ old('nom_complet', $user->nom_complet) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DNI (9 caràcters) *</label>
                                <input type="text" name="dni" class="form-control" maxlength="9" required
                                       value="{{ old('dni', $user->dni) }}" placeholder="12345678Z">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telèfon (9 dígits) *</label>
                                <input type="text" name="telefon" class="form-control" maxlength="9" required pattern="[0-9]{9}"
                                       value="{{ old('telefon', $user->telefon) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Direcció *</label>
                                <input type="text" name="direccio" class="form-control" required
                                       value="{{ old('direccio', $user->direccio) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Població *</label>
                                <input type="text" name="poblacio" class="form-control" required
                                       value="{{ old('poblacio', $user->poblacio) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Codi Postal *</label>
                                <input type="text" name="codi_postal" class="form-control" maxlength="5" required pattern="[0-9]{5}"
                                       value="{{ old('codi_postal', $user->codi_postal) }}">
                            </div>
                        </div>

                        @if($user->esEmpresa())
                            <hr class="my-4">
                            <h5>Dades de facturació (empresa)</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">CIF *</label>
                                    <input type="text" name="cif" class="form-control" maxlength="9" required
                                           value="{{ old('cif', $user->cif) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Raó social *</label>
                                    <input type="text" name="rao_social" class="form-control" required
                                           value="{{ old('rao_social', $user->rao_social) }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Direcció facturació *</label>
                                    <input type="text" name="direccio_fact" class="form-control" required
                                           value="{{ old('direccio_fact', $user->direccio_fact) }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Població facturació *</label>
                                    <input type="text" name="poblacio_fact" class="form-control" required
                                           value="{{ old('poblacio_fact', $user->poblacio_fact) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CP facturació *</label>
                                    <input type="text" name="codi_postal_fact" class="form-control" maxlength="5" required pattern="[0-9]{5}"
                                           value="{{ old('codi_postal_fact', $user->codi_postal_fact) }}">
                                </div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-warning btn-lg mt-4 w-100">
                            <i class="bi bi-check-circle"></i> Confirmar compra
                        </button>
                        <p class="small text-muted mt-2 text-center">
                            Es considerarà que el pagament s'ha efectuat correctament.
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">Resum</div>
                <div class="card-body">
                    @foreach($productes as $item)
                        <div class="d-flex justify-content-between small mb-2">
                            <span>{{ $item['producte']->nom }} × {{ $item['quantitat'] }}</span>
                            <strong>{{ number_format($item['subtotal'], 2) }} €</strong>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <span class="preu">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
