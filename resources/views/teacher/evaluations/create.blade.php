@extends('layouts.appTe')

@section('title', 'FeedBack Form')

@section('content')
    <div class="feedback-page">
        <div class="feedback-header">
            <a href="{{ route('teacher.home') }}" class="back-btn back-btn--pill">
                <span class="chev">←</span> Back
            </a>
            <h1 class="feedback-title fw-bold">FEED BACK</h1>
        </div>

        <form action="{{ route('evaluations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <section class="feedback-card">
                <!-- 生徒プロフィール -->
                <div class="feedback-profile">
                    @if ($student->profile_image)
                        <img class="feedback-avatar rounded-circle" src="{{ asset('storage/' . $student->profile_image) }}"
                            alt="{{ $student->name }}のプロフィール画像" loading="lazy">
                    @else
                        <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                            style="width:80px;height:80px;font-size:48px;color:#c7cedc;border:1px solid #888888;"></i>
                    @endif

                    <div class="feedback-name">
                        {{ $student->name }}
                        <span class="feedback-subtle">’s Feedback</span>
                    </div>
                </div>

                <div class="feedback-row">
                    <!-- 日付 -->
                    <div class="form-group">
                        <label for="evaluated_at" class="text-date">DATE</label>
                        <input type="text" name="evaluated_at" id="evaluated_at" value="{{ old('evaluated_at') }}"
                            class="blog-date text-black" placeholder="yyyy-mm-dd">
                        @error('evaluated_at')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- レッスン -->
                    <div class="form-group">
                        <div class="feedback-label">LESSON</div>
                        <select class="feedback-select @error('lesson') is-invalid @enderror" name="lesson"
                            aria-label="Lesson">
                            <option value="">lesson</option>
                            <option value="Basic English" @selected(old('lesson') === 'Basic English')>Basic English
                            </option>
                            <option value="New Topic Conversation" @selected(old('lesson') === 'New Topic Conversation')>New Topic Conversation
                            </option>
                            <option value="New Daily English" @selected(old('lesson') === 'New Daily English')>New Daily English</option>
                            <option value="Vocabulary Builder" @selected(old('lesson') === 'Vocabulary Builder')>Vocabulary Builder</option>
                            <option value="Conversation (Intermediate)" @selected(old('lesson') === 'Conversation (Intermediate)')>Conversation
                                (Intermediate)</option>
                            <option value="Business English (Intermediate)" @selected(old('lesson') === 'Business English (Intermediate)')>Business English
                                (Intermediate)</option>
                            <option value="English Grammar (Intermediate)" @selected(old('lesson') === 'English Grammar (Intermediate)')>English Grammar
                                (Intermediate)</option>
                            <option value="Intermediate Pronunciation" @selected(old('lesson') === 'Intermediate Pronunciation')>Intermediate Pronunciation</option>
                             <option value="Conversation (Advanced)" @selected(old('lesson') === 'Conversation (Advanced)')>Conversation (Advanced)</option>
                             <option value="Business English (Advanced)" @selected(old('lesson') === 'Business English (Advanced)')>Business English (Advanced)</option>
                             <option value="English Grammar (Advanced)" @selected(old('lesson') === 'English Grammar (Advanced)')>English Grammar (Advanced)</option>
                             <option value="Advanced Pronunciation" @selected(old('lesson') === 'Advanced Pronunciation')>Advanced Pronunciation</option>
                        </select>

                        @error('lesson')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- 評価 -->
                <div class="feedback-ratings">
                    <div class="feedback-rating-label">Speaking</div>
                    <select class="feedback-select" name="speaking">
                        <option value="" @selected(old('speaking') === '')>-</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('speaking') == $i)>{{ $i }}</option>
                        @endfor
                        @error('speaking')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </select>


                    <div class="feedback-rating-label">Writing</div>
                    <select class="feedback-select" name="writing">
                        <option value="" @selected(old('writing') === '')>-</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('writing') == $i)>{{ $i }}</option>
                        @endfor
                        @error('writing')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </select>


                    <div class="feedback-rating-label">Listening</div>
                    <select class="feedback-select" name="listening">
                        <option value="" @selected(old('listening') === '')>-</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('listening') == $i)>{{ $i }}</option>
                        @endfor
                        @error('Listening')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </select>


                    <div class="feedback-rating-label">Reading</div>
                    <select class="feedback-select" name="reading">
                        <option value="" @selected(old('reading') === '')>-</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('reading') == $i)>{{ $i }}</option>
                        @endfor
                        @error('reading')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </select>


                    <div class="feedback-rating-label">Grammar</div>
                    <select class="feedback-select" name="grammar">
                        <option value="" @selected(old('grammar') === '')>-</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('grammar') == $i)>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('grammar')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>


                <!-- コメント -->
                <div class="feedback-field" style="margin-top:6px;">
                    <div class="feedback-label">COMMENT
                        <span class="feedback-subtle" style="font-size:12px;margin-left:6px;">(optional)</span>
                    </div>
                    <textarea class="feedback-input" rows="4" name="comment" placeholder="Good progress ...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- アクション -->
                <div class="feedback-actions">
                    <button type="submit" class="feedback-btn feedback-btn-blue mt-3">SUBMIT</button>
                </div>
            </section>
        </form>
    </div>

    <style>
        /* ---------- layout ---------- */
        html,
        body {
            background-color: #1D80E7;
            font-family: 'M PLUS 1p', sans-serif;
            font-weight: 700;
            height: 100%;
            margin: 0;
        }

        .feedback-page {
            min-height: 100vh;
            /* layoutのヘッダー高に応じて調整 */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 72px;
            background: linear-gradient(180deg, #2b86ff 0%, #1D80E7 100%);
        }

        .feedback-header {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            /* 左=空き/Back, 中央=タイトル, 右=空き */
            align-items: center;
            gap: 160px;
            max-width: 920px;
            /* card-containerに合わせて中央寄せ */
            margin: auto;
        }

        .back-btn {
            justify-self: start;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .back-btn--pill {
            background: #fff;
            color: #1D80E7;
            border-radius: 999px;
            padding: 6px 16px;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            font-weight: 800;
            transition: .2s;
        }

        .back-btn--pill .chev {
            display: inline-block;
            transform: translateX(0);
            transition: .2s;
        }

        .back-btn--pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, .2);
        }

        .back-btn--pill:hover .chev {
            transform: translateX(-3px);
        }

        .back-btn:hover {
            background-color: #bbbbbb;
            text-decoration: none;
        }

        .feedback-title {
            font-size: 50px;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            grid-column: 2;
            color: #fff
        }

        .feedback-card {
            width: 700px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: clamp(18px, 3vw, 36px);
            color: #222;
            margin: 0 auto;
        }

        /* ---------- header in card ---------- */
        .feedback-profile {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .feedback-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .12);
        }

        .feedback-name {
            font-size: clamp(22px, 3.2vw, 32px);
            font-weight: 800;
            line-height: 1.1;
        }

        .feedback-subtle {
            color: #7b7b7b;
            font-weight: 700;
            margin-left: 8px;
            font-size: clamp(14px, 2vw, 18px);
        }

        /* ---------- form meta ---------- */
        .feedback-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(12px, 2.2vw, 24px);
            margin: 10px 0 18px;
        }

        @media (max-width:700px) {
            .feedback-meta {
                grid-template-columns: 1fr;
            }
        }

        .feedback-label {
            color: #6d7782;
            font-weight: 700;
            letter-spacing: .06em;
        }

        /* ---------- inputs ---------- */
        .feedback-input,
        .feedback-select {
            width: 100%;
            font: inherit;
            padding: 12px 44px 12px 14px;
            border: 1.5px solid #e9eef5;
            border-radius: 12px;
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
            appearance: none;
        }

        .feedback-input:focus,
        .feedback-select:focus {
            border-color: #1D80E7;
            box-shadow: 0 0 0 .2rem rgba(29, 128, 231, .18);
        }

        /* 下線タイプ（スクショ風） */
        .feedback-input.underline {
            border: 0;
            border-bottom: 2px solid #dfe6ef;
            border-radius: 0;
            padding: 8px 6px;
        }

        .feedback-input.underline:focus {
            border-bottom-color: #1D80E7;
            box-shadow: none;
        }

        /* select の矢印（SVG） */
        .feedback-select {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239da9b6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px 12px;
        }

        /* ---------- ratings grid ---------- */
        .feedback-ratings {
            display: grid;
            grid-template-columns: 1fr 160px;
            gap: 10px 18px;
            margin: 10px 0 22px;
            align-items: center;
        }

        @media (max-width:560px) {
            .feedback-ratings {
                grid-template-columns: 1fr;
            }
        }

        .feedback-rating-label {
            color: #6d7782;
            font-weight: 700;
            padding: 8px 0;
        }

        /* ---------- actions ---------- */
        .feedback-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 8px;
            gap: 16px;
        }

        .feedback-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .04s, box-shadow .2s, background .2s;
        }

        .feedback-btn:active {
            transform: translateY(1px);
        }

        .feedback-btn-blue {
            background: #1D80E7;
            color: #fff;
            box-shadow: 0 10px 26px rgba(29, 128, 231, .35);
            padding-inline: 26px;
        }

        .feedback-btn-blue:hover {
            background: #0f67c4;
        }

        #app>main.py-4 {
            padding-top: 0 !important;
        }

        .feedback-row {
            display: flex;
            gap: 20px;
            align-items: flex-end;
            /* DATEとLESSONの間隔 */
            width: 100%;
        }

        .feedback-row .form-group {
            display: flex;
            flex-direction: column;
            /* ラベルを上、入力欄を下 */
        }

        .feedback-row .form-group:first-child {
            flex: 0 0 200px;
            /* DATEの幅を固定 */
        }

        .feedback-row .form-group:last-child {
            flex: 1 1 0;
            min-width: 0;
            gap: 8px;
            /* LESSONは残りを使用 */
        }

        .feedback-row .form-group:last-child select,
        .feedback-row .feedback-select {
            display: block;
            width: 100% !important;
            /* 既存の固定幅を打ち消す */
            max-width: 100%;
            box-sizing: border-box;
        }

        .text-date {
            color: #6d7782;
            margin-bottom: 15px;
        }

        .blog-date {
            border: none;
            /* 枠線を消す */
            border-bottom: 2px solid #dfe6ef;
            /* 下線だけ残す */
            border-radius: 0;
            /* 角丸をなくす */
            padding: 8px 6px;
            /* 余白は好みで調整 */
            background: transparent;
            /* 背景を透明に */
            outline: none;
            /* フォーカス時の枠を消す */
            font: inherit;
            /* フォント継承 */
        }

        .blog-date:focus {
            border-bottom-color: #1D80E7;
            /* フォーカス時は青く */
            box-shadow: none;
            /* 影も消す */
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#evaluated_at", {
            dateFormat: "Y-m-d",
            locale: "en"
        });
    </script>
@endsection
