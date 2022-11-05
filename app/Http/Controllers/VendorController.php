<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\FuelTestRecord;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelTestsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\FuelTestController;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FuelTestController $FuelTestController, Request $request)
    {  
        $Config = $FuelTestController->config();  
        extract($Config);  
        
        if(Session::has('email')) { 
            $title = 'VENDORS';     
            $FilterVendorName = FuelTestRecord::distinct()->get(['VendorName']); 
            $FilterVendorNo = FuelTestRecord::distinct()->get(['VendorNo']); 
            
            $ViewData = [ 
                'title' => $title,   
                'FilterVendorName' => $FilterVendorName,   
                'FilterVendorNo' => $FilterVendorNo,   
            ];
 
            if (isset($_GET['Search'])) {

                $SearchValue = trim($_GET['SearchValue']);
                $title = '" ' . $SearchValue . ' "';

                $vendors =  Vendor::where('VendorNo', 'LIKE', '%' . $SearchValue . '%')
                                                ->orWhere('VendorName', 'LIKE', '%' . $SearchValue . '%')
                                                ->orWhere('id', 'LIKE', '%' . $SearchValue . '%')
                                                ->orderBy('VendorName', 'DESC')
                                                ->paginate(14)
                                                ->fragment('Vendors');
 
                $number_of_vendors = count($vendors);
                
                $vendors->setPath($_SERVER['REQUEST_URI']);  

                $ViewData = [...$Config, ...$ViewData]; 

                return view("vendors", $ViewData)->with('vendors', $vendors)
                                                    ->with('number_of_vendors', $number_of_vendors) 
                                                    ->with('title', $title);
            }

            if (isset($_GET['Clear'])) {
                return redirect('/Vendors');
            }

           if (isset($_GET['SortByVendorNo'])) {

                $SortOrder = Session::get('SortOrder', 'ASC');
                $vendors = Vendor::orderBy('VendorNo', $SortOrder)->get(); 

                $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                
                Session::put('SortOrder', $SortOrder); 

                $ViewData = [...$Config, ...$ViewData]; 

                return view('vendors', $ViewData)->with('vendors', $vendors); 

           }

            $ViewData = [...$Config, ...$ViewData]; 

            if (isset($_GET['SortByVendorName'])) { 

                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $vendors = Vendor::orderBy('VendorName', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    
                    Session::put('SortOrder', $SortOrder); 

                    return view('vendors', $ViewData)->with('vendors', $vendors); 
            
            } 

            if(isset($_GET['FilterVendorName'])) {
                $FilteredRecords[] = $request->CheckVendorName;  
                
                foreach ($FilteredRecords as $VendorName) {
                    $vendors = Vendor::whereIn('VendorName', $VendorName)->orderBy('VendorName', 'DESC')->get();
                   
                    $number_of_vendors = count($vendors); 

                    return view('vendors', $ViewData)->with('vendors', $vendors)->with('number_of_vendors', $number_of_vendors); 
                } 
            }

            if(isset($_GET['FilterVendorNo'])) {
                $FilteredRecords[] = $request->CheckVendorNo;  
                
                foreach ($FilteredRecords as $VendorNo) {
                    $vendors = Vendor::whereIn('VendorNo', $VendorNo)->orderBy('VendorNo', 'DESC')->get();
                   
                    $number_of_vendors = count($vendors); 

                    return view('vendors', $ViewData)->with('vendors', $vendors)->with('number_of_vendors', $number_of_vendors); 
                } 
            }

            return view('vendors', $ViewData);
        } else {                                       
            return redirect('/');        
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $VendorNo = $request->VendorNo;
        $VendorName = $request->VendorName;
        
        
        $AddVendor = Vendor::create([
            'VendorNo' => $VendorNo,
            'VendorName' => $VendorName, 
        ]);

        return redirect('Vendors'); 
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
