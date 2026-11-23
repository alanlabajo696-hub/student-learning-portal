@extends('layouts.portal')

@section('content')
<div class="mb-8">
    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Account Settings</p>
    <h1 class="mt-2 text-3xl font-bold">Student Profile</h1>
    <p class="mt-2 portal-muted">Manage your personal and contact information.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="portal-card p-6 h-fit text-center">
        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 text-3xl font-bold text-blue-700">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <h2 class="mt-4 text-xl font-bold">{{ $user->name }}</h2>
        <p class="mt-1 text-sm portal-muted">{{ $user->email }}</p>

        <div class="mt-5 rounded-xl bg-slate-50 p-4 text-left">
            <p class="text-xs uppercase tracking-wide portal-muted">Student ID</p>
            <p class="mt-1 font-semibold">STU-{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <div class="portal-card lg:col-span-2 p-7">
        <h2 class="text-xl font-bold">Personal Information</h2>
        <p class="mt-1 mb-6 text-sm portal-muted">Update the information associated with your student account.</p>

        <form method="POST" action="{{ route('student-profile.update') }}" data-disable-on-submit>
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="name" class="mb-2 block text-sm font-semibold">Full Name</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $user->name) }}"
                       class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                       required maxlength="255">
            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 block text-sm font-semibold">Email Address</label>
                <input id="email" type="email" value="{{ $user->email }}"
                       class="w-full border-slate-200 bg-slate-100 text-slate-500"
                       disabled>
                <p class="mt-1 text-xs portal-muted">Your registered email address is displayed here.</p>
            </div>

            <div class="mb-6">
                <label for="phone_number" class="mb-2 block text-sm font-semibold">Phone Number</label>
                <input id="phone_number" name="phone_number" type="text"
                       value="{{ old('phone_number', $phone?->phone_number) }}"
                       class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                       maxlength="30" placeholder="Enter your contact number">
            </div>

            <button type="submit" class="portal-button">Save Changes</button>
        </form>
    </div>
</div>
@endsection