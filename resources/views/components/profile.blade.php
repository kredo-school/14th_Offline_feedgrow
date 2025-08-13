<style>
.progress-ring {
    transform: rotate(-90deg);     
    transform-origin: 50% 50%;
}
.progress-bg, .progress-bar {
    fill: none;
    stroke-width: 18px;
}
.progress-bg {
    stroke: #d9d9d9;
}
.progress-bar {
    stroke: #51d1c6;
    stroke-linecap: round;
}
</style>

<div class="profile-section">
    <div class="study-progress-container text-center">
        <div class="profile-progress">
            <svg class="progress-ring" width="340" height="340" data-progress="{{ $progressRatio ?? 0 }}">
                <circle class="progress-bg" r="160" cx="170" cy="170" />
                <circle class="progress-bar" r="160" cx="170" cy="170" />
            </svg>
            <img src="{{ asset('images/daiki_icon.jpg') }}" alt="profile" class="profile-image">
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const svg = document.querySelector('.progress-ring');
    const bar = document.querySelector('.progress-bar');
    if (!svg || !bar) return;

    const r = parseFloat(bar.getAttribute('r'));
    const C = 2 * Math.PI * r;
    const ratio = parseFloat(svg.dataset.progress || '0');

    bar.style.strokeDasharray = C;
    bar.style.strokeDashoffset = C * (1 - ratio);
});
</script>
