<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\CalendarGroup;

class ScheduleController extends Controller
{

    public function create()
    {
        return view('createschedule');
    }

    public function store(Request $request)
    {
        
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

    public function storeGroup(Request $request)
    {
        
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);



        $calendar = new Calendar;
        $form = $request->all();
        $calendar['title'] = $request->title;
        $calendar['content'] = $request->content;
        $calendar['event_start_date'] = $request->start_date;
        $calendar['event_end_date'] = $request->end_date;
        $calendar['event_start_time'] = $request->start_time;
        $calendar['event_end_time'] = $request->end_time;

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
 
        // データベースに保存する
        $news->fill($form);
        $news->save();



        Calendar::create([
            'user_id' => auth()->id(), // ログインユーザーのID
            'title'   => $request->title,
            'content' => $request->content,
            'event_start_date' => $request->start_date,
            'event_end_date'   => $request->end_date,
            'event_start_time' => $request->start_time,
            'event_end_time'   => $request->end_time,
        ]);
        CalendarGroup::create([
            'calendar_id' =>
            'group_id' =>

        ]);
        

        return redirect()->route('createschedule')->with('success', 'スケジュールを作成しました！');
    }
}
