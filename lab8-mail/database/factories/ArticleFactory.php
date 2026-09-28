<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->date('d.m.Y'),
            'name' => $this->faker->sentence(4),
            'preview_image' => $this->faker->randomElement(['preview.jpg', 'preview_2.jpg']),
            'full_image' => $this->faker->randomElement(['full.jpeg', 'full_2.jpeg']),
            'shortDesc' => $this->faker->realText(50),
            'desc' => $this->faker->realText(200),
        ];
    }
}
