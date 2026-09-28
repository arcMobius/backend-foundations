<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Увеличиваем количество до 15 для проверки пагинации
        Article::factory(15)->create();
    }
}
