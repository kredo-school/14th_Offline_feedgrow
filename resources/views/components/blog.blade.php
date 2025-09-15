<!-- ブログ -->
<div class="box blog-section">
    <div class="d-flex  justify-content-between align-items-center blog-header">
        <div class="d-flex">
            <i class="fa-solid fa-blog fa-2x mt-1" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">BLOG</h2>
        </div>
        <button class="add-btn" onclick="window.location.href='{{ route('posts.create') }}'">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="mt-3 d-flex flex-wrap gap-4 blog-content ms-2">
        @forelse($posts as $post)
            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none blog-item"
                data-post-id="{{ $post->id }}" data-owner="{{ (int) ($post->user_id === Auth::id()) }}">
                @if (optional($post->user)->profile_image)
                    <img class="blog-avatar rounded-circle"
                        src="{{ asset('storage/' . optional($post->user)->profile_image) }}"
                        alt="{{ optional($post->user)->name ? $post->user->name . 'の投稿' : 'User' }}" loading="lazy">
                @else
                    <i class="fa-solid fa-user blog-avatar rounded-circle"></i>
                @endif
                <p class="post-name">{{ $post->user->name }}</p>
            </a>
        @empty
            <div class="text-muted">No Post</div>
        @endforelse
    </div>
</div>

<script>

    
</script>
