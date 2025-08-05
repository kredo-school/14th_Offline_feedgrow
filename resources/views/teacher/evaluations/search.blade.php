@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Student search</h2>
    <form action="{{ route('evaluations.search.results') }}" method="get" class="mb-4">
      <div class="input-group">
        <input
          type="text"
          name="q"
          value="{{ old('q') }}"
          class="form-control"
          placeholder="Search by student name or email address"
        >
        <button class="btn btn-primary">search</button>
      </div>
    </form>
  </div>
@endsection
