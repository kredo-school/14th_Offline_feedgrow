@extends('layouts.app')

@section('title','学習記録を追加')

@section('content')
<div class="container py-4" style="max-width: 720px;">
  <h1 class="h4 mb-3">📝 今週の学習を記録</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form method="POST" action="{{ route('study.logs.store') }}" class="row g-3">
    @csrf
    <div class="col-md-4">
      <label class="form-label">日付</label>
      <input type="date" name="studied_at" class="form-control" value="{{ old('studied_at', $today) }}" required>
    </div>
    <div class="col-md-3">
      <label class="form-label">時間（h）</label>
      <input type="number" name="hours" min="0" max="24" step="1" class="form-control" value="{{ old('hours') }}">
    </div>
    <div class="col-md-3">
      <label class="form-label">分（m）</label>
      <input type="number" name="minutes" min="0" max="59" step="1" class="form-control" value="{{ old('minutes') }}">
    </div>
    <div class="col-12">
      <label class="form-label">メモ</label>
      <input type="text" name="memo" maxlength="255" class="form-control" placeholder="例: PHP OOP / 単語テスト" value="{{ old('memo') }}">
    </div>
    <div class="col-12 d-flex gap-2">
      <button class="btn btn-success">保存する</button>
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">戻る</a>
    </div>
  </form>
</div>
@endsection
