<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Producte;
use App\Models\Seccio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'nUsuaris' => User::count(),
            'nProductes' => Producte::count(),
            'nOfertes' => Oferta::count(),
        ]);
    }

    // --- PRODUCTES ---
    public function productes()
    {
        $productes = Producte::with('seccio')->paginate(20);
        return view('admin.productes.index', compact('productes'));
    }

    public function producteCreate()
    {
        $seccions = Seccio::all();
        return view('admin.productes.edit', ['producte' => new Producte(), 'seccions' => $seccions]);
    }

    public function producteStore(Request $request)
    {
        $data = $this->validarProducte($request);
        $data['destacat'] = $request->has('destacat');

        if ($request->hasFile('imatge')) {
            $data['imatge'] = $request->file('imatge')->store('productes', 'public');
        }

        Producte::create($data);
        return redirect()->route('admin.productes')->with('success', 'Producte creat.');
    }

    public function producteEdit($id)
    {
        $producte = Producte::findOrFail($id);
        $seccions = Seccio::all();
        return view('admin.productes.edit', compact('producte', 'seccions'));
    }

    public function producteUpdate(Request $request, $id)
    {
        $producte = Producte::findOrFail($id);
        $data = $this->validarProducte($request);
        $data['destacat'] = $request->has('destacat');

        if ($request->hasFile('imatge')) {
            if ($producte->imatge) Storage::disk('public')->delete($producte->imatge);
            $data['imatge'] = $request->file('imatge')->store('productes', 'public');
        }

        $producte->update($data);
        return redirect()->route('admin.productes')->with('success', 'Producte actualitzat.');
    }

    public function producteDestroy($id)
    {
        $p = Producte::findOrFail($id);
        if ($p->imatge) Storage::disk('public')->delete($p->imatge);
        $p->delete();
        return back()->with('success', 'Producte eliminat.');
    }

    private function validarProducte(Request $request): array
    {
        return $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'preu' => 'required|numeric|min:0',
            'seccio_id' => 'required|exists:seccions,id',
            'stock' => 'required|integer|min:0',
            'imatge' => 'nullable|image|max:2048',
        ]);
    }

    // --- USUARIS ---
    public function usuaris()
    {
        $usuaris = User::paginate(20);
        return view('admin.usuaris.index', compact('usuaris'));
    }

    public function usuariEdit($id)
    {
        $usuari = User::findOrFail($id);
        return view('admin.usuaris.edit', compact('usuari'));
    }

    public function usuariUpdate(Request $request, $id)
    {
        $usuari = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'tipus' => 'required|in:particular,empresa,admin',
        ]);
        $usuari->update($data);
        return redirect()->route('admin.usuaris')->with('success', 'Usuari actualitzat.');
    }

    // --- OFERTES ---
    public function ofertes()
    {
        $ofertes = Oferta::paginate(20);
        return view('admin.ofertes.index', compact('ofertes'));
    }

    public function ofertaCreate()
    {
        return view('admin.ofertes.edit', ['oferta' => new Oferta()]);
    }

    public function ofertaStore(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'missatge' => 'required|string',
            'imatge' => 'nullable|image|max:2048',
        ]);
        $data['activa'] = $request->has('activa');
        if ($request->hasFile('imatge')) {
            $data['imatge'] = $request->file('imatge')->store('ofertes', 'public');
        }
        Oferta::create($data);
        return redirect()->route('admin.ofertes')->with('success', 'Oferta creada.');
    }

    public function ofertaEdit($id)
    {
        $oferta = Oferta::findOrFail($id);
        return view('admin.ofertes.edit', compact('oferta'));
    }

    public function ofertaUpdate(Request $request, $id)
    {
        $oferta = Oferta::findOrFail($id);
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'missatge' => 'required|string',
            'imatge' => 'nullable|image|max:2048',
        ]);
        $data['activa'] = $request->has('activa');
        if ($request->hasFile('imatge')) {
            if ($oferta->imatge) Storage::disk('public')->delete($oferta->imatge);
            $data['imatge'] = $request->file('imatge')->store('ofertes', 'public');
        }
        $oferta->update($data);
        return redirect()->route('admin.ofertes')->with('success', 'Oferta actualitzada.');
    }

    public function ofertaDestroy($id)
    {
        $o = Oferta::findOrFail($id);
        if ($o->imatge) Storage::disk('public')->delete($o->imatge);
        $o->delete();
        return back()->with('success', 'Oferta eliminada.');
    }
}
