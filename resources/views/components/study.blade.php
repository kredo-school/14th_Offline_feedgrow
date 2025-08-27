@php
    $hours = intdiv($weekMinutes, 60);
    $mins = $weekMinutes % 60;
    $targetHours = intdiv($target, 60);
    $pct = $target > 0 ? min(100, floor(($weekMinutes * 100) / $target)) : 0;

    // 円グラフ用（円周 = 2πr、r=26 → 約163.36）
    $r = 26;
    $C = 2 * M_PI * $r;
    $offset = $C * (1 - $pct / 100);
@endphp

<div class="box calendar-section">
    <div class="weekly-card {{ $pct >= 100 ? 'is-done' : '' }}">
        <div class="weekly-card__inner">
            <div class="weekly-card__left">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bookmark fa-2x" style="color: white;"></i>
                    <h2 class="ms-2 fw-bold">STUDY LOG</h2>
                </div>
                <form method="POST" action="{{ route('study.goal.save') }}" class="weekly-card__goalform" id="goalForm">
                    @csrf

                    {{-- <a href="{{ route('study.logs.create') }}" class="btn btn-sm study-btn">hhhh</a> --}}
                    <div class="weekly-card__subtitle">
                        （目標：
                         <span class="select-wrap">
                        <select name="target_hours" class="weekly-card__select" aria-label="今週の目標時間"
                            onchange="document.getElementById('goalForm').submit()">
                            @foreach ([2, 4, 6, 8] as $h)
                                <option value="{{ $h }}" @selected($targetHours === $h)>{{ $h }}H
                                </option>
                            @endforeach
                        </select>
                         </span>
                        ）
                    </div>
                </form>
                <div class="weekly-card__time">
                    <span class="weekly-card__time-num">{{ $hours }}</span>
                    <span class="weekly-card__time-unit">時間</span>
                    <span class="weekly-card__time-num">{{ $mins }}</span>
                    <span class="weekly-card__time-unit">分</span>
                </div>

                <div class="weekly-card__bar">
                    <div class="weekly-card__bar-fill" style="width: {{ $pct }}%"></div>
                </div>

                {{-- NEW: アクションボタン --}}
                <div class="weekly-actions">
                    <a href="{{ route('study.logs.create') }}" class="btn-pill btn--primary">
                        <i class="fa-solid fa-plus"></i><span>学習記録を追加</span>
                    </a>

                    <form id="resetAllForm" method="POST" action="#">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-pill btn--danger-outline" id="resetAllBtn">
                            <i class="fa-solid fa-rotate-left"></i><span>すべてリセット</span>
                        </button>
                    </form>
                </div>

                <div class="weekly-card__range">
                    {{ $weekStart->format('Y.m.d') }} 〜 {{ $weekEnd->format('Y.m.d') }}
                </div>
            </div>

            <div class="weekly-card__right">
                {{-- 円形プログレス --}}
                <svg class="weekly-ring" viewBox="0 0 64 64" aria-label="progress {{ $pct }}%">
                    <circle class="weekly-ring__bg" cx="32" cy="32" r="{{ $r }}" />
                    <circle class="weekly-ring__fg {{ $pct >= 100 ? 'is-done' : '' }}" cx="32" cy="32" r="{{ $r }}"
                        style="stroke-dasharray: {{ $C }}; stroke-dashoffset: {{ $offset }};" />
                    <text x="32" y="35" text-anchor="middle" class="weekly-ring__text"> @if($pct >= 100) ✅ @else {{ $pct }}% @endif</text>
                </svg>
            </div>
        </div>
    </div>
</div>
{{-- ↓ このCSSはお好みのCSSファイルに移してOK（いまは同梱でも動く） --}}
<style>
    .weekly-card__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px
    }

    .weekly-card__left {
        display: flex;
        flex-direction: column;
        gap: 10px
    }

    /* .weekly-card__title {
        font-weight: 800;
        letter-spacing: .04em;
        opacity: .95
    } */

    .weekly-card__subtitle {
        opacity: .85
    }

    .select-wrap{ position:relative; display:inline-block; }
.select-wrap::after{
  content:""; position:absolute; right:.55rem; top:50%;
  width:.6rem; height:.6rem; pointer-events:none; transform:translateY(-50%);
  background: url("data:image/svg+xml;utf8,\
  <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'>\
    <path d='M4 6l4 4 4-4z' fill='white' opacity='.9'/></svg>") no-repeat center/100% 100%;
  filter: drop-shadow(0 1px 1px rgba(0,0,0,.25));
}

.weekly-card__select{
  -webkit-appearance:none; appearance:none;
  color:#fff; color-scheme: dark;          /* ドロップダウン配色のヒント */
  background: linear-gradient(180deg, rgba(255,255,255,.14), rgba(255,255,255,.06));
  border:1px solid rgba(255,255,255,.28);
  padding:.32rem 2rem .32rem .6rem;        /* 右側は矢印分を確保 */
  border-radius:10px;
  font-weight:800; letter-spacing:.02em;
  box-shadow: inset 0 1px 0 rgba(255,255,255,.28), 0 6px 16px rgba(0,0,0,.18);
  backdrop-filter: blur(6px) saturate(140%);
  transition: box-shadow .15s ease, border-color .15s ease, background .2s ease;
}

  .weekly-card__select:hover{
  background: linear-gradient(180deg, rgba(255,255,255,.18), rgba(255,255,255,.08));
}
.weekly-card__select:focus{
  outline:none;
  border-color: rgba(158,232,255,.9);
  box-shadow: 0 0 0 .12rem rgba(158,232,255,.45), 0 8px 22px rgba(29,128,231,.3);
}

/* ドロップダウン内のオプション配色（効くブラウザで） */
.weekly-card__select option{
  background:#185dc6; color:#fff;
}

/* コンパクト版（文字を少しだけ小さく） */
.weekly-card__select--sm{ padding:.25rem 1.8rem .25rem .55rem; font-weight:700; }


    .weekly-card__time {
        display: flex;
        align-items: flex-end;
        gap: 8px
    }

    .weekly-card__time-num {
        font-size: 48px;
        font-weight: 900;
        line-height: 1
    }

    .weekly-card__time-unit {
        font-size: 16px;
        font-weight: 700;
        opacity: .85;
        margin-bottom: 6px
    }

    .weekly-card__bar {
        height: 8px;
        background: rgba(255, 255, 255, .18);
        border-radius: 999px;
        overflow: hidden
    }

    .weekly-card__bar-fill {
        height: 100%;
        background: #9ee8ff
    }

    .weekly-card__range {
        font-size: 12px;
        opacity: .85;
        margin-top: 2px
    }

    .weekly-card__right {
        width: 110px;
        height: 110px;
        display: grid;
        place-items: center
    }

    .weekly-ring {
        width: 100%;
        height: 100%
    }

    .weekly-ring__bg {
        fill: none;
        stroke: rgba(255, 255, 255, .25);
        stroke-width: 8
    }

    .weekly-ring__fg {
        fill: none;
        stroke: #9ee8ff;
        stroke-width: 8;
        transform: rotate(-90deg);
        transform-box: fill-box;
        transform-origin: 50% 50%;
        stroke-linecap: round;
        transition: stroke-dashoffset .6s ease
    }

    .weekly-ring__text {
        fill: #fff;
        font-size: 14px;
        font-weight: 800
    }

    @media (max-width:768px) {
        .weekly-card__inner {
            flex-direction: column;
            align-items: flex-start
        }
    }

    .study-btn {
        color: #fff;

    }

    .weekly-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-top: 12px;
    }

    /* pillボタンの共通 */
    .btn-pill {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .55rem .95rem;
        border-radius: 999px;
        font-weight: 800;
        letter-spacing: .02em;
        border: 1px solid transparent;
        color: #fff;
        text-decoration: none;
        backdrop-filter: saturate(140%) blur(2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .18), inset 0 1px 0 rgba(255, 255, 255, .25);
        transition: transform .12s ease, box-shadow .12s ease, background .2s ease, border-color .2s ease, opacity .2s ease;
    }

    .btn-pill i {
        font-size: 0.95em;
    }

    .btn-pill:active {
        transform: translateY(1px);
    }

    /* 追加ボタン（主ボタン） */
    .btn--primary {
        background: linear-gradient(180deg, #54a8ff 0%, #1D80E7 100%);
    }

    .btn--primary:hover {
        box-shadow: 0 10px 28px rgba(29, 128, 231, .35);
    }

    /* リセット（破壊操作は控えめ＋赤味） */
    .btn--danger-outline {
        background: rgba(255, 255, 255, .08);
        border-color: rgba(255, 255, 255, .25);
        color: #ffe3e3;
    }

    .btn--danger-outline:hover {
        background: rgba(255, 82, 82, .16);
        border-color: #ff9c9c;
        color: #fff;
        box-shadow: 0 10px 26px rgba(255, 82, 82, .28);
    }

    @media (max-width:640px) {
        .weekly-actions {
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn-pill span {
            display: none;
        }

        /* モバイルはアイコンのみも可 */
    }

    .badge-done{
  display:inline-flex; align-items:center; gap:.25rem;
  margin-left:.6rem; padding:.22rem .5rem;
  border-radius:999px; font-size:.75rem; font-weight:900;
  background:linear-gradient(180deg,#59f384 0%, #2ec971 100%);
  color:#063; box-shadow:0 6px 16px rgba(46,201,113,.35);
}
.badge-done .emoji{ filter: drop-shadow(0 2px 6px rgba(0,0,0,.15)); }

/* カード強調（100%達成時） */
.weekly-card{ position:relative; }  /* バッジ/演出の土台 */
.weekly-card.is-done{
  box-shadow:0 12px 28px rgba(0,0,0,.18), 0 0 0 2px rgba(46,201,113,.25) inset;
  animation: pop .6s ease;
}

/* リング色をグリーンに */
.weekly-ring__fg.is-done{
  stroke:#59f384;
  /* filter: drop-shadow(0 0 10px rgba(46,201,113,.45)); */
}

/* ちょい演出 */
@keyframes pop{
  0%{ transform:scale(.96); }
  60%{ transform:scale(1.03); }
  100%{ transform:scale(1); }
}


</style>

<script>
    document.getElementById('resetAllForm')?.addEventListener('submit', function(e) {
        const ok = confirm('本当に「すべてリセット」しますか？\n※この操作は取り消せません');
        if (!ok) {
            e.preventDefault();
            return;
        }
        const btn = document.getElementById('resetAllBtn');
        btn.disabled = true;
        btn.style.opacity = .7;
    });
</script>
