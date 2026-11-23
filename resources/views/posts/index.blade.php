@extends('layouts.portal')

@section('content')
<div class="mb-8">
    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Student Community</p>
    <h1 class="mt-2 text-3xl font-bold">Academic Discussions</h1>
    <p class="mt-2 portal-muted">Share ideas, ask questions, and learn together.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="portal-card lg:col-span-1 p-6 h-fit">
        <h2 class="text-xl font-bold mb-2">Start a Discussion</h2>
        <p class="text-sm portal-muted mb-5">Share a question, idea, or academic topic with other students.</p>

        <form method="POST" action="{{ route('posts.store') }}" data-disable-on-submit>
            @csrf

            <label class="block text-sm font-semibold mb-2" for="title">Discussion Title</label>
            <input id="title" name="title" type="text" maxlength="150"
                   value="{{ old('title') }}"
                   class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Enter a title" required>

            <label class="block text-sm font-semibold mt-4 mb-2" for="body">Your Message</label>
            <textarea id="body" name="body" rows="5" maxlength="5000"
                      class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Write your discussion here..." required>{{ old('body') }}</textarea>

            <button type="submit" class="portal-button mt-4 w-full">Publish Discussion</button>
        </form>
    </div>

    <div class="lg:col-span-2 space-y-5">
        @forelse($posts as $post)
            <div class="portal-card p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="mt-2 text-sm portal-muted">
                            Posted by {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>

                    @if($post->user_id === Auth::id())
                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                              data-disable-on-submit
                              onsubmit="return confirm('Are you sure you want to delete this discussion?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>

                <p class="mt-4 leading-relaxed text-slate-700">
                    {{ \Illuminate\Support\Str::limit($post->body, 250) }}
                </p>

                <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                    <span class="text-sm portal-muted">{{ $post->comments_count }} comment(s)</span>
                    <a href="{{ route('posts.show', $post) }}" class="text-sm font-semibold text-blue-600 hover:underline">
                        Read Discussion →
                    </a>
                </div>
            </div>
        @empty
            <div class="portal-card p-10 text-center">
                <h2 class="text-lg font-semibold">No discussions yet.</h2>
                <p class="mt-2 text-sm portal-muted">Be the first student to start a discussion!</p>
            </div>
        @endforelse

        <div>{{ $posts->links() }}</div>
    </div>
</div>
@endsection