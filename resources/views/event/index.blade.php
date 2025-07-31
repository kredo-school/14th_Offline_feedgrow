@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">カレンダー</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="calendar table table-bordered text-center">
        <thead>
            <tr>
                <th class="text-danger">Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th class="text-primary">Sat</th>
            </tr>
        </thead>
        <tbody>
            @php
                // カレンダーの行・日付サンプル（必要に応じて動的に生成してOK）
                $weeks = [
                    [30,'',1,2,3,4,5],
                    [6,7,8,9,10,11,12],
                    [13,14,15,16,17,18,19],
                    [20,21,22,23,24,25,26],
                    [27,28,29,30,31,'','']
                ];
            @endphp

            @foreach($weeks as $week)
                <tr>
                @foreach($week as $day)
                    <td style="vertical-align: top; height:120px; overflow:hidden;">
                        @if($day !== '')
                            <div class="fw-bold">{{ $day }}</div>

                            @php
                                $date = '2025-07-'.str_pad($day,2,'0',STR_PAD_LEFT);
                                $dayEvents = $events->where('date', $date);
                            @endphp

                            {{-- 既存イベント --}}
                            @foreach($dayEvents as $event)
                                <div class="mt-2 p-1 border rounded">
                                    <div><strong>{{ $event->title }}</strong></div>
                                    <div>{{ $event->time }}</div>
                                    <button
                                        class="btn btn-sm btn-primary mt-1"
                                        data-toggle="modal"
                                        data-target="#eventModal"
                                        data-id="{{ $event->id }}"
                                        data-date="{{ $event->date }}"
                                        data-title="{{ $event->title }}"
                                        data-time="{{ $event->time }}"
                                    >編集</button>
                                    <form
                                        action="{{ route('event.delete', $event->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mt-1">削除</button>
                                    </form>
                                </div>
                            @endforeach

                            {{-- 新規追加ボタン --}}
                            <button
                                class="btn btn-sm btn-success mt-2"
                                data-toggle="modal"
                                data-target="#eventModal"
                                data-date="{{ $date }}"
                            >追加</button>
                        @endif
                    </td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- モーダル：追加／編集共通 --}}
<div class="modal fade" id="eventModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="eventForm" method="POST" action="">
        @csrf
        <input type="hidden" name="date" id="modal-date">
        <input type="hidden" name="_method" id="modal-method" value="POST">

        <div class="modal-header">
          <h5 class="modal-title" id="modal-title">予定を追加</h5>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>授業名</label>
            <input type="text" name="title" id="modal-title-input" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>時間 (HH:MM)</label>
            <input type="time" name="time" id="modal-time-input" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="modal-save-btn">保存</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- モーダル初期化スクリプト --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  $('#eventModal').on('show.bs.modal', function(e) {
    const btn    = $(e.relatedTarget);
    const form   = $('#eventForm');
    const isEdit = btn.data('id') !== undefined;

    if (isEdit) {
      // 編集モード
      $('#modal-title').text('予定を編集');
      $('#modal-method').attr('name', '_method').val('PATCH');
      form.attr('action', `/event/${btn.data('id')}`);
      $('#modal-title-input').val(btn.data('title'));
      $('#modal-time-input').val(btn.data('time'));
    } else {
      // 追加モード
      $('#modal-title').text('予定を追加');
      $('#modal-method').removeAttr('name');
      form.attr('action', '{{ route("event.store") }}');
      $('#modal-title-input').val('');
      $('#modal-time-input').val('');
    }

    // 日付は共通
    $('#modal-date').val(btn.data('date'));
  });
});
</script>
@endpush
@endsection
