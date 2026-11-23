@extends('layouts.portal')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-8">
    <div>
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Learning Center</p>
        <h1 class="mt-2 text-3xl font-bold">Explore Courses</h1>
        <p class="mt-2 portal-muted">Discover courses and enroll in your preferred program.</p>
    </div>

    <a href="{{ route('courses.mine') }}" class="portal-button">My Enrollments</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($courses as $course)
        <div class="portal-card overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-indigo-700 p-6 text-white">
                <p class="text-sm text-blue-200">ACADEMIC COURSE</p>
                <h2 class="mt-3 text-xl font-bold">{{ $course->title }}</h2>
            </div>

            <div class="p-6">
                <p class="text-sm portal-muted mb-5">
                    {{ $course->students_count }} student(s) enrolled
                </p>

                @if($course->is_enrolled)
                    <div class="mb-4 rounded-lg bg-green-50 px-4 py-2 text-sm font-semibold text-green-700">
                        You are enrolled in this course.
                    </div>

                    <form method="POST" action="{{ route('courses.unenroll', $course) }}" data-disable-on-submit>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-lg border border-red-200 px-4 py-2 font-semibold text-red-600 hover:bg-red-50">
                            Unenroll
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('courses.enroll', $course) }}" data-disable-on-submit>
                        @csrf
                        <button type="submit" class="portal-button w-full">Enroll Now</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="portal-card col-span-full p-10 text-center portal-muted">
            No courses are available at the moment.
        </div>
    @endforelse
</div>
@endsection