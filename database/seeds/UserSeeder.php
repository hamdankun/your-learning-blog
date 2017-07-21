<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10)->create();
        App\Models\User::create([
            'name' => 'hamdan',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
            'slug' => 'hamdan-hanafi'
        ]);
    }
}
