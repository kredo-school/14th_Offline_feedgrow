@extends('layouts.app')
@section('title', 'Blog View')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <div class="blog-wrapper">
        <div class="blog-header">
            <a href="{{ route('student.home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="blog-title fw-bold">BLOG</h1>
        </div>
        <div class="blog-card">
            <!-- 投稿タイトルと日付 -->
            <div class="title-wrapper">
                <h2 class="post-title">{{ $post['title'] }}</h2>
                {{-- <small class="text-muted post-date" style="font-size: 14px;">{{ $post['created_at'] }}</small> --}}
                <div class="text-muted post-date" style="font-size:18px;">
                    {{ $post->created_at->format('Y-m-d') }}
                </div>
            </div>
            <!-- 投稿者 -->
            <div class="user-info">
                <a href="{{ route('profile.show', $post->user->id) }}"
                    class="d-flex align-items-center text-decoration-none text-dark">
                    @if (optional($post->user)->profile_image)
                        <img class="blog-avatar new rounded-circle" data-user="{{ $post->user_id }}"
                            src="{{ asset('storage/' . optional($post->user)->profile_image) }}"
                            alt="{{ optional($post->user)->name ? $post->user->name . 'の投稿' : 'User' }}" loading="lazy">
                    @else
                        <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                            style="width:40px;height:40px;font-size:18px;color:#c7cedc;border:1px solid #888888;"></i>
                    @endif
                    <span class="fw-bold ms-2">{{ $post->user->name }}</span>
                </a>
            </div>
            <!-- 本文 -->
            <div class="post-body">
                <p>{{ $post['caption'] }}</p>
            </div>
            <!-- 画像 -->
            @if (!empty($post->image_path))
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="blog image" class="post-image">
            @endif
            <!-- アイコン -->
            <div class="icons">
                <div>
                    <button type="button" class="btn btn-like" data-post-id="{{ $post->id }}"
                        data-liked="{{ $post->likes()->where('user_id', Auth::id())->exists() ? '1' : '0' }}">
                        <i
                            class="{{ $post->likes()->where('user_id', Auth::id())->exists() ? 'fas text-danger' : 'far' }} fa-heart"></i>
                        <span class="like-count">{{ $post->likes()->count() }}</span>
                    </button>

                    <div class="dropdown d-inline-block">
                        {{-- コメントアイコン＋件数 --}}
                        <a class="btn btn-sm dropdown-toggle p-0 border-0 bg-transparent" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-comment"></i>
                            <span class="ms-1">{{ $post->comments_count ?? $post->comments()->count() }}</span>
                        </a>

                        {{-- ドロップダウンメニュー --}}
                        <div class="dropdown-menu dropdown-menu-end p-3"
                            style="min-width: 320px; max-height: 300px; overflow-y: auto;">

                            {{-- コメント一覧 --}}
                            @forelse($post->comments()->latest()->get() as $comment)
                                <div class="mb-2 border-bottom pb-1">
                                    <div class="user-info">
                                        @if (optional($comment->user)->profile_image)
                                            <img class="blog-avatar new rounded-circle" data-user="{{ $comment->user_id }}"
                                                src="{{ asset('storage/' . optional($comment->user)->profile_image) }}"
                                                {{-- 可能なら Storage::url(...) 推奨 --}}
                                                alt="{{ optional($comment->user)->name ? $comment->user->name . 'の投稿' : 'User' }}"
                                                loading="lazy">
                                        @else
                                            <i class="fa-solid fa-user blog-avatar new rounded-circle"
                                                data-user="{{ $comment->user_id }}"></i>
                                        @endif
                                        <span class="fw-bold">{{ $comment['user']['name'] }}</span>
                                    </div>
                                    <div class="small">{{ $comment->body }}</div>

                                    {{-- 自分のコメントなら削除ボタン --}}
                                    @if (Auth::id() === $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            class="mt-1" onsubmit="return confirm('Delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm py-0 px-2">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @empty
                                <div class="text-muted small">No comments yet.</div>
                            @endforelse

                            {{-- 新規コメントフォーム --}}
                            @auth
                                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <div class="mb-2">
                                        <textarea name="body" rows="2" class="form-control form-control-sm" placeholder="Write a comment..."
                                            maxlength="255" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>

                </div>
                @can('update', $post)
                    <div class="menu-wrapper" style="position: relative; text-align: right;">
                        <button onclick="toggleMenu()" class="menu-btn">⋯</button>
                        <div id="menu-options" class="menu-options">

                            <a href="{{ route('posts.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square"></i>
                                <span class="text-primary">Edit</span></a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Do you want to delete it?')">
                                    <i class="fa-solid fa-trash"></i>
                                    <span class="text-danger">Delete</span>
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function toggleMenu() {
        const menu = document.getElementById('menu-options');
        if (!menu) return;
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

document.addEventListener('click', async (e) => {
  const btn = e.target.closest('.btn-like');
  if (!btn) return;

  const postId = btn.dataset.postId;
  const liked  = btn.dataset.liked === '1';
  const url    = liked ? `/posts/${postId}/likes` : `/posts/${postId}/likes`;
  const method = liked ? 'DELETE' : 'POST';

  try {
    const res = await fetch(url, {
      method,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
      },
    });
    if (!res.ok) throw new Error('Network error');
    const data = await res.json(); // { liked: boolean, count: number }

    // UI 反映（アイコンと色）
    const icon = btn.querySelector('i.fa-heart');
    icon.className = (data.liked ? 'fas text-danger' : 'far') + ' fa-heart';

    // 数更新
    btn.querySelector('.like-count').textContent = data.count;

    // 状態保存
    btn.dataset.liked = data.liked ? '1' : '0';
  } catch (err) {
    console.error(err);
  }
});
</script>
