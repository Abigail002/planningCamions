<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

/*         $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@medlog.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'contact' => '98788654',
        ]);
 */
        /*         $this->call([
            TrailerSeeder::class,
            TruckSeeder::class,
            ContainerTypeSeeder::class,
        ]);
 */
        $role = Role::create(['name' => 'CoordinationOfficer']);
        $role2 = Role::create(['name' => 'OperationOfficer']);
        //$user->assignRole($role);
    }
}
