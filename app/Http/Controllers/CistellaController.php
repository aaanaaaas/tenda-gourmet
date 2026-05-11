<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use Illuminate\Http\Request;

/**
 * Gestió de la cistella.
 * Apartat 7: el projecte exigeix explícitament l'ús de la variable $_COOKIE.
 * Per això, tot i que Laravel ofereix helpers de cookies, aquí accedim
 * directament a la superglobal $_COOKIE per a llegir, i a setcookie()
 * (via Cookie::queue que internament ho fa) per a escriure.
 */
class CistellaController extends Controller
{
    private const COOKIE_NAME = 'cistella_tenda';
    private const COOKIE_DAYS = 30;

    /**
     * Llegeix la cistella de $_COOKIE.
     * Retorna un array [producte_id => quantitat]
     */
    private function llegirCistella(): array
    {
        // Accés directe a $_COOKIE tal com demana el projecte
        if (!isset($_COOKIE[self::COOKIE_NAME])) {
            return [];
        }
        $decoded = json_decode($_COOKIE[self::COOKIE_NAME], true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Desa la cistella a una cookie del navegador.
     */
    private function desarCistella(array $cistella): void
    {
        $valor = json_encode($cistella);
        // setcookie modifica $_COOKIE en la següent petició
        setcookie(
            self::COOKIE_NAME,
            $valor,
            time() + (self::COOKIE_DAYS * 24 * 60 * 60),
            '/'
        );
        // També l'actualitzem per a la petició actual
        $_COOKIE[self::COOKIE_NAME] = $valor;
    }

    public function mostrar()
    {
        $cistella = $this->llegirCistella();
        $productes = [];
        $total = 0;

        if (!empty($cistella)) {
            $ids = array_keys($cistella);
            $trobats = Producte::whereIn('id', $ids)->get();
            foreach ($trobats as $p) {
                $quantitat = $cistella[$p->id] ?? 0;
                $subtotal = $p->preu * $quantitat;
                $total += $subtotal;
                $productes[] = [
                    'producte' => $p,
                    'quantitat' => $quantitat,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cistella.index', compact('productes', 'total'));
    }

    public function afegir(Request $request, $id)
    {
        Producte::findOrFail($id); // comprovem que existeix
        $cistella = $this->llegirCistella();
        $quantitat = (int) $request->input('quantitat', 1);
        $cistella[$id] = ($cistella[$id] ?? 0) + $quantitat;
        $this->desarCistella($cistella);

        return redirect()->back()->with('success', 'Producte afegit a la cistella!');
    }

    public function treure($id)
    {
        $cistella = $this->llegirCistella();
        unset($cistella[$id]);
        $this->desarCistella($cistella);

        return redirect()->route('cistella.mostrar');
    }

    public function actualitzar(Request $request, $id)
    {
        $cistella = $this->llegirCistella();
        $quantitat = max(0, (int) $request->input('quantitat', 1));

        if ($quantitat === 0) {
            unset($cistella[$id]);
        } else {
            $cistella[$id] = $quantitat;
        }

        $this->desarCistella($cistella);
        return redirect()->route('cistella.mostrar');
    }

    public function buidar()
    {
        setcookie(self::COOKIE_NAME, '', time() - 3600, '/');
        unset($_COOKIE[self::COOKIE_NAME]);
        return redirect()->route('cistella.mostrar');
    }

    /**
     * Mètode auxiliar per al layout: nombre d'articles a la cistella.
     */
    public static function totalArticles(): int
    {
        if (!isset($_COOKIE[self::COOKIE_NAME])) {
            return 0;
        }
        $cistella = json_decode($_COOKIE[self::COOKIE_NAME], true) ?? [];
        return array_sum($cistella);
    }
}
