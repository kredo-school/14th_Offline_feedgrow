{{-- resources/views/teacher/evaluations/create.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>「{{ $student->name }}」さんの評価</h2>

    <form action="{{ route('evaluations.store') }}" method="POST">
      @csrf

      <input type="hidden" name="student_id" value="{{ $student->id }}">

      @foreach (['speaking' => '話す', 'listening' => '聞く', 'reading' => '読む', 'writing' => '書く'] as $key => $label)
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

      <div class="mb-3">
        <label class="form-label">コメント（任意）</label>
        <textarea name="comment" class="form-control" rows="3"></textarea>
      </div>

      <button class="btn btn-primary">送信する</button>
    </form>
  </div>
@endsection
