<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $student = Student::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => auth()->user()->name]
        );

        $courses = Course::withCount('students')
            ->withExists([
                'students as is_enrolled' => fn ($query) =>
                    $query->where('students.id', $student->id)
            ])
            ->orderBy('title')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function myCourses()
    {
        $student = Student::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => auth()->user()->name]
        );

        $courses = $student->courses()->withCount('students')->get();

        return view('courses.mine', compact('courses'));
    }

    public function enroll(Course $course)
    {
        $student = Student::firstOrCreate(
            ['user_id' => auth()->id()],
            ['name' => auth()->user()->name]
        );

        $student->courses()->syncWithoutDetaching([$course->id]);

        return back()->with('success', 'You have successfully enrolled in this course.');
    }

    public function unenroll(Course $course)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $student->courses()->detach($course->id);

        return back()->with('success', 'You have unenrolled from this course.');
    }
}