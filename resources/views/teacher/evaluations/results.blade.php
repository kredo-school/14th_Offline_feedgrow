@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>Search results:「{{ $q }}」</h2>

    @if($students->isEmpty())
      <p>No matching students were found.</p>
    @else
      <table class="table">
        <thead>
          <tr>
            <th>name</th>
            <th>email address</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($students as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>{{ $student->email }}</td>
              <td>
                <a
                  href="{{ route('evaluations.create', $student->id) }}"
                  class="btn btn-sm btn-success"
                >
                  evaluate
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    {{-- ← 検索フォームへ戻る --}}
    <a href="{{ route('evaluations.search.form') }}" class="btn btn-secondary mt-3">
      Return to search form
    </a>
  </div>
@endsection
