@extends('layouts.appTe')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home_te.css') }}">

<main class="py-5">
  <div class="container">
    <div class="bg-white rounded shadow-sm p-4">
      <h2 class="mb-4 text-black fw-bold">Search results:「{{ $q }}」</h2>

      @if($students->isEmpty())
        <div class="alert alert-warning">
          No matching students were found.
        </div>
      @else
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>Student</th>
                <th>Email address</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($students as $student)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                        @if ($student->profile_image)
                                            <img class="avatar rounded-circle"
                                                src="{{ asset('storage/' . $student->profile_image) }}"
                                                alt="{{ $student->name }}">
                                        @else
                                            <i class="fa-solid fa-user avatar rounded-circle"
                                                style="font-size:32px; color:#ccc;"></i>
                                        @endif
                      <span>{{ $student->name }}</span>
                    </div>
                  </td>
                  <td>{{ $student->email }}</td>
                  <td class="text-center">
                    <a
                      href="{{ route('evaluations.create', $student->id) }}"
                      class="btn btn-primary btn-sm rounded-pill px-3"
                    >
                      <i class="fas fa-clipboard-check me-1"></i> Evaluate
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      <div class="mt-4">
        <a href="{{ route('teacher.home') }}"
          class="btn btn-outline-primary rounded-pill">
          <i class="fas fa-arrow-left me-1"></i> Return to search form
        </a>
      </div>
    </div>
  </div>
</main>
@endsection
