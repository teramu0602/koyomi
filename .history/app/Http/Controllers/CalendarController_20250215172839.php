<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show($year, $month,$weekday)
    {
        return view('calender.home', compact('year', 'month'));
    }

    public function showAdmin($year, $month,$weekday)
    {
        return view('calender.home', compact('year', 'month'));
    }
}
