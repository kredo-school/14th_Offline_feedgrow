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
            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none blog-item">
                @if (optional($post->user)->profile_image)
                    <img class="blog-avatar new rounded-circle" data-user="{{ $post->user_id }}"
                        src="{{ asset('storage/' . optional($post->user)->profile_image) }}" {{-- 可能なら Storage::url(...) 推奨 --}}
                        alt="{{ optional($post->user)->name ? $post->user->name . 'の投稿' : 'User' }}" loading="lazy">
                @else
                    <img src="{{ asset('images/User-avatar.png') }}" class="blog-avatar new rounded-circle"  data-user="{{ $post->user_id }}">
                @endif
                <p class="post-name">{{$post->user->name}}</p>
            </a>
        @empty
            <div class="text-muted">No Post</div>
        @endforelse
    </div>
</div>

<script>
    window.addEventListener = () => {
        const readUsers = JSON.parse(localStorage.getItem('readUsers') || '[]');
        document.querySelectorAll('.blog-avatar').forEach(avatar => {
            const user = avatar.dataset.user;
            if (readUsers.includes(user)) {
                avatar.classList.remove('new');
                avatar.classList.add('read');
            }

            avatar.addEventListener('click', () => {
                avatar.classList.remove('new');
                avatar.classList.add('read');
                markAsRead(user);
            });
        });
    };

    function markAsRead(user) {
        let readUsers = JSON.parse(localStorage.getItem('readUsers') || '[]');
        if (!readUsers.includes(user)) {
            readUsers.push(user);
            localStorage.setItem('readUsers', JSON.stringify(readUsers));
        }
    }
</script>
