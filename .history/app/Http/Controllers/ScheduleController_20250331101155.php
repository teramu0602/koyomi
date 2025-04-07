<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        public function create()
        {
            return view('schedule_create');
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);

        Calendar::create([
            'user_id' => auth()->id(), // ログインユーザーのID
            'title'   => $request->title,
            'content' => $request->content,
            'event_start_date' => $request->start_date,
            'event_end_date'   => $request->end_date,
            'event_start_time' => $request->start_time,
            'event_end_time'   => $request->end_time,
        ]);

        return redirect()->route('createschedule')->with('success', 'スケジュールを作成しました！');
    }
}
