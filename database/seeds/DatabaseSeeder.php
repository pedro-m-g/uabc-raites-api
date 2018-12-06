<?php

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
        factory(App\User::class)->create([
            'email' => 'pedro.martindelcampo.gonzalez@gmail.com',
            'is_driver' => true
        ]);
        factory(App\User::class)->create([
            'email' => 'pedro.martin@uabc.edu.mx',
            'is_driver' => false
        ]);
    }
}
