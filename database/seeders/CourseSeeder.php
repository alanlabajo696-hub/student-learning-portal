<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::firstOrCreate(['title' => 'BS Information Technology']);
        Course::firstOrCreate(['title' => 'Hospitality Management']);
        Course::firstOrCreate(['title' => 'Computer Science']);
        Course::firstOrCreate(['title' => 'Business Administration']);
    }
}