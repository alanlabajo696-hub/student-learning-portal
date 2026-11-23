@extends('layouts.portal')

@section('content')
<div class="mb-6">
    <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
        ← Back to Discussions
    </a>
</div>

<div class="portal-card p-7 mb-6">
    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Discussion</p>
            <h1 class="mt-2 text-3xl font-bold">{{ $post->title }}</h1>
            <p class="mt-3 text-sm portal-muted">
                Posted by {{ $post->user->name }} · {{ $post->created_at->format('M d, Y h:i A') }}
            </p>
        </div>

        @if($post->user_id === Auth::id())
            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                  data-disable-on-submit
                  onsubmit="return confirm('Delete this discussion?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">
                    Delete Discussion
                </button>
            </form>
        @endif
    </div>

    <div class="mt-7 whitespace-pre-line leading-8 text-slate-700">{{ $post->body }}</div>
</div>

<div class="portal-card p-7 mb-6">
    <h2 class="text-xl font-bold mb-5">Comments ({{ $post->comments->count() }})</h2>

    <form method="POST" action="{{ route('comments.store', $post) }}" data-disable-on-submit>
        @csrf

        <label for="body" class="mb-2 block text-sm font-semibold">Add Your Comment</label>
        <textarea id="body" name="body" rows="3" maxlength="2000"
                  class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                  placeholder="Write your comment..." required>{{ old('body') }}</textarea>

        <button type="submit" class="portal-button mt-3">Post Comment</button>
    </form>
</div>

<div class="space-y-4">
    @forelse($post->comments as $comment)
        <div class="portal-card p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-semibold">{{ $comment->user->name }}</p>
                    <p class="mt-1 text-xs portal-muted">{{ $comment->created_at->diffForHumans() }}</p>
                </div>

                @if($comment->user_id === Auth::id())
                    <form method="POST"
                          action="{{ route('comments.destroy', [$post, $comment->id]) }}"
                          data-disable-on-submit
                          onsubmit="return confirm('Delete this comment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>
                @endif
            </div>

            <p class="mt-4 whitespace-pre-line leading-relaxed text-slate-700">{{ $comment->body }}</p>
        </div>
    @empty
        <div class="portal-card p-6 text-center portal-muted">
            No comments yet. Be the first to reply!
        </div>
    @endforelse
</div>
@endsection