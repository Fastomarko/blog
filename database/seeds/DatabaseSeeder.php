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
        // $this->call(UsersTableSeeder::class);
        DB::table(categories)->insert
        ([
           'category'=>'LIFE STYLE'
        ]);

        DB::table(categories)->insert
        ([
            'category'=>'NATURE'
        ]);

        DB::table(categories)->insert
        ([
            'category'=>'SCIENCE AND TECHNOLOGY'
        ]);

        DB::table(categories)->insert
        ([
            'category'=>'SPORTS'
        ]);
    }
}
