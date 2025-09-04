@extends('layouts.appTe')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home_te.css') }}">
    <main class="py-5">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container">
            <div class="bg-white elev-card p-4">
                <!-- 上段：検索 -->
                <div class="row g-3 align-items-center">
                    <div class="col-lg-6">
                        <form action="{{ route('evaluations.search.results') }}" method="get" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="q" value="{{ old('q') }}" class="form-control"
                                    placeholder="Search by student name or email address">
                                <button class="btn btn-primary">search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 学生テーブル -->
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col">Student</th>
                                <th scope="col" class="text-start">Feedback</th>
                                <th scope="col">Evaluation date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <!-- 生徒プロフィール -->
                                    <td class="d-flex align-items-center gap-3">
                                        @can('viewAllEvaluationsForStudent', $student)
                                            <a href="{{ route('teacher.evaluations.all_for_student', $student->id) }}"
                                                class="d-flex align-items-center gap-3 text-decoration-none text-body">
                                                @if ($student->profile_image)
                                                    <img class="avatar rounded-circle"
                                                        src="{{ asset('storage/' . $student->profile_image) }}"
                                                        alt="{{ $student->name }}">
                                                @else
                                                    <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                        style="width:50px;height:50px;font-size:30px;color:#c7cedc;border:1px solid #888888;"></i>
                                                @endif
                                                <div>{{ $student->name }}</div>
                                            </a>
                                        @else
                                            <div class="d-flex align-items-center gap-3">
                                                @if ($student->profile_image)
                                                    <img class="avatar rounded-circle"
                                                        src="{{ asset('storage/' . $student->profile_image) }}"
                                                        alt="{{ $student->name }}">
                                                @else
                                                    <i class="fa-solid fa-user rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                        style="width:50px;height:50px;font-size:30px;color:#c7cedc;border:1px solid #888888;"></i>
                                                @endif
                                                <div>{{ $student->name }}</div>
                                            </div>
                                        @endcan
                                    </td>

                                    <!-- フィードバック作成ボタン -->
                                    <td class="text-start">
                                        <a href="{{ route('evaluations.create', $student->id) }}"
                                            class="btn btn-primary feedback-btn-sm">
                                            <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                            <span class="d-none d-sm-inline">Feedback</span>
                                        </a>
                                    </td>

                                    <td class="text-start">
                                        {{ optional(
                                            $student->evaluations->first()?->evaluated_at ?? $student->evaluations->first()?->created_at,
                                        )?->format('Y-m-d') ?? '―' }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
