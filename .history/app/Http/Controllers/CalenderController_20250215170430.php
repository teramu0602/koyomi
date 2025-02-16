namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show($year, $month)
    {
        return view('calendar.index', compact('year', 'month'));
    }

    public function showAdmin($year, $month)
    {
        return view('admin.calendar', compact('year', 'month'));
    }
}
