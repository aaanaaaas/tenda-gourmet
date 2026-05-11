<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Recuperació de clau</title></head>
<body style="font-family: Georgia, serif; background:#fffaf0; padding:20px;">
    <div style="max-width:600px; margin:0 auto; background:white; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <h1 style="color:#8b2635;">Recuperació de clau</h1>
        <p>Hola <strong>{{ $user->name }}</strong>,</p>
        <p>Has sol·licitat una nova clau per al teu compte. Aquí la tens:</p>
        <div style="background:#f4a261; color:white; padding:15px; font-size:1.3em; text-align:center; border-radius:8px; font-family:monospace; letter-spacing:2px;">
            {{ $novaClau }}
        </div>
        <p style="margin-top:20px;">Per seguretat, et recomanem que canviïs aquesta clau des de la teva àrea personal tan aviat com puguis.</p>
        <p>Si no has sol·licitat aquest canvi, contacta amb nosaltres immediatament.</p>
        <hr>
        <p style="color:#888; font-size:0.9em;">
            Aquest és un correu automàtic. Si us plau, no hi responguis directament.<br>
            <em>Tenda Gourmet © 2026</em>
        </p>
    </div>
</body>
</html>
