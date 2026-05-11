<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Benvinguda</title></head>
<body style="font-family: Georgia, serif; background:#fffaf0; padding:20px;">
    <div style="max-width:600px; margin:0 auto; background:white; padding:30px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <h1 style="color:#8b2635;">Benvingut/da a Tenda Gourmet!</h1>
        <p>Hola <strong>{{ $user->name }}</strong>,</p>
        <p>El teu compte s'ha creat correctament. Ja pots gaudir dels nostres productes gourmet i fer les teves primeres comandes.</p>
        <p>Dades del teu compte:</p>
        <ul>
            <li><strong>Usuari:</strong> {{ $user->name }}</li>
            <li><strong>Correu:</strong> {{ $user->email }}</li>
        </ul>
        <p>Si tens qualsevol dubte, respon aquest correu o contacta'ns.</p>
        <hr>
        <p style="color:#888; font-size:0.9em;">
            Aquest és un correu automàtic. Si us plau, no hi responguis directament.<br>
            <em>Tenda Gourmet © 2026</em>
        </p>
    </div>
</body>
</html>
