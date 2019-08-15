<?php

namespace App\Http\Controllers;

use App\Customer;
use App\VehicleRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function salesReport()
    {
        $vehicle_records = DB::table('vehicle_records')->select('id', 'created_at', DB::raw('SUM(last_pay_amount) as amount'))->groupBy('created_at')->get();
        return view('report.sale', compact('vehicle_records'));
    }

    public function pendingReport(Request $request)
    {
        $params = $request->except('_token');
        $customers = Customer::pluck('name', 'id');
        $vehicle_records = VehicleRecord::whereDate('renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))->orderBy('renewal_date', 'ASC')->filter($params)->get();
        return view('report.pending', compact('vehicle_records', 'customers'));
    }

    public function receivedReport(Request $request)
    {
        $params = $request->except('_token');
        $customers = Customer::pluck('name', 'id');
        $vehicle_records = VehicleRecord::filter($params)->get();
        return view('report.received', compact('vehicle_records', 'customers'));
    }

    public function vehicleReport()
    {
        $vehicle_records = VehicleRecord::with('salesType', 'customers')->orderBy('created_at', 'ASC')->get();
        return view('report.vehicle', compact('vehicle_records'));
    }
}
