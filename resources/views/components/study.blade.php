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
<div class="weekly-card">
    <div class="weekly-card__inner">
        <div class="weekly-card__left">
            <div class="weekly-card__title">今週の学習時間</div>

            <form method="POST" action="{{ route('study.goal.save') }}" class="weekly-card__goalform" id="goalForm">
                @csrf

                <a href="{{ route('study.logs.create') }}" class="btn btn-sm study-btn">hhhh</a>
                    <div class="weekly-card__subtitle">
                        （目標：
                        <select name="target_hours" class="weekly-card__select" aria-label="今週の目標時間"
                            onchange="document.getElementById('goalForm').submit()">
                            @foreach ([2, 4, 6, 8] as $h)
                                <option value="{{ $h }}" @selected($targetHours === $h)>{{ $h }}時間
                                </option>
                            @endforeach
                        </select>
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

            <div class="weekly-card__range">
                {{ $weekStart->format('Y.m.d') }} 〜 {{ $weekEnd->format('Y.m.d') }}
            </div>
        </div>

        <div class="weekly-card__right">
            {{-- 円形プログレス --}}
            <svg class="weekly-ring" viewBox="0 0 64 64" aria-label="progress {{ $pct }}%">
                <circle class="weekly-ring__bg" cx="32" cy="32" r="{{ $r }}" />
                <circle class="weekly-ring__fg" cx="32" cy="32" r="{{ $r }}"
                    style="stroke-dasharray: {{ $C }}; stroke-dashoffset: {{ $offset }};" />
                <text x="32" y="35" text-anchor="middle" class="weekly-ring__text">{{ $pct }}%</text>
            </svg>
        </div>
    </div>
</div>
</div>
{{-- ↓ このCSSはお好みのCSSファイルに移してOK（いまは同梱でも動く） --}}
<style>
    .weekly-card {
        background: linear-gradient(180deg, #1f6fe8 0%, #1a63cf 100%);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, .15);
        color: #fff
    }

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

    .weekly-card__title {
        font-weight: 800;
        letter-spacing: .04em;
        opacity: .95
    }

    .weekly-card__subtitle {
        opacity: .85
    }

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
</style>
