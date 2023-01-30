<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();

        return redirect('/')->with('success', 'Log Out effettuato!');
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(){

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);



        if(! auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Errore nel login! Controlla le credenziali'
            ]);
        }

        session()->regenerate();

        if( ! User::find(auth()->user()->id)->isActive) {
            auth()->logout();
            throw ValidationException::withMessages([
                'email' => 'Il tuo account non è ancora attivo!'
            ]);
        }
        if (User::find(auth()->user()->id)->isAdmin) {
            return redirect('admin/boardgames')->with('success', 'Bentornato amministratore!');
        }
        return redirect('/')->with('success', 'Bentornato!');
    }
}
