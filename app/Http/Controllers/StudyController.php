<?php

namespace App\Http\Controllers;

use App\Models\StudyGoal;
use App\Models\StudyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudyController extends Controller
{
    // 今週の目標 保存/更新
    public function saveGoal(Request $request)
    {
        $validated = $request->validate([
            'target_hours' => 'required|in:2,4,6,8',
        ]);

        $userId        = Auth::id();
        $weekStart     = now()->startOfWeek(Carbon::MONDAY)->toDateString();
        $targetMinutes = (int) $validated['target_hours'] * 60;

        StudyGoal::updateOrCreate(
            ['user_id' => $userId, 'week_start_date' => $weekStart],
            ['target_minutes' => $targetMinutes]
        );

        return back()->with('success', '今週の目標を更新しました。');
    }

    // 学習ログ 追加
    public function storeLog(Request $request)
    {
        $validated = $request->validate([
            'studied_at' => 'required|date',
            'hours'      => 'nullable|integer|min:0|max:24',
            'minutes'    => 'nullable|integer|min:0|max:59',
            'memo'       => 'nullable|string|max:255',
        ]);

        $minutes = ($validated['hours'] ?? 0) * 60 + ($validated['minutes'] ?? 0);

        if ($minutes <= 0) {
            return back()
                ->withErrors(['hours' => '学習時間は0より大きい値を入力してください。'])
                ->withInput();
        }

        StudyLog::create([
            'user_id'    => Auth::id(),
            'studied_at' => $validated['studied_at'],
            'minutes'    => $minutes,
            'memo'       => $validated['memo'] ?? null,
        ]);

        return back()->with('success', '学習記録を追加しました。');
    }

    public function createLog()
{
    $today = now()->toDateString();
    return view('study.create', compact('today'));
}

public function resetAll()
{
    StudyLog::where('user_id', Auth::id())->delete();
    return back();
}
}
