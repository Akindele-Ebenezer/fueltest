<?php
namespace App\Http\Controllers;
 

use Illuminate\Http\Request;
use App\Models\FuelTest;
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
        $fuel_test_users = DB::table('fuel_test_users')->get();
 
        $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->get(); 
        $number_of_previous_records = count($previous_records);
 
        $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
        $number_of_all_records = count($all_records);

        if(!(Session::has('email'))) {
            Session::forget('email');
            Session::flush();
            return redirect('/');        
        } else {
            return view('fuel_test', [
                'number_of_previous_records' => $number_of_previous_records,
                'number_of_all_records' => $number_of_all_records,
                'fuel_test_users' => $fuel_test_users
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
            return redirect('fuel_test');
        } elseif(empty($TruckPlateNo)) { 
            return redirect('fuel_test');
        } elseif(empty($TankNo)) { 
            return redirect('fuel_test');
        } elseif(empty($AppearanceResult)) { 
            return redirect('fuel_test');
        } elseif(empty($Color)) { 
            return redirect('fuel_test');
        } elseif(empty($Density)) { 
            return redirect('fuel_test');
        } elseif(empty($FlashPoint)) { 
            return redirect('fuel_test');
        } elseif(empty($Temp)) { 
            return redirect('fuel_test');
        } elseif(empty($WaterSediment)) { 
            return redirect('fuel_test');
        } elseif(empty($Cleanliness)) { 
            return redirect('fuel_test');
        } elseif(empty($DateOfTest)) { 
            return redirect('fuel_test');
        } elseif(empty($MadeBy)) { 
            return redirect('fuel_test');
        } elseif(empty($DeliveredTo)) { 
            return redirect('fuel_test');
        } elseif(empty($Remarks)) { 
            return redirect('fuel_test');
        } else { 
                // $create_record = new FuelTest([
                //         'SampleNo' => $request->SampleNo,
                //         'SampleCollectionDate' => $SampleCollectionDate,
                //         'TruckPlateNo' => $TruckPlateNo,
                //         'TankNo' => $TankNo,
                //         'AppearanceResult' => $AppearanceResult,
                //         'Color' => $Color,
                //         'Density' => $Density,
                //         'FlashPoint' => $FlashPoint,
                //         'Temp' => $Temp,
                //         'WaterSediment' => $WaterSediment,
                //         'Cleanliness' => $Cleanliness,
                //         'DateOfTest' => $DateOfTest,
                //         'uid' => $uid,
                //         'MadeBy' => $MadeBy,
                //         'DeliveredTo' => $DeliveredTo,
                //         'Remarks' => $Remarks
                //     ]);
        
                // $create_record->save();

                $create_record = DB::table('fuel_test_records')->insert([
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
                
            if(Session::has('email')) {
                $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
                $number_of_all_records = count($all_records);
                 
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
    public function show_all_records()
    { 
        if(Session::has('email')) {
            // $all_records = FuelTest::paginate(3);
            $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
            $number_of_all_records = count($all_records);
             
            $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
            $number_of_previous_records = count($previous_records);

            return view("all_records", [
                'all_records' => $all_records,
                'number_of_all_records' => $number_of_all_records,
                'number_of_previous_records' => $number_of_previous_records,
            ]);

        } else { 
            return redirect('/');        
        }
    }

    public function show_previous_records()
    {
        if(Session::has('email')) {

            $previous_records = DB::table('fuel_test_records')->where('uid', Session::get('id'))->orderBy('SampleNo', 'desc')->get(); 
            $number_of_previous_records = count($previous_records);
            Session::put('number_of_previous_records',  $number_of_previous_records);
             
            $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
            $number_of_all_records = count($all_records);

            return view("previous_records", [
                'previous_records' => $previous_records,
                'number_of_previous_records' => $number_of_previous_records,
                'number_of_all_records' => $number_of_all_records,
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
         
        $all_records = DB::table('fuel_test_records')->orderBy('SampleNo', 'desc')->get();
        $number_of_all_records = count($all_records);

        // $edit = FuelTest::where('SampleNo', $SampleNo)->update([
        //     'SampleNo' => $request->SampleNo,
        //     'SampleCollectionDate' => $SampleCollectionDate,
        //     'TruckPlateNo' => $TruckPlateNo,
        //     'TankNo' => $TankNo,
        //     'AppearanceResult' => $AppearanceResult,
        //     'Color' => $Color,
        //     'Density' => $Density,
        //     'FlashPoint' => $FlashPoint,
        //     'Temp' => $Temp,
        //     'WaterSediment' => $WaterSediment,
        //     'Cleanliness' => $Cleanliness,
        //     'DateOfTest' => $DateOfTest,
        //     'uid' => $uid,
        //     'MadeBy' => $MadeBy,
        //     'DeliveredTo' => $DeliveredTo,
        //     'Remarks' => $Remarks
        //  ]);

         $edit = DB::table('fuel_test_records')
         ->where('SampleNo', $SampleNo)
         ->update([
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
        echo $SampleNo;
        $save_changes = FuelTest::where('SampleNo', $SampleNo)->update([
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

         return redirect('fuel_test');
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
