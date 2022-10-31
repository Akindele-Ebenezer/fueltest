<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request; 
use App\Models\FuelTestUser;
use App\Models\FuelTestRecord;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelTestsExport;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Carbon;
use DateTime;
use App\Charts\FuelTestStats; 

class FuelTestController extends Controller
{
    
    public function export() 
    {
        return Excel::download(new FuelTestsExport, 'FuelTest.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    { 
        date_default_timezone_set('Africa/Lagos');

        $id = Session::get('id'); 
        $name = Session::get('name');
        $email = Session::get('email');
        $header_info = "ID : [" . $id . "] Email : " . $email;
        $sample_no = date('Ymd') . $id . 0;

        $fuel_test_users = DB::table('fuel_test_users')->get();
        $number_fuel_test_users = count($fuel_test_users);

        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'DESC')->paginate(14)->fragment('PreviousRecords');
        $number_of_previous_records = count($previous_records);

        $all_records_for_insights = FuelTestRecord::orderBy('SampleNo', 'DESC')->get()->toArray(); 
        
        $number_of_previous_records_absolute = FuelTestRecord::select('id')->where('uid', $id)->count();
        $number_of_all_records_absolute = FuelTestRecord::select('id')->count();
 
        $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'DESC')->paginate(14)->fragment('AllRecords'); 
        $number_of_all_records = count($all_records);

        $vendors = Vendor::all();
        $number_of_vendors = count($vendors); 
 
        $VendorWithTheHighestSupply = FuelTestRecord::select('VendorName') 
                                                    ->whereNot('VendorName', NULL)
                                                    ->whereNot('VendorName', '')
                                                    ->groupBy('VendorName')  
                                                    ->limit(1)
                                                    ->get()
                                                    ->toArray(); 
                                                    
        $VendorWithTheLowestSupply = FuelTestRecord::select('VendorName')
                                                    ->groupBy('VendorName') 
                                                    ->orderBy('VendorName', 'DESC')
                                                    ->limit(2)
                                                    ->get()
                                                    ->toArray(); 
                                 
        $VendorWithTheHighestSupply = $VendorWithTheHighestSupply[0]['VendorName']; 
        $VendorWithTheLowestSupply = $VendorWithTheLowestSupply[1]['VendorName'];  
        
        $PercentageForVendorWithTheHighestSupply = FuelTestRecord::select('id') 
                                                    ->where('VendorName', $VendorWithTheHighestSupply) 
                                                    ->limit(1)
                                                    ->count(); 

        $PercentageForVendorWithTheLowestSupply = FuelTestRecord::select('id') 
                                                    ->where('VendorName', $VendorWithTheLowestSupply) 
                                                    ->limit(1)
                                                    ->count(); 

        $PercentageForVendorWithTheHighestSupply = $PercentageForVendorWithTheHighestSupply / $number_of_all_records_absolute * 100;
        $PercentageForVendorWithTheLowestSupply = $PercentageForVendorWithTheLowestSupply / $number_of_all_records_absolute * 100;
 

        // $PassedRecords = FuelTestRecord::whereIn('AppearanceResult', ['Bright', 'Clear', 'BRIGHT']) 
        // ->where('Color', '<=', '2.5')
        // ->whereBetween('Density', ['0.82', '0.855']) 
        // ->whereBetween('FlashPoint', ['52', '92']) 
        // ->where('WaterSediment', '<=', '0.050')        
        // ->where(function($query) {
        //             $query->whereBetween('Cleanliness', ['12', '15']) 
        //                     ->orWhere('Cleanliness', 'LIKE', 'OK');
        // })    
        // ->orderBy('SampleNo', 'DESC')
        // ->get(); 

        $PassedRecords = FuelTestRecord::where('ApprovalForUse', 'APPROVED')->orderBy('SampleNo', 'DESC')->paginate(14);
        $number_of_passed_records = FuelTestRecord::select('id')->where('ApprovalForUse', 'APPROVED')->count();  
         
        // $PassedRecords_ = FuelTestRecord::where('uid', $id)
        // ->whereIn('AppearanceResult', ['Bright', 'Clear', 'BRIGHT']) 
        // ->where('Color', '<=', '2.5')
        // ->whereBetween('Density', ['0.82', '0.855']) 
        // ->whereBetween('FlashPoint', ['52', '92']) 
        // ->where('WaterSediment', '<=', '0.050')        
        // ->where(function($query) {
        //     $query->whereBetween('Cleanliness', ['12', '15']) 
        //     ->orWhere('Cleanliness', 'LIKE', 'OK');
        // })    
        // ->orderBy('SampleNo', 'DESC')
        // ->get();   
        
        $PassedRecords_ = FuelTestRecord::where('uid', $id)
                                        ->where('ApprovalForUse', 'APPROVED')->orderBy('SampleNo', 'DESC')
                                        ->paginate(14);
        $number_of_passed_records_ = FuelTestRecord::select('id')
                                        ->where('uid', $id)
                                        ->where('ApprovalForUse', 'APPROVED')->orderBy('SampleNo', 'DESC')
                                        ->count();  
        
        // $FailedRecords = DB::select("SELECT * FROM fuel_test_records
        // WHERE NOT 
        // AppearanceResult IN ('Bright', 'Clear', 'BRIGHT') 
        // OR	
        // Color > 2.5  
        // OR	NOT	
        // Density BETWEEN 0.82 AND 0.855
        // OR NOT	
        // Flashpoint BETWEEN 52 AND 92
        // OR	
        // WaterSediment > 0.050 
        // OR NOT	
        // (Cleanliness BETWEEN 12 AND 15 OR Cleanliness LIKE 'OK')
        // ORDER BY
        // SampleNo DESC");  

        $DiffRecords = FuelTestRecord::select('id')->where('VendorName', NULL)->paginate(14);
        $number_of_diff_records = FuelTestRecord::where('VendorName', NULL)->count(); 
        
        $DiffRecords_ = FuelTestRecord::where('uid', $id) 
                                        ->where('VendorName', NULL)
                                        ->paginate(14);
        $number_of_diff_records_ = FuelTestRecord::select('id')->where('uid', $id) 
                                                    ->where('VendorName', NULL)
                                                    ->count(); 
        
        $FailedRecords = FuelTestRecord::where('ApprovalForUse', 'REJECTED')->orderBy('SampleNo', 'DESC')->paginate(14);
        $number_of_failed_records = FuelTestRecord::select('id')->where('ApprovalForUse', 'REJECTED')->count(); 
        
        // $FailedRecords_ = DB::select("SELECT * FROM fuel_test_records
        // WHERE uid = ?
        // AND 	
        // (NOT (AppearanceResult IN ('Bright', 'Clear', 'BRIGHT'))
        // OR	
        // Color > 2.5  
        // OR	NOT	
        // Density BETWEEN 0.82 AND 0.855
        // OR NOT	
        // Flashpoint BETWEEN 52 AND 92
        // OR	
        // WaterSediment > 0.050 
        // OR NOT	
        // (Cleanliness BETWEEN 12 AND 15 OR Cleanliness LIKE 'OK'))
        // ORDER BY
        // SampleNo DESC", [$id]);  

        $FailedRecords_ = FuelTestRecord::where('uid', $id)
                                        ->where('ApprovalForUse', 'REJECTED')->orderBy('SampleNo', 'DESC')
                                        ->paginate(14);
        $number_of_failed_records_ = FuelTestRecord::select('id')
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'REJECTED')
                                                    ->count();

        $WavedRecords = FuelTestRecord::where('ApprovalForUse', 'WAIVED')->orderBy('SampleNo', 'DESC')
                                        ->paginate(14);
        $number_of_waved_records = FuelTestRecord::select('id')
                                                    ->where('ApprovalForUse', 'WAIVED')
                                                    ->count();  

        $WavedRecords_ = FuelTestRecord::where('uid', $id)->orderBy('SampleNo', 'DESC')
                                        ->where('ApprovalForUse', 'WAIVED')
                                        ->paginate(14);
        $number_of_waved_records_ = FuelTestRecord::select('id')
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'WAIVED')
                                                    ->count();   
 
        $AbsolutePercentageOfPassedRecords = $number_of_passed_records / $number_of_all_records_absolute * 100; 
        $AbsolutePercentageOfFailedRecords = $number_of_failed_records / $number_of_all_records_absolute * 100;
        $AbsolutePercentageOfWavedRecords = $number_of_waved_records / $number_of_all_records_absolute * 100;
        $AbsolutePercentageOfDiffRecords = $number_of_diff_records / $number_of_all_records_absolute * 100;
        
        return [ 
            'id' => $id,
            'Visibility' => '',
            'name' => $name,
            'email' => $email, 
            'header_info' => $header_info,
            'sample_no' => $sample_no,
            'all_records' => $all_records,
            'previous_records' => $previous_records,
            'vendors' => $vendors,
            'fuel_test_users' => $fuel_test_users,
            'number_fuel_test_users' => $number_fuel_test_users,
            'number_of_all_records' => $number_of_all_records,
            'number_of_previous_records' => $number_of_previous_records,
            'number_of_passed_records' => $number_of_passed_records,
            'number_of_failed_records' => $number_of_failed_records,
            'number_of_vendors' => $number_of_vendors,
            'PassedRecords' => $PassedRecords,
            'FailedRecords' => $FailedRecords,
            'PassedRecords_' => $PassedRecords_,
            'FailedRecords_' => $FailedRecords_,
            'WavedRecords_' => $WavedRecords_,
            'WavedRecords' => $WavedRecords,
            'DiffRecords' => $DiffRecords,
            'DiffRecords_' => $DiffRecords_,
            'PercentageForVendorWithTheLowestSupply' => $PercentageForVendorWithTheLowestSupply,
            'PercentageForVendorWithTheHighestSupply' => $PercentageForVendorWithTheHighestSupply,
            'VendorWithTheHighestSupply' => $VendorWithTheHighestSupply,
            'VendorWithTheLowestSupply' => $VendorWithTheLowestSupply,
            'number_of_diff_records' => $number_of_diff_records,
            'number_of_diff_records_' => $number_of_diff_records_,
            'number_of_waved_records' => $number_of_waved_records,
            'number_of_waved_records_' => $number_of_waved_records_,
            'number_of_passed_records_' => $number_of_passed_records_,
            'number_of_failed_records_' => $number_of_failed_records_, 
            'number_of_previous_records_absolute' => $number_of_previous_records_absolute,
            'number_of_all_records_absolute' => $number_of_all_records_absolute,
            'AbsolutePercentageOfFailedRecords' => $AbsolutePercentageOfFailedRecords,
            'AbsolutePercentageOfPassedRecords' => $AbsolutePercentageOfPassedRecords,
            'AbsolutePercentageOfWavedRecords' => $AbsolutePercentageOfWavedRecords,
            'AbsolutePercentageOfDiffRecords' => $AbsolutePercentageOfDiffRecords, 
        ]; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $Config = $this->config();  
        extract($Config); 
        
        $title = 'Depasamarine'; 
         
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } else {
            $VendorName = '';

            if (Session::get('VendorNo')) {
                $VendorNo = Session::get('VendorNo'); 

                $VendorNo = Vendor::where('VendorNo', $VendorNo)->get();

                foreach ($VendorNo as $VendorName) {
                    $VendorName = $VendorName->VendorName;
                }
            }
 
            $ViewData = [ 
                'title' => $title, 
                'VendorNo' => Session::get('VendorNo'), 
                'VendorName' => $VendorName, 
                'VendorNameErrorMessage' => Session::get('VendorNameErrorMessage'), 
                'SampleCollectionDateErrorMessage' => Session::get('SampleCollectionDateErrorMessage'), 
                'TruckPlateNoErrorMessage' => Session::get('TruckPlateNoErrorMessage'), 
                'TankNoErrorMessage' => Session::get('TankNoErrorMessage'), 
                'AppearanceResultErrorMessage' => Session::get('AppearanceResultErrorMessage'), 
                'ColorErrorMessage' => Session::get('ColorErrorMessage'), 
                'DensityErrorMessage' => Session::get('DensityErrorMessage'), 
                'FlashPointErrorMessage' => Session::get('FlashPointErrorMessage'), 
                'TempErrorMessage' => Session::get('TempErrorMessage'), 
                'WaterSedimentErrorMessage' => Session::get('WaterSedimentErrorMessage'), 
                'CleanlinessErrorMessage' => Session::get('CleanlinessErrorMessage'), 
                'DateOfTestErrorMessage' => Session::get('DateOfTestErrorMessage'), 
                'MadeByErrorMessage' => Session::get('MadeByErrorMessage'), 
                'DeliveredToErrorMessage' => Session::get('DeliveredToErrorMessage'), 
                'RemarksErrorMessage' => Session::get('RemarksErrorMessage'), 
                'TestResultErrorMessage' => Session::get('TestResultErrorMessage'),  
                'ApprovalForUseErrorMessage' => Session::get('ApprovalForUseErrorMessage'), 
            ];
     
            $ViewData = [...$Config, ...$ViewData];   
    
            return view('fuel_test', $ViewData);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $title = 'Record Created';

        $Config = $this->config();  
        extract($Config);  
        
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } 

        $SampleNo = $request->SampleNo; 
        $SampleCollectionDate = $request->SampleCollectionDate; 
        $TruckPlateNo = $request->TruckPlateNo; 
        $TankNo = $request->TankNo; 
        $AppearanceResult = $request->AppearanceResult; 
        $Color = $request->Color; 
        $Density = $request->Density; 
        $FlashPoint = $request->FlashPoint; 
        $Temp = $request->Temp; 
        $WaterSediment = $request->WaterSediment; 
        $Cleanliness = $request->Cleanliness; 
        $DateOfTest = $request->DateOfTest; 
        $uid = $request->uid; 
        $MadeBy = $request->MadeBy; 
        $DeliveredTo = $request->DeliveredTo; 
        $Remarks = $request->Remarks; 
        $ApprovalForUse = $request->ApprovalForUse; 
        
        $VendorNo = substr($request->VendorNo, 0, 6); 
        $VendorName = $request->VendorName; 

        $TestResult = $request->TestResult; 
         
        if(empty($SampleCollectionDate)) {
            $SampleCollectionDateErrorMessage = 'Enter Date for Sample Collection';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('SampleCollectionDateErrorMessage', $SampleCollectionDateErrorMessage)->withInput();
        } elseif(empty($VendorName)) { 
            $VendorNameErrorMessage = 'Vendor Name is required';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('VendorNameErrorMessage', $VendorNameErrorMessage)->withInput();
        } elseif(empty($TruckPlateNo)) { 
            $TruckPlateNoErrorMessage = 'Truck Plate No is required';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('TruckPlateNoErrorMessage', $TruckPlateNoErrorMessage)->withInput();
        } elseif(empty($TankNo)) { 
            $TankNoErrorMessage = 'Enter Tank No';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('TankNoErrorMessage', $TankNoErrorMessage)->withInput();
        } elseif(empty($AppearanceResult)) { 
            $AppearanceResultErrorMessage = 'Appearance Result field can\'t be empty';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('AppearanceResultErrorMessage', $AppearanceResultErrorMessage)->withInput();
        } elseif(empty($Color)) { 
            $ColorErrorMessage = 'Select Color';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('ColorErrorMessage', $ColorErrorMessage)->withInput();
        } elseif(empty($Density)) { 
            $DensityErrorMessage = 'Input Density';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('DensityErrorMessage', $DensityErrorMessage)->withInput();
        } elseif(empty($FlashPoint)) { 
            $FlashPointErrorMessage = 'Enter Flash Point';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('FlashPointErrorMessage', $FlashPointErrorMessage)->withInput();
        } elseif(empty($Temp)) { 
            $TempErrorMessage = 'This field is required';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('TempErrorMessage', $TempErrorMessage)->withInput();
        } elseif(empty($WaterSediment)) { 
            $WaterSedimentErrorMessage = 'This field is required';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('WaterSedimentErrorMessage', $WaterSedimentErrorMessage)->withInput();
        } elseif(empty($Cleanliness)) { 
            $CleanlinessErrorMessage = 'Clean or Not ??';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('CleanlinessErrorMessage', $CleanlinessErrorMessage)->withInput();
        } elseif(empty($DateOfTest)) { 
            $DateOfTestErrorMessage = 'Date Of Test cannot be NULL';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('DateOfTestErrorMessage', $DateOfTestErrorMessage)->withInput();
        } elseif(empty($MadeBy)) { 
            $MadeByErrorMessage = 'Made By who?';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('MadeByErrorMessage', $MadeByErrorMessage)->withInput();
        } elseif(empty($DeliveredTo)) { 
            $DeliveredToErrorMessage = 'Delivered to who?';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('DeliveredToErrorMessage', $DeliveredToErrorMessage)->withInput();
        } elseif(empty($Remarks)) { 
            $RemarksErrorMessage = 'Write your Remarks..';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('RemarksErrorMessage', $RemarksErrorMessage)->withInput();
        } elseif(empty($ApprovalForUse)) { 
            $ApprovalForUseErrorMessage = 'Approved or Not?..';
            return redirect('FuelTest')->with('VendorNo', $VendorNo)->with('ApprovalForUseErrorMessage', $ApprovalForUseErrorMessage)->withInput();
        } else { 
                $create_record = FuelTestRecord::create([
                        'SampleNo' => $SampleNo,
                        'SampleCollectionDate' => $SampleCollectionDate,
                        'TruckPlateNo' => $TruckPlateNo,
                        'TankNo' => $TankNo,
                        'AppearanceResult' => $AppearanceResult,
                        'Color' => $Color,
                        'Density' => $Density,
                        'FlashPoint' => $FlashPoint,
                        'Temp' => $Temp,
                        'WaterSediment' => $WaterSediment,
                        'Cleanliness' => $Cleanliness,
                        'DateOfTest' => $DateOfTest,
                        'uid' => $uid,
                        'MadeBy' => $MadeBy,
                        'DeliveredTo' => $DeliveredTo,
                        'Remarks' => $Remarks,
                        'VendorName' => $VendorName,
                        'VendorNo' => $VendorNo,
                        'ApprovalForUse' => $ApprovalForUse,
                    ]);  
                    
            if(Session::has('email')) { 
                
                $VendorNo_ = $request->VendorNo; 
                $VendorName_ = $request->VendorName; 
                
                $TestResult = $request->TestResult;
  
                $ViewData = [
                    'SampleNo' => $SampleNo,
                    'SampleCollectionDate' => $SampleCollectionDate,
                    'TruckPlateNo' => $TruckPlateNo,
                    'TankNo' => $TankNo,
                    'AppearanceResult' => $AppearanceResult,
                    'Color' => $Color,
                    'Density' => $Density,
                    'FlashPoint' => $FlashPoint,
                    'Temp' => $Temp,
                    'WaterSediment' => $WaterSediment,
                    'Cleanliness' => $Cleanliness,
                    'DateOfTest' => $DateOfTest,
                    'uid' => $uid,
                    'MadeBy' => $MadeBy,
                    'ApprovalForUse' => $ApprovalForUse,
                    'DeliveredTo' => $DeliveredTo,
                    'Remarks' => $Remarks, 
                    'title' => $title, 
                    'VendorNo_' => $VendorNo_, 
                    'VendorName_' => $VendorName_, 
                    'TestResult' => $TestResult,  
                ];

                $ViewData = [...$Config, ...$ViewData];  
                extract($Config); 
                
                return view("record_success", $ViewData);

            } else { 
                return redirect('/');        
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all_records(Request $request)
    { 
        if(Session::has('email')) {
  
            $title = 'All Records';
            $FilterSampleNo = FuelTestRecord::select('SampleNo')
                                                ->distinct()
                                                ->get();
                                                
            $FilterSampleCollectionDate = FuelTestRecord::select('SampleCollectionDate')
                                                ->distinct()
                                                ->get();
                                                
            $FilterTruckPlateNo = FuelTestRecord::select('TruckPlateNo')
                                                ->distinct()
                                                ->get();
                                                
            $FilterTankNo = FuelTestRecord::select('TankNo')
                                                ->distinct()
                                                ->get();
                                                
            $FilterAppearanceResult = FuelTestRecord::select('AppearanceResult')
                                                ->distinct()
                                                ->get();
                                                
            $FilterColor = FuelTestRecord::select('Color')
                                                ->distinct()
                                                ->get();
                                                
            $FilterDensity = FuelTestRecord::select('Density')
                                                ->distinct()
                                                ->get();
                                                
            $FilterFlashPoint = FuelTestRecord::select('FlashPoint')
                                                ->distinct()
                                                ->get();
                                                
            $FilterTemp = FuelTestRecord::select('Temp')
                                                ->distinct()
                                                ->get();
                                                
            $FilterWaterSediment = FuelTestRecord::select('WaterSediment')
                                                ->distinct()
                                                ->get();
                                                
            $FilterCleanliness = FuelTestRecord::select('Cleanliness')
                                                ->distinct()
                                                ->get();
                                                
            $FilterDateOfTest = FuelTestRecord::select('DateOfTest')
                                                ->distinct()
                                                ->get();
                                                
            $FilterMadeBy = FuelTestRecord::select('MadeBy')
                                                ->distinct()
                                                ->get();
                                                
            $FilterDeliveredTo = FuelTestRecord::select('DeliveredTo')
                                                ->distinct()
                                                ->get();
                                                
            $FilterRemarks = FuelTestRecord::select('Remarks')
                                                ->distinct()
                                                ->get();          
                                                
            $FilterVendorName = FuelTestRecord::select('VendorName')
                                                ->distinct()
                                                ->get();          
                                                

            $Config = $this->config(); 
             
            extract($Config);    
            
            $SampleNo = ''; 
            $SampleCollectionDate = ''; 
            $TruckPlateNo = ''; 
            $TankNo = ''; 
            $AppearanceResult = ''; 
            $Color = ''; 
            $Density = ''; 
            $FlashPoint = ''; 
            $Temp = ''; 
            $WaterSediment = ''; 
            $Cleanliness = ''; 
            $DateOfTest = ''; 
            $uid = ''; 
            $MadeBy = ''; 
            $DeliveredTo = ''; 
            $Remarks = ''; 
            $ApprovalForUse = '';  
            $VendorNo = ''; 
            $VendorName = ''; 
 
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                $SampleNo = $request->SampleNo; 
                $SampleCollectionDate = $request->SampleCollectionDate; 
                $TruckPlateNo = $request->TruckPlateNo; 
                $TankNo = $request->TankNo; 
                $AppearanceResult = $request->AppearanceResult; 
                $Color = $request->Color; 
                $Density = $request->Density; 
                $FlashPoint = $request->FlashPoint; 
                $Temp = $request->Temp; 
                $WaterSediment = $request->WaterSediment; 
                $Cleanliness = $request->Cleanliness; 
                $DateOfTest = $request->DateOfTest; 
                $uid = $request->uid; 
                $MadeBy = $request->MadeBy; 
                $DeliveredTo = $request->DeliveredTo; 
                $Remarks = $request->Remarks; 
                $ApprovalForUse = $request->ApprovalForUse;  
                $VendorNo = $request->VendorNo; 
                $VendorName = $request->VendorName; 

            }
 
            $ViewData = [   
                'title' => $title,    
                'FilterSampleNo' => $FilterSampleNo,
                'FilterSampleCollectionDate' => $FilterSampleCollectionDate,
                'FilterTruckPlateNo' => $FilterTruckPlateNo,
                'FilterTankNo' => $FilterTankNo,
                'FilterAppearanceResult' => $FilterAppearanceResult,
                'FilterColor' => $FilterColor,
                'FilterDensity' => $FilterDensity,
                'FilterFlashPoint' => $FilterFlashPoint,
                'FilterTemp' => $FilterTemp,
                'FilterWaterSediment' => $FilterWaterSediment,
                'FilterCleanliness' => $FilterCleanliness,
                'FilterDateOfTest' => $FilterDateOfTest,
                'FilterMadeBy' => $FilterMadeBy,
                'FilterDeliveredTo' => $FilterDeliveredTo,
                'FilterRemarks' => $FilterRemarks,   
                'FilterVendorName' => $FilterVendorName,        
                'SampleNo' => $SampleNo,       
                'SampleCollectionDate' => $SampleCollectionDate,       
                'TruckPlateNo' => $TruckPlateNo,       
                'TankNo' => $TankNo,       
                'AppearanceResult' => $AppearanceResult,       
                'Color' => $Color,       
                'Density' => $Density,       
                'FlashPoint' => $FlashPoint,       
                'Temp' => $Temp,       
                'WaterSediment' => $WaterSediment,       
                'Cleanliness' => $Cleanliness,       
                'DateOfTest' => $DateOfTest,       
                'uid' => $uid,       
                'MadeBy' => $MadeBy,       
                'DeliveredTo' => $DeliveredTo,       
                'Remarks' => $Remarks,       
                'ApprovalForUse' => $ApprovalForUse,       
                'VendorNo' => $VendorNo,
                'VendorName' => $VendorName,        
            ];

            $ViewData = [...$Config, ...$ViewData]; 
            
            if(isset($_GET['FilterDiffTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->count();
                            
                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            
            if(isset($_GET['FilterWavedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', 'WAIVED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->count();
                            
                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            
            if(isset($_GET['FilterFailedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', 'REJECTED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            if(isset($_GET['FilterPassedTestsForCurrentVendor'])) {
                
                    $title = $VendorName = $_GET['Title'];
                    $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', 'APPROVED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(14);
                    
                    $all_records->setPath($_SERVER['REQUEST_URI']);  

                    $number_of_all_records = count($all_records);
                    
                    $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                    ->where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                    ->where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                    ->where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                    ->where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count(); 

                    $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                    ->where('VendorName', $VendorName)
                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
            
            if(isset($_GET['FilterVendorName'])) {
                $FilteredRecords[] = $_GET['CheckVendorName'];   
                foreach ($FilteredRecords as $VendorName) {
                    $title = $VendorName[0];
                    $all_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)->orderBy('SampleNo', 'DESC')->paginate(14);

                    $all_records->setPath($_SERVER['REQUEST_URI']);  

                    $number_of_all_records = count($all_records);
                    
                    $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count(); 
                }  

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute); 
            }

            if (isset($_GET['SortByVendorName'])) {
                $FilteredRecords[] = $request->CheckVendorName; 
 
                foreach ($FilteredRecords as $VendorName) {    
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('VendorName', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    
                    Session::put('SortOrder', $SortOrder); 
                }
            } 

            if (isset($_GET['FilterRecordsOfToday'])) {
                $RecordsOfToday = $request->RecordsOfToday; 
                
                $all_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday)
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Today';
                $number_of_all_records = count($all_records); 

                $number_of_all_records_absolute = FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday)
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records) 
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute); 
            }
 
            if (isset($_GET['FilterRecordsOfYesterday'])) {
                $RecordsOfYesterday = $request->RecordsOfYesterday; 
                
                $all_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterday)
                                                ->orderBy('SampleNo', 'DESC')
                                                ->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Yesterday';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->where('SampleCollectionDate', $RecordsOfYesterday)
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records) 
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }

            if (isset($_GET['FilterRecordsOfLastSevenDays'])) {
                $TodaysDate = date('Y-m-d'); 
                $LastSevenDays = date('Y-m-d', strtotime( '-7 day' )); 
                 
                $all_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Last Seven Days';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records) 
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            } 
 
            if (isset($_GET['FilterRecordsOfThisMonth'])) {
                $FirstDayOfThisMonth = date('Y-m-01'); 
                $TodaysDate = date('Y-m-d'); 
                
                $all_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                 
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                        
                $title = 'This Month';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records) 
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
            
            if (isset($_GET['FilterRecordsOfLastMonth'])) {
                $FirstDayOfLastMonth = date("Y-0n-0j", strtotime("first day of previous month"));  
                $LastDayOfLastMonth = date("Y-0n-j", strtotime("last day of previous month"));
                  
                $all_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                 
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                         
                $title = 'Last Month';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records) 
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }  

            if (isset($_GET['FilterPassedTests'])) {   
                $all_records = $PassedRecords;  
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                   
                $title = 'Passed Tests';
                
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                    ->where('ApprovalForUse', 'APPROVED')
                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }

            if (isset($_GET['FilterDiffTests'])) {   
                $all_records = $DiffRecords; 
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $title = 'Diff Tests';
                $number_of_all_records = count($all_records);
                
                $number_of_all_records_absolute = FuelTestRecord::where('ApprovalForUse', NULL)
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            } 

            if (isset($_GET['FilterWavedTests'])) {   
                $all_records = $WavedRecords; 
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Waived Tests';
                $number_of_all_records = count($all_records);
                
                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            } 

            if (isset($_GET['FilterFailedTests'])) {   
                $all_records = $FailedRecords; 
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Failed Tests';
                $number_of_all_records = count($all_records);
                
                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
 
            if (isset($_GET['FilterDateBetweenForCurrentVendor'])) {
                $title = $VendorName = $_GET['Title'];

                $DateFrom = $request->DateFrom;
                $DateTo = $request->DateTo;
                
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                ->orderBy('SampleNo', 'DESC')
                                                ->paginate(14);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_all_records = count($all_records);
                    
                $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                
                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->where('VendorName', $VendorName)
                                                                    ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                    ->with('number_of_passed_records', $number_of_passed_records)
                                                    ->with('number_of_failed_records', $number_of_failed_records)
                                                    ->with('number_of_waved_records', $number_of_waved_records)
                                                    ->with('number_of_diff_records', $number_of_diff_records)
                                                    ->with('number_of_all_records', $number_of_all_records)
                                                    ->with('title', $title)
                                                    ->with('number_of_all_records_absolute', $number_of_all_records_absolute);                                                
            }
 
            if (isset($_GET['FilterDateBetween'])) {
                $DateFrom = $request->DateFrom;
                $DateTo = $request->DateTo;
                
                $all_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_all_records = count($all_records);
                
                $number_of_all_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)
                                                    ->with('number_of_passed_records', $number_of_passed_records)
                                                    ->with('number_of_failed_records', $number_of_failed_records)
                                                    ->with('number_of_waved_records', $number_of_waved_records)
                                                    ->with('number_of_diff_records', $number_of_diff_records)
                                                    ->with('number_of_all_records', $number_of_all_records)
                                                    ->with('title', $title)
                                                    ->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }

            if (isset($_GET['SortBySampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {    
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('SampleNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo;  
                
                foreach ($FilteredRecords as $SampleNo) {
                    $all_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->orderBy('SampleNo', 'DESC')->paginate(14);
                   
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                } 
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('SampleCollectionDate', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $all_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->orderBy('SampleCollectionDate', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('TruckPlateNo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $all_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->orderBy('TruckPlateNo', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('TankNo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $all_records = FuelTestRecord::whereIn('TankNo', $TankNo)->orderBy('TankNo', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('AppearanceResult', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $all_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->orderBy('AppearanceResult', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Color', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $all_records = FuelTestRecord::whereIn('Color', $Color)->orderBy('Color', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);  
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Density', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $all_records = FuelTestRecord::whereIn('Density', $Density)->orderBy('Density', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('FlashPoint', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $all_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->orderBy('FlashPoint', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Temp', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $all_records = FuelTestRecord::whereIn('Temp', $Temp)->orderBy('Temp', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('WaterSediment', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $all_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->orderBy('WaterSediment', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Cleanliness', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $all_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->orderBy('Cleanliness', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('DateOfTest', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $all_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->orderBy('DateOfTest', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);  
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('MadeBy', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $all_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->orderBy('MadeBy', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('DeliveredTo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $all_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->orderBy('DeliveredTo', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Remarks', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $all_records = FuelTestRecord::whereIn('Remarks', $Remarks)->orderBy('Remarks', 'DESC')->paginate(14);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);  
                }
            } 
 
            return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title);

        } else { 
            return redirect('/');        
        }
    }

    public function show_previous_records(Request $request)
    {  
        if(Session::has('email')) {  
            $Config = $this->config();
            extract($Config); 

            $SampleNo = ''; 
            $SampleCollectionDate = ''; 
            $TruckPlateNo = ''; 
            $TankNo = ''; 
            $AppearanceResult = ''; 
            $Color = ''; 
            $Density = ''; 
            $FlashPoint = ''; 
            $Temp = ''; 
            $WaterSediment = ''; 
            $Cleanliness = ''; 
            $DateOfTest = ''; 
            $uid = ''; 
            $MadeBy = ''; 
            $DeliveredTo = ''; 
            $Remarks = ''; 
            $ApprovalForUse = '';  
            $VendorNo = ''; 
            $VendorName = ''; 
 
            $title = 'Previous Records'; 
              
            $FilterSampleNo = FuelTestRecord::select('SampleNo')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterSampleCollectionDate = FuelTestRecord::select('SampleCollectionDate')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterTruckPlateNo = FuelTestRecord::select('TruckPlateNo')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterTankNo = FuelTestRecord::select('TankNo')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterAppearanceResult = FuelTestRecord::select('AppearanceResult')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterColor = FuelTestRecord::select('Color')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterDensity = FuelTestRecord::select('Density')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterFlashPoint = FuelTestRecord::select('FlashPoint')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterTemp = FuelTestRecord::select('Temp')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterWaterSediment = FuelTestRecord::select('WaterSediment')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterCleanliness = FuelTestRecord::select('Cleanliness')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterDateOfTest = FuelTestRecord::select('DateOfTest')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterMadeBy = FuelTestRecord::select('MadeBy')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterDeliveredTo = FuelTestRecord::select('DeliveredTo')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get();

            $FilterRemarks = FuelTestRecord::select('Remarks')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get(); 

            $FilterVendorName = FuelTestRecord::select('VendorName')
                                                ->where('uid', $id)
                                                ->distinct()
                                                ->get(); 

  
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                $SampleNo = $request->SampleNo; 
                $SampleCollectionDate = $request->SampleCollectionDate; 
                $TruckPlateNo = $request->TruckPlateNo; 
                $TankNo = $request->TankNo; 
                $AppearanceResult = $request->AppearanceResult; 
                $Color = $request->Color; 
                $Density = $request->Density; 
                $FlashPoint = $request->FlashPoint; 
                $Temp = $request->Temp; 
                $WaterSediment = $request->WaterSediment; 
                $Cleanliness = $request->Cleanliness; 
                $DateOfTest = $request->DateOfTest; 
                $uid = $request->uid; 
                $MadeBy = $request->MadeBy; 
                $DeliveredTo = $request->DeliveredTo; 
                $Remarks = $request->Remarks; 
                $ApprovalForUse = $request->ApprovalForUse;  
                $VendorNo = $request->VendorNo; 
                $VendorName = $request->VendorName; 
                
            }
 
            $ViewData = [   
                'title' => $title,    
                'FilterSampleNo' => $FilterSampleNo,
                'FilterSampleCollectionDate' => $FilterSampleCollectionDate,
                'FilterTruckPlateNo' => $FilterTruckPlateNo,
                'FilterTankNo' => $FilterTankNo,
                'FilterAppearanceResult' => $FilterAppearanceResult,
                'FilterColor' => $FilterColor,
                'FilterDensity' => $FilterDensity,
                'FilterFlashPoint' => $FilterFlashPoint,
                'FilterTemp' => $FilterTemp,
                'FilterWaterSediment' => $FilterWaterSediment,
                'FilterCleanliness' => $FilterCleanliness,
                'FilterDateOfTest' => $FilterDateOfTest,
                'FilterMadeBy' => $FilterMadeBy,
                'FilterDeliveredTo' => $FilterDeliveredTo,
                'FilterRemarks' => $FilterRemarks,  
                'FilterVendorName' => $FilterVendorName,  
                'PassedRecords' => $PassedRecords_,
                'FailedRecords' => $FailedRecords_,
                'number_of_passed_records' => $number_of_passed_records_,
                'number_of_failed_records' => $number_of_failed_records_,       
                'SampleNo' => $SampleNo,       
                'SampleCollectionDate' => $SampleCollectionDate,       
                'TruckPlateNo' => $TruckPlateNo,       
                'TankNo' => $TankNo,       
                'AppearanceResult' => $AppearanceResult,       
                'Color' => $Color,       
                'Density' => $Density,       
                'FlashPoint' => $FlashPoint,       
                'Temp' => $Temp,       
                'WaterSediment' => $WaterSediment,       
                'Cleanliness' => $Cleanliness,       
                'DateOfTest' => $DateOfTest,       
                'uid' => $uid,       
                'MadeBy' => $MadeBy,       
                'DeliveredTo' => $DeliveredTo,       
                'Remarks' => $Remarks,       
                'ApprovalForUse' => $ApprovalForUse,       
                'VendorNo' => $VendorNo,
                'VendorName' => $VendorName, 
            ]; 
            
            $ViewData = [...$Config, ...$ViewData];  
            
            if(isset($_GET['FilterDiffTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                        ->where('VendorName', $VendorName)
                                                                        ->where('uid', $id)
                                                                        ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
         
            if(isset($_GET['FilterWavedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'WAIVED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                ->where('VendorName', $VendorName)
                                                                ->where('uid', $id)
                                                                ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
        
            
            if(isset($_GET['FilterFailedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'REJECTED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                        
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
        
            if(isset($_GET['FilterPassedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', 'APPROVED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
                
                $number_of_passed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
            
            if(isset($_GET['FilterVendorName'])) {
                $FilteredRecords[] = $_GET['CheckVendorName']; 
        
                foreach ($FilteredRecords as $VendorName) {
                    $title = $VendorName[0];
                    $previous_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                                    ->where('uid', $id)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->paginate(14);
                    
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
        
                    $number_of_passed_records_ = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records_ = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records_ = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records_ = \App\Models\FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count();  
                }

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                    ->whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                        ->with('number_of_passed_records_', $number_of_passed_records_)
                                                        ->with('number_of_failed_records_', $number_of_failed_records_)
                                                        ->with('number_of_waved_records_', $number_of_waved_records_)
                                                        ->with('number_of_diff_records_', $number_of_diff_records_)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute); 
            }

            if (isset($_GET['SortByVendorName'])) {
                $FilteredRecords[] = $request->CheckVendorName; 
 
                foreach ($FilteredRecords as $VendorName) {  
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('VendorName', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            } 

            if (isset($_GET['FilterRecordsOfToday'])) {
                $RecordsOfToday = $request->RecordsOfToday; 
                
                $previous_records = FuelTestRecord::where('uid', $id)
                                ->where('SampleCollectionDate', $RecordsOfToday)
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Today';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday) 
                                                                    ->where('uid', $id)
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)  
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
 
            if (isset($_GET['FilterRecordsOfYesterday'])) {
                $RecordsOfYesterday = $request->RecordsOfYesterday; 
                
                $previous_records = FuelTestRecord::where('uid', $id)
                                                    ->where('SampleCollectionDate', $RecordsOfYesterday)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->paginate(14);

                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Yesterday';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                    ->where('SampleCollectionDate', $RecordsOfYesterday) 
                                                                    ->where('uid', $id)
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)  
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }

            if (isset($_GET['FilterRecordsOfLastSevenDays'])) {
                $TodaysDate = date('Y-m-d'); 
                $LastSevenDays = date('Y-m-d', strtotime( '-7 day' )); 
                 
                $previous_records = FuelTestRecord::where('uid', $id)
                                                    ->whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Last Seven Days';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate]) 
                                                                    ->where('uid', $id)
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)  
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            } 
 
            if (isset($_GET['FilterRecordsOfThisMonth'])) {
                $FirstDayOfThisMonth = date('Y-m-01'); 
                $TodaysDate = date('Y-m-d'); 
                
                $previous_records = FuelTestRecord::where('uid', $id)
                                                    ->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->paginate(14);

                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'This Month';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate]) 
                                                                    ->where('uid', $id)
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)  
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
            
            if (isset($_GET['FilterRecordsOfLastMonth'])) {
                $FirstDayOfLastMonth = date("Y-0n-0j", strtotime("first day of previous month"));  
                $LastDayOfLastMonth = date("Y-0n-j", strtotime("last day of previous month"));
                   
                $previous_records = FuelTestRecord::where('uid', $id)
                                                    ->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Last Month';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth]) 
                                                                    ->where('uid', $id)
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)  
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }  

            if (isset($_GET['FilterPassedTests'])) {   
                $previous_records = $PassedRecords_;
                  
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Passed Tests';
                
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                    ->where('ApprovalForUse', 'APPROVED')
                                                    ->where('uid', $id)
                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }

            if (isset($_GET['FilterDiffTests'])) {   
                $previous_records = $DiffRecords_; 
                  
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Diff Tests';
                
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::where('ApprovalForUse', NULL)
                                                    ->where('uid', $id)
                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            } 

            if (isset($_GET['FilterWavedTests'])) {   
                $previous_records = $WavedRecords_;  
                  
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Waived Tests';
                
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                    ->where('ApprovalForUse', 'WAIVED')
                                                    ->where('uid', $id)
                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            } 

            if (isset($_GET['FilterFailedTests'])) {   
                $previous_records = $FailedRecords_; 
                  
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'Failed Tests';
                
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                    ->where('ApprovalForUse', 'REJECTED')
                                                    ->where('uid', $id)
                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                        ->with('number_of_passed_records', $number_of_passed_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('title', $title)
                                                        ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);

            }
 
            if (isset($_GET['FilterDateBetweenForCurrentVendor'])) {
                $title = $VendorName = $_GET['Title'];

                $DateFrom = $request->DateFrom;
                $DateTo = $request->DateTo;
                
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                ->orderBy('SampleNo', 'DESC')
                                                ->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_previous_records = count($previous_records);
                    
                $number_of_passed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                
                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                ->where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                    ->with('number_of_passed_records', $number_of_passed_records)
                                                    ->with('number_of_failed_records', $number_of_failed_records)
                                                    ->with('number_of_waved_records', $number_of_waved_records)
                                                    ->with('number_of_diff_records', $number_of_diff_records)
                                                    ->with('number_of_previous_records', $number_of_previous_records)
                                                    ->with('title', $title)
                                                    ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);                                                
            }
 
            if (isset($_GET['FilterDateBetween'])) {
                $DateFrom = $request->DateFrom;
                $DateTo = $request->DateTo;
                
                $previous_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                ->where('uid', $id)->orderBy('SampleNo', 'DESC')
                                ->paginate(14);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_previous_records = count($previous_records);
                
                $number_of_previous_records_absolute = FuelTestRecord::select('id')
                                                                    ->whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
                                                                    ->count();

                return view("previous_records", $ViewData)->with('previous_records', $previous_records)
                                                    ->with('number_of_passed_records', $number_of_passed_records)
                                                    ->with('number_of_failed_records', $number_of_failed_records)
                                                    ->with('number_of_waved_records', $number_of_waved_records)
                                                    ->with('number_of_diff_records', $number_of_diff_records)
                                                    ->with('number_of_previous_records', $number_of_previous_records)
                                                    ->with('title', $title)
                                                    ->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }

            if (isset($_GET['SortBySampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {  
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('SampleNo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {
                    $previous_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->where('uid', $id)->orderBy('SampleNo', 'DESC')->paginate(14);
                   
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('SampleCollectionDate', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $previous_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->where('uid', $id)->orderBy('SampleCollectionDate', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('TruckPlateNo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $previous_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->where('uid', $id)->orderBy('TruckPlateNo', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('TankNo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $previous_records = FuelTestRecord::whereIn('TankNo', $TankNo)->where('uid', $id)->orderBy('TankNo', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('AppearanceResult', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $previous_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->where('uid', $id)->orderBy('AppearanceResult', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Color', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $previous_records = FuelTestRecord::whereIn('Color', $Color)->where('uid', $id)->orderBy('Color', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Density', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $previous_records = FuelTestRecord::whereIn('Density', $Density)->where('uid', $id)->orderBy('Density', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('FlashPoint', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $previous_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->where('uid', $id)->orderBy('FlashPoint', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Temp', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $previous_records = FuelTestRecord::whereIn('Temp', $Temp)->where('uid', $id)->orderBy('Temp', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('WaterSediment', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $previous_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->where('uid', $id)->orderBy('WaterSediment', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Cleanliness', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $previous_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->where('uid', $id)->orderBy('Cleanliness', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('DateOfTest', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $previous_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->where('uid', $id)->orderBy('DateOfTest', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('MadeBy', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $previous_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->where('uid', $id)->orderBy('MadeBy', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('DeliveredTo', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $previous_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->where('uid', $id)->orderBy('DeliveredTo', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);  
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Remarks', $SortOrder)->paginate(14);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $previous_records = FuelTestRecord::whereIn('Remarks', $Remarks)->where('uid', $id)->orderBy('Remarks', 'DESC')->paginate(14);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title);
        } else { 
            return redirect('/');        
        }  
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $SampleNo)
    {
        $Config = $this->config();  
        extract($Config); 
        
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } 
         
        $title = 'Edit Record';  

        $SampleNo = $request->SampleNo;   
        $SampleCollectionDate = $request->SampleCollectionDate; 
        $TruckPlateNo = $request->TruckPlateNo; 
        $TankNo = $request->TankNo; 
        $AppearanceResult = $request->AppearanceResult; 
        $Color = $request->Color; 
        $Density = $request->Density; 
        $FlashPoint = $request->FlashPoint; 
        $Temp = $request->Temp; 
        $WaterSediment = $request->WaterSediment; 
        $Cleanliness = $request->Cleanliness; 
        $DateOfTest = $request->DateOfTest; 
        $uid = $request->uid; 
        $MadeBy = $request->MadeBy; 
        $DeliveredTo = $request->DeliveredTo; 
        $Remarks = $request->Remarks; 
        $VendorName = $request->VendorName; 
        $VendorNo = $request->VendorNo;  
        $ApprovalForUse = $request->ApprovalForUse;
        
        $VendorName = '';
 
            $VendorEdit = Vendor::where('VendorNo', $VendorNo)->get();

            foreach ($VendorEdit as $VendorName) {
                $VendorName = $VendorName->VendorName;
            }  

        $edit = FuelTestRecord::where('SampleNo', $SampleNo)->update([
            'SampleNo' => $request->SampleNo,
            'SampleCollectionDate' => $SampleCollectionDate,
            'TruckPlateNo' => $TruckPlateNo,
            'TankNo' => $TankNo,
            'AppearanceResult' => $AppearanceResult,
            'Color' => $Color,
            'Density' => $Density,
            'FlashPoint' => $FlashPoint,
            'Temp' => $Temp,
            'WaterSediment' => $WaterSediment,
            'Cleanliness' => $Cleanliness,
            'DateOfTest' => $DateOfTest,
            'uid' => $uid,
            'MadeBy' => $MadeBy,
            'DeliveredTo' => $DeliveredTo,
            'Remarks' => $Remarks,
            'VendorName' => $VendorName,
            'VendorNo' => $VendorNo,
            'ApprovalForUse' => $ApprovalForUse,
         ]);

         $ViewData = [
            'SampleNo' => $request->SampleNo,
            'SampleCollectionDate' => $SampleCollectionDate,
            'TruckPlateNo' => $TruckPlateNo,
            'TankNo' => $TankNo,
            'AppearanceResult' => $AppearanceResult,
            'Color' => $Color,
            'Density' => $Density,
            'FlashPoint' => $FlashPoint,
            'Temp' => $Temp,
            'WaterSediment' => $WaterSediment,
            'Cleanliness' => $Cleanliness,
            'DateOfTest' => $DateOfTest,
            'uid' => $uid,
            'MadeBy' => $MadeBy,
            'DeliveredTo' => $DeliveredTo,
            'Remarks' => $Remarks, 
            'VendorName' => $VendorName, 
            'VendorNo' => $VendorNo, 
            'ApprovalForUse' => $ApprovalForUse, 
            'title' => $title,  
        ];
 
        $ViewData = [...$Config, ...$ViewData];   

        return view("edit", $ViewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SampleNo)
    {
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } 
        
        $SampleNo = $request->SampleNo;   
        $SampleCollectionDate = $request->SampleCollectionDate; 
        $TruckPlateNo = $request->TruckPlateNo; 
        $TankNo = $request->TankNo; 
        $AppearanceResult = $request->AppearanceResult; 
        $Color = $request->Color; 
        $Density = $request->Density; 
        $FlashPoint = $request->FlashPoint; 
        $Temp = $request->Temp; 
        $WaterSediment = $request->WaterSediment; 
        $Cleanliness = $request->Cleanliness; 
        $DateOfTest = $request->DateOfTest; 
        $uid = $request->uid; 
        $MadeBy = $request->MadeBy; 
        $DeliveredTo = $request->DeliveredTo; 
        $Remarks = $request->Remarks;
        $ApprovalForUse = $request->ApprovalForUse;  
         
        $VendorNo = $request->VendorNo;
        $VendorName = $request->VendorName;

        $save_changes = FuelTestRecord::where('SampleNo', $SampleNo)->update([
            'SampleNo' => $request->SampleNo,
            'SampleCollectionDate' => $SampleCollectionDate,
            'TruckPlateNo' => $TruckPlateNo,
            'TankNo' => $TankNo,
            'AppearanceResult' => $AppearanceResult,
            'Color' => $Color,
            'Density' => $Density,
            'FlashPoint' => $FlashPoint,
            'Temp' => $Temp,
            'WaterSediment' => $WaterSediment,
            'Cleanliness' => $Cleanliness,
            'DateOfTest' => $DateOfTest,
            'uid' => $uid,
            'MadeBy' => $MadeBy,
            'DeliveredTo' => $DeliveredTo,
            'Remarks' => $Remarks,
            'VendorName' => $VendorName,
            'VendorNo' => $VendorNo,
            'ApprovalForUse' => $ApprovalForUse,
         ]);

         return redirect('FuelTest');
    }

    public function show_stats() { 
        $Config = $this->config();
        extract($Config); 
 
        $title = 'INSIGHTS';

        $PercentageOfPassedRecords = $number_of_passed_records / $number_of_all_records * 100; 
        $PercentageOfFailedRecords = $number_of_failed_records / $number_of_all_records * 100;
        $PercentageOfWavedRecords = $number_of_waved_records / $number_of_all_records * 100;
        $PercentageOfDiffRecords = $number_of_diff_records / $number_of_all_records * 100;
  
        $FirstDayOfLastMonth = date("Y-0n-j", strtotime("first day of previous month"));  
        $LastDayOfLastMonth = date("Y-0n-j", strtotime("last day of previous month"));
            
        $last_month_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                        ->orderBy('SampleNo', 'DESC')
                        ->get();
         
        $number_of_all_records_last_month = count($last_month_records); 
        $PercentageOfNumberOfRecordsLastMonth = $number_of_all_records_last_month / $number_of_all_records * 100; 
 
        $FirstDayOfThisMonth = date('Y-m-1'); 
        $TodaysDate = date('Y-m-d'); 
        
        $this_month_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                ->orderBy('SampleNo', 'DESC')
                                ->get();
         
        $number_of_all_records_this_month = count($this_month_records);
        $PercentageOfAllRecordsThisMonth = $number_of_all_records_this_month / $number_of_all_records * 100; 

        $TodaysDate = date('Y-m-d'); 
        $LastSevenDays = date('Y-m-d', strtotime( '-1 week' )); 
         
        $last_seven_days_records = FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])
                        ->orderBy('SampleNo', 'DESC')
                        ->get();
         
        $number_of_all_records_last_seven_days = count($last_seven_days_records);
        $PercentageOfAllRecordsSevenDaysAgo = $PercentageOfNumberOfRecordsLastSevenDays = $number_of_all_records_last_seven_days / $number_of_all_records * 100; 
        
        $AbsolutePercentageOfNumberOfRecordsLastMonth = $number_of_all_records_last_month / $number_of_all_records_absolute * 100; 
        $AbsolutePercentageOfAllRecordsThisMonth = $number_of_all_records_this_month / $number_of_all_records_absolute * 100;
        $AbsolutePercentageOfNumberOfRecordsLastSevenDays = $number_of_all_records_last_seven_days / $number_of_all_records_absolute * 100;

        $RecordsOfYesterday = date('Y-m-d',strtotime("-1 day")); 
                
        $yesterday_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterday)
                                        ->orderBy('SampleNo', 'DESC')
                                        ->get();
         
        $number_of_yesterday_records = count($yesterday_records);
        $PercentageOfAllRecordsYesterday = $number_of_yesterday_records / $number_of_all_records * 100; 
        $AbsolutePercentageOfAllRecordsYesterday = $number_of_yesterday_records / $number_of_all_records_absolute * 100; 

        $RecordsOfToday = date('Y-m-d'); 
                
        $todays_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday)
                        ->orderBy('SampleNo', 'DESC')
                        ->get();
         
        $number_of_todays_records = count($todays_records); 
        $PercentageOfAllRecordsToday = $number_of_todays_records / $number_of_all_records * 100; 
        $AbsolutePercentageOfAllRecordsToday = $number_of_todays_records / $number_of_all_records_absolute * 100; 

              
        $RecordsOfTwoDaysAgo = date('Y-m-d', strtotime("-2 day"));   
        $number_of_two_days_ago_records = FuelTestRecord::select('id')
                                    ->where('SampleCollectionDate', $RecordsOfTwoDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfThreeDaysAgo = date('Y-m-d', strtotime("-3 day"));   
        $number_of_three_days_ago_records = FuelTestRecord::select('id')
                                    ->where('SampleCollectionDate', $RecordsOfThreeDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfFourDaysAgo = date('Y-m-d', strtotime("-4 day"));   
        $number_of_four_days_ago_records = FuelTestRecord::select('id')
                                    ->where('SampleCollectionDate', $RecordsOfFourDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfFiveDaysAgo = date('Y-m-d', strtotime("-5 day"));   
        $number_of_five_days_ago_records = FuelTestRecord::select('id')
                                    ->where('SampleCollectionDate', $RecordsOfFiveDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfSixDaysAgo = date('Y-m-d', strtotime("-6 day"));   
        $number_of_six_days_ago_records = FuelTestRecord::select('id')
                                    ->where('SampleCollectionDate', $RecordsOfSixDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records_absolute * 100;                       
 
        $ViewData = [  
            'title' => $title,  
            'number_of_all_records_last_month' => $number_of_all_records_last_month,
            'number_of_all_records_this_month' => $number_of_all_records_this_month,
            'number_of_all_records_last_seven_days' => $number_of_all_records_last_seven_days,
            'number_of_yesterday_records' => $number_of_yesterday_records,
            'number_of_todays_records' => $number_of_todays_records,
            'number_of_two_days_ago_records' => $number_of_two_days_ago_records,
            'number_of_three_days_ago_records' => $number_of_three_days_ago_records,
            'number_of_four_days_ago_records' => $number_of_four_days_ago_records,
            'number_of_five_days_ago_records' => $number_of_five_days_ago_records,
            'number_of_six_days_ago_records' => $number_of_two_days_ago_records,
            'PercentageOfFailedRecords' => $PercentageOfFailedRecords,
            'PercentageOfPassedRecords' => $PercentageOfPassedRecords,
            'PercentageOfWavedRecords' => $PercentageOfWavedRecords,
            'PercentageOfDiffRecords' => $PercentageOfDiffRecords,
            'AbsolutePercentageOfNumberOfRecordsLastMonth' => $AbsolutePercentageOfNumberOfRecordsLastMonth,
            'AbsolutePercentageOfAllRecordsThisMonth' => $AbsolutePercentageOfAllRecordsThisMonth,
            'PercentageOfAllRecordsThisMonth' => $PercentageOfAllRecordsThisMonth,
            'PercentageOfAllRecordsThisMonth' => $PercentageOfAllRecordsThisMonth, 
            'AbsolutePercentageOfNumberOfRecordsLastSevenDays' => $AbsolutePercentageOfNumberOfRecordsLastSevenDays,
            'PercentageOfNumberOfRecordsLastSevenDays' => $PercentageOfNumberOfRecordsLastSevenDays,
            'PercentageOfAllRecordsToday' => $PercentageOfAllRecordsToday,
            'PercentageOfAllRecordsYesterday' => $PercentageOfAllRecordsYesterday,
            'PercentageOfAllRecordsTwoDaysAgo' => $PercentageOfAllRecordsTwoDaysAgo,
            'PercentageOfAllRecordsThreeDaysAgo' => $PercentageOfAllRecordsThreeDaysAgo,
            'PercentageOfAllRecordsFourDaysAgo' => $PercentageOfAllRecordsFourDaysAgo,
            'PercentageOfAllRecordsFiveDaysAgo' => $PercentageOfAllRecordsFiveDaysAgo,
            'PercentageOfAllRecordsSixDaysAgo' => $PercentageOfAllRecordsSixDaysAgo,
            'PercentageOfAllRecordsSevenDaysAgo' => $PercentageOfAllRecordsSevenDaysAgo,
            'AbsolutePercentageOfAllRecordsToday' => $AbsolutePercentageOfAllRecordsToday,
            'AbsolutePercentageOfAllRecordsYesterday' => $AbsolutePercentageOfAllRecordsYesterday,
            'AbsolutePercentageOfAllRecordsTwoDaysAgo' => $AbsolutePercentageOfAllRecordsTwoDaysAgo,
            'AbsolutePercentageOfAllRecordsThreeDaysAgo' => $AbsolutePercentageOfAllRecordsThreeDaysAgo,
            'AbsolutePercentageOfAllRecordsFourDaysAgo' => $AbsolutePercentageOfAllRecordsFourDaysAgo,
            'AbsolutePercentageOfAllRecordsFiveDaysAgo' => $AbsolutePercentageOfAllRecordsFiveDaysAgo,
            'AbsolutePercentageOfAllRecordsSixDaysAgo' => $AbsolutePercentageOfAllRecordsSixDaysAgo, 
        ];

        $ViewData = [...$Config, ...$ViewData];  
    
        return view('FuelTestStats', $ViewData);
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
