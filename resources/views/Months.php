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
    $TotalNumberOfApprovedRecordsForEachMonth_  = [0]; 
    $TotalNumberOfWaivedRecordsForEachMonth_    = [0]; 
    $TotalNumberOfRejectedRecordsForEachMonth_  = [0]; 
    $TotalNumberOfDiffRecordsForEachMonth_      = [0]; 
    $PercentageOfAllRecordsForEachMonth         = [0];  
    $AbsolutePercentageOfAllRecordsForEachMonth = [0]; 
    $TotalNumberOfApprovedRecordsForEachMonth   = [0]; 
    $TotalNumberOfWaivedRecordsForEachMonth     = [0]; 
    $TotalNumberOfRejectedRecordsForEachMonth   = [0]; 
    $TotalNumberOfDiffRecordsForEachMonth       = [0]; 

    $AbsolutePercentageOfAllApprovedRecordsForEachMonth     = [0]; 
    $AbsolutePercentageOfAllWaivedRecordsForEachMonth       = [0]; 
    $AbsolutePercentageOfAllRejectedRecordsForEachMonth     = [0];
    $AbsolutePercentageOfAllDiffRecordsForEachMonth         = [0];

    $AbsolutePercentageOfAllApprovedRecordsForEachMonth_    = [0]; 
    $AbsolutePercentageOfAllWaivedRecordsForEachMonth_      = [0]; 
    $AbsolutePercentageOfAllRejectedRecordsForEachMonth_    = [0];
    $AbsolutePercentageOfAllDiffRecordsForEachMonth_        = [0];
    
    for ($i = 1; $i < count($MonthNames); $i++) {
        
        if ($i < 10) { 
            $MonthNumber = 0 . $i; 
        } else {
            $MonthNumber = $i;             
        }
         
        $AbsoluteMonthNumber = $i;  
        $Year_ = date('Y');
        $Years = range(2000, strftime("%Y", time()));
         
        // ${"FirstDayOf" . $MonthNames[$i]} = date('2022-' . $MonthNumber . '-01'); 
        // ${"LastDayOf" . $MonthNames[$i]} = date('2022-' . $MonthNumber . '-' . cal_days_in_month(CAL_EASTER_DEFAULT, $AbsoluteMonthNumber , date('2022')));
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

                $MonthNames = [0, 0];
                $TotalNumberOfRecordsForEachMonth_ = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $TotalNumberOfApprovedRecordsForEachMonth_ = [0, 0];
                $TotalNumberOfWaivedRecordsForEachMonth_ = [0, 0];
                $TotalNumberOfRejectedRecordsForEachMonth_ = [0, 0];
                $TotalNumberOfDiffRecordsForEachMonth_ = [0, 0];
                $AbsolutePercentageOfAllApprovedRecordsForEachMonth_ = [0, 0];
                $AbsolutePercentageOfAllWaivedRecordsForEachMonth_ = [0, 0];
                $AbsolutePercentageOfAllRejectedRecordsForEachMonth_ = [0, 0];
                $AbsolutePercentageOfAllDiffRecordsForEachMonth_ = [0, 0];

                $PercentageOfFailedRecords = $PercentageOfPassedRecords = $PercentageOfWavedRecords = $PercentageOfDiffRecords = $PercentageOfNumberOfRecordsLastMonth = $PercentageOfAllRecordsThisMonth = $PercentageOfFailedRecords = $PercentageOfPassedRecords = $PercentageOfWavedRecords = $PercentageOfDiffRecords = $PercentageOfNumberOfRecordsLastMonth = $PercentageOfAllRecordsThisMonth = $PercentageOfNumberOfRecordsLastSevenDays = $PercentageOfAllRecordsToday = $PercentageOfAllRecordsYesterday = $PercentageOfAllRecordsTwoDaysAgo = $PercentageOfAllRecordsThreeDaysAgo = $PercentageOfAllRecordsFourDaysAgo = $PercentageOfAllRecordsFiveDaysAgo = $PercentageOfAllRecordsSixDaysAgo = $PercentageOfAllRecordsSevenDaysAgo = $PercentageOfDiffRecords = $number_of_passed_records = $number_of_diff_records = $number_of_failed_records = $number_of_waved_records = $number_of_all_records_last_month = $number_of_all_records_this_month = $number_of_all_records_last_seven_days = $number_of_yesterday_records = $number_of_todays_records = $number_of_two_days_ago_records = $number_of_three_days_ago_records = $number_of_four_days_ago_records = $number_of_five_days_ago_records = $number_of_six_days_ago_records = $number_of_all_records = $number_of_previous_records = $NumberOfApprovedRecordsLastMonth_CurrentVendor = $NumberOfWaivedRecordsLastMonth_CurrentVendor = $NumberOfRejectedRecordsLastMonth_CurrentVendor = $PercentageOfApprovedRecordsLastMonth_CurrentVendor = $PercentageOfWaivedRecordsLastMonth_CurrentVendor  = $PercentageOfRejectedRecordsLastMonth_CurrentVendor  = $PercentageOfApprovedRecordsYesterday_CurrentVendor = $PercentageOfWaivedRecordsYesterday_CurrentVendor  = $PercentageOfRejectedRecordsYesterday_CurrentVendor = $PercentageOfDiffRecordsYesterday_CurrentVendor = $NumberOfDiffRecordsLastMonth_CurrentVendor = $PercentageOfDiffRecordsLastMonth_CurrentVendor  = $NumberOfApprovedRecordsThisMonth_CurrentVendor = $NumberOfWaivedRecordsThisMonth_CurrentVendor = $NumberOfRejectedRecordsThisMonth_CurrentVendor = $PercentageOfAllRecordsThisMonth_CurrentVendor = $PercentageOfNumberOfRecordsLastMonth_CurrentVendor = $PercentageOfAllRecordsLastSevenDays_CurrentVendor =                  
                $PercentageOfApprovedRecordsThisMonth_CurrentVendor = $PercentageOfWaivedRecordsThisMonth_CurrentVendor  = $PercentageOfRejectedRecordsThisMonth_CurrentVendor = $NumberOfDiffRecordsThisMonth_CurrentVendor = $PercentageOfDiffRecordsThisMonth_CurrentVendor  = $CurrentVendor_NumberOfOneWeekAgoRecords_APPROVED = $CurrentVendor_NumberOfOneWeekAgoRecords_WAIVED = $CurrentVendor_NumberOfOneWeekAgoRecords_REJECTED = $CurrentVendor_NumberOfOneWeekAgoRecords_DIFF = $PercentageOfNumberOfRecordsLastSevenDays_CurrentVendor = $PercentageOfApprovedRecordsOneWeekAgo_CurrentVendor = $PercentageOfWaivedRecordsOneWeekAgo_CurrentVendor = $PercentageOfRejectedRecordsOneWeekAgo_CurrentVendor = $PercentageOfDiffRecordsOneWeekAgo_CurrentVendor = $CurrentVendor_NumberOfTodayRecords_APPROVED = $CurrentVendor_NumberOfYesterdayRecords_APPROVED = $CurrentVendor_NumberOfDayBeforeRecords_APPROVED = $CurrentVendor_NumberOfThreeDaysAgoRecords_APPROVED = $CurrentVendor_NumberOfFourDaysAgoRecords_APPROVED = $CurrentVendor_NumberOfFiveDaysAgoRecords_APPROVED = $CurrentVendor_NumberOfSixDaysAgoRecords_APPROVED = $CurrentVendor_NumberOfTodayRecords_WAIVED = $CurrentVendor_NumberOfYesterdayRecords_WAIVED = $CurrentVendor_NumberOfDayBeforeRecords_WAIVED = $CurrentVendor_NumberOfThreeDaysAgoRecords_WAIVED = $CurrentVendor_NumberOfFourDaysAgoRecords_WAIVED = $CurrentVendor_NumberOfFiveDaysAgoRecords_WAIVED = $CurrentVendor_NumberOfSixDaysAgoRecords_WAIVED = $CurrentVendor_NumberOfTodayRecords_REJECTED = $CurrentVendor_NumberOfYesterdayRecords_REJECTED = $CurrentVendor_NumberOfDayBeforeRecords_REJECTED = $CurrentVendor_NumberOfThreeDaysAgoRecords_REJECTED = $CurrentVendor_NumberOfFourDaysAgoRecords_REJECTED = $CurrentVendor_NumberOfFiveDaysAgoRecords_REJECTED = $CurrentVendor_NumberOfSixDaysAgoRecords_REJECTED = $CurrentVendor_NumberOfTodayRecords_DIFF = $CurrentVendor_NumberOfYesterdayRecords_DIFF = $CurrentVendor_NumberOfDayBeforeRecords_DIFF = $CurrentVendor_NumberOfThreeDaysAgoRecords_DIFF = $CurrentVendor_NumberOfFourDaysAgoRecords_DIFF = $CurrentVendor_NumberOfFiveDaysAgoRecords_DIFF = $CurrentVendor_NumberOfSixDaysAgoRecords_DIFF = $AbsolutePercentageOfNumberOfRecordsLastSevenDays = $AbsolutePercentageOfAllRecordsToday =  $AbsolutePercentageOfAllRecordsYesterday = $AbsolutePercentageOfAllRecordsTwoDaysAgo = $AbsolutePercentageOfAllRecordsThreeDaysAgo = $AbsolutePercentageOfAllRecordsFourDaysAgo = $AbsolutePercentageOfAllRecordsFiveDaysAgo = $AbsolutePercentageOfAllRecordsSixDaysAgo = $AbsolutePercentageOfNumberOfRecordsLastSevenDays = $PercentageOfApprovedRecordsToday_CurrentVendor = $PercentageOfWaivedRecordsToday_CurrentVendor = $PercentageOfRejectedRecordsToday_CurrentVendor = $PercentageOfDiffRecordsToday_CurrentVendor = $PercentageOfApprovedRecordsDayBefore_CurrentVendor = $PercentageOfWaivedRecordsDayBefore_CurrentVendor = $PercentageOfRejectedRecordsDayBefore_CurrentVendor = $PercentageOfDiffRecordsDayBefore_CurrentVendor = $PercentageOfApprovedRecordsThreeDaysAgo_CurrentVendor = $PercentageOfWaivedRecordsThreeDaysAgo_CurrentVendor = $PercentageOfRejectedRecordsThreeDaysAgo_CurrentVendor = $PercentageOfDiffRecordsThreeDaysAgo_CurrentVendor = $PercentageOfApprovedRecordsFourDaysAgo_CurrentVendor = $PercentageOfWaivedRecordsFourDaysAgo_CurrentVendor = $PercentageOfRejectedRecordsFourDaysAgo_CurrentVendor = $PercentageOfDiffRecordsFourDaysAgo_CurrentVendor = $PercentageOfApprovedRecordsFiveDaysAgo_CurrentVendor = $PercentageOfWaivedRecordsFiveDaysAgo_CurrentVendor = $PercentageOfRejectedRecordsFiveDaysAgo_CurrentVendor = $PercentageOfDiffRecordsFiveDaysAgo_CurrentVendor = $PercentageOfApprovedRecordsSixDaysAgo_CurrentVendor = $PercentageOfWaivedRecordsSixDaysAgo_CurrentVendor = $PercentageOfRejectedRecordsSixDaysAgo_CurrentVendor = $PercentageOfDiffRecordsSixDaysAgo_CurrentVendor = 0;
                
                for($i = 1; $i < count($MonthNames); $i++) {
                    $TotalNumberOfRecordsForEachMonth_[$i] = 0;
                    ${"PercentageOfAllRecordsIn" . $MonthNames[$i]} = 0;
                }

            } else {
                
// LAST MONTH BREAKDOWN

    $FirstDayOfLastMonth = date("Y-m-d", strtotime("first day of previous month"));  
    $LastDayOfLastMonth = date("Y-m-d", strtotime("last day of previous month")); 

    $NumberOfApprovedRecordsLastMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfWaivedRecordsLastMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfRejectedRecordsLastMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfDiffRecordsLastMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('VendorName', NULL)
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfRecordsLastMonth_CurrentVendor = $NumberOfApprovedRecordsLastMonth_CurrentVendor + $NumberOfWaivedRecordsLastMonth_CurrentVendor + $NumberOfRejectedRecordsLastMonth_CurrentVendor + $NumberOfDiffRecordsLastMonth_CurrentVendor;

    $PercentageOfApprovedRecordsLastMonth_CurrentVendor = $NumberOfRecordsLastMonth_CurrentVendor == 0 ? 0 : ($NumberOfApprovedRecordsLastMonth_CurrentVendor / $NumberOfRecordsLastMonth_CurrentVendor * 100);
    $PercentageOfWaivedRecordsLastMonth_CurrentVendor = $NumberOfRecordsLastMonth_CurrentVendor == 0 ? 0 : ($NumberOfWaivedRecordsLastMonth_CurrentVendor / $NumberOfRecordsLastMonth_CurrentVendor * 100);
    $PercentageOfRejectedRecordsLastMonth_CurrentVendor = $NumberOfRecordsLastMonth_CurrentVendor == 0 ? 0 : ($NumberOfRejectedRecordsLastMonth_CurrentVendor / $NumberOfRecordsLastMonth_CurrentVendor * 100); 
    $PercentageOfDiffRecordsLastMonth_CurrentVendor = $NumberOfRecordsLastMonth_CurrentVendor == 0 ? 0 : ($NumberOfDiffRecordsLastMonth_CurrentVendor / $NumberOfRecordsLastMonth_CurrentVendor * 100); 

// THIS MONTH

    $FirstDayOfThisMonth = date('Y-m-01'); 
    $TodaysDate = date('Y-m-d'); 
    
    $NumberOfApprovedRecordsThisMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfWaivedRecordsThisMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfRejectedRecordsThisMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfDiffRecordsThisMonth_CurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('VendorName', NULL)
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->count();

    $NumberOfRecordsThisMonth_CurrentVendor = $NumberOfApprovedRecordsThisMonth_CurrentVendor + $NumberOfWaivedRecordsThisMonth_CurrentVendor + $NumberOfRejectedRecordsThisMonth_CurrentVendor;

    $PercentageOfApprovedRecordsThisMonth_CurrentVendor = $NumberOfRecordsThisMonth_CurrentVendor == 0 ? 0 : ($NumberOfApprovedRecordsThisMonth_CurrentVendor / $NumberOfRecordsThisMonth_CurrentVendor * 100);
    $PercentageOfWaivedRecordsThisMonth_CurrentVendor = $NumberOfRecordsThisMonth_CurrentVendor == 0 ? 0 : ($NumberOfWaivedRecordsThisMonth_CurrentVendor / $NumberOfRecordsThisMonth_CurrentVendor * 100);
    $PercentageOfRejectedRecordsThisMonth_CurrentVendor = $NumberOfRecordsThisMonth_CurrentVendor == 0 ? 0 : ($NumberOfRejectedRecordsThisMonth_CurrentVendor / $NumberOfRecordsThisMonth_CurrentVendor * 100); 
    $PercentageOfDiffRecordsThisMonth_CurrentVendor = $NumberOfRecordsThisMonth_CurrentVendor == 0 ? 0 : ($NumberOfDiffRecordsThisMonth_CurrentVendor / $NumberOfRecordsThisMonth_CurrentVendor * 100); 
  
                    // MONTHLY
                $CurrentVendor_NumberOfMonthlyRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfMonthlyRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfMonthlyRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfMonthlyRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                    // TODAY
                $CurrentVendor_NumberOfTodayRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d'))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfTodayRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d'))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfTodayRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d'))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfTodayRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d'))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsToday = $CurrentVendor_NumberOfTodayRecords_APPROVED + $CurrentVendor_NumberOfTodayRecords_WAIVED + $CurrentVendor_NumberOfTodayRecords_REJECTED + $CurrentVendor_NumberOfTodayRecords_DIFF;

                $PercentageOfApprovedRecordsToday_CurrentVendor = $NumberOfRecordsToday == 0 ? 0 : ($CurrentVendor_NumberOfTodayRecords_APPROVED / $NumberOfRecordsToday * 100);
                $PercentageOfWaivedRecordsToday_CurrentVendor = $NumberOfRecordsToday == 0 ? 0 : ($CurrentVendor_NumberOfTodayRecords_WAIVED / $NumberOfRecordsToday * 100);
                $PercentageOfRejectedRecordsToday_CurrentVendor = $NumberOfRecordsToday == 0 ? 0 : ($CurrentVendor_NumberOfTodayRecords_REJECTED / $NumberOfRecordsToday * 100); 
                $PercentageOfDiffRecordsToday_CurrentVendor = $NumberOfRecordsToday == 0 ? 0 : ($CurrentVendor_NumberOfTodayRecords_DIFF / $NumberOfRecordsToday * 100); 
            
                    // YESTERDAY
                $CurrentVendor_NumberOfYesterdayRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfYesterdayRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfYesterdayRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfYesterdayRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsYesterday = $CurrentVendor_NumberOfYesterdayRecords_APPROVED + $CurrentVendor_NumberOfYesterdayRecords_WAIVED + $CurrentVendor_NumberOfYesterdayRecords_REJECTED + $CurrentVendor_NumberOfYesterdayRecords_DIFF;

                $PercentageOfApprovedRecordsYesterday_CurrentVendor = $NumberOfRecordsYesterday == 0 ? 0 : ($CurrentVendor_NumberOfYesterdayRecords_APPROVED / $NumberOfRecordsYesterday * 100);
                $PercentageOfWaivedRecordsYesterday_CurrentVendor = $NumberOfRecordsYesterday == 0 ? 0 : ($CurrentVendor_NumberOfYesterdayRecords_WAIVED / $NumberOfRecordsYesterday * 100);
                $PercentageOfRejectedRecordsYesterday_CurrentVendor = $NumberOfRecordsYesterday == 0 ? 0 : ($CurrentVendor_NumberOfYesterdayRecords_REJECTED / $NumberOfRecordsYesterday * 100); 
                $PercentageOfDiffRecordsYesterday_CurrentVendor = $NumberOfRecordsYesterday == 0 ? 0 : ($CurrentVendor_NumberOfYesterdayRecords_DIFF / $NumberOfRecordsYesterday * 100); 
             
                    // DAY BEFORE
                $CurrentVendor_NumberOfDayBeforeRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfDayBeforeRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfDayBeforeRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfDayBeforeRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsDayBefore = $CurrentVendor_NumberOfDayBeforeRecords_APPROVED + $CurrentVendor_NumberOfDayBeforeRecords_WAIVED + $CurrentVendor_NumberOfDayBeforeRecords_REJECTED + $CurrentVendor_NumberOfDayBeforeRecords_DIFF;

                $PercentageOfApprovedRecordsDayBefore_CurrentVendor = $NumberOfRecordsDayBefore == 0 ? 0 : ($CurrentVendor_NumberOfDayBeforeRecords_APPROVED / $NumberOfRecordsDayBefore * 100);
                $PercentageOfWaivedRecordsDayBefore_CurrentVendor = $NumberOfRecordsDayBefore == 0 ? 0 : ($CurrentVendor_NumberOfDayBeforeRecords_WAIVED / $NumberOfRecordsDayBefore * 100);
                $PercentageOfRejectedRecordsDayBefore_CurrentVendor = $NumberOfRecordsDayBefore == 0 ? 0 : ($CurrentVendor_NumberOfDayBeforeRecords_REJECTED / $NumberOfRecordsDayBefore * 100); 
                $PercentageOfDiffRecordsDayBefore_CurrentVendor = $NumberOfRecordsDayBefore == 0 ? 0 : ($CurrentVendor_NumberOfDayBeforeRecords_DIFF / $NumberOfRecordsDayBefore * 100); 

                    // THREE DAYS AGO
                $CurrentVendor_NumberOfThreeDaysAgoRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfThreeDaysAgoRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfThreeDaysAgoRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfThreeDaysAgoRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsThreeDaysAgo = $CurrentVendor_NumberOfThreeDaysAgoRecords_APPROVED + $CurrentVendor_NumberOfThreeDaysAgoRecords_WAIVED + $CurrentVendor_NumberOfThreeDaysAgoRecords_REJECTED + $CurrentVendor_NumberOfThreeDaysAgoRecords_DIFF;

                $PercentageOfApprovedRecordsThreeDaysAgo_CurrentVendor = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfThreeDaysAgoRecords_APPROVED / $NumberOfRecordsThreeDaysAgo * 100);
                $PercentageOfWaivedRecordsThreeDaysAgo_CurrentVendor = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfThreeDaysAgoRecords_WAIVED / $NumberOfRecordsThreeDaysAgo * 100);
                $PercentageOfRejectedRecordsThreeDaysAgo_CurrentVendor = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfThreeDaysAgoRecords_REJECTED / $NumberOfRecordsThreeDaysAgo * 100); 
                $PercentageOfDiffRecordsThreeDaysAgo_CurrentVendor = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfThreeDaysAgoRecords_DIFF / $NumberOfRecordsThreeDaysAgo * 100); 

                    // FOUR DAYS AGO
                $CurrentVendor_NumberOfFourDaysAgoRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFourDaysAgoRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFourDaysAgoRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFourDaysAgoRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsFourDaysAgo = $CurrentVendor_NumberOfFourDaysAgoRecords_APPROVED + $CurrentVendor_NumberOfFourDaysAgoRecords_WAIVED + $CurrentVendor_NumberOfFourDaysAgoRecords_REJECTED + $CurrentVendor_NumberOfFourDaysAgoRecords_DIFF;

                $PercentageOfApprovedRecordsFourDaysAgo_CurrentVendor = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFourDaysAgoRecords_APPROVED / $NumberOfRecordsFourDaysAgo * 100);
                $PercentageOfWaivedRecordsFourDaysAgo_CurrentVendor = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFourDaysAgoRecords_WAIVED / $NumberOfRecordsFourDaysAgo * 100);
                $PercentageOfRejectedRecordsFourDaysAgo_CurrentVendor = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFourDaysAgoRecords_REJECTED / $NumberOfRecordsFourDaysAgo * 100); 
                $PercentageOfDiffRecordsFourDaysAgo_CurrentVendor = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFourDaysAgoRecords_DIFF / $NumberOfRecordsFourDaysAgo * 100); 

                    // FIVE DAYS AGO
                $CurrentVendor_NumberOfFiveDaysAgoRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFiveDaysAgoRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFiveDaysAgoRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfFiveDaysAgoRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsFiveDaysAgo = $CurrentVendor_NumberOfFiveDaysAgoRecords_APPROVED + $CurrentVendor_NumberOfFiveDaysAgoRecords_WAIVED + $CurrentVendor_NumberOfFiveDaysAgoRecords_REJECTED + $CurrentVendor_NumberOfFiveDaysAgoRecords_DIFF;

                $PercentageOfApprovedRecordsFiveDaysAgo_CurrentVendor = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFiveDaysAgoRecords_APPROVED / $NumberOfRecordsFiveDaysAgo * 100);
                $PercentageOfWaivedRecordsFiveDaysAgo_CurrentVendor = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFiveDaysAgoRecords_WAIVED / $NumberOfRecordsFiveDaysAgo * 100);
                $PercentageOfRejectedRecordsFiveDaysAgo_CurrentVendor = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFiveDaysAgoRecords_REJECTED / $NumberOfRecordsFiveDaysAgo * 100); 
                $PercentageOfDiffRecordsFiveDaysAgo_CurrentVendor = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfFiveDaysAgoRecords_DIFF / $NumberOfRecordsFiveDaysAgo * 100); 

                    // SIX DAYS AGO
                $CurrentVendor_NumberOfSixDaysAgoRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfSixDaysAgoRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfSixDaysAgoRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfSixDaysAgoRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsSixDaysAgo = $CurrentVendor_NumberOfSixDaysAgoRecords_APPROVED + $CurrentVendor_NumberOfSixDaysAgoRecords_WAIVED + $CurrentVendor_NumberOfSixDaysAgoRecords_REJECTED + $CurrentVendor_NumberOfSixDaysAgoRecords_DIFF;

                $PercentageOfApprovedRecordsSixDaysAgo_CurrentVendor = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfSixDaysAgoRecords_APPROVED / $NumberOfRecordsSixDaysAgo * 100);
                $PercentageOfWaivedRecordsSixDaysAgo_CurrentVendor = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfSixDaysAgoRecords_WAIVED / $NumberOfRecordsSixDaysAgo * 100);
                $PercentageOfRejectedRecordsSixDaysAgo_CurrentVendor = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfSixDaysAgoRecords_REJECTED / $NumberOfRecordsSixDaysAgo * 100); 
                $PercentageOfDiffRecordsSixDaysAgo_CurrentVendor = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($CurrentVendor_NumberOfSixDaysAgoRecords_DIFF / $NumberOfRecordsSixDaysAgo * 100); 

                    // ONE WEEK AGO
                $CurrentVendor_NumberOfOneWeekAgoRecords_APPROVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'APPROVED')
                            ->where('SampleCollectionDate', '>=', date('Y-m-d',  strtotime("-1 week")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfOneWeekAgoRecords_WAIVED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'WAIVED')
                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfOneWeekAgoRecords_REJECTED = \App\Models\FuelTestRecord::select('id')
                            ->where('ApprovalForUse', 'REJECTED')
                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $CurrentVendor_NumberOfOneWeekAgoRecords_DIFF = \App\Models\FuelTestRecord::select('id')
                            ->where('VendorName', NULL)
                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
                            ->where('VendorNo', $CurrentVendorNo)
                            ->count();

                $NumberOfRecordsOneWeekAgo = $CurrentVendor_NumberOfOneWeekAgoRecords_APPROVED + $CurrentVendor_NumberOfOneWeekAgoRecords_WAIVED + $CurrentVendor_NumberOfOneWeekAgoRecords_REJECTED + $CurrentVendor_NumberOfOneWeekAgoRecords_DIFF;

                $PercentageOfApprovedRecordsOneWeekAgo_CurrentVendor = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($CurrentVendor_NumberOfOneWeekAgoRecords_APPROVED / $NumberOfRecordsOneWeekAgo * 100);
                $PercentageOfWaivedRecordsOneWeekAgo_CurrentVendor = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($CurrentVendor_NumberOfOneWeekAgoRecords_WAIVED / $NumberOfRecordsOneWeekAgo * 100);
                $PercentageOfRejectedRecordsOneWeekAgo_CurrentVendor = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($CurrentVendor_NumberOfOneWeekAgoRecords_REJECTED / $NumberOfRecordsOneWeekAgo * 100); 
                $PercentageOfDiffRecordsOneWeekAgo_CurrentVendor = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($CurrentVendor_NumberOfOneWeekAgoRecords_DIFF / $NumberOfRecordsOneWeekAgo * 100); 

                ${"CurrentVendor_APPROVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $CurrentVendor_NumberOfMonthlyRecords_APPROVED / $number_of_all_records_absolute * 100;          
                ${"CurrentVendor_WAIVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $CurrentVendor_NumberOfMonthlyRecords_WAIVED / $number_of_all_records_absolute * 100;          
                ${"CurrentVendor_REJECTED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $CurrentVendor_NumberOfMonthlyRecords_REJECTED / $number_of_all_records_absolute * 100;          
                ${"CurrentVendor_DIFF_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]} = $CurrentVendor_NumberOfMonthlyRecords_DIFF / $number_of_all_records_absolute * 100;          
       
                array_push($AbsolutePercentageOfAllApprovedRecordsForEachMonth_, ${"CurrentVendor_APPROVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});        
                array_push($AbsolutePercentageOfAllWaivedRecordsForEachMonth_, ${"CurrentVendor_WAIVED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});        
                array_push($AbsolutePercentageOfAllRejectedRecordsForEachMonth_, ${"CurrentVendor_REJECTED_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});    
                array_push($AbsolutePercentageOfAllDiffRecordsForEachMonth_, ${"CurrentVendor_DIFF_AbsolutePercentageOfAllRecordsIn" . $MonthNames[$i]});    

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

                $NumberOfApprovedRecordsForEachMonth_ = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->where('VendorNo', $CurrentVendorNo) 
                                                                        ->where('ApprovalForUse', 'APPROVED') 
                                                                        ->count(); 

                $NumberOfWaivedRecordsForEachMonth_ = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->where('VendorNo', $CurrentVendorNo) 
                                                                        ->where('ApprovalForUse', 'WAIVED') 
                                                                        ->count(); 

                $NumberOfRejectedRecordsForEachMonth_ = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->where('VendorNo', $CurrentVendorNo) 
                                                                        ->where('ApprovalForUse', 'REJECTED') 
                                                                        ->count(); 

                $NumberOfDiffRecordsForEachMonth_ = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [${"FirstDayOf" . $MonthNames[$i]}, ${"LastDayOf" . $MonthNames[$i]}])
                                                                        ->where('VendorNo', $CurrentVendorNo) 
                                                                        ->where('VendorName', NULL) 
                                                                        ->count(); 

                array_push($TotalNumberOfRecordsForEachMonth_, $NumberOfMonthlyRecords[$i]);
                array_push($TotalNumberOfApprovedRecordsForEachMonth_, $NumberOfApprovedRecordsForEachMonth_);
                array_push($TotalNumberOfWaivedRecordsForEachMonth_, $NumberOfWaivedRecordsForEachMonth_);
                array_push($TotalNumberOfRejectedRecordsForEachMonth_, $NumberOfRejectedRecordsForEachMonth_);
                array_push($TotalNumberOfDiffRecordsForEachMonth_, $NumberOfDiffRecordsForEachMonth_);
                 
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
                $PercentageOfNumberOfRecordsLastMonth_CurrentVendor = $number_of_all_records_last_month / $number_of_all_records * 100;
    
                $FirstDayOfThisMonth = date('Y-m-01'); 
                $TodaysDate = date('Y-m-d'); 
                
                $AllRecordsThisMonthForCurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])                                                                    
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                        ->get();
        
                $number_of_all_records_this_month = count($AllRecordsThisMonthForCurrentVendor);
                $PercentageOfAllRecordsThisMonth_CurrentVendor = $number_of_all_records_this_month / $number_of_all_records * 100;
        
                $LastSevenDays = date('Y-m-d', strtotime( '-7 day' )); 
                    
                $AllRecordsLastSevenDaysForCurrentVendor = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$LastSevenDays, $TodaysDate])                                                                        
                                                                    ->where('VendorNo', $CurrentVendorNo)
                                                                    ->orderBy('SampleNo', 'DESC')
                                                                            ->get();
                    
                $number_of_all_records_last_seven_days = count($AllRecordsLastSevenDaysForCurrentVendor);
                $PercentageOfNumberOfRecordsLastSevenDays_CurrentVendor = $number_of_all_records_last_seven_days / $number_of_all_records * 100;
    
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
                                                                        ->where('VendorName', NULL)
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