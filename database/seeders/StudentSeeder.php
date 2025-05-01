<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as FakerFactory;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create('ms_MY');

        for ($i = 0; $i < 20; $i++) {
            Student::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'studentId' => $faker->unique()->numberBetween(100000, 999999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
