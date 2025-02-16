@extends('layouts.admin_calender')

@section('title', 'home')

@section('drop_menu')
<p>    ナビ入れる    max-width: 1870px;  直す</p>
@endsection

@section('header')
<p>カレンダー</p>
@endsection



  
  
  
  
  <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; text-align: center; padding: 10px; }
        th { background: orange; }
        .sunday { background: pink; color: red; }
        .saturday { background: pink; color: blue; }
        .next-month { background: #ccc; color: #666; }
    </style>
@section('content')
@php
    // URLパラメータから年月を取得（なければ現在の年月）
    $year = request('year', date('Y'));
    $month = request('month', date('n'));

    // 前月・次月の計算
    $prevMonth = $month - 1;
    $prevYear = $year;
    if ($prevMonth < 1) {
        $prevMonth = 12;
        $prevYear--;
    }

    $nextMonth = $month + 1;
    $nextYear = $year;
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $nextYear++;
    }

    // 月の情報を取得
    $firstDay = strtotime("$year-$month-1");
    $lastDay = date('t', $firstDay);
    $startWeekday = date('w', $firstDay);

    // カレンダー配列を作成
    $calendar = [];
    $row = [];
    for ($i = 0; $i < $startWeekday; $i++) {
        $row[] = "";
    }
    for ($day = 1; $day <= $lastDay; $day++) {
        $row[] = $day;
        if (count($row) == 7) {
            $calendar[] = $row;
            $row = [];
        }
    }
    while (count($row) < 7) {
        $row[] = "";
    }
    $calendar[] = $row;

    // 翌月の最初の数日をグレーにする
    $nextMonthDays = range(1, 4);
@endphp



<a class="month_toggle" href="{{ url('/calendar', ['year' => $prevYear, 'month' => $prevMonth]) }}">◀</a>
　{{ $year }}年　{{ $month }}月　
<a class="month_toggle" href="{{ url('/calendar', ['year' => $nextYear, 'month' => $nextMonth]) }}">▶</a>
<button onclick="toggleMode()">グループ / 個人</button>

<table>
    <tr>
        <th class="sunday">日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class="saturday">土</th>
    </tr>
    @foreach ($calendar as $week)
        <tr>
            @foreach ($week as $day)
                @php
                    $class = "";
                    if ($day !== "") {
                        if (in_array($day, $nextMonthDays)) {
                            $class = "next-month";
                        } elseif (($loop->index + $startWeekday) % 7 == 0) {
                            $class = "sunday";
                        } elseif (($loop->index + $startWeekday) % 7 == 6) {
                            $class = "saturday";
                        }
                    }
                @endphp
                <td class="{{ $class }}">{{ $day }}</td>
            @endforeach
        </tr>
    @endforeach
</table>

<script>
    function toggleMode() {
        alert("グループ / 個人の切り替え機能は後で実装");
    }
</script>

</body>
</html>
@endsection




@php
    $class = "";
    $currentMonth = date('m');  // 現在の月
    $currentYear = date('Y');   // 現在の年
    $daysInCurrentMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); // 現月の日数

    // 前月と来月の日数を計算
    $prevMonthDays = [];
    $nextMonthDays = [];

    // 前月の日付を取得
    $prevMonthLastDay = strtotime("last day of previous month");
    $prevMonthDays = range(1, date('d', $prevMonthLastDay));  // 前月の日数

    // 来月の日付を取得
    $nextMonthFirstDay = strtotime("first day of next month");
    $nextMonthDays = range(1, date('t', $nextMonthFirstDay));  // 来月の日数

    // カレンダーに表示する日付
    $totalDays = $daysInCurrentMonth + count($prevMonthDays) + count($nextMonthDays); // 表示すべき日数

    // 最初の日曜日の曜日
    $startWeekday = date('w', strtotime("first day of $currentYear-$currentMonth-01"));
@endphp

@for ($day = 1; $day <= $totalDays; $day++)
    @php
        // グレーの日付（前月・来月の日付）
        if ($day <= count($prevMonthDays)) {
            $class = "gray"; // 前月の日付にはグレーのクラス
        } elseif ($day > $daysInCurrentMonth) {
            $class = "gray"; // 来月の日付にはグレーのクラス
        }
        // 現月の日曜日
        elseif (($loop->index + $startWeekday) % 7 == 0) {
            $class = "sunday";
        }
        // 現月の土曜日
        elseif (($loop->index + $startWeekday) % 7 == 6) {
            $class = "saturday";
        }
        else {
            $class = "";  // 現月の日付は通常クラス（何も指定しない）
        }
    @endphp
    <div class="day {{ $class }}">
        {{ $day <= $daysInCurrentMonth ? $day : '' }}
    </div>
@endfor
