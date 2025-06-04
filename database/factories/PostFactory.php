<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    // Indique quel modèle cette factory fabrique
    protected $model = Post::class;

    // Définition des données factices générées
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),      // un titre aléatoire
            'content' => $this->faker->paragraph(),   // un paragraphe aléatoire
            // ajoute d'autres champs si nécessaire
        ];
    }
}
