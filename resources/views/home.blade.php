@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="container dashboard-container">
  @include('components.profile')
  @include('components.calendar')
  @include('components.task')


  @include('components.graph', [
    'speakingAvg'  => $speakingAvg,
    'writingAvg'   => $writingAvg,
    'listeningAvg' => $listeningAvg,
    'readingAvg'   => $readingAvg,
    'grammarAvg'   => $grammarAvg,
  ])

  @include('components.recommend')
  @include('components.blog')
</div>

<div class="container py-4">
  <div class="alert alert-success text-center">
    <strong>{{ Auth::user()->username }}</strong>（Student）Welcome！
  </div>
</div>
@endsection
