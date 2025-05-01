<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Lecturer;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = FakerFactory::create('ms_MY');
        $genders = ['male', 'female'];

        for ($i = 0; $i < 15; $i++) {
            $gender = $faker->randomElement($genders);
            $title = $gender === 'male' ? $faker->randomElement(['Dr.', 'Mr.', 'Prof.']) : $faker->randomElement(['Dr.', 'Ms.', 'Mrs.', 'Prof.']);
            $firstName = $faker->firstName($gender);
            $lastName = $faker->lastName();

            Lecturer::create([
                'staffId' => $faker->unique()->numerify('STAF###'),
                'name' => trim("$title $firstName $lastName"),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Lecturer::create([
            'staffId' => 'STAF001',
            'name' => 'Prof. Dr. Siti Fatimah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
