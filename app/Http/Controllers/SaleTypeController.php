<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleType;
use App\SaleType;
use Illuminate\Http\Request;

class SaleTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sale-type-list');
        $this->middleware('permission:sale-type-create', ['only' => ['create','store']]);
        $this->middleware('permission:sale-type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sale-type-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_types = SaleType::orderBy('created_at', 'DESC')->get();
        return view('sale-type.index', compact('sale_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleType $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        SaleType::create($validated);
        return back()->with('success', 'Sale Type added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function show(SaleType $saleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleType $saleType)
    {
        return view('sale-type.edit', ['sale_type'=> $saleType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleType $saleType)
    {
        $validated = $this->validate($request, [
            'name' => 'required|unique:sale_types,name,'.$saleType->id,
        ]);
        $saleType->update($validated);
        return back()->with('success', 'Sale Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleType $saleType)
    {
        try {

            $saleType->delete();
            return back()->with('success', 'Record deleted successfully');

        }  catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Cannot delete this row. Reference present in other records');


        }
    }
}
