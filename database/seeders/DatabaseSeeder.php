<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Pasidarau user name:edgaras psw:123
        DB::table('users')->insert([
            'name' => 'Edgaras',
            'email' => 'edgaras@example.com',
            'password' => Hash::make('123'),
        ]);

        $faker = Faker\Factory::create();
        // Sukuriam fake areas
        $areas =  array('Information Technology', 'Human Resources', 'Engineering/Mechanics', 'Sales', 'Marketing');
        foreach ($areas as $key => $area) {
            DB::table('areas')->insert([
                'title' => $area,
                'photo' => $key + 10 . '.jpg'
            ]);
        }
        // Sukuriam fake posts IT
        $posts =  array('PHP Developer', '.NET Developer', 'React Developer', 'Angular developer', 'Java Developer');
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post,
                'salary' => rand(600, 3000),
                'description' => '<p>'. $faker->paragraph() . '</p>',
                'area_id' => 1,
                'photo' => rand(1,4) . '.jpg'
            ]);
        }
        // Sukuriam fake posts HR
        $posts =  array('HR Specialist', 'Training Coordinator');
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post,
                'salary' => rand(600, 3000),
                'description' => '<p>'. $faker->paragraph() . '</p>',
                'area_id' => 2,
                'photo' => rand(1,4) . '.jpg'
            ]);
        }
        // Sukuriam fake posts ED
        $posts =  array('Engineering-Designer');
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post,
                'salary' => rand(600, 3000),
                'description' => '<p>'. $faker->paragraph() . '</p>',
                'area_id' => 3,
                'photo' => rand(1,4) . '.jpg'
            ]);
        }
        // Sukuriam fake posts sales
        $posts =  array('Sales maneger', 'Project manager');
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post,
                'salary' => rand(600, 3000),
                'description' => '<p>'. $faker->paragraph() . '</p>',
                'area_id' => 4,
                'photo' => rand(1,4) . '.jpg'
            ]);
        }
        // Sukuriam fake posts marketing
        $posts =  array('Marketing specialist');
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post,
                'salary' => rand(600, 3000),
                'description' => '<p>'. $faker->paragraph() . '</p>',
                'area_id' => 5,
                'photo' => rand(1,4) . '.jpg'
            ]);
        }
    }
}
