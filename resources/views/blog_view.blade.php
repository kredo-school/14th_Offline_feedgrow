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
                            style="width:40px;height:40px;font-size:21px;color:#c7cedc;border:1px solid #888888;"></i>
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
                        <div class="dropdown-menu dropdown-menu-end comment-menu p-3" data-bs-auto-close="outside">

                            {{-- コメント一覧 --}}
                            @forelse($post->comments()->latest()->get() as $comment)
                                @php $u = optional($comment->user); @endphp
                                <div class="cmt">
                                    <div class="cmt-head d-flex align-items-center gap-2">
                                        @if ($u?->profile_image)
                                            <img class="cmt-avatar" src="{{ asset('storage/' . $u->profile_image) }}"
                                                alt="">
                                        @else
                                            <div class="cmt-avatar"><i class="fa-solid fa-user"></i></div>
                                        @endif
                                        <span class="cmt-name ms-2">{{ $u->name ?? 'User' }}</span>
                                        <small class="cmt-time ms-auto text-muted">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>

                                        {{-- 自分のコメント or 投稿者なら削除可 --}}
                                        @if (Auth::id() === $comment->user_id || Auth::id() === $post->user_id)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                                class="ms-1">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="cmt-del mt-3" title="Delete"
                                                    aria-label="Delete">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="cmt-body">{{ $comment->body }}</div>
                                </div>
                            @empty
                                <div class="text-muted small">No comments yet.</div>
                            @endforelse

                            {{-- 新規コメントフォーム --}}
                            @auth
                                <form action="{{ route('comments.store', $post->id) }}" method="POST"
                                    class="comment-form mt-2">
                                    @csrf
                                    <input name="body" class="form-control comment-input" placeholder="Write a comment..."
                                        maxlength="255" required>
                                    <button type="submit" class="comment-send">Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>

                </div>
                @can('update', $post)
                    <div class="menu-wrapper" style="position: relative; text-align: right;">
                        <button onclick="toggleMenu()" class="menu-btn">⋯</button>
                        <div id="menu-options" class="menu-options">

                            {{-- <a href="{{ route('posts.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square"></i>
                                <span class="text-primary">Edit</span></a> --}}
                            {{-- Edit --}}
                            <a href="{{ route('posts.edit', $post->id) }}" class="icon-btn icon-edit" title="Edit"
                                aria-label="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        @endcan
                        @can('delete', $post)
                            {{-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Do you want to delete it?')">
                                    <i class="fa-solid fa-trash"></i>
                                    <span class="text-danger">Delete</span>
                                </button>
                            </form> --}}
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Do you want to delete it?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="icon-btn icon-danger" title="Delete" aria-label="Delete">
                                    <i class="fa-regular fa-trash-can"></i>
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
