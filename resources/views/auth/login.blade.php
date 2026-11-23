@extends('layouts.auth')

@section('content')
<div>
    <p class="text-sm font-bold uppercase tracking-widest text-blue-600">Welcome Back</p>
    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">Sign In</h2>
    <p class="mt-2 text-sm text-slate-500">
        Enter your account details to continue learning.
    </p>
</div>

<form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5" data-disable-on-submit>
    @csrf

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
            Email Address
        </label>
        <input id="email"
               type="email"
               name="email"
               value="{{ old('email') }}"
               required
               autofocus
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
               autocomplete="current-password"
               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
    </div>

    <div class="flex items-center justify-between gap-3">
        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600">
            Remember me
        </label>

        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-sm font-semibold text-blue-600 hover:underline">
                Forgot password?
            </a>
        @endif
    </div>

    <button type="submit" class="auth-button w-full">
        Sign In to LearnHub
    </button>
</form>

<div class="mt-8 border-t border-slate-100 pt-6 text-center">
    <p class="text-sm text-slate-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">
            Create an account
        </a>
    </p>
</div>
@endsection
