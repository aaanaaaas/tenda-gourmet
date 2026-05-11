<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Models\Seccio;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function perSeccio($slug)
    {
        $seccio = Seccio::where('slug', $slug)->firstOrFail();
        $productes = $seccio->productes()->paginate(12);
        $seccions = Seccio::all();

        return view('productes.index', [
            'productes' => $productes,
            'seccions' => $seccions,
            'titol' => $seccio->nom,
        ]);
    }

    public function cerca(Request $request)
    {
        $q = $request->input('q', '');
        $productes = Producte::where('nom', 'like', "%$q%")
            ->orWhere('descripcio', 'like', "%$q%")
            ->paginate(12);
        $seccions = Seccio::all();

        return view('productes.index', [
            'productes' => $productes,
            'seccions' => $seccions,
            'titol' => "Resultats per a: \"$q\"",
        ]);
    }

    public function mostrar($id)
    {
        $producte = Producte::with('seccio')->findOrFail($id);
        return view('productes.show', compact('producte'));
    }
}
