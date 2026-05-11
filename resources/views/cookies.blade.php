@extends('layouts.app')
@section('titol', 'Política de cookies i protecció de dades')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Política de cookies i protecció de dades</h1>

    <div class="card p-4">
        <h3>1. Què són les cookies?</h3>
        <p>Les cookies són petits fitxers de text que s'emmagatzemen al teu navegador quan visites el nostre lloc web. Serveixen per recordar preferències, millorar la teva experiència i permetre funcionalitats com la cistella de la compra.</p>

        <h3>2. Quines cookies utilitzem?</h3>
        <ul>
            <li><strong>Cookie <code>cistella_tenda</code></strong> — Imprescindible. Guarda els productes que afegeixes a la cistella. Durada: 30 dies.</li>
            <li><strong>Cookie <code>laravel_session</code></strong> — Imprescindible. Gestiona la sessió d'usuari. Durada: 2 hores.</li>
            <li><strong>Cookie <code>XSRF-TOKEN</code></strong> — Imprescindible. Protecció contra atacs CSRF.</li>
        </ul>

        <h3>3. Protecció de dades (RGPD)</h3>
        <p>En conformitat amb el Reglament General de Protecció de Dades (UE 2016/679) i la LOPDGDD (Llei Orgànica 3/2018):</p>
        <ul>
            <li><strong>Responsable:</strong> Tenda Gourmet — Institut de Lliçà</li>
            <li><strong>Finalitat:</strong> Gestió de comandes i comunicació amb el client.</li>
            <li><strong>Legitimació:</strong> Execució del contracte de compra i consentiment explícit en el registre.</li>
            <li><strong>Destinataris:</strong> No se cediran dades a tercers, excepte obligació legal.</li>
            <li><strong>Drets:</strong> Pots exercir els drets d'accés, rectificació, supressió, oposició, portabilitat i limitació del tractament escrivint a <strong>contacte@tendagourmet.cat</strong>.</li>
            <li><strong>Conservació:</strong> Les dades es conserven durant el temps necessari per a complir amb la finalitat i les obligacions legals.</li>
        </ul>

        <h3>4. Com desactivar les cookies</h3>
        <p>Pots desactivar o eliminar les cookies des de la configuració del teu navegador. Tingues en compte que, si desactives cookies imprescindibles, algunes funcionalitats (com la cistella) no funcionaran correctament.</p>

        <h3>5. Contacte</h3>
        <p>Per qualsevol dubte sobre aquesta política, pots contactar-nos a <strong>contacte@tendagourmet.cat</strong>.</p>
    </div>
</div>
@endsection
