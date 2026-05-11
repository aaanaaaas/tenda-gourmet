# Notes tècniques del projecte

## Apartat 7 — Cistella amb `$_COOKIE`

El projecte exigeix explícitament l'ús de la **variable superglobal `$_COOKIE`** de PHP. Laravel, per defecte, xifra totes les cookies mitjançant el middleware `EncryptCookies`, cosa que faria que `$_COOKIE['cistella_tenda']` retornés text xifrat inútil.

**Solució aplicada**: a `app/Http/Middleware/EncryptCookies.php` s'ha afegit `cistella_tenda` a l'array `$except`, de manera que aquesta cookie concreta no es xifra. Així, a `CistellaController`, es pot llegir directament:

```php
$cistella = json_decode($_COOKIE['cistella_tenda'], true);
```

I escriure amb `setcookie()` nativa de PHP, tal com demana el projecte.

## Apartat 12 — Verificació DNI

Implementat a `app/Helpers/DniHelper.php`:
- **DNI**: 8 dígits + lletra. Algoritme: `lletra = "TRWAGMYFPDXBNJZSQVHLCKE"[numero % 23]`.
- **NIE**: X/Y/Z + 7 dígits + lletra. Es converteix la primera lletra (X=0, Y=1, Z=2) i s'aplica el mateix algoritme.
- **CIF**: validació amb algoritme oficial (suma posicions parelles doblades + imparelles, mod 10).

S'usa a `CompraController::processar()` i a `CompteController::update()`.

## Apartat 11 — Correu

3 Mailables creats:
- `BenvingudaMail` — en crear compte
- `RecuperacioClauMail` — en sol·licitar nova clau
- `ConfirmacioCompraMail` — en finalitzar compra

Totes les crides a `Mail::to()->send()` estan dins de `try/catch` per no bloquejar el flux si SMTP falla.

**Recomanació**: fes servir **Mailtrap.io** en desenvolupament (gratuït). Configura `.env`:

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<el_teu_usuari>
MAIL_PASSWORD=<la_teva_clau>
MAIL_FROM_ADDRESS=noreply@tendagourmet.cat
```

## Apartat 14 — Mapa contacte

L'iframe apunta a una cerca genèrica de l'Institut de Lliçà. Abans d'entregar, substitueix-lo pel codi d'embed real de Google Maps (a Maps → Compartir → Incrustar mapa → copia el `<iframe>`).

## Apartat 17 — Bootstrap

Carregat via CDN a `resources/views/layouts/app.blade.php` per simplicitat (no cal Vite / npm). Versió 5.3.2 + Bootstrap Icons 1.11.

## Gestió d'imatges

Les imatges de productes i ofertes es guarden a `storage/app/public/`. Cal executar:

```bash
php artisan storage:link
```

Això crea l'enllaç simbòlic `public/storage` → `storage/app/public` perquè les imatges siguin accessibles via URL.

## Els apartats del PDF coberts

| # | Apartat | Estat |
|---|---------|-------|
| 1 | Capçalera (menú, cercador, logo, cistella) | ✅ |
| 2 | Peu de pàgina (nom © 2026, autors) | ✅ |
| 3 | Pàgina d'inici (ofertes, destacats, seccions) | ✅ |
| 4 | Seccions + cerca (amb cistella via `$_COOKIE`) | ✅ |
| 5 | Registre d'usuaris (valida duplicats) | ✅ |
| 6 | Log in (`$_SESSION` via `Auth::user()`, admin al menú si procedeix) | ✅ |
| 7 | Cistella amb `$_COOKIE` | ✅ |
| 8 | Pàgina de compra (dades precarregades, validacions) | ✅ |
| 9 | Gestió del compte | ✅ |
| 10 | Administració (CRUD productes, ofertes; edit usuaris) | ✅ |
| 11 | Correu (registre, recuperació, compra) | ✅ |
| 12 | Verificació DNI/NIE/CIF | ✅ |
| 13 | Recuperació de clau | ✅ |
| 14 | Contacte amb Maps | ✅ |
| 15 | Cookies i protecció de dades | ✅ |
| 16 | Laravel + Eloquent ORM | ✅ |
| 17 | Bootstrap 5.3 | ✅ |

## Abans d'entregar, revisa:

1. Substitueix `[El teu nom]` a `README.md` i al peu (`layouts/app.blade.php`) amb el teu nom real.
2. Posa l'iframe de Google Maps real (apartat 14).
3. Substitueix el correu `contacte@tendagourmet.cat` pel teu correu de l'INS Lliçà als apartats 14 i 15.
4. Prova que tots els correus arriben amb Mailtrap.
5. Puja-ho al domini.cat i comprova que tot funciona.
