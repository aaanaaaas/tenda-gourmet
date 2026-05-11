<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Producte;
use App\Models\Seccio;

class HomeController extends Controller
{
    public function index()
    {
        $ofertes = Oferta::where('activa', true)->get();
        $destacats = Producte::destacats()->with('seccio')->take(6)->get();
        $seccions = Seccio::all();

        return view('home', compact('ofertes', 'destacats', 'seccions'));
    }

    public function contacte()
    {
        return view('contacte');
    }

    public function cookies()
    {
        return view('cookies');
    }
}
