@extends('layouts.portal')

@section('content')
<div class="mb-8">
    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Student Portal</p>
    <h1 class="mt-2 text-3xl font-bold text-slate-900">
        Welcome back, {{ Auth::user()->name }}!
    </h1>
    <p class="mt-2 portal-muted">Here's an overview of your learning activities.</p>
</div>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <div class="portal-card p-6">
        <p class="text-sm portal-muted">My Enrolled Courses</p>
        <p class="mt-3 text-3xl font-bold text-blue-600">{{ $stats['courses'] }}</p>
    </div>

    <div class="portal-card p-6">
        <p class="text-sm portal-muted">Available Courses</p>
        <p class="mt-3 text-3xl font-bold text-indigo-600">{{ $stats['available_courses'] }}</p>
    </div>

    <div class="portal-card p-6">
        <p class="text-sm portal-muted">Community Discussions</p>
        <p class="mt-3 text-3xl font-bold text-purple-600">{{ $stats['posts'] }}</p>
    </div>

    <div class="portal-card p-6">
        <p class="text-sm portal-muted">Registered Students</p>
        <p class="mt-3 text-3xl font-bold text-emerald-600">{{ $stats['students'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="portal-card lg:col-span-2 p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold">Recent Discussions</h2>
                <p class="text-sm portal-muted mt-1">See what students are talking about.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                View all
            </a>
        </div>

        @forelse($recentPosts as $post)
            <a href="{{ route('posts.show', $post) }}" class="block border-b border-slate-100 py-4 last:border-0">
                <h3 class="font-semibold text-slate-800">{{ $post->title }}</h3>
                <p class="mt-1 text-sm portal-muted">
                    By {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-2 text-sm text-slate-600">
                    {{ \Illuminate\Support\Str::limit($post->body, 110) }}
                </p>
            </a>
        @empty
            <p class="py-8 text-center portal-muted">No discussions yet. Start the first conversation!</p>
        @endforelse
    </div>

    <div class="portal-card p-6">
        <h2 class="text-xl font-bold">Quick Actions</h2>
        <p class="mt-1 mb-5 text-sm portal-muted">Continue your academic activities.</p>

        <div class="space-y-3">
            <a href="{{ route('courses.index') }}" class="block rounded-xl bg-blue-50 p-4 hover:bg-blue-100">
                <p class="font-semibold text-blue-800">Explore Courses</p>
                <p class="mt-1 text-sm text-blue-600">Find and enroll in courses.</p>
            </a>

            <a href="{{ route('courses.mine') }}" class="block rounded-xl bg-indigo-50 p-4 hover:bg-indigo-100">
                <p class="font-semibold text-indigo-800">My Courses</p>
                <p class="mt-1 text-sm text-indigo-600">View your enrolled courses.</p>
            </a>

            <a href="{{ route('student-profile.edit') }}" class="block rounded-xl bg-emerald-50 p-4 hover:bg-emerald-100">
                <p class="font-semibold text-emerald-800">Update Profile</p>
                <p class="mt-1 text-sm text-emerald-600">Manage your student information.</p>
            </a>
        </div>
    </div>
</div>
@endsection