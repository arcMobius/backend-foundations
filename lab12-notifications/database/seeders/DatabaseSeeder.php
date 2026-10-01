<?php
namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        Article::factory(15)->create();
    }
}
