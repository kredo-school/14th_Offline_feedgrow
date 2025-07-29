 <!-- カレンダー -->
 <!-- FullCalendar CSS & JS -->
{{-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
 <div class="box calendar-section">
        <div class="d-flex  justify-content-between align-items-center">
        <div class="d-flex">
            <i class="fa-solid fa-calendar-days fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">CALENDAR</h2>
        </div>
        <div>
            <button class="add-btn" onclick="">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
    <div id="calendar"></div>
 </div>


    <!-- FullCalendar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '100%',
                locale: 'ja' // 日本語表示にしたい場合
            });
            calendar.render();
        });
    </script>
@endsection --}}


<!-- カレンダー表示エリア -->
<div class="box calendar-section">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <i class="fa-solid fa-calendar-days fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">CALENDAR</h2>
        </div>
        <div>
            <button class="add-btn">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
    <div id="calendar"></div>
</div>

<!-- FullCalendar JS -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '100%',
                locale: 'ja'
            });
            calendar.render();
        }
    });
</script>
