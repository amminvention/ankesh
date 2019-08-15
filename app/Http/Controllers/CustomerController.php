<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreCustomer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer-list');
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        Customer::create($validated);
        return back()->with('success', 'Customer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', ['customer'=> $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'nullable|unique:customers,email,'.$customer->id,
            'whatsapp' => 'nullable|max:255',
            'phone' => 'nullable|max:255'
        ]);
        $customer->update($validated);
        return back()->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {

            $customer->delete();
            return back()->with('success', 'Record deleted successfully');

        }  catch (\Illuminate\Database\QueryException $e) {

            return back()->with('error', 'Cannot delete this row. Reference present in other records');


        }
    }
}
