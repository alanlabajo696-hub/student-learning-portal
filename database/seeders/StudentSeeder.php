<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        for ($i = 1; $i <= 5; $i++) {
            $user = User::firstOrCreate(
                ['email' => "student{$i}@example.com"],
                [
                    'name' => "Student {$i}",
                    'password' => Hash::make('Student123!'),
                ]
            );

            $student = Student::firstOrCreate(
                ['user_id' => $user->id],
                ['name' => $user->name]
            );

            $student->courses()->syncWithoutDetaching(
                $courses->random(rand(1, min(2, $courses->count())))->modelKeys()
            );
        }
    }
}