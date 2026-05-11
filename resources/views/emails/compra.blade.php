<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Confirmació compra</title></head>
<body style="font-family: Georgia, serif; background:#fffaf0; padding:20px;">
    <div style="max-width:600px; margin:0 auto; background:white; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <h1 style="color:#8b2635;">Compra confirmada!</h1>
        <p>Hola <strong>{{ $comanda->nom_complet }}</strong>,</p>
        <p>Gràcies per la teva compra. La teva comanda <strong>#{{ $comanda->id }}</strong> s'ha registrat correctament.</p>

        <h3>Productes</h3>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#264653; color:white;">
                    <th style="padding:10px; text-align:left;">Producte</th>
                    <th style="padding:10px;">Q.</th>
                    <th style="padding:10px; text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comanda->productes as $p)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:10px;">{{ $p['nom'] }}</td>
                        <td style="padding:10px; text-align:center;">{{ $p['quantitat'] }}</td>
                        <td style="padding:10px; text-align:right;">{{ number_format($p['preu'] * $p['quantitat'], 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background:#f4a261; color:white; font-weight:bold;">
                    <td colspan="2" style="padding:10px;">TOTAL</td>
                    <td style="padding:10px; text-align:right;">{{ number_format($comanda->total, 2) }} €</td>
                </tr>
            </tfoot>
        </table>

        <h3 style="margin-top:25px;">Enviament</h3>
        <p>
            {{ $comanda->nom_complet }}<br>
            {{ $comanda->direccio }}<br>
            {{ $comanda->codi_postal }} {{ $comanda->poblacio }}<br>
            Telèfon: {{ $comanda->telefon }}
        </p>

        <p>T'avisarem quan la comanda surti cap a tu.</p>
        <hr>
        <p style="color:#888; font-size:0.9em;">
            Aquest és un correu automàtic. Si us plau, no hi responguis directament.<br>
            <em>Tenda Gourmet © 2026</em>
        </p>
    </div>
</body>
</html>
