<?php

namespace Database\Seeders;

use Dotenv\Util\Str;
use Illuminate\Database\Seeder;
use Hash;
use DB;
use Faker\Factory as Faker; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')-> insert([
            'name' => 'Mulkis',
            'email' => 'mulkis@bit.com',
            'password' => Hash::make('uoj'),
        ]);

        $faker = Faker::create();
        $authors = 10;
        $publishers = 10;
        $books = 100;
        
        foreach (range(1, $authors) as $_) {
            DB::table('authors')-> insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'portrait' => $faker->imageUrl(180, 340),
            ]);
        }
        foreach (range(1, $publishers) as $_) {
            DB::table('publishers')-> insert([
                'title' => $faker->company(),
            ]);
        }
        foreach (range(1, $books) as $_) {
            DB::table('books')-> insert([
                'title' => str_replace(['.', "'", '"', '`', '(', ')'], '',$faker->realText(rand(10, 64))),
                'isbn' => $faker->isbn10(),
                'pages' => rand(12, 1499),
                'about' => $faker->realText(300, 4),
                'author_id' => rand(1, $authors),
                'publisher_id' => rand(1, $publishers),
            ]);
        }
    }
}
