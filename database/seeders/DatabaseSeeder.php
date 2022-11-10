<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->withPersonalTeam()->create();
         \App\Models\User::factory(10)->create();
         \App\Models\Team::factory(10)->create();

/*         \App\Models\User::factory()->create([
             'name' => 'Test User',
            'email' => 'test@example.com',
         ]);*/

        $this->call([
            MotivoSeeder::class,
            ZonaSeeder::class,
            DependenciaSeeder::class,
            ProgramaSeeder::class,
            ZonaDependenciaSeeder::class,
        ]);

    }
}
