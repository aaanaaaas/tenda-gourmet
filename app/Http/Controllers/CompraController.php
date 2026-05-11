<?php

namespace App\Http\Controllers;

use App\Helpers\DniHelper;
use App\Mail\ConfirmacioCompraMail;
use App\Models\Comanda;
use App\Models\Producte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class CompraController extends Controller
{
    private const COOKIE_NAME = 'cistella_tenda';

    private function llegirCistella(): array
    {
        if (!isset($_COOKIE[self::COOKIE_NAME])) return [];
        $d = json_decode($_COOKIE[self::COOKIE_NAME], true);
        return is_array($d) ? $d : [];
    }

    public function checkout()
    {
        $cistella = $this->llegirCistella();
        if (empty($cistella)) {
            return redirect()->route('cistella.mostrar')
                ->with('error', 'La cistella està buida.');
        }

        $productes = [];
        $total = 0;
        $trobats = Producte::whereIn('id', array_keys($cistella))->get();
        foreach ($trobats as $p) {
            $q = $cistella[$p->id] ?? 0;
            $total += $p->preu * $q;
            $productes[] = ['producte' => $p, 'quantitat' => $q, 'subtotal' => $p->preu * $q];
        }

        return view('compra.checkout', [
            'productes' => $productes,
            'total' => $total,
            'user' => auth()->user(),
        ]);
    }

    public function processar(Request $request)
    {
        $rules = [
            'nom_complet' => 'required|string|max:255',
            'dni' => ['required', 'string', 'size:9'],
            'telefon' => ['required', 'string', 'regex:/^[0-9]{9}$/'],
            'direccio' => 'required|string|max:255',
            'poblacio' => 'required|string|max:100',
            'codi_postal' => ['required', 'string', 'regex:/^[0-9]{5}$/'],
        ];

        // Si és empresa, requerim també facturació
        if (auth()->user()->esEmpresa()) {
            $rules['cif'] = ['required', 'string', 'size:9'];
            $rules['rao_social'] = 'required|string|max:255';
            $rules['direccio_fact'] = 'required|string|max:255';
            $rules['poblacio_fact'] = 'required|string|max:100';
            $rules['codi_postal_fact'] = ['required', 'string', 'regex:/^[0-9]{5}$/'];
        }

        $data = $request->validate($rules);

        // Verificació real del DNI (apartat 12)
        if (!DniHelper::verificarDni($data['dni'])) {
            return back()->withErrors(['dni' => 'El DNI introduït no és vàlid.'])->withInput();
        }

        if (auth()->user()->esEmpresa() && !DniHelper::verificarCif($data['cif'])) {
            return back()->withErrors(['cif' => 'El CIF introduït no és vàlid.'])->withInput();
        }

        // Recuperem cistella i creem comanda
        $cistella = $this->llegirCistella();
        if (empty($cistella)) {
            return redirect()->route('cistella.mostrar');
        }

        $productesSnapshot = [];
        $total = 0;
        $trobats = Producte::whereIn('id', array_keys($cistella))->get();
        foreach ($trobats as $p) {
            $q = $cistella[$p->id] ?? 0;
            $total += $p->preu * $q;
            $productesSnapshot[] = [
                'id' => $p->id,
                'nom' => $p->nom,
                'preu' => $p->preu,
                'quantitat' => $q,
            ];
        }

        $comanda = Comanda::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'nom_complet' => $data['nom_complet'],
            'dni' => strtoupper($data['dni']),
            'telefon' => $data['telefon'],
            'direccio' => $data['direccio'],
            'poblacio' => $data['poblacio'],
            'codi_postal' => $data['codi_postal'],
            'productes' => $productesSnapshot,
        ]);

        // Buidem cistella
        setcookie(self::COOKIE_NAME, '', time() - 3600, '/');
        unset($_COOKIE[self::COOKIE_NAME]);

        // Correu de confirmació (apartat 11)
        try {
            Mail::to(auth()->user()->email)->send(new ConfirmacioCompraMail($comanda));
        } catch (\Exception $e) {
            logger()->error('Error correu compra: ' . $e->getMessage());
        }

        return redirect()->route('compra.confirmacio', $comanda->id);
    }

    public function confirmacio($id)
    {
        $comanda = Comanda::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('compra.confirmacio', compact('comanda'));
    }
}
