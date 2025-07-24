    <!-- プロフィール -->
    <div class="profile-section">
        <div class="study-progress-container text-center">
            <div class="profile-progress">
                <svg class="progress-ring" width="340" height="340">
                    <circle class="progress-bg" r="160" cx="170" cy="170" />
                    <circle class="progress-bar" r="160" cx="170" cy="170" />
                </svg>
                <img src="{{ asset('images/daiki_icon.jpg') }}" alt="profile" class="profile-image">
            </div>
            <div class="study-time mt-2">
                <span class="fw-bold" style="font-size: 1.1rem;">Today: 2h 15m</span>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const progressBar = document.querySelector('.progress-bar');
                const totalLength = 2 * Math.PI * 70;
                const progressRatio = 0.7;

                if (progressBar) {
                    progressBar.style.strokeDasharray = totalLength;
                    progressBar.style.strokeDashoffset = totalLength * (1 - progressRatio);
                }
            });
        </script>
    </div>
