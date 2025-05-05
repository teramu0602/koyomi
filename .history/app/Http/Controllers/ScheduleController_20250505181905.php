<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\CalendarGroup;
use App\Models\Group;

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
            'color'  => 'nullable', //追加　nullableの編集をする！
        ]);

        Calendar::create([
            'user_id' => auth()->id(), // ログインユーザーのID
            'title'   => $request->title,
            'content' => $request->content,
            'event_start_date' => $request->start_date,
            'event_end_date'   => $request->end_date,
            'event_start_time' => $request->start_time,
            'event_end_time'   => $request->end_time,
            'color'  => $request->color,
        ]);
        

        return redirect()->route('calendar')->with('success', 'スケジュールを作成しました！');
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
            'group_id' =>'nullable',
            'color'  => 'nullable', //追加　nullableの編集をする！
        ]);



        $calendar = new Calendar;
        $form = $request->all();
        $calendar['user_id'] = auth()->id();
        $calendar['title'] = $request->title;
        $calendar['content'] = $request->content;
        $calendar['event_start_date'] = $request->start_date;
        $calendar['event_end_date'] = $request->end_date;
        $calendar['event_start_time'] = $request->start_time;
        $calendar['event_end_time'] = $request->end_time;
        $calendar['color'] = $request->color;

        $calendar->save();

        CalendarGroup::create([
            'calendar_id' => $calendar['id'],
            'group_id' => $request->group_id

        ]);
        return redirect()->route('group.home', ['id' => $request->group_id])
        ->with('success', 'スケジュールを作成しました。');
    }


    public function s_edit($id)
    {
        $event = Calendar::with('groups')->findOrFail($id);
        $canEdit = $event->groups->isEmpty() || $event->groups->contains(function ($group) {
            return $group->edit_flg == 1;
        });
    
        if (!$canEdit) {
            return redirect()->back()->with('error', 'このイベントは編集できません。');
        }
    
        return view('admin.edit_schedule', compact('event'));
    }
    


    
    public function s_update(Request $request, $id)
    {
        $event = Calendar::with('groups')->findOrFail($id);
        $groupId = $request->input('group_id');

    
        // $canEdit = $event->groups->contains(function ($group) {
        //     return $group->edit_flg == 1;
        // });
    
        // if (!$canEdit) {
        //     return redirect()->back()->with('error', 'このイベントは編集できません。');
        // }
    
        $request->validate([
            'event_start_date' => 'required|date',
            'event_start_time' => 'required',
            'event_end_date' => 'nullable|date',
            'event_end_time' => 'nullable',
            'content' => 'nullable|string|max:1000',
            'title' =>'required',
            'group_id' =>'nullable',
        ]);
    
        $event->update([
            'event_start_date' => $request->event_start_date,
            'event_start_time' => $request->event_start_time,
            'event_end_date' => $request->event_end_date,
            'event_end_time' => $request->event_end_time,
            'content' => $request->content,
            'title' => $request->title,
        ]);
        \Log::info('更新後: ', $event->toArray());
        return redirect()->route('group.home', ['id' => $groupId])
        ->with('success', 'スケジュールを更新しました。');

    }

    public function destroy($id)
{
    $event = Calendar::with('groups')->findOrFail($id);

    // 編集可能な権限チェック
    $canEdit = $event->groups->isEmpty() || $event->groups->contains(function ($group) {
        return $group->edit_flg == 1;
    });

    if (!$canEdit) {
        return redirect()->back()->with('error', 'このイベントは削除できません。');
    }

    $event->delete();

    // リダイレクト先を分岐
    if ($event->groups->isNotEmpty()) {
        $groupId = $event->groups->first()->id; // 最初のグループIDを取得
        return redirect()->route('group.home', ['id' => $groupId])
                         ->with('success', 'イベントを削除しました。');
    } else {
        return redirect()->route('calendar')
                         ->with('success', 'イベントを削除しました。');
    }
}

    
}
