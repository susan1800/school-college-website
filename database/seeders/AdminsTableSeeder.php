<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Admin::create([
            'name'      =>  $faker->name,
            'email'     =>  'admin@admin.com',
            'password'  =>  bcrypt('admin@password'),
            // 'status'    => '1',
        ]);
    }
}
