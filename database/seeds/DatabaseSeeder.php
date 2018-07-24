<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('categories')->insert(
            [
                'category' => 'СТИЛЬ ЖИЗНИ',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('categories')->insert(
        [
            'category' => 'ПРИРОДА',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
                'category' => 'НАУКА И ТЕХНОЛОГИИ',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
                'category' => 'СПОРТ',
                'created_at' => now(),
                'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'Test@mail.com',
            'password' => bcrypt('Test'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
