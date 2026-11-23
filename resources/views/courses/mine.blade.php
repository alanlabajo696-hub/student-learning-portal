@extends('layouts.portal')

@section('content')
<div class="mb-8">
    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">My Learning</p>
    <h1 class="mt-2 text-3xl font-bold">My Enrolled Courses</h1>
    <p class="mt-2 portal-muted">All courses you have enrolled in.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($courses as $course)
        <div class="portal-card p-6">
            <div class="mb-4 flex items-center justify-between">
                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                    Enrolled
                </span>
                <span class="text-xs portal-muted">{{ $course->students_count }} student(s)</span>
            </div>

            <h2 class="text-xl font-bold">{{ $course->title }}</h2>
            <p class="mt-2 mb-6 text-sm portal-muted">You are currently enrolled in this academic course.</p>

            <form method="POST" action="{{ route('courses.unenroll', $course) }}" data-disable-on-submit>
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full rounded-lg border border-red-200 px-4 py-2 font-semibold text-red-600 hover:bg-red-50">
                    Unenroll from Course
                </button>
            </form>
        </div>
    @empty
        <div class="portal-card col-span-full p-10 text-center">
            <h2 class="text-lg font-semibold">You haven't enrolled in any courses yet.</h2>
            <p class="mt-2 mb-5 text-sm portal-muted">Explore the available courses to get started.</p>
            <a href="{{ route('courses.index') }}" class="portal-button">Browse Courses</a>
        </div>
    @endforelse
</div>
@endsection