<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\FuelTestUser; 
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function fuel_test_user_login(Request $request) {
        
            $username = $request->Email;
            $password = $request->Password; 

            $query = FuelTestUser::select('id', 'Email', 'Name', 'Role')
                                    ->where('Email', $username)
                                    ->where('Password', $password)
                                    ->get();

            if(count($query) == 1) {
                
                foreach($query as $current_user) {
    
                    $id = $current_user->id;
                    $user = $current_user->Email;
                    $user_password = $current_user->Password;
                    $Role = $current_user->Role;
                    
                    Session::put('id', $current_user->id); 
                    Session::put('email', $current_user->Email); 
                    Session::put('name', $current_user->Name); 
                    Session::put('Role', $Role); 

                    $SetStatus_ONLINE = FuelTestUser::where('id', $id)
                                                    ->update(['Status' => 1]);

                    if(Session::has('email')) {
                        return redirect('AllRecords'); 
                    } else {                                       
                        return redirect('/');        
                    }  
                    
                } 

            } elseif(empty($username)) {
                $EmailError = 'Enter Email..';

                return view('/login', [
                    'EmailError' => $EmailError,
                    'PasswordError' => '',
                    'WrongCredentials' => ''
                ]);
            } elseif(empty($password)) {
                $PasswordError = 'Enter Password..';

                return view('/login', [
                    'EmailError' => '',
                    'PasswordError' => $PasswordError,
                    'WrongCredentials' => ''
                ]);
            } else {  
                
                $WrongCredentials = 'Wrong Email/Password';

                    return view('/login', [
                        'EmailError' => '',
                        'PasswordError' => '',
                        'WrongCredentials' => $WrongCredentials
                    ]);
                }
            }


    public function fuel_test_user_logout() { 
        
            $SetStatus_OFFLINE = FuelTestUser::where('id', Session::get('id'))
                                                ->update(['Status' => 0]);

            Session::flush(); 
            return redirect('/');
    }
}
