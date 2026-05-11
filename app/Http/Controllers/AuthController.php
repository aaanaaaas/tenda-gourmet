<?php

namespace App\Http\Controllers;

use App\Mail\BenvingudaMail;
use App\Mail\RecuperacioClauMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // --- LOGIN ---
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // La info de l'usuari queda a $_SESSION automàticament via Auth::user()
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Les credencials no són correctes.',
        ])->onlyInput('email');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // --- REGISTRE ---
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipus' => 'particular',
        ]);

        // Correu de benvinguda (apartat 11)
        try {
            Mail::to($user->email)->send(new BenvingudaMail($user));
        } catch (\Exception $e) {
            // No bloquegem el registre si el correu falla
            logger()->error('Error enviant correu benvinguda: ' . $e->getMessage());
        }

        Auth::login($user);
        return redirect('/')->with('success', 'Compte creat correctament!');
    }

    // --- RECUPERACIÓ DE CLAU (apartat 13) ---
    public function forgotForm()
    {
        return view('auth.forgot');
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No existeix cap usuari amb aquest correu.']);
        }

        // Generem una clau genèrica nova
        $novaClau = Str::random(10);
        $user->password = Hash::make($novaClau);
        $user->save();

        try {
            Mail::to($user->email)->send(new RecuperacioClauMail($user, $novaClau));
        } catch (\Exception $e) {
            logger()->error('Error correu recuperació: ' . $e->getMessage());
        }

        return redirect('/login')->with('success', "S'ha enviat la nova clau al teu correu.");
    }
}
