@extends('layouts.admin_calender')

@section('title', 'home')


@section('drop_menu')
<p>
    @guest
    @if (Route::has('login'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
    @endif

    @if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
    @endif
    @else

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>


        </div>
    </li>
    @endguest
</p>
@endsection

@section('header')
<p>カレンダー</p>
@endsection

@section('content')
@php
// URLパラメータから年月を取得（なければ現在の年月）
$year = request('year', date('Y'));
$month = request('month', date('n'));
$weekday = request('weekday', date('w'));

// 前月・次月の計算
$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth=12;
    $prevYear--;
}

// 曜日を取得 前月次月の計算に使いたい


$nextMonth=$month + 1;
$nextYear=$year;
if ($nextMonth> 12) {
    $nextMonth = 1;
    $nextYear++;
}

// 月の情報を取得
$firstDay = strtotime("$year-$month-1");
$lastDay = date('t', $firstDay);
$lastDayTimestamp = strtotime("$year-$month-$lastDay");
$startWeekday = date('w', $firstDay);
$lastWeekday = date('w', $lastDayTimestamp);

$firstDayOfPreviousMonth = strtotime("first day of last month"); // 前月の1日目
$lastDayOfPreviousMonth = date('t', strtotime("$prevYear-$prevMonth-01")); // 前月の最終日

$firstDayOfPreviousMonth = strtotime("last day of last month"); // 前月の1日目
$firstDayOfPreviousMonthFormatted = date('j', $firstDayOfPreviousMonth); // 日付をフォーマットして取得

// 曜日を取得 前月次月の計算に使いたい
$lastmonthday = $lastDayOfPreviousMonth-$startWeekday+1;
$nextmonthday = 1;

// カレンダー配列を作成
$calendar = [];
$row = [];
for ($i = 0; $i < $startWeekday; $i++) {
    $row[]=$lastmonthday++;
}
for ($day=1; $day <=$lastDay; $day++) {
    $row[]=$day;
    if (count($row)==7) {
        $calendar[]=$row;
        $row=[];
    }
}

for ($i=0; $i < 6-$lastWeekday; $i++) {
    $row[]=$nextmonthday++;
}


$calendar[]=$row;

// 翌月の最初の数日をグレーにする
$nextMonthDays=range($lastmonthday-$weekday-1, $lastDayOfPreviousMonth);
@endphp



<div class="group_color">
    <a class="who2">{{ $group->group_name }}の予定表</a>
    <a class="month_toggle" href="{{ url('/group_home/' . $group->id . '/'. $prevYear . '/' . $prevMonth) }}">◀</a>
    　{{ $year }}年　{{ $month }}月　
    <a class="month_toggle" href="{{ url('/group_home/' . $group->id . '/'. $nextYear . '/' . $nextMonth) }}">▶</a>

    <form action="{{ route('groups.list') }}" method="GET" style="display: inline;">
        <button type="submit" class="switch_button {{ request()->is('grouplist') ? 'active' : '' }}">グループ</button>
    </form>

    <form action="{{ route('groups.list') }}" method="GET" style="display: inline;">
        <button type="submit" {{ request()->is('personal') ? 'active' : '' }}">個人</button>
    </form>

    <form action="{{ route('groupCalendarAdd', ['group_id' => $group->id]) }}" method="GET" style="display: inline;">
        <button type="submit" >予定作成</button>
    </form>
</div>

<table>
    <tr>
        <th class="red">日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class="blue">土</th>
    </tr>
    @foreach ($calendar as $week)
    <tr>
        @foreach ($week as $day)
        @php
        $class = "";

        if ($day !== "") {
            // 前月の日付の判定
            if ($loop->parent->first && $day > 20) {
                $class = "prev-month";
            }
            // 翌月の日付の判定
            elseif ($loop->parent->last && $day < 10) {
                $class="next-month" ;
            }
            // 日曜（赤）
            elseif ($loop->index % 7 == 0) {
                $class = "sunday";
            }
            // 土曜（青）
            elseif ($loop->index % 7 == 6) {
                $class = "saturday";
            }
        }
        @endphp
        <td class="{{ $class }}" onclick="window.location.href='飛びたいパス';">
            <div>{{ $day }}</div>
            <div>
                @php
                    $e = $post->filter(function($event) use ($year, $month, $day, $group) {
                    return $event->event_start_date === sprintf('%04d-%02d-%02d', $year, $month, $day);                        
                    });
                @endphp

                @foreach($e as $event)
                    <div class = "title1">{{ $event->title }}</div>
                @endforeach
            </div>
        </td>
        @endforeach
    </tr>
    @endforeach
</table>


<script>
    function toggleMode() {
        alert("グループ / 個人の切り替え機能は後で実装");
    }
</script>






<table>
    <tr>
        <th class="red">日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class="blue">土</th>
    </tr>
    @foreach ($calendar as $week)
    <tr>
        @foreach ($week as $day)
        @php
        $class = "";

        if ($day !== "") {
            // 前月の日付の判定
            if ($loop->parent->first && $day > 20) {
                $class = "prev-month";
            }
            // 翌月の日付の判定
            elseif ($loop->parent->last && $day < 10) {
                $class="next-month" ;
            }
            // 日曜（赤）
            elseif ($loop->index % 7 == 0) {
                $class = "sunday";
            }
            // 土曜（青）
            elseif ($loop->index % 7 == 6) {
                $class = "saturday";
            }
        }
        @endphp
        <td class="{{ $class }}">
            <div>{{ $day }}</div>
            <div>
                @php
                    $e = $post->filter(function($event) use ($year, $month, $day, $group) {
                    return $event->event_start_date === sprintf('%04d-%02d-%02d', $year, $month, $day);                        
                    });
                @endphp

                @foreach($e as $event)
                    <div>
                        <a href="{{ route('group.details', ['id' => $event->id]) }}">{{ $event->title }}</a>
                    </div>
                @endforeach
            </div>
        </td>
        @endforeach
    </tr>
    @endforeach
</table>


<table>
    <tr>
        <th class="red">日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class="blue">土</th>
    </tr>
    @foreach ($calendar as $week)
    <tr>
        @foreach ($week as $day)
        @php
        $class = "";

        if ($day !== "") {
            $dayDate = \Carbon\Carbon::parse($day); // Carbonで日付を扱いやすくする
            $dayYear = $dayDate->year;
            $dayMonth = $dayDate->month;
            $dayDay = $dayDate->day;

            // 前月の日付の判定
            if ($loop->parent->first && ($dayMonth != $month)) {
                $class = "prev-month";
            }
            // 翌月の日付の判定
            elseif ($loop->parent->last && ($dayMonth != $month)) {
                $class = "next-month";
            }
            // 日曜（赤）
            elseif ($loop->index % 7 == 0) {
                $class = "sunday";
            }
            // 土曜（青）
            elseif ($loop->index % 7 == 6) {
                $class = "saturday";
            }
        }

        @endphp
        <td class="{{ $class }}" style="position: relative;" >
        @php
    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
    $e = $post->filter(function($event) use ($dateStr) {
        return $event->event_start_date === $dateStr
            && Auth::check()
            && $event->user_id === Auth::id();
    });
@endphp
            <div>{{ (int)substr($day, 8, 2) }}</div>
            {{-- イベント数のバッジ（0件は表示しない） --}}
            @if ($e->count() > 0)
                <div class="event-count-badge">
                    {{ $e->count() }}
                </div>
            @endif
            <div class = "calendar_title">

                <!-- @foreach($e as $event)
                    <div>{{ $event->title }}</div>
                @endforeach -->
                @foreach($e as $event)
                <div>
                    <a href="{{ route('group.details', ['id' => $event->id]) }}">{{ $event->title }}</a>
                </div>
        @endforeach
            </div>
        </td>
        @endforeach
    </tr>
    @endforeach
</table>

@endsection