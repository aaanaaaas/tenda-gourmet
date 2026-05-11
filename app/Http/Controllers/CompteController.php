<?php

namespace App\Http\Controllers;

use App\Helpers\DniHelper;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function edit()
    {
        return view('compte.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'nom_complet' => 'nullable|string|max:255',
            'dni' => 'nullable|string|size:9',
            'telefon' => ['nullable', 'regex:/^[0-9]{9}$/'],
            'direccio' => 'nullable|string|max:255',
            'poblacio' => 'nullable|string|max:100',
            'codi_postal' => ['nullable', 'regex:/^[0-9]{5}$/'],
        ];

        if ($user->esEmpresa()) {
            $rules['cif'] = 'nullable|string|size:9';
            $rules['rao_social'] = 'nullable|string|max:255';
            $rules['direccio_fact'] = 'nullable|string|max:255';
            $rules['poblacio_fact'] = 'nullable|string|max:100';
            $rules['codi_postal_fact'] = ['nullable', 'regex:/^[0-9]{5}$/'];
        }

        $data = $request->validate($rules);

        // Verificació DNI si s'ha omplert
        if (!empty($data['dni']) && !DniHelper::verificarDni($data['dni'])) {
            return back()->withErrors(['dni' => 'DNI no vàlid.'])->withInput();
        }

        if ($user->esEmpresa() && !empty($data['cif']) && !DniHelper::verificarCif($data['cif'])) {
            return back()->withErrors(['cif' => 'CIF no vàlid.'])->withInput();
        }

        // L'usuari NO pot canviar-se a admin
        $user->fill($data);
        $user->save();

        return back()->with('success', 'Dades actualitzades correctament.');
    }
}
