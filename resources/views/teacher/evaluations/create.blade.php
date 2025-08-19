{{-- resources/views/teacher/evaluations/create.blade.php --}}
{{-- @extends('layouts.app')

@section('content')
  <div class="container">
    <h2>「{{ $student->name }}」さんの評価</h2>

    <form action="{{ route('evaluations.store') }}" method="POST">
    @csrf

      <input type="hidden" name="student_id" value="{{ $student->id }}">

      <div class="mb-3">
        <label class="form-label">受けた授業</label>
        <textarea name="comment" class="form-control" rows="3"></textarea>
      </div>

      @foreach (['speaking' => '話す', 'listening' => '聞く', 'reading' => '読む', 'writing' => '書く', 'grammar' => '文法'] as $key => $label)
        <div class="mb-3">
          <label class="form-label">{{ $label }}（1〜5）</label>
          <select name="{{ $key }}" class="form-select">
            <option value="">未評価</option>
            @for ($i = 1; $i <= 5; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>
      @endforeach



      <button class="btn btn-primary">送信する</button>
    </form>
  </div>
@endsection --}}

@extends('layouts.appTe')

@section('title', 'FeedBack Form')

@section('content')
    <div class="feedback-page">
        <h1 class="feedback-title">FEED BACK</h1>

        <section class="feedback-card">
            <!-- 顔＋名前（※実データに差し替えてOK） -->
            <div class="feedback-profile">
                <img class="feedback-avatar"
                    src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=256&auto=format&fit=crop"
                    alt="student avatar">
                <div class="feedback-name">Kyota <span class="feedback-subtle">’s Feedback</span></div>
            </div>

            <!-- 日付・レッスン -->
            <div class="feedback-meta">
                <div class="feedback-field">
                    <div class="feedback-label">DATE</div>
                    <input class="feedback-input underline" type="text" placeholder="yyyy/mm/dd" inputmode="numeric">
                    {{-- ※ 通常の date にしたい場合は ↓ を使って underline クラスを外す
        <input class="feedback-input" type="date">
        --}}
                </div>

                <div class="feedback-field">
                    <div class="feedback-label">LESSON</div>
                    <select class="feedback-select" aria-label="Lesson">
                        <option value="">lesson</option>
                        <option>Conversation A</option>
                        <option>Business Email</option>
                        <option>Pronunciation</option>
                    </select>
                </div>
            </div>

            <!-- 評価行 -->
            <div class="feedback-ratings">
                <div class="feedback-rating-label">Speaking</div>
                <select class="feedback-select" aria-label="Speaking">
                    <option value="" selected>-</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

                <div class="feedback-rating-label">Writing</div>
                <select class="feedback-select" aria-label="Writing">
                    <option value="" selected>-</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

                <div class="feedback-rating-label">Listening</div>
                <select class="feedback-select" aria-label="Listening">
                    <option value="" selected>-</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

                <div class="feedback-rating-label">Reading</div>
                <select class="feedback-select" aria-label="Reading">
                    <option value="" selected>-</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

                <div class="feedback-rating-label">Grammar</div>
                <select class="feedback-select" aria-label="Grammar">
                    <option value="" selected>-</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <!-- コメント（任意） -->
            <div class="feedback-field" style="margin-top:6px;">
                <div class="feedback-label">COMMENT <span class="feedback-subtle"
                        style="font-size:12px;margin-left:6px;">(optional)</span></div>
                <textarea class="feedback-input" rows="4"
                    placeholder="Good progress on pronunciation. Next: shadowing practice for /r/ and /l/ …"></textarea>
            </div>

            <!-- アクション -->
            <div class="feedback-actions">
                <button type="button" class="feedback-btn feedback-btn-gray" onclick="history.back()">← BACK</button>
                <button type="button" class="feedback-btn feedback-btn-blue" id="feedback-submit">SUBMIT</button>
            </div>
        </section>
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
            padding: 48px 16px 72px;
            background: linear-gradient(180deg, #2b86ff 0%, #1D80E7 100%);
        }

        .feedback-title {
            margin: 0 0 28px;
            color: #fff;
            font-weight: 800;
            font-size: clamp(34px, 5vw, 64px);
            letter-spacing: .06em;
            text-shadow: 0 6px 18px rgba(0, 0, 0, .15);
        }

        .feedback-card {
            width: min(920px, 100%);
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 14px 30px rgba(0, 0, 0, .10);
            padding: clamp(18px, 3vw, 36px);
            color: #222;
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

        .feedback-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .feedback-label {
            color: #9aa3ad;
            font-weight: 700;
            letter-spacing: .06em;
            font-size: 13px;
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
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            gap: 16px;
        }

        .feedback-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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

        .feedback-btn-gray {
            background: #d1d1d1;
            color: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
        }

        .feedback-btn-gray:hover {
            filter: brightness(.95);
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
            /* 下も詰めたいなら ↓ も付ける */
            /* padding-bottom: 0 !important; */
        }
    </style>

    <script>
        document.getElementById('feedback-submit')?.addEventListener('click', function(e) {
            e.preventDefault();
            alert('UIデモ：送信処理は未実装です。');
        });
    </script>
@endsection
