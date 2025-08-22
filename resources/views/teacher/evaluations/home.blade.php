@extends('layouts.appTe')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home_te.css') }}">
    <main class="py-5">
        <div class="container">
            <div class="bg-white elev-card p-4">
                <!-- 上段：検索／並び替え／絞り込み -->
                <div class="row g-3 align-items-center">
                    <div class="col-lg-6">
                        <div class="input-group">
                            {{-- <span class="input-group-text control pill"><i class="bi bi-search"></i></span> --}}
                            {{-- <input class="form-control control pill" placeholder="Search..."> --}}
                            <form action="{{ route('evaluations.search.results') }}" method="get" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="q" value="{{ old('q') }}" class="form-control"
                                        placeholder="Search by student name or email address">
                                    <button class="btn btn-primary">search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select control pill">
                            <option>Order</option>
                            <option value="name">NAME（A→Z）</option>
                            {{-- <option value="likes">いいね（多い）</option> --}}
                            <option value="active">最終アクティブ（日付新しい）</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select control pill">
                            <option>絞り込み あり</option>
                            <option>ALL</option>
                            <option>⭐</option>
                            {{-- <option>👍多い(>=3)</option> --}}
                            <option>アクティブ（7日以内）</option>
                        </select>
                    </div>
                </div>

                <!-- クイックフィルター（チップ） -->
                <div class="d-flex gap-2 mt-3">
                    <button class="chip active"><i class="bi bi-star-fill text-warning me-1"></i></button>
                    {{-- <button class="chip"><i class="bi bi-hand-thumbs-up me-1"></i> > 多い</button> --}}
                    <button class="chip"><i class="bi bi-activity me-1"></i>Active</button>
                </div>

                <!-- 学生テーブル -->
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead class="text-muted">
                            <tr>
                                <th scope="col">Student</th>
                                <th scope="col" class="text-center">Feedback</th>
                                <th scope="col" class="text-center"><i class="bi bi-star"></i></th>
                                <th scope="col">Active</th>
                                <th scope="col" class="text-end">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row1 -->
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img class="avatar" src="https://i.pravatar.cc/80?img=1" alt="">
                                    <div class="fw-semibold">Daiki</div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary feedback-btn-sm">
                                        <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                        <span class="d-none d-sm-inline">Feedback</span>
                                    </a>
                                </td>
                                <td class="text-center"><i class="bi bi-star-fill text-warning"></i></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i>8/13/2025 6:24p.m </td>
                                <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary pill"><i
                                            class="bi bi-chevron-right"></i></a></td>
                            </tr>
                            <!-- row2 -->
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img class="avatar" src="https://i.pravatar.cc/80?img=12" alt="">
                                    <div class="fw-semibold">Kyota</div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary feedback-btn-sm">
                                        <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                        <span class="d-none d-sm-inline">Feedback</span>
                                    </a>
                                </td>
                                <td class="text-center"><i class="bi bi-star-fill text-warning"></i></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i>8/13/2025 6:24p.m </td>
                                <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary pill"><i
                                            class="bi bi-chevron-right"></i></a></td>
                            </tr>
                            <!-- row3 -->
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img class="avatar" src="https://i.pravatar.cc/80?img=20" alt="">
                                    <div class="fw-semibold">John</div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary feedback-btn-sm">
                                        <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                        <span class="d-none d-sm-inline">Feedback</span>
                                    </a>
                                </td>
                                <td class="text-center"><i class="bi bi-star text-secondary"></i></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i>8/13/2025 6:24p.m </td>
                                <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary pill"><i
                                            class="bi bi-chevron-right"></i></a></td>
                            </tr>
                            <!-- row4 -->
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img class="avatar" src="https://i.pravatar.cc/80?img=24" alt="">
                                    <div class="fw-semibold">Ema</div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary feedback-btn-sm">
                                        <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                        <span class="d-none d-sm-inline">Feedback</span>
                                    </a>
                                </td>
                                <td class="text-center"><i class="bi bi-star text-secondary"></i></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i>8/13/2025 6:24p.m </td>
                                <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary pill"><i
                                            class="bi bi-chevron-right"></i></a></td>
                            </tr>
                            <!-- row5 -->
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img class="avatar" src="https://i.pravatar.cc/80?img=32" alt="">
                                    <div class="fw-semibold">Jun</div>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary feedback-btn-sm">
                                        <span class="ic-tile-sm"><i class="bi bi-clipboard-check"></i></span>
                                        <span class="d-none d-sm-inline">Feedback</span>
                                    </a>
                                </td>
                                <td class="text-center"><i class="bi bi-star text-secondary"></i></td>
                                <td><i class="bi bi-calendar3 me-1 text-muted"></i>8/13/2025 6:24p.m </td>
                                <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary pill"><i
                                            class="bi bi-chevron-right"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ページネーション -->
                <nav class="mt-3">
                    <ul class="pagination justify-content-center gap-2">
                        <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                        <li class="page-item active"><span class="page-link">1</span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection
