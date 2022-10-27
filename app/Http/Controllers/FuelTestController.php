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

        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'DESC')->paginate(15);
        $number_of_previous_records = count($previous_records);

        $all_records_for_insights = FuelTestRecord::orderBy('SampleNo', 'DESC')->get()->toArray(); 
        
        $number_of_previous_records_absolute = FuelTestRecord::where('uid', $id)->count();
        $number_of_all_records_absolute = FuelTestRecord::count();
 
        $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'DESC')->paginate(15)->fragment('AllRecords'); 
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
        
        $PercentageForVendorWithTheHighestSupply = FuelTestRecord::select('VendorName') 
                                                    ->where('VendorName', $VendorWithTheHighestSupply) 
                                                    ->limit(1)
                                                    ->count(); 

        $PercentageForVendorWithTheLowestSupply = FuelTestRecord::select('VendorName') 
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

        $PassedRecords = FuelTestRecord::where('ApprovalForUse', 'APPROVED')->orderBy('SampleNo', 'DESC')->paginate(15);
        $number_of_passed_records = FuelTestRecord::where('ApprovalForUse', 'APPROVED')->count();  
         
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
                                        ->paginate(15);
        $number_of_passed_records_ = FuelTestRecord::where('uid', $id)
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

        $DiffRecords = FuelTestRecord::where('VendorName', NULL)->paginate(15);
        $number_of_diff_records = FuelTestRecord::where('VendorName', NULL)->count(); 
        
        $DiffRecords_ = FuelTestRecord::where('uid', $id) 
                                        ->where('VendorName', NULL)
                                        ->paginate(15);
        $number_of_diff_records_ = FuelTestRecord::where('uid', $id) 
                                                    ->where('VendorName', NULL)
                                                    ->count(); 
        
        $FailedRecords = FuelTestRecord::where('ApprovalForUse', 'REJECTED')->orderBy('SampleNo', 'DESC')->paginate(15);
        $number_of_failed_records = FuelTestRecord::where('ApprovalForUse', 'REJECTED')->count(); 
        
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
                                        ->paginate(15);
        $number_of_failed_records_ = FuelTestRecord::where('uid', $id)
                                                    ->where('ApprovalForUse', 'REJECTED')
                                                    ->count();

        $WavedRecords = FuelTestRecord::where('ApprovalForUse', 'WAIVED')->orderBy('SampleNo', 'DESC')
                                        ->paginate(15);
        $number_of_waved_records = FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                    ->count();  

        $WavedRecords_ = FuelTestRecord::where('uid', $id)->orderBy('SampleNo', 'DESC')
                                        ->where('ApprovalForUse', 'WAIVED')
                                        ->paginate(15);
        $number_of_waved_records_ = FuelTestRecord::where('uid', $id)
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
                                                ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->count();
                            
                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            
            if(isset($_GET['FilterWavedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', 'WAIVED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->count();
                            
                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            
            if(isset($_GET['FilterFailedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', 'REJECTED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $number_of_all_records = count($all_records);
                
                $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                $number_of_all_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
        
            if(isset($_GET['FilterPassedTestsForCurrentVendor'])) {
                
                    $title = $VendorName = $_GET['Title'];
                    $all_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', 'APPROVED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(15);
                    
                    $all_records->setPath($_SERVER['REQUEST_URI']);  

                    $number_of_all_records = count($all_records);
                    
                    $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count(); 

                    $number_of_all_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                    ->count();

                return view("all_records", $ViewData)->with('all_records', $all_records)->with('number_of_passed_records', $number_of_passed_records)->with('number_of_failed_records', $number_of_failed_records)->with('number_of_waved_records', $number_of_waved_records)->with('number_of_diff_records', $number_of_diff_records)->with('number_of_all_records', $number_of_all_records)->with('title', $title)->with('number_of_all_records_absolute', $number_of_all_records_absolute);
            }
            
            if(isset($_GET['FilterVendorName'])) {
                $FilteredRecords[] = $_GET['CheckVendorName'];   
                foreach ($FilteredRecords as $VendorName) {
                    $title = $VendorName[0];
                    $all_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)->orderBy('SampleNo', 'DESC')->paginate(15);

                    $all_records->setPath($_SERVER['REQUEST_URI']);  

                    $number_of_all_records = count($all_records);
                    
                    $number_of_passed_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count(); 
                }  

                $number_of_all_records_absolute = FuelTestRecord::whereIn('VendorName', $VendorName)
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
                                ->paginate(15);
                
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
                                                ->paginate(15);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Yesterday';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterday)
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
                                ->paginate(15);
                
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
                                ->paginate(15);
                 
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                        
                $title = 'This Month';
                $number_of_all_records = count($all_records);

                $number_of_all_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
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
                                ->paginate(15);
                 
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

                $number_of_all_records_absolute = FuelTestRecord::where('ApprovalForUse', 'APPROVED')
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
                
                $number_of_all_records_absolute = FuelTestRecord::where('ApprovalForUse', 'WAIVED')
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
                
                $number_of_all_records_absolute = FuelTestRecord::where('ApprovalForUse', 'REJECTED')
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
                                                ->paginate(15);
                
                $all_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_all_records = count($all_records);
                    
                $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                
                $number_of_all_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
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
                                ->paginate(15);
                  
                $all_records->setPath($_SERVER['REQUEST_URI']);  

                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_all_records = count($all_records);
                
                $number_of_all_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
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
                    $all_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->orderBy('SampleNo', 'DESC')->paginate(15);
                   
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                } 
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('SampleCollectionDate', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $all_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->orderBy('SampleCollectionDate', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('TruckPlateNo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $all_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->orderBy('TruckPlateNo', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('TankNo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $all_records = FuelTestRecord::whereIn('TankNo', $TankNo)->orderBy('TankNo', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('AppearanceResult', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $all_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->orderBy('AppearanceResult', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Color', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $all_records = FuelTestRecord::whereIn('Color', $Color)->orderBy('Color', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);  
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Density', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $all_records = FuelTestRecord::whereIn('Density', $Density)->orderBy('Density', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('FlashPoint', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $all_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->orderBy('FlashPoint', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Temp', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $all_records = FuelTestRecord::whereIn('Temp', $Temp)->orderBy('Temp', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('WaterSediment', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $all_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->orderBy('WaterSediment', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Cleanliness', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $all_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->orderBy('Cleanliness', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('DateOfTest', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $all_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->orderBy('DateOfTest', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records);  
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('MadeBy', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $all_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->orderBy('MadeBy', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('DeliveredTo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $all_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->orderBy('DeliveredTo', 'DESC')->paginate(15);
                      
                    $all_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_all_records = count($all_records); 
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $all_records = FuelTestRecord::orderBy('Remarks', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $all_records = FuelTestRecord::whereIn('Remarks', $Remarks)->orderBy('Remarks', 'DESC')->paginate(15);
                      
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
                                                    ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->where('uid', $id)
                ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
         
            if(isset($_GET['FilterWavedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'WAIVED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->where('uid', $id)
                ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
        
            
            if(isset($_GET['FilterFailedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', 'REJECTED')
                                                    ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                        
                $number_of_previous_records = count($previous_records);
            
                $number_of_passed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
                ->where('uid', $id)
                ->count();
                                
                return view("previous_records", $ViewData)->with('previous_records', $previous_records)->with('number_of_passed_records_', $number_of_passed_records_)->with('number_of_failed_records_', $number_of_failed_records_)->with('number_of_waved_records_', $number_of_waved_records_)->with('number_of_diff_records_', $number_of_diff_records_)->with('number_of_previous_records', $number_of_previous_records)->with('title', $title)->with('number_of_previous_records_absolute', $number_of_previous_records_absolute);
            }
        
            if(isset($_GET['FilterPassedTestsForCurrentVendor'])) {
                
                $title = $VendorName = $_GET['Title'];
                $previous_records = FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', 'APPROVED')
                                                ->orderBy('SampleNo', 'DESC')->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                $number_of_previous_records = count($previous_records);
                
                $number_of_passed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records_ = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count();  

                $number_of_previous_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
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
                                                                    ->paginate(15);
                    
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
        
                    $number_of_passed_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "APPROVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_failed_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "REJECTED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_waved_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', "WAIVED")
                                                    ->orderBy('SampleNo', 'DESC')->count(); 
                    
                    $number_of_diff_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                    ->where('uid', $id)
                                                    ->where('ApprovalForUse', NULL)
                                                    ->count();  
                }

                $number_of_previous_records_absolute = FuelTestRecord::whereIn('VendorName', $VendorName)
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
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('VendorName', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            } 

            if (isset($_GET['FilterRecordsOfToday'])) {
                $RecordsOfToday = $request->RecordsOfToday; 
                
                $previous_records = FuelTestRecord::where('uid', $id)
                                ->where('SampleCollectionDate', $RecordsOfToday)
                                ->orderBy('SampleNo', 'DESC')
                                ->paginate(15);
                
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
                                                    ->paginate(15);

                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Yesterday';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterday) 
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
                                                    ->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Last Seven Days';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate]) 
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
                                                    ->paginate(15);

                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'This Month';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate]) 
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
                                                    ->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                  
                $title = 'Last Month';
                $number_of_previous_records = count($previous_records);

                $number_of_previous_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth]) 
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

                $number_of_previous_records_absolute = FuelTestRecord::where('ApprovalForUse', 'APPROVED')
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

                $number_of_previous_records_absolute = FuelTestRecord::where('ApprovalForUse', 'WAIVED')
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

                $number_of_previous_records_absolute = FuelTestRecord::where('ApprovalForUse', 'REJECTED')
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
                                                ->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_previous_records = count($previous_records);
                    
                $number_of_passed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "APPROVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_failed_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "REJECTED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_waved_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', "WAIVED")
                                                ->orderBy('SampleNo', 'DESC')->count(); 
                
                $number_of_diff_records = \App\Models\FuelTestRecord::where('VendorName', $VendorName)
                                                ->where('uid', $id)
                                                ->where('ApprovalForUse', NULL)
                                                ->count(); 

                
                $number_of_previous_records_absolute = FuelTestRecord::where('VendorName', $VendorName)
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
                                ->paginate(15);
                
                $previous_records->setPath($_SERVER['REQUEST_URI']);  
                
                $title = 'From ' . $DateFrom . ' to ' . $DateTo;
                $number_of_previous_records = count($previous_records);
                
                $number_of_previous_records_absolute = FuelTestRecord::whereBetween('SampleCollectionDate', [$DateFrom, $DateTo])
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
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('SampleNo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {
                    $previous_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->where('uid', $id)->orderBy('SampleNo', 'DESC')->paginate(15);
                   
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('SampleCollectionDate', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $previous_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->where('uid', $id)->orderBy('SampleCollectionDate', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('TruckPlateNo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $previous_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->where('uid', $id)->orderBy('TruckPlateNo', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('TankNo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $previous_records = FuelTestRecord::whereIn('TankNo', $TankNo)->where('uid', $id)->orderBy('TankNo', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('AppearanceResult', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $previous_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->where('uid', $id)->orderBy('AppearanceResult', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Color', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $previous_records = FuelTestRecord::whereIn('Color', $Color)->where('uid', $id)->orderBy('Color', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Density', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $previous_records = FuelTestRecord::whereIn('Density', $Density)->where('uid', $id)->orderBy('Density', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('FlashPoint', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $previous_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->where('uid', $id)->orderBy('FlashPoint', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Temp', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $previous_records = FuelTestRecord::whereIn('Temp', $Temp)->where('uid', $id)->orderBy('Temp', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('WaterSediment', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $previous_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->where('uid', $id)->orderBy('WaterSediment', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Cleanliness', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $previous_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->where('uid', $id)->orderBy('Cleanliness', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('DateOfTest', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $previous_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->where('uid', $id)->orderBy('DateOfTest', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('MadeBy', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $previous_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->where('uid', $id)->orderBy('MadeBy', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('DeliveredTo', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $previous_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->where('uid', $id)->orderBy('DeliveredTo', 'DESC')->paginate(15);
                 
                    $previous_records->setPath($_SERVER['REQUEST_URI']);  
                    
                    $number_of_previous_records = count($previous_records);  
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) { 
                    $SortOrder = Session::get('SortOrder', 'ASC');
                    $previous_records = FuelTestRecord::where('uid', $id)->orderBy('Remarks', $SortOrder)->paginate(15);

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $previous_records = FuelTestRecord::whereIn('Remarks', $Remarks)->where('uid', $id)->orderBy('Remarks', 'DESC')->paginate(15);
                 
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
        $number_of_two_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfTwoDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfThreeDaysAgo = date('Y-m-d', strtotime("-3 day"));   
        $number_of_three_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfThreeDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfFourDaysAgo = date('Y-m-d', strtotime("-4 day"));   
        $number_of_four_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfFourDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfFiveDaysAgo = date('Y-m-d', strtotime("-5 day"));   
        $number_of_five_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfFiveDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records_absolute * 100;                       
                        
              
        $RecordsOfSixDaysAgo = date('Y-m-d', strtotime("-6 day"));   
        $number_of_six_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfSixDaysAgo)
                        ->orderBy('SampleNo', 'DESC')
                        ->count(); 
        $PercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records * 100;                       
        $AbsolutePercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records_absolute * 100;                       

        $Month1 = '01';                        
        $FirstDayOfJanuary = date('Y-' . $Month1 . '-01'); 
        $LastDayOfJanuary = date('Y-' . $Month1 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 1, 2022));                        
        $January = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJanuary, $LastDayOfJanuary])
                                    ->count();   
        $PercentageOfAllRecordsInJanuary = $January / $number_of_all_records * 100;                      
        $AbsolutePercentageOfAllRecordsInJanuary = $January / $number_of_all_records_absolute * 100;                      
      
        $Month2 = '02';                        
        $FirstDayOfFebruary = date('Y-' . $Month2 . '-01'); 
        $LastDayOfFebruary = date('Y-' . $Month2 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 2, 2022));                        
        $February = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfFebruary, $LastDayOfFebruary])
                                    ->count();                        
        $PercentageOfAllRecordsInFebruary = $February / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInFebruary = $February / $number_of_all_records_absolute * 100;  
      
        $Month3 = '03';                        
        $FirstDayOfMarch = date('Y-' . $Month3 . '-01'); 
        $LastDayOfMarch = date('Y-' . $Month3 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 3, 2022));                        
        $March = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfMarch, $LastDayOfMarch])
                                    ->count();                        
        $PercentageOfAllRecordsInMarch = $March / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInMarch = $March / $number_of_all_records_absolute * 100;  
      
        $Month4 = '04';                        
        $FirstDayOfApril = date('Y-' . $Month4 . '-01'); 
        $LastDayOfApril = date('Y-' . $Month4 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 4, 2022));                        
        $April = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfApril, $LastDayOfApril])
                                    ->count();                        
        $PercentageOfAllRecordsInApril = $April / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInApril = $April / $number_of_all_records_absolute * 100;  
      
        $Month5 = '05';                        
        $FirstDayOfMay = date('Y-' . $Month5 . '-01'); 
        $LastDayOfMay = date('Y-' . $Month5 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 5, 2022));                        
        $May = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfMay, $LastDayOfMay])
                                    ->count();                        
        $PercentageOfAllRecordsInMay = $May / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInMay = $May / $number_of_all_records_absolute * 100;  
      
        $Month6 = '06';                        
        $FirstDayOfJune = date('Y-' . $Month6 . '-01'); 
        $LastDayOfJune = date('Y-' . $Month6 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 6, 2022));                        
        $June = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJune, $LastDayOfJune])
                                    ->count();                        
        $PercentageOfAllRecordsInJune = $June / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInJune = $June / $number_of_all_records_absolute * 100;  
     
        $Month7 = '07';                        
        $FirstDayOfJuly = date('Y-' . $Month7 . '-01'); 
        $LastDayOfJuly = date('Y-' . $Month7 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 7, 2022));                        
        $July = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJuly, $LastDayOfJuly])
                                    ->count();                        
        $PercentageOfAllRecordsInJuly = $July / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInJuly = $July / $number_of_all_records_absolute * 100;  
    
        $Month8 = '08';                        
        $FirstDayOfAugust = date('Y-' . $Month8 . '-01'); 
        $LastDayOfAugust = date('Y-' . $Month8 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 8, 2022));                        
        $August = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfAugust, $LastDayOfAugust])
                                    ->count();                        
        $PercentageOfAllRecordsInAugust = $August / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInAugust = $August / $number_of_all_records_absolute * 100;  
  
    
        $Month9 = '09';                        
        $FirstDayOfSeptember = date('Y-' . $Month9 . '-01'); 
        $LastDayOfSeptember = date('Y-' . $Month9 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 9, 2022));                        
        $September = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfSeptember, $LastDayOfSeptember])
                                    ->count();                        
        $PercentageOfAllRecordsInSeptember = $September / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInSeptember = $September / $number_of_all_records_absolute * 100;  
  
    
        $Month10 = '10';                        
        $FirstDayOfOctober = date('Y-' . $Month10 . '-01'); 
        $LastDayOfOctober = date('Y-' . $Month10 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 10, 2022));                        
        $October = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfOctober, $LastDayOfOctober])
                                    ->count();                        
        $PercentageOfAllRecordsInOctober = $October / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInOctober = $October / $number_of_all_records_absolute * 100;  
  
    
        $Month11 = '11';                        
        $FirstDayOfNovember = date('Y-' . $Month11 . '-01'); 
        $LastDayOfNovember = date('Y-' . $Month11 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 11, 2022));                        
        $November = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfNovember, $LastDayOfNovember])
                                    ->count();                        
        $PercentageOfAllRecordsInNovember = $November / $number_of_all_records * 100;  
        $AbsolutePercentageOfAllRecordsInNovember = $November / $number_of_all_records_absolute * 100;  
  
    
        $Month12 = '12';                        
        $FirstDayOfDecember = date('Y-' . $Month12 . '-01'); 
        $LastDayOfDecember = date('Y-' . $Month12 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 12, 2022));                        
        $December = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfDecember, $LastDayOfDecember])
                                    ->count();                        
        $PercentageOfAllRecordsInDecember = $December / $number_of_all_records * 100;    
        $AbsolutePercentageOfAllRecordsInDecember = $December / $number_of_all_records_absolute * 100;    

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
            'PercentageOfAllRecordsInJanuary' => $PercentageOfAllRecordsInJanuary,
            'PercentageOfAllRecordsInFebruary' => $PercentageOfAllRecordsInFebruary,
            'PercentageOfAllRecordsInMarch' => $PercentageOfAllRecordsInMarch,
            'PercentageOfAllRecordsInApril' => $PercentageOfAllRecordsInApril,
            'PercentageOfAllRecordsInMay' => $PercentageOfAllRecordsInMay,
            'PercentageOfAllRecordsInJune' => $PercentageOfAllRecordsInJune,
            'PercentageOfAllRecordsInJuly' => $PercentageOfAllRecordsInJuly,
            'PercentageOfAllRecordsInAugust' => $PercentageOfAllRecordsInAugust,
            'PercentageOfAllRecordsInSeptember' => $PercentageOfAllRecordsInSeptember,
            'PercentageOfAllRecordsInOctober' => $PercentageOfAllRecordsInOctober,
            'PercentageOfAllRecordsInNovember' => $PercentageOfAllRecordsInNovember,
            'PercentageOfAllRecordsInDecember' => $PercentageOfAllRecordsInDecember,
            'AbsolutePercentageOfAllRecordsInJanuary' => $AbsolutePercentageOfAllRecordsInJanuary,
            'AbsolutePercentageOfAllRecordsInFebruary' => $AbsolutePercentageOfAllRecordsInFebruary,
            'AbsolutePercentageOfAllRecordsInMarch' => $AbsolutePercentageOfAllRecordsInMarch,
            'AbsolutePercentageOfAllRecordsInApril' => $AbsolutePercentageOfAllRecordsInApril,
            'AbsolutePercentageOfAllRecordsInMay' => $AbsolutePercentageOfAllRecordsInMay,
            'AbsolutePercentageOfAllRecordsInJune' => $AbsolutePercentageOfAllRecordsInJune,
            'AbsolutePercentageOfAllRecordsInJuly' => $AbsolutePercentageOfAllRecordsInJuly,
            'AbsolutePercentageOfAllRecordsInAugust' => $AbsolutePercentageOfAllRecordsInAugust,
            'AbsolutePercentageOfAllRecordsInSeptember' => $AbsolutePercentageOfAllRecordsInSeptember,
            'AbsolutePercentageOfAllRecordsInOctober' => $AbsolutePercentageOfAllRecordsInOctober,
            'AbsolutePercentageOfAllRecordsInNovember' => $AbsolutePercentageOfAllRecordsInNovember,
            'AbsolutePercentageOfAllRecordsInDecember' => $AbsolutePercentageOfAllRecordsInDecember,
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
            'January' => $January,
            'February' => $February,
            'March' => $March,
            'April' => $April,
            'May' => $May,
            'June' => $June,
            'July' => $July,
            'August' => $August,
            'September' => $September,
            'October' => $October,
            'November' => $November,
            'December' => $December, 
        ];

        $ViewData = [...$Config, ...$ViewData];  
   
            
        if (isset($_GET['GenerateChartForCurrentVendor'])) {
            
            $CurrentVendorNo = $_GET['GenerateChartForCurrentVendor'];
            $CurrentVendorName = FuelTestRecord::select('VendorName')
                                                ->where('VendorNo', $CurrentVendorNo)
                                                ->orderBy('SampleNo', 'DESC')
                                                ->first();
             
            if($CurrentVendorName == null) { 
                $CurrentVendorName = '<big style="color: red; font-family: arial;">This Vendor has NO RECORDS yet !</big>';  

                return view('FuelTestStats', $ViewData)->with('Visibility', 'hide')
                                                        ->with('CurrentVendorNo', $CurrentVendorNo)   
                                                        ->with('CurrentVendorName', $CurrentVendorName)   
                                                        ->with('FirstSupplyDate', '')   
                                                        ->with('RecentSupplyDate', '')    
                                                        ->with('PercentageOfFailedRecords', 0)
                                                        ->with('PercentageOfPassedRecords', 0)
                                                        ->with('PercentageOfWavedRecords', 0)
                                                        ->with('PercentageOfDiffRecords', 0)
                                                        ->with('PercentageOfNumberOfRecordsLastMonth', 0)
                                                        ->with('PercentageOfAllRecordsThisMonth', 0)
                                                        ->with('PercentageOfAllRecordsInJanuary', 0)
                                                        ->with('PercentageOfAllRecordsInFebruary', 0)
                                                        ->with('PercentageOfAllRecordsInMarch', 0)
                                                        ->with('PercentageOfAllRecordsInApril', 0)
                                                        ->with('PercentageOfAllRecordsInMay', 0)
                                                        ->with('PercentageOfAllRecordsInJune', 0)
                                                        ->with('PercentageOfAllRecordsInJuly', 0)
                                                        ->with('PercentageOfAllRecordsInAugust', 0)
                                                        ->with('PercentageOfAllRecordsInSeptember', 0)
                                                        ->with('PercentageOfAllRecordsInOctober', 0)
                                                        ->with('PercentageOfAllRecordsInNovember', 0)
                                                        ->with('PercentageOfAllRecordsInDecember', 0)
                                                        ->with('PercentageOfNumberOfRecordsLastSevenDays', 0)
                                                        ->with('PercentageOfAllRecordsToday', 0)
                                                        ->with('PercentageOfAllRecordsYesterday', 0)
                                                        ->with('PercentageOfAllRecordsTwoDaysAgo', 0)
                                                        ->with('PercentageOfAllRecordsThreeDaysAgo', 0)
                                                        ->with('PercentageOfAllRecordsFourDaysAgo', 0)
                                                        ->with('PercentageOfAllRecordsFiveDaysAgo', 0)
                                                        ->with('PercentageOfAllRecordsSixDaysAgo', 0)
                                                        ->with('PercentageOfAllRecordsSevenDaysAgo', 0)  
                                                        ->with('PercentageOfDiffRecords', 0)   
                                                        ->with('number_of_passed_records', 0)   
                                                        ->with('number_of_diff_records', 0)
                                                        ->with('number_of_failed_records', 0)
                                                        ->with('number_of_waved_records', 0)
                                                        ->with('number_of_all_records_last_month', 0)
                                                        ->with('number_of_all_records_this_month', 0)
                                                        ->with('number_of_all_records_last_seven_days', 0)
                                                        ->with('number_of_yesterday_records', 0)
                                                        ->with('number_of_todays_records', 0)
                                                        ->with('number_of_two_days_ago_records', 0)
                                                        ->with('number_of_three_days_ago_records', 0)
                                                        ->with('number_of_four_days_ago_records', 0)
                                                        ->with('number_of_five_days_ago_records', 0)
                                                        ->with('number_of_six_days_ago_records', 0)
                                                        ->with('number_of_all_records', 0)
                                                        ->with('number_of_previous_records', 0)
                                                        ->with('January', 0)
                                                        ->with('February', 0)
                                                        ->with('March', 0)
                                                        ->with('April', 0)
                                                        ->with('May', 0)
                                                        ->with('June', 0)
                                                        ->with('July', 0)
                                                        ->with('August', 0)
                                                        ->with('September', 0)
                                                        ->with('October', 0)
                                                        ->with('November', 0)
                                                        ->with('December', 0);
            } else {
                $CurrentVendorName = $CurrentVendorName->VendorName;  

                $number_of_all_records = FuelTestRecord::where('VendorNo', $CurrentVendorNo)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->count();
    
                $number_of_previous_records = FuelTestRecord::where('VendorNo', $CurrentVendorNo)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->count();
    
                $PassedRecords = FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();

                $number_of_passed_records = count($PassedRecords);     
    
                $DiffRecords = FuelTestRecord::where('VendorName', NULL)
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->get();
    
                $number_of_diff_records = count($DiffRecords);  
                
                $FailedRecords = FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();
    
                $number_of_failed_records = count($FailedRecords);  
    
                $WavedRecords = FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();
    
                $number_of_waved_records = count($WavedRecords);  
                
                $PercentageOfPassedRecords = $number_of_passed_records / $number_of_all_records * 100; 
                $PercentageOfFailedRecords = $number_of_failed_records / $number_of_all_records * 100;
                $PercentageOfWavedRecords = $number_of_waved_records / $number_of_all_records * 100;
                $PercentageOfDiffRecords = $number_of_diff_records / $number_of_all_records * 100;
     
     
                $FirstDayOfLastMonth = date("Y-0n-0j", strtotime("first day of previous month"));  
                $LastDayOfLastMonth = date("Y-0n-j", strtotime("last day of previous month"));
                   
                $AllRecordsLastMonthForCurrentVendor = FuelTestRecord::where('VendorNo', $CurrentVendorNo)
                                                                        ->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                        ->orderBy('SampleNo', 'DESC')
                                                                        ->get();
    
                $number_of_all_records_last_month = count($AllRecordsLastMonthForCurrentVendor);
    
                $FirstDayOfThisMonth = date('Y-m-01'); 
                $TodaysDate = date('Y-m-d'); 
                
                $AllRecordsThisMonthForCurrentVendor = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])                                                                    
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                        ->get();
     
                $number_of_all_records_this_month = count($AllRecordsThisMonthForCurrentVendor);
     
                $LastSevenDays = date('Y-m-d', strtotime( '-7 day' )); 
                 
                $AllRecordsLastSevenDaysForCurrentVendor = FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])                                                                        
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                            ->get();
                 
                $number_of_all_records_last_seven_days = count($AllRecordsLastSevenDaysForCurrentVendor);
    
                $RecordsOfYesterdayForCurrentVendor = date('Y-m-d',strtotime("-1 day")); 
                    
                $yesterday_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterdayForCurrentVendor)                                                    
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                        ->get();
                        
                $number_of_yesterday_records = count($yesterday_records);
    
                $RecordsOfToday = date('Y-m-d'); 
                    
                $RecordsOfTodayForCurrentVendor = FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->get();
                 
                $number_of_todays_records = count($RecordsOfTodayForCurrentVendor); 
            
                $RecordsOfTwoDaysAgo = date('Y-m-d', strtotime("-2 day"));   
                $number_of_two_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfTwoDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                      
                $RecordsOfThreeDaysAgo = date('Y-m-d', strtotime("-3 day"));   
                $number_of_three_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfThreeDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                      
                $RecordsOfFourDaysAgo = date('Y-m-d', strtotime("-4 day"));   
                $number_of_four_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfFourDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                      
                $RecordsOfFiveDaysAgo = date('Y-m-d', strtotime("-5 day"));   
                $number_of_five_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfFiveDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                      
                $RecordsOfSixDaysAgo = date('Y-m-d', strtotime("-6 day"));   
                $number_of_six_days_ago_records = FuelTestRecord::where('SampleCollectionDate', $RecordsOfSixDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
    
                $Month1 = '01';                        
                $FirstDayOfJanuary = date('Y-' . $Month1 . '-01'); 
                $LastDayOfJanuary = date('Y-' . $Month1 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 1, 2022));                        
                $January = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJanuary, $LastDayOfJanuary])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month2 = '02';                        
                $FirstDayOfFebruary = date('Y-' . $Month2 . '-01'); 
                $LastDayOfFebruary = date('Y-' . $Month2 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 2, 2022));                        
                $February = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfFebruary, $LastDayOfFebruary])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month3 = '03';                        
                $FirstDayOfMarch = date('Y-' . $Month3 . '-01'); 
                $LastDayOfMarch = date('Y-' . $Month3 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 3, 2022));                        
                $March = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfMarch, $LastDayOfMarch])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month4 = '04';                        
                $FirstDayOfApril = date('Y-' . $Month4 . '-01'); 
                $LastDayOfApril = date('Y-' . $Month4 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 4, 2022));                        
                $April = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfApril, $LastDayOfApril])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month5 = '05';                        
                $FirstDayOfMay = date('Y-' . $Month5 . '-01'); 
                $LastDayOfMay = date('Y-' . $Month5 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 5, 2022));                        
                $May = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfMay, $LastDayOfMay])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month6 = '06';                        
                $FirstDayOfJune = date('Y-' . $Month6 . '-01'); 
                $LastDayOfJune = date('Y-' . $Month6 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 6, 2022));                        
                $June = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJune, $LastDayOfJune])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                
                $Month7 = '07';                        
                $FirstDayOfJuly = date('Y-' . $Month7 . '-01'); 
                $LastDayOfJuly = date('Y-' . $Month7 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 7, 2022));                        
                $July = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfJuly, $LastDayOfJuly])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
            
                $Month8 = '08';                        
                $FirstDayOfAugust = date('Y-' . $Month8 . '-01'); 
                $LastDayOfAugust = date('Y-' . $Month8 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 8, 2022));                        
                $August = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfAugust, $LastDayOfAugust])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
            
            
                $Month9 = '09';                        
                $FirstDayOfSeptember = date('Y-' . $Month9 . '-01'); 
                $LastDayOfSeptember = date('Y-' . $Month9 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 9, 2022));                        
                $September = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfSeptember, $LastDayOfSeptember])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
            
            
                $Month10 = '10';                        
                $FirstDayOfOctober = date('Y-' . $Month10 . '-01'); 
                $LastDayOfOctober = date('Y-' . $Month10 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 10, 2022));                        
                $October = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfOctober, $LastDayOfOctober])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
            
            
                $Month11 = '11';                        
                $FirstDayOfNovember = date('Y-' . $Month11 . '-01'); 
                $LastDayOfNovember = date('Y-' . $Month11 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 11, 2022));                        
                $November = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfNovember, $LastDayOfNovember])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
            
            
                $Month12 = '12';                        
                $FirstDayOfDecember = date('Y-' . $Month12 . '-01'); 
                $LastDayOfDecember = date('Y-' . $Month12 . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, 12, 2022));                        
                $December = FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfDecember, $LastDayOfDecember])                                                                
                                            ->where('VendorNo', $CurrentVendorNo)
                                            ->count();                        
                                                 
                $FirstSupplyDate = FuelTestRecord::select('SampleCollectionDate')                                                                
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->first();         
                                                 
                $RecentSupplyDate = FuelTestRecord::select('SampleCollectionDate')                                                                
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->first();         
    
                $FirstSupplyDate = $FirstSupplyDate->SampleCollectionDate;
                $RecentSupplyDate = $RecentSupplyDate->SampleCollectionDate;
     
                $PercentageOfNumberOfRecordsLastMonth = $number_of_all_records_last_month / $number_of_all_records * 100; 
                $PercentageOfAllRecordsThisMonth = $number_of_all_records_this_month / $number_of_all_records * 100;
                $PercentageOfNumberOfRecordsLastSevenDays = $number_of_all_records_last_seven_days / $number_of_all_records * 100;
                
                $PercentageOfAllRecordsInJanuary = $January / $number_of_all_records * 100;     
                $PercentageOfAllRecordsInFebruary = $February / $number_of_all_records * 100; 
                $PercentageOfAllRecordsInMarch = $March / $number_of_all_records * 100;
                $PercentageOfAllRecordsInApril = $April / $number_of_all_records * 100;
                $PercentageOfAllRecordsInMay = $May / $number_of_all_records * 100;
                $PercentageOfAllRecordsInJune = $June / $number_of_all_records * 100;     
                $PercentageOfAllRecordsInJuly = $July / $number_of_all_records * 100; 
                $PercentageOfAllRecordsInAugust = $August / $number_of_all_records * 100;
                $PercentageOfAllRecordsInSeptember = $September / $number_of_all_records * 100;
                $PercentageOfAllRecordsInOctober = $October / $number_of_all_records * 100;
                $PercentageOfAllRecordsInNovember = $November / $number_of_all_records * 100;
                $PercentageOfAllRecordsInDecember = $December / $number_of_all_records * 100;

                $PercentageOfAllRecordsToday = $number_of_todays_records / $number_of_all_records * 100; 
                $PercentageOfAllRecordsYesterday = $number_of_yesterday_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsSevenDaysAgo = $number_of_all_records_last_seven_days / $number_of_all_records * 100;

                return view('FuelTestStats', $ViewData)->with('Visibility', 'hide')
                                                        ->with('CurrentVendorNo', $CurrentVendorNo)   
                                                        ->with('CurrentVendorName', $CurrentVendorName)   
                                                        ->with('FirstSupplyDate', $FirstSupplyDate)   
                                                        ->with('RecentSupplyDate', $RecentSupplyDate)   
                                                        ->with('PercentageOfAllRecordsInJanuary', $PercentageOfAllRecordsInJanuary)   
                                                        ->with('PercentageOfAllRecordsInFebruary', $PercentageOfAllRecordsInFebruary)   
                                                        ->with('PercentageOfAllRecordsInMarch', $PercentageOfAllRecordsInMarch)   
                                                        ->with('PercentageOfAllRecordsInApril', $PercentageOfAllRecordsInApril)   
                                                        ->with('PercentageOfAllRecordsInMay', $PercentageOfAllRecordsInMay)   
                                                        ->with('PercentageOfAllRecordsInJune', $PercentageOfAllRecordsInJune)   
                                                        ->with('PercentageOfAllRecordsInJuly', $PercentageOfAllRecordsInJuly)   
                                                        ->with('PercentageOfAllRecordsInAugust', $PercentageOfAllRecordsInAugust)   
                                                        ->with('PercentageOfAllRecordsInSeptember', $PercentageOfAllRecordsInSeptember)   
                                                        ->with('PercentageOfAllRecordsInOctober', $PercentageOfAllRecordsInOctober)   
                                                        ->with('PercentageOfAllRecordsInNovember', $PercentageOfAllRecordsInNovember)   
                                                        ->with('PercentageOfAllRecordsInDecember', $PercentageOfAllRecordsInDecember)   
                                                        ->with('PercentageOfAllRecordsThisMonth', $PercentageOfAllRecordsThisMonth)   
                                                        ->with('PercentageOfNumberOfRecordsLastSevenDays', $PercentageOfNumberOfRecordsLastSevenDays)   
                                                        ->with('PercentageOfNumberOfRecordsLastMonth', $PercentageOfNumberOfRecordsLastMonth)   
                                                        ->with('PercentageOfAllRecordsToday', $PercentageOfAllRecordsToday)   
                                                        ->with('PercentageOfAllRecordsYesterday', $PercentageOfAllRecordsYesterday)   
                                                        ->with('PercentageOfAllRecordsTwoDaysAgo', $PercentageOfAllRecordsTwoDaysAgo)   
                                                        ->with('PercentageOfAllRecordsThreeDaysAgo', $PercentageOfAllRecordsThreeDaysAgo)   
                                                        ->with('PercentageOfAllRecordsFourDaysAgo', $PercentageOfAllRecordsFourDaysAgo)   
                                                        ->with('PercentageOfAllRecordsFiveDaysAgo', $PercentageOfAllRecordsFiveDaysAgo)   
                                                        ->with('PercentageOfAllRecordsSixDaysAgo', $PercentageOfAllRecordsSixDaysAgo)   
                                                        ->with('PercentageOfAllRecordsSevenDaysAgo', $PercentageOfAllRecordsSevenDaysAgo)   
                                                        ->with('PercentageOfPassedRecords', $PercentageOfPassedRecords)   
                                                        ->with('PercentageOfWavedRecords', $PercentageOfWavedRecords)   
                                                        ->with('PercentageOfFailedRecords', $PercentageOfFailedRecords)   
                                                        ->with('PercentageOfDiffRecords', $PercentageOfDiffRecords)   
                                                        ->with('number_of_passed_records', $number_of_passed_records)   
                                                        ->with('number_of_diff_records', $number_of_diff_records)
                                                        ->with('number_of_failed_records', $number_of_failed_records)
                                                        ->with('number_of_waved_records', $number_of_waved_records)
                                                        ->with('number_of_all_records_last_month', $number_of_all_records_last_month)
                                                        ->with('number_of_all_records_this_month', $number_of_all_records_this_month)
                                                        ->with('number_of_all_records_last_seven_days', $number_of_all_records_last_seven_days)
                                                        ->with('number_of_yesterday_records', $number_of_yesterday_records)
                                                        ->with('number_of_todays_records', $number_of_todays_records)
                                                        ->with('number_of_two_days_ago_records', $number_of_two_days_ago_records)
                                                        ->with('number_of_three_days_ago_records', $number_of_three_days_ago_records)
                                                        ->with('number_of_four_days_ago_records', $number_of_four_days_ago_records)
                                                        ->with('number_of_five_days_ago_records', $number_of_five_days_ago_records)
                                                        ->with('number_of_six_days_ago_records', $number_of_six_days_ago_records)
                                                        ->with('number_of_all_records', $number_of_all_records)
                                                        ->with('number_of_previous_records', $number_of_previous_records)
                                                        ->with('January', $January)
                                                        ->with('February', $February)
                                                        ->with('March', $March)
                                                        ->with('April', $April)
                                                        ->with('May', $May)
                                                        ->with('June', $June)
                                                        ->with('July', $July)
                                                        ->with('August', $August)
                                                        ->with('September', $September)
                                                        ->with('October', $October)
                                                        ->with('November', $November)
                                                        ->with('December', $December);    
            }

        }

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
