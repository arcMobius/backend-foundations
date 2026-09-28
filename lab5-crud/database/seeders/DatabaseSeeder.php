<?php
namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory(15)->create();
    }
}
