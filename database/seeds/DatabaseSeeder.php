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
                'category' => 'LIFE STYLE',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('categories')->insert(
        [
            'category' => 'NATURE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
                'category' => 'SCIENCE AND TECHNOLOGY',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
                'category' => 'SPORTS',
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
