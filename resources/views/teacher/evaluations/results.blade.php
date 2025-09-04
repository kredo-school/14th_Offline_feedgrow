@extends('layouts.appTe')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home_te.css') }}">

    <main class="py-5">
        <div class="container">
            <div class="bg-white p-4 result-card">
                <h2 class="mb-4 text-search fw-bold">Search results:「<span class="text-black">{{ $q }}</span>」</h2>

                @if ($students->isEmpty())
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
                                    <th class="text-start">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($student->profile_image)
                                                    <img class="avatar rounded-circle"
                                                        src="{{ asset('storage/' . $student->profile_image) }}"
                                                        alt="{{ $student->name }}">
                                                @else
                                                    {{-- <i class="fa-solid fa-user avatar rounded-circle"
                                                style="font-size:32px; color:#ccc;"></i> --}}
                                                    <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                        style="width:50px;height:50px;font-size:30px;color:#c7cedc;border:1px solid #888888;"></i>
                                                @endif
                                                <span class="ms-4">{{ $student->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $student->email }}</td>
                                        <td class="text-start">
                                        <a href="{{ route('evaluations.create', $student->id) }}"
                                            class="btn btn-primary feedback-btn-sm">
                                            <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                            <span class="d-none d-sm-inline">Feedback</span>
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('teacher.home') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Return to search form
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
