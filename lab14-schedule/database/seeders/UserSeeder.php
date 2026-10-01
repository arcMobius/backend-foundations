<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder {
    public function run(): void {
        $moderatorRole = Role::where('name', 'moderator')->first();
        User::create([
            'name' => 'Главный Модератор',
            'email' => 'mod@admin.com',
            'password' => Hash::make('123456'),
            'role_id' => $moderatorRole ? $moderatorRole->id : 1
        ]);
    }
}
