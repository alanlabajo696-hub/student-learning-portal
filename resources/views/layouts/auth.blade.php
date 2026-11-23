<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Welcome to LearnHub' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f1f5f9;
            color: #17233c;
        }
        .auth-panel {
            background: linear-gradient(145deg, #101f3d, #1e40af);
        }
        .auth-card {
            background: white;
            border-radius: 22px;
            box-shadow: 0 20px 60px rgba(15, 35, 70, .12);
        }
        .auth-button {
            background: #2563eb;
            color: white;
            border-radius: 10px;
            padding: 12px 18px;
            font-weight: 700;
        }
        .auth-button:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <main class="w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2">

            <section class="auth-panel hidden md:flex flex-col justify-between p-10 text-white">
                <div>
                    <a href="{{ route('login') }}" class="text-2xl font-extrabold tracking-tight">
                        <span class="text-blue-300">LEARN</span>HUB
                    </a>

                    <div class="mt-24">
                        <p class="text-sm font-bold uppercase tracking-[.25em] text-blue-200">
                            Learn. Connect. Grow.
                        </p>
                        <h1 class="mt-5 text-4xl font-extrabold leading-tight">
                            Your journey to knowledge starts here.
                        </h1>
                        <p class="mt-5 leading-7 text-blue-100">
                            Explore academic courses, connect with fellow students,
                            and make every learning opportunity count.
                        </p>
                    </div>
                </div>

                <p class="text-sm text-blue-200">
                    © {{ date('Y') }} LearnHub Student Portal
                </p>
            </section>

            <section class="p-7 sm:p-10 md:p-12">
                <div class="mb-8 md:hidden">
                    <a href="{{ route('login') }}" class="text-2xl font-extrabold">
                        <span class="text-blue-600">LEARN</span>HUB
                    </a>
                </div>

                @if(session('status'))
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-3 text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <p class="mb-1 font-bold">Please check your information.</p>
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </section>

        </div>
    </main>

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

            form.querySelectorAll('button[type="submit"], button:not([type])')
                .forEach(function (button) {
                    button.disabled = true;
                    button.classList.add('opacity-60', 'cursor-not-allowed');
                    button.innerText = 'Please wait...';
                });
        });
    </script>

</body>
</html>
