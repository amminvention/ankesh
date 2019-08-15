<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreVehicleRecord;
use App\Http\Requests\UpdateVehicleRecord;
use App\SaleType;
use App\VehicleRecord;
use Illuminate\Http\Request;

class VehicleRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:vehicle-record-list');
        $this->middleware('permission:vehicle-record-create', ['only' => ['create','store']]);
        $this->middleware('permission:vehicle-record-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vehicle-record-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle_records = VehicleRecord::with('salesType', 'customers')->get();
        return view('vehicle-record.index', compact('vehicle_records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale_types = SaleType::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        return view('vehicle-record.create', compact('sale_types', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRecord $request)
    {
        $validated = $request->validated();
        VehicleRecord::create($validated);
        return back()->with('success', 'Vehicle Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VehicleRecord  $vehicleRecord
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleRecord $vehicleRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VehicleRecord  $vehicleRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleRecord $vehicleRecord)
    {
        $sale_types = SaleType::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');
        return view('vehicle-record.edit', ['vehicle_record'=> $vehicleRecord, 'sale_types'=>$sale_types, 'customers'=>$customers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VehicleRecord  $vehicleRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRecord $request, VehicleRecord $vehicleRecord)
    {
        $validated = $request->validated();
        $vehicleRecord->update($validated);
        return back()->with('success', 'Vehicle Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VehicleRecord  $vehicleRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleRecord $vehicleRecord)
    {
        try {

            $vehicleRecord->delete();
            return back()->with('success', 'Record deleted successfully');

        }  catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Cannot delete this row. Reference present in other records');


        }
    }
}
