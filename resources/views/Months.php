<?php

    $MonthNames = [
        '',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    $TotalNumberOfRecordsForEachMonth           = [0]; 
    $TotalNumberOfRecordsForEachMonth_          = [0]; 
    $PercentageOfAllRecordsForEachMonth         = [0];  
    $AbsolutePercentageOfAllRecordsForEachMonth = [0]; 
    $TotalNumberOfApprovedRecordsForEachMonth   = [0]; 
    $TotalNumberOfWaivedRecordsForEachMonth     = [0]; 
    $TotalNumberOfRejectedRecordsForEachMonth   = [0]; 
    $TotalNumberOfDiffRecordsForEachMonth   = [0]; 

    $AbsolutePercentageOfAllApprovedRecordsForEachMonth     = [0]; 
    $AbsolutePercentageOfAllWaivedRecordsForEachMonth       = [0]; 
    $AbsolutePercentageOfAllRejectedRecordsForEachMonth     = [0];
    $AbsolutePercentageOfAllDiffRecordsForEachMonth     = [0];
    
    for ($i = 1; $i < count($MonthNames); $i++) {
        
        if ($i < 10) { 
            $MonthNumber = 0 . $i; 
        } else {
            $MonthNumber = $i;             
        }
         
        $AbsoluteMonthNumber = $i;  
        $Year_ = date('Y');
        $Years = range(2000, strftime("%Y", time()));
         
        ${"FirstDayOf" . $MonthNames[$i]} = date('Y-' . $MonthNumber . '-01'); 
        ${"LastDayOf" . $MonthNames[$i]} = date('Y-' . $MonthNumber . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, $AbsoluteMonthNumber , date('Y')));
// ///////////////////////
           if(isset($_GET['GetYearlyReport'])) {
               $Year_ = $_GET['Year'];

               if($Year_ === 'Select Year') {
                    $Year_ = date('Y'); 
               }

                ${"FirstDayOf" . $MonthNames[$i]} = $Year_ . '-' . $MonthNumber . '-01'; 
                ${"LastDayOf" . $MonthNames[$i]} = $Year_ . '-' . $MonthNumber . cal_days_in_month(CAL_EASTER_DEFAULT, $AbsoluteMonthNumber , $Year_);
           }

           if(isset($_GET['ResetYearlyReport'])) {
                header('Location: /FuelTestStats');
           }
// ///////////////////////
           if (isset($_GET['GenerateChartForCurrentVendor'])) {
            
            $CurrentVendorNo = $_GET['GenerateChartForCurrentVendor'];
            $CurrentVendorName = App\Models\FuelTestRecord::select('VendorName')
                                                            ->where('VendorNo', $CurrentVendorNo) 
                                                            ->first();

            if($CurrentVendorName == null) {  

                $CurrentVendorName = '<big style="color: red; font-family: arial;">This Vendor has NO RECORDS yet !</big>';  
                $FirstSupplyDate = ''; 
                $RecentSupplyDate = '';

                $PercentageOfFailedRecords = $PercentageOfPassedRecords = $PercentageOfWavedRecords = $PercentageOfDiffRecords = $PercentageOfNumberOfRecordsLastMonth = $PercentageOfAllRecordsThisMonth = $PercentageOfFailedRecords = $PercentageOfPassedRecords = $PercentageOfWavedRecords = $PercentageOfDiffRecords = $PercentageOfNumberOfRecordsLastMonth = $PercentageOfAllRecordsThisMonth = $PercentageOfNumberOfRecordsLastSevenDays = $PercentageOfAllRecordsToday = $PercentageOfAllRecordsYesterday = $PercentageOfAllRecordsTwoDaysAgo = $PercentageOfAllRecordsThreeDaysAgo = $PercentageOfAllRecordsFourDaysAgo = $PercentageOfAllRecordsFiveDaysAgo = $PercentageOfAllRecordsSixDaysAgo = $PercentageOfAllRecordsSevenDaysAgo = $PercentageOfDiffRecords = $number_of_passed_records = $number_of_diff_records = $number_of_failed_records = $number_of_waved_records = $number_of_all_records_last_month = $number_of_all_records_this_month = $number_of_all_records_last_seven_days = $number_of_yesterday_records = $number_of_todays_records = $number_of_two_days_ago_records = $number_of_three_days_ago_records = $number_of_four_days_ago_records = $number_of_five_days_ago_records = $number_of_six_days_ago_records = $number_of_all_records = $number_of_previous_records = 0;
                
                for($i = 1; $i < count($MonthNames); $i++) {
                    $TotalNumberOfRecordsForEachMonth_[$i] = 0;
                    ${"PercentageOfAllRecordsIn" . $MonthNames[$i]} = 0;
                }


            } else {
                    
                $FirstSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                            ->where('VendorNo', $CurrentVendorNo)
                                                            ->first(); 

                $RecentSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                            ->where('VendorNo', $CurrentVendorNo)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->first();         

                $FirstSupplyDate = $FirstSupplyDate->SampleCollectionDate;
                $RecentSupplyDate = $RecentSupplyDate->SampleCollectionDate;

                $number_of_all_records = App\Models\FuelTestRecord::select('id')
                                                                    ->where('VendorNo', $CurrentVendorNo) 
                                                                    ->count();

                $NumberOfMonthlyRecords[$i] = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->where('VendorNo', $CurrentVendorNo) 
                                                                        ->count(); 

                array_push($TotalNumberOfRecordsForEachMonth_, $NumberOfMonthlyRecords[$i]);
                // echo $MonthNames[$i] . ' ......';
                ${"PercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords[$i] / $number_of_all_records * 100;      
 
                $CurrentVendorName = $CurrentVendorName->VendorName;
                $number_of_all_records = \App\Models\FuelTestRecord::select('id')
                                                            ->where('VendorNo', $CurrentVendorNo)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->count();
    
                $number_of_previous_records = \App\Models\FuelTestRecord::select('id')
                                                            ->where('VendorNo', $CurrentVendorNo)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->count();
    
                $PassedRecords = \App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();
    
                $number_of_passed_records = count($PassedRecords);     
    
                $DiffRecords = \App\Models\FuelTestRecord::where('VendorName', NULL)
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->get();
    
                $number_of_diff_records = count($DiffRecords);  
                
                $FailedRecords = \App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();
    
                $number_of_failed_records = count($FailedRecords);  
    
                $WavedRecords = \App\Models\FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->get();
    
                $number_of_waved_records = count($WavedRecords);  
                
                $PercentageOfPassedRecords = $number_of_passed_records / $number_of_all_records * 100; 
                $PercentageOfFailedRecords = $number_of_failed_records / $number_of_all_records * 100;
                $PercentageOfWavedRecords = $number_of_waved_records / $number_of_all_records * 100;
                $PercentageOfDiffRecords = $number_of_diff_records / $number_of_all_records * 100;
        
        
                $FirstDayOfLastMonth = date("Y-m-d", strtotime("first day of previous month"));  
                $LastDayOfLastMonth = date("Y-m-d", strtotime("last day of previous month")); 
                    
                $AllRecordsLastMonthForCurrentVendor = \App\Models\FuelTestRecord::where('VendorNo', $CurrentVendorNo)
                                                                        ->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                        ->orderBy('SampleNo', 'DESC')
                                                                        ->get();
    
                $number_of_all_records_last_month = count($AllRecordsLastMonthForCurrentVendor);
    
                $FirstDayOfThisMonth = date('Y-m-01'); 
                $TodaysDate = date('Y-m-d'); 
                
                $AllRecordsThisMonthForCurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])                                                                    
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                        ->get();
        
                $number_of_all_records_this_month = count($AllRecordsThisMonthForCurrentVendor);
        
                $LastSevenDays = date('Y-m-d', strtotime( '-7 day' )); 
                    
                $AllRecordsLastSevenDaysForCurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])                                                                        
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                            ->get();
                    
                $number_of_all_records_last_seven_days = count($AllRecordsLastSevenDaysForCurrentVendor);
    
                $RecordsOfYesterdayForCurrentVendor = date('Y-m-d', strtotime("-1 day")); 
                    
                $yesterday_records = \App\Models\FuelTestRecord::where('SampleCollectionDate', $RecordsOfYesterdayForCurrentVendor)                                                    
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                        ->get();
                        
                $number_of_yesterday_records = count($yesterday_records);
    
                $RecordsOfToday = date('Y-m-d'); 
                    
                $RecordsOfTodayForCurrentVendor = \App\Models\FuelTestRecord::where('SampleCollectionDate', $RecordsOfToday)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->get();
                    
                $number_of_todays_records = count($RecordsOfTodayForCurrentVendor); 
            
                $RecordsOfTwoDaysAgo = date('Y-m-d', strtotime("-2 day"));   
                $number_of_two_days_ago_records = \App\Models\FuelTestRecord::select('id')
                                            ->where('SampleCollectionDate', $RecordsOfTwoDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                        
                $RecordsOfThreeDaysAgo = date('Y-m-d', strtotime("-3 day"));   
                $number_of_three_days_ago_records = \App\Models\FuelTestRecord::select('id')
                                            ->where('SampleCollectionDate', $RecordsOfThreeDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                        
                $RecordsOfFourDaysAgo = date('Y-m-d', strtotime("-4 day"));   
                $number_of_four_days_ago_records = \App\Models\FuelTestRecord::select('id')
                                            ->where('SampleCollectionDate', $RecordsOfFourDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                        
                $RecordsOfFiveDaysAgo = date('Y-m-d', strtotime("-5 day"));   
                $number_of_five_days_ago_records = \App\Models\FuelTestRecord::select('id')
                                            ->where('SampleCollectionDate', $RecordsOfFiveDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                
                        
                $RecordsOfSixDaysAgo = date('Y-m-d', strtotime("-6 day"));   
                $number_of_six_days_ago_records = \App\Models\FuelTestRecord::select('id')
                                            ->where('SampleCollectionDate', $RecordsOfSixDaysAgo)                                                                
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                    ->count(); 
                                                    
                $FirstSupplyDate = \App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->first();         
                                                    
                $RecentSupplyDate = \App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                    ->where('VendorNo', $CurrentVendorNo)
                                                    ->orderBy('SampleNo', 'DESC')
                                                    ->first();         
    
                $FirstSupplyDate = $FirstSupplyDate->SampleCollectionDate;
                $RecentSupplyDate = $RecentSupplyDate->SampleCollectionDate;
        
                $PercentageOfNumberOfRecordsLastMonth = $number_of_all_records_last_month / $number_of_all_records * 100; 
                $PercentageOfAllRecordsThisMonth = $number_of_all_records_this_month / $number_of_all_records * 100;
                $PercentageOfNumberOfRecordsLastSevenDays = $number_of_all_records_last_seven_days / $number_of_all_records * 100;
                    
                $PercentageOfAllRecordsToday = $number_of_todays_records / $number_of_all_records * 100; 
                $PercentageOfAllRecordsYesterday = $number_of_yesterday_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsTwoDaysAgo = $number_of_two_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsThreeDaysAgo = $number_of_three_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsFourDaysAgo = $number_of_four_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsFiveDaysAgo = $number_of_five_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsSixDaysAgo = $number_of_six_days_ago_records / $number_of_all_records * 100;
                $PercentageOfAllRecordsSevenDaysAgo = $number_of_all_records_last_seven_days / $number_of_all_records * 100;
     
            }
                
        } else {

            $NumberOfMonthlyRecords[$i] = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                        ->count();  
 
            $NumberOfMonthlyRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                                                                        ->where('ApprovalForUse', 'APPROVED')
                                                                        ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->count();
 
            $NumberOfMonthlyRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                                                                        ->where('ApprovalForUse', 'WAIVED')
                                                                        ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->count();
 
            $NumberOfMonthlyRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                                                                        ->where('ApprovalForUse', 'REJECTED')
                                                                        ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->count();
 
            $NumberOfMonthlyRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                                                                        ->where('ApprovalForUse', NULL)
                                                                        ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->count();

            ${"PercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords[$i] / $number_of_all_records * 100;  
            ${"AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords[$i] / $number_of_all_records_absolute * 100;          

            ${"APPROVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords_APPROVED / $number_of_all_records_absolute * 100;          
            ${"WAIVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords_WAIVED / $number_of_all_records_absolute * 100;          
            ${"REJECTED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords_REJECTED / $number_of_all_records_absolute * 100;          
            ${"DIFF_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $NumberOfMonthlyRecords_DIFF / $number_of_all_records_absolute * 100;          
    
            array_push($TotalNumberOfRecordsForEachMonth, $NumberOfMonthlyRecords[$i]);
            array_push($TotalNumberOfApprovedRecordsForEachMonth, $NumberOfMonthlyRecords_APPROVED);
            array_push($TotalNumberOfWaivedRecordsForEachMonth, $NumberOfMonthlyRecords_WAIVED);
            array_push($TotalNumberOfRejectedRecordsForEachMonth, $NumberOfMonthlyRecords_REJECTED);
            array_push($TotalNumberOfDiffRecordsForEachMonth, $NumberOfMonthlyRecords_DIFF);
            array_push($PercentageOfAllRecordsForEachMonth, ${"PercentageOfAllRecordsIn" . $MonthNames[$i]});
            array_push($AbsolutePercentageOfAllRecordsForEachMonth, ${"AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]}); 

            array_push($AbsolutePercentageOfAllApprovedRecordsForEachMonth, ${"APPROVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});        
            array_push($AbsolutePercentageOfAllWaivedRecordsForEachMonth, ${"WAIVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});        
            array_push($AbsolutePercentageOfAllRejectedRecordsForEachMonth, ${"REJECTED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});    
            array_push($AbsolutePercentageOfAllDiffRecordsForEachMonth, ${"DIFF_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});    
            
        }
 
    }    