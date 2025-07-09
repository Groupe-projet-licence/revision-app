<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Sheet;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        return redirect(RouteServiceProvider::HOME);
    }
}

       /* //Verifie si c'est la premiere connexion
        $utilisateur = Auth::user();

        if(!$utilisateur->has_seen_tutorial){
            //Cree une fiche par defaut
            Sheet::create([
                'title' => 'Bienvenue sur EasyLearning',
                'description' => 'Voici un exemple de fiche de revision',
                'content' => 'Ceci est une fiche de démonstration. Tu peux la supprimer ou en créer d\'autres !',
                'user_id' => $utilisateur->id,
                'category_id' => 1,
            ]);

            //Marquer comme vu (pour ne pas créer à chaque fois)
            $utilisateur->has_seen_tutorial = true;
            $utilisateur->save();
        }*/