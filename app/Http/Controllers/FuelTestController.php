<?php
namespace App\Http\Controllers;
 

use Illuminate\Http\Request; 
use App\Models\FuelTestRecord;
use App\Models\Vendor;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\FuelTestsExport;
use Maatwebsite\Excel\Facades\Excel; 

class FuelTestController extends Controller
{
    
    public function export() 
    {
        return Excel::download(new FuelTestsExport, 'fueltest.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $title = 'Depasamarine';
        $id = Session::get('id'); 
        $name = Session::get('name');
        $email = Session::get('email');
        $header_info = "ID : [" . $id . "] Email : " . $email;
        $sample_no = date('Ymd') . $id . 0;

        $fuel_test_users = DB::table('fuel_test_users')->get();
 
        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->get(); 
        $number_of_previous_records = count($previous_records);
 
        $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get(); 
        $number_of_all_records = count($all_records);

        $vendors = Vendor::all();
        $number_of_vendors = count($vendors);

        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } else {
            return view('fuel_test', [
                'number_of_previous_records' => $number_of_previous_records,
                'number_of_all_records' => $number_of_all_records,
                'fuel_test_users' => $fuel_test_users,
                'number_of_vendors' => $number_of_vendors,
                'vendors' => $vendors,
                'id' => $id,
                'title' => $title,
                'name' => $name,
                'header_info' => $header_info,
                'email' => $email,
                'sample_no' => $sample_no,
            ]);
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
        
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        }

        $id = Session::get('id');
        $title = 'Record Created';
        $name = Session::get('name');
        $email = Session::get('email');
        $header_info = 'Manage all your Records effectively. Log In';
        $sample_no; 

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
        
        if(empty($SampleCollectionDate)) {
            return redirect('FuelTest');
        } elseif(empty($TruckPlateNo)) { 
            return redirect('FuelTest');
        } elseif(empty($TankNo)) { 
            return redirect('FuelTest');
        } elseif(empty($AppearanceResult)) { 
            return redirect('FuelTest');
        } elseif(empty($Color)) { 
            return redirect('FuelTest');
        } elseif(empty($Density)) { 
            return redirect('FuelTest');
        } elseif(empty($FlashPoint)) { 
            return redirect('FuelTest');
        } elseif(empty($Temp)) { 
            return redirect('FuelTest');
        } elseif(empty($WaterSediment)) { 
            return redirect('FuelTest');
        } elseif(empty($Cleanliness)) { 
            return redirect('FuelTest');
        } elseif(empty($DateOfTest)) { 
            return redirect('FuelTest');
        } elseif(empty($MadeBy)) { 
            return redirect('FuelTest');
        } elseif(empty($DeliveredTo)) { 
            return redirect('FuelTest');
        } elseif(empty($Remarks)) { 
            return redirect('FuelTest');
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
                    ]);
        
                $create_record->save();
                
            if(Session::has('email')) {
                $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get(); 
                $number_of_all_records = count($all_records);
                        
                $vendors = Vendor::all();
                $number_of_vendors = count($vendors);

                $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
                $number_of_previous_records = count($previous_records);
                
                return view("record_success", [
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
                    'number_of_all_records' => $number_of_all_records,
                    'number_of_previous_records' => $number_of_previous_records,
                    'number_of_vendors' => $number_of_vendors,
                    'vendors' => $vendors,
                    'id' => $id,
                    'title' => $title,
                    'name' => $name,
                    'header_info' => $header_info,
                    'email' => $email, 
                ]);

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

            $id = Session::get('id');
            $name = Session::get('name');
            $email = Session::get('email');
            $title = 'All Records';
            $header_info = 'Manage all your Records effectively. Log In';
             
            // $all_records = FuelTestRecord::paginate(3);
            $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get(); 
            $number_of_all_records = count($all_records);
                                     
            $vendors = Vendor::all();
            $number_of_vendors = count($vendors);
            
            $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
            $number_of_previous_records = count($previous_records);

            $FilterSampleNo = FuelTestRecord::distinct()->get(['SampleNo']);
            $FilterSampleCollectionDate = FuelTestRecord::distinct()->get(['SampleCollectionDate']);
            $FilterTruckPlateNo = FuelTestRecord::distinct()->get(['TruckPlateNo']);
            $FilterTankNo = FuelTestRecord::distinct()->get(['TankNo']);
            $FilterAppearanceResult = FuelTestRecord::distinct()->get(['AppearanceResult']);
            $FilterColor = FuelTestRecord::distinct()->get(['Color']);
            $FilterDensity = FuelTestRecord::distinct()->get(['Density']);
            $FilterFlashPoint = FuelTestRecord::distinct()->get(['FlashPoint']);
            $FilterTemp = FuelTestRecord::distinct()->get(['Temp']);
            $FilterWaterSediment = FuelTestRecord::distinct()->get(['WaterSediment']);
            $FilterCleanliness = FuelTestRecord::distinct()->get(['Cleanliness']);
            $FilterDateOfTest = FuelTestRecord::distinct()->get(['DateOfTest']);
            $FilterMadeBy = FuelTestRecord::distinct()->get(['MadeBy']);
            $FilterDeliveredTo = FuelTestRecord::distinct()->get(['DeliveredTo']);
            $FilterRemarks = FuelTestRecord::distinct()->get(['Remarks']); 

            if (isset($_GET['SortBySampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('SampleNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 

                foreach ($FilteredRecords as $SampleNo) {
                    $all_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->orderBy('SampleNo', 'DESC')->get();  
                }

                if (isset($_GET['SortBySampleNo'])) {
                    echo 'sfsf';
                    // $all_records = FuelTestRecord::orderBy('SampleNo', $SortOrder)->get(); 
                }
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('SampleCollectionDate', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $all_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->orderBy('SampleCollectionDate', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('TruckPlateNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $all_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->orderBy('TruckPlateNo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('TankNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $all_records = FuelTestRecord::whereIn('TankNo', $TankNo)->orderBy('TankNo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('AppearanceResult', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $all_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->orderBy('AppearanceResult', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('Color', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $all_records = FuelTestRecord::whereIn('Color', $Color)->orderBy('Color', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('Density', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $all_records = FuelTestRecord::whereIn('Density', $Density)->orderBy('Density', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('FlashPoint', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $all_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->orderBy('FlashPoint', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('Temp', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $all_records = FuelTestRecord::whereIn('Temp', $Temp)->orderBy('Temp', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('WaterSediment', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $all_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->orderBy('WaterSediment', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('Cleanliness', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $all_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->orderBy('Cleanliness', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('DateOfTest', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $all_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->orderBy('DateOfTest', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('MadeBy', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $all_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->orderBy('MadeBy', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('DeliveredTo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $all_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->orderBy('DeliveredTo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $all_records = FuelTestRecord::orderBy('Remarks', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $all_records = FuelTestRecord::whereIn('Remarks', $Remarks)->orderBy('Remarks', 'DESC')->get();  
                }
            }

            return view("all_records", [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'title' => $title,
                'header_info' => $header_info,
                'all_records' => $all_records,
                'number_of_all_records' => $number_of_all_records,
                'number_of_previous_records' => $number_of_previous_records,
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
                'number_of_vendors' => $number_of_vendors,
                'vendors' => $vendors,
            ]);

        } else { 
            return redirect('/');        
        }
    }

    public function show_previous_records(Request $request)
    {  
        if(Session::has('email')) {

            $id = Session::get('id');
            $name = Session::get('name');
            $email = Session::get('email');
            $title = 'Previous Records';
            $header_info = 'Manage all your Records effectively. Log In';
             
            $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
            $number_of_previous_records = count($previous_records);
            Session::put('number_of_previous_records',  $number_of_previous_records);
             
            $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get(); 
            $number_of_all_records = count($all_records);
                        
            $vendors = Vendor::all();
            $number_of_vendors = count($vendors);
            
            $FilterSampleNo = FuelTestRecord::distinct()->get(['SampleNo']);
            $FilterSampleCollectionDate = FuelTestRecord::distinct()->get(['SampleCollectionDate']);
            $FilterTruckPlateNo = FuelTestRecord::distinct()->get(['TruckPlateNo']);
            $FilterTankNo = FuelTestRecord::distinct()->get(['TankNo']);
            $FilterAppearanceResult = FuelTestRecord::distinct()->get(['AppearanceResult']);
            $FilterColor = FuelTestRecord::distinct()->get(['Color']);
            $FilterDensity = FuelTestRecord::distinct()->get(['Density']);
            $FilterFlashPoint = FuelTestRecord::distinct()->get(['FlashPoint']);
            $FilterTemp = FuelTestRecord::distinct()->get(['Temp']);
            $FilterWaterSediment = FuelTestRecord::distinct()->get(['WaterSediment']);
            $FilterCleanliness = FuelTestRecord::distinct()->get(['Cleanliness']);
            $FilterDateOfTest = FuelTestRecord::distinct()->get(['DateOfTest']);
            $FilterMadeBy = FuelTestRecord::distinct()->get(['MadeBy']);
            $FilterDeliveredTo = FuelTestRecord::distinct()->get(['DeliveredTo']);
            $FilterRemarks = FuelTestRecord::distinct()->get(['Remarks']); 

            if (isset($_GET['SortBySampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('SampleNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleNo'])) {
                $FilteredRecords[] = $request->CheckSampleNo; 
 
                foreach ($FilteredRecords as $SampleNo) {
                    $previous_records = FuelTestRecord::whereIn('SampleNo', $SampleNo)->where('uid', $id)->orderBy('SampleNo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortBySampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 
 
                foreach ($FilteredRecords as $SampleCollectionDate) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('SampleCollectionDate', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterSampleCollectionDate'])) {
                $FilteredRecords[] = $request->CheckSampleCollectionDate; 

                foreach ($FilteredRecords as $SampleCollectionDate) {
                    $previous_records = FuelTestRecord::whereIn('SampleCollectionDate', $SampleCollectionDate)->where('uid', $id)->orderBy('SampleCollectionDate', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 
 
                foreach ($FilteredRecords as $TruckPlateNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('TruckPlateNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTruckPlateNo'])) {
                $FilteredRecords[] = $request->CheckTruckPlateNo; 

                foreach ($FilteredRecords as $TruckPlateNo) {
                    $previous_records = FuelTestRecord::whereIn('TruckPlateNo', $TruckPlateNo)->where('uid', $id)->orderBy('TruckPlateNo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 
 
                foreach ($FilteredRecords as $TankNo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('TankNo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTankNo'])) {
                $FilteredRecords[] = $request->CheckTankNo; 

                foreach ($FilteredRecords as $TankNo) {
                    $previous_records = FuelTestRecord::whereIn('TankNo', $TankNo)->where('uid', $id)->orderBy('TankNo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 
 
                foreach ($FilteredRecords as $AppearanceResult) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('AppearanceResult', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterAppearanceResult'])) {
                $FilteredRecords[] = $request->CheckAppearanceResult; 

                foreach ($FilteredRecords as $AppearanceResult) {
                    $previous_records = FuelTestRecord::whereIn('AppearanceResult', $AppearanceResult)->where('uid', $id)->orderBy('AppearanceResult', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByColor'])) {
                $FilteredRecords[] = $request->CheckColor; 
 
                foreach ($FilteredRecords as $Color) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('Color', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterColor'])) {
                $FilteredRecords[] = $request->CheckColor; 

                foreach ($FilteredRecords as $Color) {
                    $previous_records = FuelTestRecord::whereIn('Color', $Color)->where('uid', $id)->orderBy('Color', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 
 
                foreach ($FilteredRecords as $Density) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('Density', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDensity'])) {
                $FilteredRecords[] = $request->CheckDensity; 

                foreach ($FilteredRecords as $Density) {
                    $previous_records = FuelTestRecord::whereIn('Density', $Density)->where('uid', $id)->orderBy('Density', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 
 
                foreach ($FilteredRecords as $FlashPoint) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('FlashPoint', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterFlashPoint'])) {
                $FilteredRecords[] = $request->CheckFlashPoint; 

                foreach ($FilteredRecords as $FlashPoint) {
                    $previous_records = FuelTestRecord::whereIn('FlashPoint', $FlashPoint)->where('uid', $id)->orderBy('FlashPoint', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 
 
                foreach ($FilteredRecords as $Temp) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('Temp', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterTemp'])) {
                $FilteredRecords[] = $request->CheckTemp; 

                foreach ($FilteredRecords as $Temp) {
                    $previous_records = FuelTestRecord::whereIn('Temp', $Temp)->where('uid', $id)->orderBy('Temp', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 
 
                foreach ($FilteredRecords as $WaterSediment) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('WaterSediment', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterWaterSediment'])) {
                $FilteredRecords[] = $request->CheckWaterSediment; 

                foreach ($FilteredRecords as $WaterSediment) {
                    $previous_records = FuelTestRecord::whereIn('WaterSediment', $WaterSediment)->where('uid', $id)->orderBy('WaterSediment', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 
 
                foreach ($FilteredRecords as $Cleanliness) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('Cleanliness', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterCleanliness'])) {
                $FilteredRecords[] = $request->CheckCleanliness; 

                foreach ($FilteredRecords as $Cleanliness) {
                    $previous_records = FuelTestRecord::whereIn('Cleanliness', $Cleanliness)->where('uid', $id)->orderBy('Cleanliness', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 
 
                foreach ($FilteredRecords as $DateOfTest) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('DateOfTest', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDateOfTest'])) {
                $FilteredRecords[] = $request->CheckDateOfTest; 

                foreach ($FilteredRecords as $DateOfTest) {
                    $previous_records = FuelTestRecord::whereIn('DateOfTest', $DateOfTest)->where('uid', $id)->orderBy('DateOfTest', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 
 
                foreach ($FilteredRecords as $MadeBy) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('MadeBy', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterMadeBy'])) {
                $FilteredRecords[] = $request->CheckMadeBy; 

                foreach ($FilteredRecords as $MadeBy) {
                    $previous_records = FuelTestRecord::whereIn('MadeBy', $MadeBy)->where('uid', $id)->orderBy('MadeBy', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 
 
                foreach ($FilteredRecords as $DeliveredTo) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('DeliveredTo', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterDeliveredTo'])) {
                $FilteredRecords[] = $request->CheckDeliveredTo; 

                foreach ($FilteredRecords as $DeliveredTo) {
                    $previous_records = FuelTestRecord::whereIn('DeliveredTo', $DeliveredTo)->where('uid', $id)->orderBy('DeliveredTo', 'DESC')->get();  
                }
            }

            if (isset($_GET['SortByRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 
 
                foreach ($FilteredRecords as $Remarks) {
                    Session::get('SortOrder',  'ASC'); 

                    $SortOrder = Session::get('SortOrder');
                    $previous_records = FuelTestRecord::orderBy('Remarks', $SortOrder)->get(); 

                    $SortOrder = $SortOrder == 'DESC' ? 'ASC': 'DESC';
                    Session::put('SortOrder', $SortOrder); 
                }
            }

            if(isset($_GET['FilterRemarks'])) {
                $FilteredRecords[] = $request->CheckRemarks; 

                foreach ($FilteredRecords as $Remarks) {
                    $previous_records = FuelTestRecord::whereIn('Remarks', $Remarks)->where('uid', $id)->orderBy('Remarks', 'DESC')->get();  
                }
            }

            return view("previous_records", [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'title' => $title,
                'header_info' => $header_info,
                'previous_records' => $previous_records,
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
                'number_of_previous_records' => $number_of_previous_records,
                'number_of_all_records' => $number_of_all_records,
                'number_of_vendors' => $number_of_vendors,
                'vendors' => $vendors,
            ]);
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
        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } 
        
        $id = Session::get('id');
        $title = 'Edit Record';
        $name = Session::get('name');
        $email = Session::get('email');
        $header_info = 'Manage all your Records effectively. Log In';
        
        $sample_no;

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
        
        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
        $number_of_previous_records = count($previous_records); 
         
        $all_records = FuelTestRecord::orderBy('SampleNo', 'DESC')->get();
        // $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
        $number_of_all_records = count($all_records);
                        
        $vendors = Vendor::all();
        $number_of_vendors = count($vendors);
        
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
            'Remarks' => $Remarks
         ]);

        return view("edit", [
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
            'number_of_previous_records' => $number_of_previous_records,
            'number_of_all_records' => $number_of_all_records,
            'number_of_vendors' => $number_of_vendors,
            'id' => $id,
            'title' => $title,
            'name' => $name,
            'header_info' => $header_info,
            'email' => $email,
        ]);
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
            'Remarks' => $Remarks
         ]);

         return redirect('FuelTest');
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
