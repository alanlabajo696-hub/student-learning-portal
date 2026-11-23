<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Student Learning Portal' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background: #f4f7fb; color: #17233c; }
        .portal-nav { background: #101f3d; }
        .portal-link { color: #cbd5e1; transition: .2s; }
        .portal-link:hover, .portal-link.active { color: white; background: #263b60; }
        .portal-card { background: white; border: 1px solid #e7edf5; border-radius: 18px; box-shadow: 0 5px 20px rgba(20,40,80,.04); }
        .portal-button { background: #2563eb; color: white; border-radius: 10px; padding: 10px 17px; font-weight: 600; }
        .portal-button:hover { background: #1d4ed8; }
        .portal-muted { color: #718096; }
        input, textarea, select { border-radius: 10px !important; }
    </style>
</head>
<body class="min-h-screen">

    <nav class="portal-nav text-white">
        <div class="max-w-7xl mx-auto px-5 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight">
                <span class="text-blue-400">LEARN</span>HUB
            </a>

            <div class="flex flex-wrap items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="portal-link rounded-lg px-3 py-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('courses.index') }}"
                   class="portal-link rounded-lg px-3 py-2 {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    Courses
                </a>

                <a href="{{ route('posts.index') }}"
                   class="portal-link rounded-lg px-3 py-2 {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                    Discussions
                </a>

                <a href="{{ route('student-profile.edit') }}"
                   class="portal-link rounded-lg px-3 py-2 {{ request()->routeIs('student-profile.*') ? 'active' : '' }}">
                    My Profile
                </a>

                <span class="hidden md:inline text-slate-400 mx-2">|</span>
                <span class="text-slate-200">{{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" data-disable-on-submit>
                    @csrf
                    <button type="submit" class="ml-2 rounded-lg bg-red-500/90 px-3 py-2 text-white hover:bg-red-600">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-5 py-8">
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-red-700">
                <p class="font-semibold mb-1">Please check the following:</p>
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-12 border-t border-slate-200 bg-white py-6 text-center text-sm portal-muted">
        © {{ date('Y') }} LearnHub — Student Learning and Academic Portal
    </footer>

    <script>
        document.addEventListener('submit', function (event) {
            const form = event.target;

            if (!form.matches('[data-disable-on-submit]')) {
                return;
            }

            if (form.dataset.submitting === 'true') {
                event.preventDefault();
                return;
            }

            form.dataset.submitting = 'true';

            const buttons = form.querySelectorAll('button[type="submit"], button:not([type])');

            buttons.forEach(function (button) {
                button.disabled = true;
                button.classList.add('opacity-60', 'cursor-not-allowed');
                button.dataset.originalText = button.innerText;
                button.innerText = 'Processing...';
            });
        });
    </script>
</body>
</html>