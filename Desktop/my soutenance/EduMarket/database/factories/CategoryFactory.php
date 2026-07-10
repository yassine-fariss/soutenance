<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Livres',
            'Manuels Universitaires',
            'Fournitures Scolaires',
            'Calculatrices',
            'Outils de Dessin',
            'Kits Pédagogiques',
            'Papeterie',
            'Matériel de Classe',
            'Sciences et Expériences',
            'Langues Étrangères',
            'Informatique et Programmation',
            'Arts Créatifs',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
        ];
    }
}
