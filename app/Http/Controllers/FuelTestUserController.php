<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor; 
use App\Models\FuelTestRecord;
use App\Models\FuelTestUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelTestsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\FuelTestController;

class FuelTestUserController extends Controller
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
            $title = 'USERS'; 
            $FilterUserNames = FuelTestUser::distinct()->get(['Name']); 
            $FilterEmails = FuelTestUser::distinct()->get(['Email']);  
            
            $ViewData = [ 
                'title' => $title,   
                'FilterUserNames' => $FilterUserNames,   
                'FilterEmails' => $FilterEmails,   
            ];

            if (isset($_GET['SortByEmail'])) {

                $SortOrder = Session::get('SortOrder', 'ASC');
                $fuel_test_users = FuelTestUser::orderBy('Email', $SortOrder)->get(); 

                $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                
                Session::put('SortOrder', $SortOrder); 

                $ViewData = [...$Config, ...$ViewData]; 

                return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 

           }

            $ViewData = [...$Config, ...$ViewData]; 

            if (isset($_GET['SortByName'])) { 

                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $fuel_test_users = FuelTestUser::orderBy('Name', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    
                    Session::put('SortOrder', $SortOrder); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 
            
            } 

            if(isset($_GET['FilterUserNames'])) {
                $FilteredRecords[] = $request->CheckUserNames;  
                
                foreach ($FilteredRecords as $UserNames) {
                    $fuel_test_users = FuelTestUser::whereIn('Name', $UserNames)->orderBy('Name', 'DESC')->get();
                   
                    $number_of_fuel_test_users = count($fuel_test_users); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users)->with('number_of_fuel_test_users', $number_of_fuel_test_users); 
                } 
            }

            if(isset($_GET['FilterEmails'])) {
                $FilteredRecords[] = $request->CheckEmails;  
                
                foreach ($FilteredRecords as $Email) {
                    $fuel_test_users = FuelTestUser::whereIn('Email', $Email)->orderBy('Email', 'DESC')->get();
                   
                    $number_of_fuel_test_users = count($fuel_test_users); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users)->with('number_of_fuel_test_users', $number_of_fuel_test_users); 
                } 
            }

            $ViewData = [...$Config, ...$ViewData]; 
             
            return view('Users', $ViewData);
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
        $Name = $request->Name;
        $Email = $request->Email;
        $Password = $request->Password;
        
        
        $AddVendor = FuelTestUser::create([
            'Name' => $Name,
            'Email' => $Email, 
            'Password' => $Password, 
        ]);

        return redirect('Users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
