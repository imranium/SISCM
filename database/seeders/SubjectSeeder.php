<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use Faker\Factory as FakerFactory;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $subjects = [
            'Mathematics',
            'Science',
            'Bahasa Melayu',
            'English',
            'History',
            'Geography',
            'Islamic Studies',
            'Moral Education',
            'Art Education',
            'Physical Education',
            'Sains Komputer',
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject,
                'subjectCode' => strtoupper($faker->lexify('???')) . $faker->randomNumber(5), 
                'credits_hours' => $faker->numberBetween(0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }        
    }
}
