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
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
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
        $prevMonth = 12;
        $prevYear--;
    }

    // 曜日を取得  前月次月の計算に使いたい
    

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

    $firstDayOfPreviousMonth = strtotime("first day of last month"); // 前月の1日目
    $lastDayOfPreviousMonth = date('t', $month); // 前月の最終日

    $firstDayOfPreviousMonth = strtotime("last day of last month"); // 前月の1日目
    $firstDayOfPreviousMonthFormatted = date('j', $firstDayOfPreviousMonth); // 日付をフォーマットして取得

    // 曜日を取得  前月次月の計算に使いたい
    $lastmonthday = $lastDayOfPreviousMonth-$weekday;
    $nextmonthday = 1;



    // カレンダー配列を作成
    $calendar = [];
    $row = [];
    for ($i = 0; $i < $startWeekday; $i++) {
        $row[] = $lastmonthday++;
    }
    for ($day = 1; $day <= $lastDay; $day++) {
        $row[] = $day;
        if (count($row) == 7) {
            $calendar[] = $row;
            $row = [];
        }
    }
    while (count($row) < 7) {
        $row[] = $nextmonthday;
        
    }
    $calendar[] = $row;

    // 翌月の最初の数日をグレーにする
    $nextMonthDays = range($lastmonthday-$weekday-1, $lastDayOfPreviousMonth);
@endphp



<div class="switch">
<a class="month_toggle" href="{{ url('/admin/home/' . $prevYear . '/' . $prevMonth) }}">◀</a>
　{{ $year }}年　{{ $month }}月　
<a class="month_toggle" href="{{ url('/admin/home/' . $nextYear . '/' . $nextMonth) }}">▶</a>

<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>

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
                        // 前月の日付の判定
                        if ($loop->parent->first && $day > 20) {
                            $class = "prev-month";
                        }
                        // 翌月の日付の判定
                        elseif ($loop->parent->last && $day < 10) {
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




