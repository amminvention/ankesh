<?php

namespace App\Http\Controllers;

use App\VehicleRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $overdue_monthly = DB::table('vehicle_records')
            ->join('customers', 'vehicle_records.customer_id', '=', 'customers.id')
            ->select('vehicle_records.id','customers.name', DB::raw('SUM(vehicle_records.renewal_amount) as amount'), DB::raw('count(*) as nov'))
            ->whereDate('vehicle_records.renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))
            ->whereMonth('vehicle_records.created_at', Carbon::now()->format('m'))
            ->groupBy('customers.id')
            ->get();
        $overdue_all = DB::table('vehicle_records')
            ->join('customers', 'vehicle_records.customer_id', '=', 'customers.id')
            ->select('vehicle_records.id','customers.name', DB::raw('SUM(vehicle_records.renewal_amount) as amount'), DB::raw('count(*) as nov'))
            ->whereDate('vehicle_records.renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))
            ->groupBy('customers.id')
            ->get();
        $vehicle_records = VehicleRecord::whereDate('renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))->orderBy('renewal_date', 'ASC')->get();
        $monthly_pending = VehicleRecord::whereDate('renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))->whereMonth('created_at', Carbon::now()->format('m'))->get();
        return view('home', compact('vehicle_records', 'monthly_pending', 'overdue_monthly', 'overdue_all'));
    }
}
