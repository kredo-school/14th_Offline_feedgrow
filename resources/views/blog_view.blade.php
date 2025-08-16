@extends('layouts.app')

@section('title', 'Blog View')

@section('content')
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
                <small class="text-muted post-date" style="font-size: 14px;">{{ $post['created_at'] }}</small>
            </div>

            <!-- 投稿者 -->
            <div class="user-info">
                @if (optional($post->user)->profile_image)
                    <img class="blog-avatar new rounded-circle" data-user="{{ $post->user_id }}"
                        src="{{ asset('storage/' . optional($post->user)->profile_image) }}" {{-- 可能なら Storage::url(...) 推奨 --}}
                        alt="{{ optional($post->user)->name ? $post->user->name . 'の投稿' : 'User' }}" loading="lazy">
                @else
                    <i class="fa-solid fa-user blog-avatar new rounded-circle" data-user="{{ $post->user_id }}"></i>
                @endif
                <span class="fw-bold">{{ $post['user']['name'] }}</span>
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
            <div class="flex items-center px-4 py-2 space-x-6 border border-black">
                <div class="flex item-centre space-x-1">
                    @if ($post->isLiked())
                        <form action="{{ route('likes.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="fa-solid fa-heart text-danger"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('likes.store', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </form>
                    @endif
                    <span class="text-sm">{{ $post->likes->count() }}</span>
                </div>

                <div class="flex items-center space-x-1">
                    <button type="button" class="btn btn-sm p-0" @click="openComments = !openComments">
                        <i class="far fa-comment"></i>
                    </button>
                    <span class="text-sm">{{ $post->comments->count() }}</span>
                </div>
            </div>

            <div x-show="openComments" x-cloak @click.away="openComments = false"
                class="px-4 pb-4 max-h-36 overflow-y-auto">
                @forelse ($post->comments as $comment)
                    <div class="flex items-start border-black py-1 text-sm">
                        <div class="user-info">
                            @if (!empty(Auth::user()->profile_image))
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="User Avatar"
                                    class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <i class="fa-solid fa-user rounded-circle d-inline-block text-center"
                                    style="width:40px; height:40px; font-size:28px; line-height:50px; color:#c7cedc;">
                                </i>
                            @endif
                            <span class="fw-bold">
                                {{ optional($comment->user)->username ?? optional($comment->user)->name }}
                            </span>
                        </div>
                        <strong{{ $comment->user->name }}< /strong>&nbsp;{{ $comment->body }}
                            @if ($comment->user_id === auth()->id())
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ml-auto"
                                    onsubmit="return confirm('このコメントを削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-500">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">
                        There are no previous comments</p>
                @endforelse
                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2">
                    @csrf
                    <textarea name="body" id="body" rows="2" class="w-full border-black rounded p-1 text-sm mb-2" required></textarea>
                    <button type="submit" class="w-full btn btn-primary text-sm">send</button>
                </form>
            </div>



            <div id="menu-options" class="menu-options">
                <a href="#"><i class="fa-solid fa-pen-to-square"></i>
                    <span class="text-primary">Edit</span></a>

                <a href="#"><i class="fa-solid fa-trash"></i>
                    <span class="text-danger">Delete</span></a>
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
</script>
