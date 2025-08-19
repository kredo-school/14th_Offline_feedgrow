 <!-- カレンダー -->
 <div class="box calendar-section">
     <!-- === 総学習時間カード === -->
     <div class="study-card" id="studyCard">
         <div class="study-card__bg"></div>
         <div class="study-card__inner">
             <div class="study-card__header">
                 <span class="dot"></span>
                 <div class="heading">
                     <div class="title">今週の学習時間</div>
                     <div class="sub">(目標：<span id="goalHoursText">7</span>時間)</div>
                 </div>
                 <div class="progress-wrap" aria-label="progress">
                     <svg viewBox="0 0 120 120" class="ring">
                         <defs>
                             <linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">
                                 <stop offset="0%" stop-color="#a7e8ff" />
                                 <stop offset="100%" stop-color="#7cc9ff" />
                             </linearGradient>
                         </defs>
                         <!-- 背景リング -->
                         <circle cx="60" cy="60" r="52" class="ring-bg" />
                         <!-- 進捗リング -->
                         <circle cx="60" cy="60" r="52" class="ring-fg" stroke="url(#g)" />
                     </svg>
                     <div class="progress-center">
                         <div class="pct" id="pct">0%</div>
                     </div>
                 </div>
             </div>

             <div class="study-card__value">
                 <span class="num" id="hours">0</span><span class="unit">時間</span>
                 <span class="num" id="mins">00</span><span class="unit">分</span>
             </div>

             <div class="study-card__bar">
                 <div class="bar" id="bar"></div>
                 <div class="shine" id="shine"></div>
             </div>
         </div>
     </div>
 </div>

 <script>
  (function(){
    const $hours = document.getElementById('hours');
    const $mins  = document.getElementById('mins');
    const $pct   = document.getElementById('pct');
    const $bar   = document.getElementById('bar');
    const $shine = document.getElementById('shine');
    const $ring  = document.querySelector('.ring-fg');
    const $goalText = document.getElementById('goalHoursText');

    let currentMin = 0;
    let goalH = 7;

    function format(value, digits=2){ return String(value).padStart(digits,'0'); }

    function animateNumber($el, from, to, duration=500){
      const start = performance.now();
      function step(now){
        const t = Math.min(1, (now-start)/duration);
        const eased = 1 - Math.pow(1-t, 3);
        const val = from + (to-from) * eased;
        $el.textContent = Math.floor(val);
        if(t<1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }

    function updateVisual(totalMin){
      const h = Math.floor(totalMin / 60);
      const m = totalMin % 60;
      animateNumber($hours, parseInt($hours.textContent||0), h, 500);
      animateNumber($mins,  parseInt($mins.textContent||0),  m, 500);
      $mins.textContent = format(parseInt($mins.textContent||0));

      const pct = Math.min(100, Math.round((totalMin / (goalH*60)) * 100));
      $pct.textContent = pct + "%";

      const CIRC = 2 * Math.PI * 52;
      const offset = CIRC * (1 - pct/100);
      $ring.style.strokeDashoffset = offset;

      $bar.style.width = pct + '%';
      $shine.classList.remove('run'); void $shine.offsetWidth; $shine.classList.add('run');
    }

    window.setStudyMinutes = function(totalMin, goalHours){
      if(typeof goalHours === 'number' && goalHours>0){
        goalH = goalHours; $goalText.textContent = goalH;
      }
      updateVisual(totalMin);
      currentMin = totalMin;
    };

    // ✅ 初期値（例：1時間9分 = 69分）
    setStudyMinutes(79, 7);
  })();
</script>
