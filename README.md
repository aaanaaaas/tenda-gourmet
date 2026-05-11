# Tenda Gourmet — Projecte Final PHP

E-commerce de productes gourmet fet amb **Laravel 10** i **Bootstrap 5.3**.
Projecte per al mòdul M09 - Implantació d'aplicacions web (CFGS ASIX - Ciberseguretat).

## Requisits
- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js (opcional, només si vols compilar assets)

## Instal·lació pas a pas

### 1. Crear el projecte base de Laravel
Els arxius d'aquest repositori són els **arxius personalitzats** del projecte. Primer has de crear un projecte Laravel en blanc i després copiar-hi aquests arxius a sobre.

```bash
composer create-project laravel/laravel tenda-gourmet "10.*"
cd tenda-gourmet
```

### 2. Copiar els arxius del projecte
Copia tot el contingut d'aquest ZIP dins de la carpeta `tenda-gourmet/`, sobreescrivint els que ja existeixen.

### 3. Instal·lar dependències
```bash
composer install
```

### 4. Configurar l'entorn
```bash
cp .env.example .env
php artisan key:generate
```

Edita `.env` i configura la base de dades:
```
DB_DATABASE=tenda_gourmet
DB_USERNAME=el_teu_usuari
DB_PASSWORD=la_teva_clau
```

Per al correu, fes servir Mailtrap (gratuït per a desenvolupament):
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=el_teu_mailtrap
MAIL_PASSWORD=la_teva_clau
MAIL_FROM_ADDRESS=noreply@tendagourmet.cat
MAIL_FROM_NAME="Tenda Gourmet"
```

### 5. Crear la base de dades
```bash
mysql -u root -p -e "CREATE DATABASE tenda_gourmet CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
php artisan db:seed
```

### 6. Crear enllaç simbòlic per a imatges
```bash
php artisan storage:link
```

### 7. Arrencar el servidor
```bash
php artisan serve
```

Obre http://localhost:8000

## Credencials per defecte (seeder)

- **Administrador**: `admin@tendagourmet.cat` / `admin1234`
- **Usuari particular**: `user@test.cat` / `user1234`

## Desplegament a domini.cat

1. Puja els arxius per FTP/SSH a la carpeta `public_html` (o equivalent).
2. Configura l'arrel del domini apuntant a `/public`.
3. Copia `.env.example` a `.env` i configura-ho amb les dades del servidor.
4. Executa `composer install --no-dev --optimize-autoloader`.
5. Executa les migracions: `php artisan migrate --force && php artisan db:seed --force`.
6. Assegura't que les carpetes `storage/` i `bootstrap/cache/` tenen permisos d'escriptura.

## Apartats del projecte implementats

| # | Apartat | Fitxer principal |
|---|---------|------------------|
| 1 | Capçalera | `resources/views/layouts/app.blade.php` |
| 2 | Peu de pàgina | `resources/views/layouts/app.blade.php` |
| 3 | Pàgina d'inici | `resources/views/home.blade.php` |
| 4 | Seccions i cerca | `resources/views/productes/index.blade.php` |
| 5 | Registre | `resources/views/auth/register.blade.php` |
| 6 | Log in | `resources/views/auth/login.blade.php` |
| 7 | Cistella ($_COOKIE) | `app/Http/Controllers/CistellaController.php` |
| 8 | Pàgina de compra | `resources/views/compra/checkout.blade.php` |
| 9 | Gestió del compte | `resources/views/compte/edit.blade.php` |
| 10 | Administració | `resources/views/admin/*` |
| 11 | Correu | `app/Mail/*` |
| 12 | Verificació DNI | `app/Helpers/DniHelper.php` |
| 13 | Recuperació clau | `resources/views/auth/forgot.blade.php` |
| 14 | Contacte | `resources/views/contacte.blade.php` |
| 15 | Cookies | `resources/views/cookies.blade.php` |
| 16 | Laravel + Eloquent | Tot el projecte |
| 17 | Bootstrap 5.3 | `resources/views/layouts/app.blade.php` |

## Autors
[El teu nom] — CFGS ASIX Ciberseguretat — Institut de Lliçà — 2026
