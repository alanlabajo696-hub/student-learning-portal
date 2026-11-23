@extends('layouts.auth')

@section('content')
<div>
    <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Join LearnHub</p>
    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">Create Account</h2>
    <p class="mt-2 text-sm text-slate-500">
        Register as a student and start your learning journey.
    </p>
</div>

<form method="POST" action="{{ route('register') }}" class="mt-7 space-y-4" data-disable-on-submit>
    @csrf

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
            Full Name
        </label>
        <input id="name"
               type="text"
               name="name"
               value="{{ old('name') }}"
               required
               autofocus
               autocomplete="name"
               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
            Email Address
        </label>
        <input id="email"
               type="email"
               name="email"
               value="{{ old('email') }}"
               required
               autocomplete="username"
               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div>
        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
            Password
        </label>
        <input id="password"
               type="password"
               name="password"
               required
               autocomplete="new-password"
               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div>
        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
            Confirm Password
        </label>
        <input id="password_confirmation"
               type="password"
               name="password_confirmation"
               required
               autocomplete="new-password"
               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <button type="submit" class="auth-button w-full">
        Create My Account
    </button>
</form>

<div class="mt-7 border-t border-slate-100 pt-6 text-center">
    <p class="text-sm text-slate-500">
        Already registered?
        <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline">
            Sign in instead
        </a>
    </p>
</div>
@endsection
