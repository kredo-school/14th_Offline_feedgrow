<!-- リコメンド -->
<div class="box recommend-section">
    <div class="d-flex  justify-content-between align-items-center">
        <div class="d-flex">
            <i class="fa-solid fa-thumbs-up fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold mb-2">RECOMMEND</h2>
        </div>
    </div>
    @if(!empty($materials))
    <ul>
        <li class="my-2">{{$materials['speaking']}}</li>
        <li class="my-2">{{$materials['writing']}}</li>
        <li class="my-2">{{$materials['listening']}}</li>
        <li class="my-2">{{$materials['reading']}}</li>
    </ul>
    @endif
</div>
