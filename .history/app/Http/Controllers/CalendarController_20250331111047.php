namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Models\UserGroup;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function showAdmin($year, $month)
    {
        // その月のスケジュールを取得し、日付ごとに整理
        $schedules = Calendar::whereYear('date', $year)
                            ->whereMonth('date', $month)
                            ->get()
                            ->groupBy(function ($schedule) {
                                return date('j', strtotime($schedule->date)); // 日ごとにグループ化
                            });

        return view('calender.home', compact('year', 'month', 'schedules'));
    }

    // グループ作成データの保存
    public function store(Request $request)
    {
        \Log::info($request->all());

        $request->validate([
            'group_name' => 'required|string|max:30|unique:groups,group_name',
            'join_id' => 'required|integer|max:10',
            'edit_flg' => 'nullable|boolean'
        ], [
            'group_name.max' => 'グループ名は30文字以内で入力してください。',
            'join_id.max' => '参加IDは10文字以内で入力してください。',
            'group_name.unique' => 'このグループ名はすでに使用されています。',
        ]);

        \Log::info("Validated data: ", $request->only(['group_name', 'join_id', 'edit_flg']));

        $group = Group::create([
            'group_name' => $request->group_name,
            'join_id' => $request->join_id,
            'edit_flg' => $request->has('edit_flg') ? 1 : 0,
        ]);

        if ($group) {
            UserGroup::create([
                'user_id' => auth()->id(),
                'group_id' => $group->id,
                'owner_flg' => 1,
            ]);

            return redirect()->route('groups.list')->with('success', 'グループが作成されました！');
        }

        return back()->with('error', 'グループ作成に失敗しました。');
    }
}
