@php
    // ===== 数値計算 =====
    $hours = intdiv($weekMinutes, 60);
    $mins = $weekMinutes % 60;
    $targetHours = intdiv($target, 60);
    $pct = $target > 0 ? min(100, floor(($weekMinutes * 100) / $target)) : 0;

    // Ring（円周 C=2πr）
    $r = 26;
    $C = 2 * M_PI * $r;
    $offset = $C * (1 - $pct / 100);
@endphp

<div class="box calendar-section">
    <div class="sl-card {{ $pct >= 100 ? 'is-done' : '' }}" data-minutes="{{ $weekMinutes }}"
        data-target="{{ $target }}" data-circ="{{ $C }}" data-week="{{ $weekStart->toDateString() }}">

        <!-- ===== 上段：タイトル / ゴール / 時間 / リング ===== -->
        <div class="sl-grid">
            <!-- 左エリア -->
            <div class="sl-left">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bookmark fa-2x" style="color: white;"></i>
                    <h2 class="ms-2 fw-bold">STUDY LOG</h2>
                </div>

                <div class="sl-goal">
                    <span class="sl-goal__label">GOAL</span>
                    <form method="POST" action="{{ route('study.goal.save') }}" id="goalForm" class="m-0">
                        @csrf
                        <span class="sl-select-wrap">
                            <select name="target_hours" class="sl-select" aria-label="Weekly goal"
                                onchange="document.getElementById('goalForm').submit()">
                                @foreach ([2, 4, 6, 8] as $h)
                                    <option value="{{ $h }}" @selected($targetHours === $h)>
                                        {{ $h }}h</option>
                                @endforeach
                            </select>
                        </span>
                    </form>
                </div>

                <div class="sl-time">
                    <span class="sl-time__num js-hours">{{ $hours }}</span>
                    <span class="sl-time__unit">h</span>
                    <span class="sl-time__num js-mins">{{ $mins }}</span>
                    <span class="sl-time__unit">m</span>
                </div>
            </div>

            <!-- 右エリア：リング -->
            <div class="sl-right">
                <svg class="sl-ring" viewBox="0 0 64 64" aria-label="progress {{ $pct }}%">
                    <circle class="sl-ring__bg" cx="32" cy="32" r="{{ $r }}" />
                    <circle class="sl-ring__fg {{ $pct >= 100 ? 'is-done' : '' }}" cx="32" cy="32"
                        r="{{ $r }}"
                        style="stroke-dasharray: {{ $C }}; stroke-dashoffset: {{ $offset }};" />
                    <text x="32" y="38" text-anchor="middle" class="sl-ring__text {{ $pct >= 100 ? 'done' : '' }}">
                        @if ($pct >= 100)
                            ACHIEVE
                        @else
                            {{ $pct }}%
                        @endif
                    </text>
                </svg>
            </div>

            <!-- ===== 中段：入力バー（カード幅いっぱいに） ===== -->
            <div class="sl-inputbar">
                <form method="POST" action="{{ route('study.logs.store') }}" id="quickLogForm"
                    class="sl-inputbar__form">
                    @csrf
                    <input type="hidden" name="date" value="{{ now()->toDateString() }}">

                    <div class="sl-hm">
                        <input type="number" name="hours" min="0" step="1" class="sl-input sl-num"
                            placeholder="0" aria-label="Hours">
                        <span class="sl-hm__sep">h</span>
                        <input type="number" name="minutes" min="0" step="5" class="sl-input sl-num"
                            placeholder="0" aria-label="Minutes">
                        <span class="sl-hm__sep">m</span>
                    </div>

                    <div class="sl-chips">
                        <button type="button" class="sl-chip" data-min="15">+15</button>
                        <button type="button" class="sl-chip" data-min="30">+30</button>
                    </div>
                </form>
            </div>

            <!-- ===== 下段：大きめボタン（画像準拠） ===== -->
            <div class="sl-actions">
                <a href="{{ route('study.logs.create') }}" class="sl-bigbtn sl-bigbtn--primary">ADD LOG</a>

                <form method="POST" action="#" id="resetAllForm" class="m-0">
                    @csrf @method('DELETE')
                    <button type="submit" class="sl-bigbtn sl-bigbtn--secondary" id="resetAllBtn">RESET ALL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* レイアウト */
    .sl-grid {
        display: grid;
        grid-template-columns: 1fr 180px;
        /* 左は可変、右は固定 */
        column-gap: 20px;
        row-gap: 14px;
        align-items: start;
    }

    /* ===== タイトル & GOAL ===== */

    .sl-goal {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin-top: 10px;
    }

    .sl-goal__label {
        font-weight: 800;
        opacity: .9;
        letter-spacing: .04em;
    }

    /* セレクト（小さめピル） */
    .sl-select-wrap {
        position: relative;
        display: inline-block;
    }

    .sl-select-wrap::after {
        content: "";
        position: absolute;
        right: .5rem;
        top: 50%;
        width: .55rem;
        height: .55rem;
        transform: translateY(-50%);
        pointer-events: none;
        background: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath d='M4 6l4 4 4-4z' fill='white' opacity='.9'/%3E%3C/svg%3E") no-repeat center/100% 100%;
    }

    .sl-select {
        -webkit-appearance: none;
        appearance: none;
        color: #cfe6ff;
        background: #1a62c7;
        border: 1px solid rgba(255, 255, 255, .28);
        border-radius: 10px;
        padding: .2rem 1.6rem .2rem .6rem;
        font-weight: 800;
        letter-spacing: .02em;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25);
    }

    /* ===== 時間（大きく） ===== */
    .sl-time {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        margin-top: 20px;
        margin-left: 30px;
    }

    .sl-time__num {
        font-size: 78px;
        font-weight: 900;
        line-height: 1;
    }

    .sl-time__unit {
        font-size: 26px;
        font-weight: 800;
        opacity: .9;
        margin-bottom: 10px;
        margin-left: 10px;
    }

    /* ===== リング（右上のボックスに近い見た目） ===== */
    .sl-right {
        grid-column: 2 / 3;
        grid-row: 1 / 3;
        display: grid;
        place-items: center;
        padding: 0px;
        justify-self: end;
        /* ← 右端に配置 */
    }

    .sl-ring {
        width: 160px;
        height: 160px;
        margin-top: 35px;
    }

    .sl-ring__bg {
        fill: none;
        stroke: rgba(255, 255, 255, .28);
        stroke-width: 8;
    }

    .sl-ring__fg {
        fill: none;
        stroke: #9ee8ff;
        stroke-width: 8;
        stroke-linecap: round;
        transform: rotate(-90deg);
        transform-box: fill-box;
        transform-origin: 50% 50%;
        transition: stroke-dashoffset .5s ease;
    }

    .sl-ring__fg.is-done {
        stroke: #DCBF7D;
    }

    .sl-ring__text.done {
        font-size: 9px;
        font-weight: 900;
        letter-spacing: .05em;
        /* ← テキストも金色に */
    }

    .sl-ring__text {
        fill: #cfe6ff;
        font-size: 18px;
        font-weight: 900;

    }

    /* ===== 入力バー（横長の濃い帯） ===== */
    .sl-inputbar {
        grid-column: 1 / -1;
        /* カード幅いっぱい */
        /* background: rgba(12, 48, 122, .38);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 10px; */

        /* box-shadow: inset 0 1px 0 rgba(255, 255, 255, .12); */
    }

    .sl-inputbar__form {
        display: flex;
        align-items: center;
        gap: .8rem;
    }

    .sl-hm {
        display: flex;
        align-items: center;
        gap: .5rem;
        flex: 1;
    }

    .sl-input {
        background: rgba(17, 95, 191, .75);
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 12px;
        color: #cfe6ff;
        padding: .5rem .7rem;
        font-weight: 800;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25);
    }

    .sl-input::placeholder {
        color: rgba(207, 230, 255, .85);
    }

    .sl-num {
        width: 120px;
        text-align: center;
    }

    .sl-hm__sep {
        font-weight: 900;
        opacity: .9;
        margin: 0 .2rem;
    }

    .sl-chips {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .sl-chip {
        padding: .35rem .8rem;
        border-radius: 999px;
        font-weight: 900;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .3);
        color: #e9f4ff;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25);
        transition: transform .1s ease, background .15s ease;
    }

    .sl-chip:hover {
        transform: translateY(-1px);
        background: rgba(255, 255, 255, .18);
    }

    /* ===== ボタン（大きめ） ===== */
    .sl-actions {
        grid-column: 1 / -1;
        display: flex;
        gap: 18px;
        padding-top: 6px;
        margin: 0 auto;
    }

    .sl-bigbtn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 200px;
        padding: .8rem 1.2rem;
        border-radius: 16px;
        font-weight: 900;
        letter-spacing: .02em;
        text-decoration: none;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .35);
        /* box-shadow: 0 8px 20px rgba(0, 0, 0, .2), inset 0 1px 0 rgba(255, 255, 255, .25); */
        transition: transform .1s ease, box-shadow .15s ease, filter .15s ease;
    }

    .sl-bigbtn--primary {
        background: linear-gradient(180deg, #3aa2ff 0%, #1E73E6 100%);
    }

    .sl-bigbtn--secondary {
        background: linear-gradient(180deg, #2F7EE5 0%, #1D5BCD 100%);
    }

    .sl-bigbtn:hover {
        transform: translateY(-1px);
        filter: brightness(1.03);
    }

    /* アニメ（増加時の数字ポップ） */
    .sl-pop {
        animation: slPop .28s ease;
    }

    @keyframes slPop {
        0% {
            transform: translateY(2px) scale(.98);
        }

        60% {
            transform: translateY(-1px) scale(1.06);
        }

        100% {
            transform: translateY(0) scale(1);
        }
    }

    /* モバイル */
    @media (max-width: 768px) {
        .sl-grid {
            grid-template-columns: 1fr;
        }

        .sl-right {
            grid-column: 1 / -1;
            grid-row: auto;
        }

        .sl-actions {
            flex-wrap: wrap;
        }

        .sl-bigbtn {
            min-width: 46%;
            flex: 1;
        }
    }
</style>

<script>
    /* RESET確認 */
    document.getElementById('resetAllForm')?.addEventListener('submit', (e) => {
        if (!confirm('RESET ALL LOGS? THIS CANNOT BE UNDONE.')) {
            e.preventDefault();
            return;
        }
        const btn = document.getElementById('resetAllBtn');
        btn.disabled = true;
        btn.style.opacity = .7;
    });

    /* +15/+30 加算（60分で繰り上げ） */
    document.querySelectorAll('.sl-chip').forEach(btn => {
        btn.addEventListener('click', () => {
            const form = document.getElementById('quickLogForm');
            const h = form.querySelector('input[name="hours"]');
            const m = form.querySelector('input[name="minutes"]');
            let minutes = (parseInt(m.value || 0, 10) || 0) + parseInt(btn.dataset.min, 10);
            let hours = parseInt(h.value || 0, 10) || 0;
            hours += Math.floor(minutes / 60);
            minutes = minutes % 60;
            h.value = hours;
            m.value = minutes;
        });
    });

    /* 値が増えた時だけ 数字/リング を軽くアニメ */
    (() => {
        const card = document.querySelector('.sl-card');
        if (!card) return;
        const nowMin = Number(card.dataset.minutes);
        const target = Number(card.dataset.target) || 0;
        const circ = Number(card.dataset.circ) || (2 * Math.PI * 26);
        const key = `studyMinutes:${card.dataset.week||'week'}`;

        const hEl = card.querySelector('.js-hours');
        const mEl = card.querySelector('.js-mins');
        const ring = card.querySelector('.sl-ring__fg');
        if (!hEl || !mEl || !ring) return;

        const prevStored = localStorage.getItem(key);
        const prevMin = prevStored !== null ? Number(prevStored) : nowMin;
        if (nowMin <= prevMin) {
            localStorage.setItem(key, String(nowMin));
            return;
        }

        const pct = m => target > 0 ? Math.min(100, Math.floor(m * 100 / target)) : 0;
        const from = prevMin,
            to = nowMin,
            dur = 800,
            ease = t => 1 - Math.pow(1 - t, 3),
            start = performance.now();

        function tick(t) {
            const p = Math.min(1, (t - start) / dur);
            const v = Math.round(from + (to - from) * ease(p));
            hEl.textContent = Math.floor(v / 60);
            mEl.textContent = v % 60;
            if (p < 1) requestAnimationFrame(tick);
            else [hEl, mEl].forEach(el => {
                el.classList.add('sl-pop');
                setTimeout(() => el.classList.remove('sl-pop'), 320);
            });
        }
        requestAnimationFrame(tick);

        const fromPct = pct(from),
            toPct = pct(to);
        ring.style.transition = 'stroke-dashoffset .5s ease';
        ring.style.strokeDasharray = circ;
        ring.style.strokeDashoffset = circ * (1 - fromPct / 100);
        requestAnimationFrame(() => ring.style.strokeDashoffset = circ * (1 - toPct / 100));

        localStorage.setItem(key, String(nowMin));
    })();
</script>
