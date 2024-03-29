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
                'ErrorMessage' => Session::get('ErrorMessage'),   
            ];

            if(isset($_GET['EditUserDetails'])) {
                $Email[] = $_GET['EditUserEmail'];
                $Ids[] = $_GET['EditUserId'];
   
                return redirect()->back();
            }

            if(isset($_GET['Delete_'])) { 
                if(empty($_GET['DeleteUser'])) {
                    return redirect()->back();  
                }

                $CheckedUsersToDelete[] = $_GET['DeleteUser'];
                
                foreach ($CheckedUsersToDelete as $User) {
                    $DeleteCheckedUsers = FuelTestUser::whereIn('id', $User)->delete();
                }
                return redirect()->back(); 
            }
            
            if (isset($_GET['Search'])) {

                $SearchValue = trim($_GET['SearchValue']);
                $title = '" ' . $SearchValue . ' "';

                if($SearchValue == 'online' || $SearchValue == 'Online' || $SearchValue == 'ONLINE') {
                    $SearchValue = 1;
                } elseif($SearchValue == 'offline' || $SearchValue == 'Offline' || $SearchValue == 'OFFLINE') {
                    $SearchValue = 0;
                }

                $fuel_test_users =  FuelTestUser::where('Email', 'LIKE', '%' . $SearchValue . '%')
                                                ->orWhere('Name', 'LIKE', '%' . $SearchValue . '%') 
                                                ->orWhere('Status', 'LIKE', '%' . $SearchValue . '%') 
                                                ->orWhere('Role', 'LIKE', '%' . $SearchValue . '%') 
                                                ->orderBy('Name', 'DESC')
                                                ->paginate(14)
                                                ->fragment('Users');
 
                $number_of_fuel_test_users = count($fuel_test_users);
                
                $fuel_test_users->setPath($_SERVER['REQUEST_URI']);  

                $ViewData = [...$Config, ...$ViewData]; 

                return view("Users", $ViewData)->with('fuel_test_users', $fuel_test_users)
                                                    ->with('number_of_fuel_test_users', $number_of_fuel_test_users) 
                                                    ->with('title', $title);
            }

            if (isset($_GET['Clear'])) {
                return redirect('/Users');
            }

            if (isset($_GET['SortByRole'])) {

                $SortOrder = Session::get('SortOrder', 'ASC');
                $fuel_test_users = FuelTestUser::orderBy('Role', $SortOrder)->paginate(14); 

                $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                
                Session::put('SortOrder', $SortOrder); 

                $ViewData = [...$Config, ...$ViewData]; 

                return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 

           }

            if (isset($_GET['SortByStatus'])) {

                $SortOrder = Session::get('SortOrder', 'ASC');
                $fuel_test_users = FuelTestUser::orderBy('Status', $SortOrder)->paginate(14); 

                $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                
                Session::put('SortOrder', $SortOrder); 

                $ViewData = [...$Config, ...$ViewData]; 

                return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 

           }

            if (isset($_GET['SortByEmail'])) {

                $SortOrder = Session::get('SortOrder', 'ASC');
                $fuel_test_users = FuelTestUser::orderBy('Email', $SortOrder)->paginate(14); 

                $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                
                Session::put('SortOrder', $SortOrder); 

                $ViewData = [...$Config, ...$ViewData]; 

                return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 

           }

            $ViewData = [...$Config, ...$ViewData]; 

            if (isset($_GET['SortByName'])) { 

                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $fuel_test_users = FuelTestUser::orderBy('Name', $SortOrder)->paginate(14); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    
                    Session::put('SortOrder', $SortOrder); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users); 
            
            } 

            if(isset($_GET['FilterRole'])) {
                
                if(empty($_GET['CheckRole'])) {
                   return  redirect()->back();
                }
                
                $FilteredRecords[] = $request->CheckRole;  
                
                foreach ($FilteredRecords as $Role) {
                    $fuel_test_users = FuelTestUser::whereIn('Role', $Role)->orderBy('Name', 'DESC')->paginate(14);
                   
                    $number_of_fuel_test_users = count($fuel_test_users); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users)->with('number_of_fuel_test_users', $number_of_fuel_test_users); 
                } 
            }

            if(isset($_GET['FilterStatus'])) {
                
                if(empty($_GET['CheckStatus'])) {
                   return  redirect()->back();
                }
                
                $FilteredRecords[] = $request->CheckStatus;  
                
                foreach ($FilteredRecords as $Status) {
                    $fuel_test_users = FuelTestUser::whereIn('Status', $Status)->orderBy('Name', 'DESC')->paginate(14);
                   
                    $number_of_fuel_test_users = count($fuel_test_users); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users)->with('number_of_fuel_test_users', $number_of_fuel_test_users); 
                } 
            }

            if(isset($_GET['FilterUserNames'])) {
                
                if(empty($_GET['CheckUserNames'])) {
                   return  redirect()->back();
                }
                
                $FilteredRecords[] = $request->CheckUserNames;  
                
                foreach ($FilteredRecords as $UserNames) {
                    $fuel_test_users = FuelTestUser::whereIn('Name', $UserNames)->orderBy('Name', 'DESC')->paginate(14);
                   
                    $number_of_fuel_test_users = count($fuel_test_users); 

                    return view('users', $ViewData)->with('fuel_test_users', $fuel_test_users)->with('number_of_fuel_test_users', $number_of_fuel_test_users); 
                } 
            }

            if(isset($_GET['FilterEmails'])) {
                
                if(empty($_GET['CheckEmails'])) {
                   return  redirect()->back();
                }
                
                $FilteredRecords[] = $request->CheckEmails;  
                
                foreach ($FilteredRecords as $Email) {
                    $fuel_test_users = FuelTestUser::whereIn('Email', $Email)->orderBy('Email', 'DESC')->paginate(14);
                   
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
        $Role = $request->Role;
        
        if(empty($Name)) {
            $ErrorMessage = 'Add a Name for the User..';
            return redirect()->back()->with('ErrorMessage', $ErrorMessage);
        } elseif(empty($Email)) {
            $ErrorMessage = 'Add Email for the User..';
            return redirect()->back()->with('ErrorMessage', $ErrorMessage);
        } elseif(empty($Password)) {
            $ErrorMessage = 'Add Password for the User..';
            return redirect()->back()->with('ErrorMessage', $ErrorMessage);
        } elseif(empty($Role) || $Role === 'Assign Role..') {
            $ErrorMessage = 'Add Role for the User..';
            return redirect()->back()->with('ErrorMessage', $ErrorMessage);
        }
        
        $AddVendor = FuelTestUser::create([
            'Name' => $Name,
            'Email' => $Email, 
            'Password' => $Password, 
            'Role' => $Role, 
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
    public function update(Request $request, $UserId)
    { 
            $UserId = $request->UserId;
 
            $UserName_UPDATE = $request->UserName;
            $UserEmail_UPDATE = $request->UserEmail;
            $UserRole_UPDATE = $request->UserRole;
            $UserPassword_UPDATE = $request->UserPassword;

            $UpdateUser = FuelTestUser::where('id', $UserId)
                                                ->update([
                                                    'Email' => $UserEmail_UPDATE,
                                                    'Name' => $UserName_UPDATE,
                                                    'Role' => $UserRole_UPDATE,
                                                    'Password' => $UserPassword_UPDATE,
                                                ]); 

            return redirect('/Users');
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
