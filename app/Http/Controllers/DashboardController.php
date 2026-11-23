<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => auth()->user()->name]
        );

        $stats = [
            'courses' => $student->courses()->count(),
            'available_courses' => Course::count(),
            'posts' => Post::count(),
            'students' => Student::count(),
        ];

        $recentPosts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('student', 'stats', 'recentPosts'));
    }
}