<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\FuelTestRecord;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelTestsExport;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $id = Session::get('id');
        $name = Session::get('name');
        $email = Session::get('email');
        $title = 'VENDORS';
        $header_info = 'Manage all your Records effectively. Log In'; 
        
        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->get(); 
        $number_of_previous_records = count($previous_records);
 
        $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get(); 
        $number_of_all_records = count($all_records); 

        $vendors = Vendor::all();
        $number_of_vendors = count($vendors);
        

        return view('vendors', [
            'Id' => $id,
            'Name' => $name,
            'Email' => $email,
            'Title' => $title,
            'Header_Info' => $header_info,
            'number_of_previous_records' => $number_of_previous_records,
            'number_of_all_records' => $number_of_all_records,
            'number_of_vendors' => $number_of_vendors,
            'all_records' => $all_records,
            'Vendors' => $vendors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
