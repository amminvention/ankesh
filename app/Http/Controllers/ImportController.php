<?php

namespace App\Http\Controllers;

use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use App\VehicleRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        return view('vehicle-record.import');
    }

    public function importExcel(Request $request)
    {
        $arr = array();
        $request->validate([
            'import_file' => 'required|mimes:xls,xlsx|max:4096'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr = [
                    'vehicle_no' => $value->vehicle_no,
                    'customer_id' => $value->customer_id,
                    'sale_type_id' => $value->sale_type_id,
                    'date_of_install' => $value->date_of_install,
                    'last_pay_date' => $value->last_pay_date,
                    'last_pay_amount' => $value->last_pay_amount,
                    'renewal_date' => $value->renewal_date,
                    'renewal_amount' => $value->renewal_amount,
                    'duration' => $value->duration,
                    'agreed_rate' => $value->agreed_rate,
                    'device_model' => $value->device_model,
                    'device_imei' => $value->device_imei,
                    'sim_no' => $value->sim_no,
                    'sales_person' => $value->sales_person,
                    'remarks' => $value->remarks
                ];
            }

            if(!empty($arr)){
                VehicleRecord::insert($arr);
            }
        }

        return redirect()->route('vehicle-record.index')->with('Data Inserted successfully');
    }


}
