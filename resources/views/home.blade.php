@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="alert alert-success text-center">
        <strong>{{ Auth::user()->username }}</strong>（Student）Welcome！
    </div>
</div>

@endsection
