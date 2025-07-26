@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="alert alert-primary text-center">
        <strong>{{ Auth::user()->username }}</strong> さん（Teacher）Welcome！
    </div>
    </div>
@endsection
