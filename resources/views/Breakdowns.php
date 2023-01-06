<?php

// LAST MONTH BREAKDOWN

    $FirstDayOfLastMonth = date("Y-m-d", strtotime("first day of previous month"));  
    $LastDayOfLastMonth = date("Y-m-d", strtotime("last day of previous month")); 

    $NumberOfApprovedRecordsLastMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->count();

    $NumberOfWaivedRecordsLastMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->count();

    $NumberOfRejectedRecordsLastMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->count();

    $NumberOfDiffRecordsLastMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('VendorName', NULL)
                                                                    ->count();

    $NumberOfRecordsLastMonth = $NumberOfApprovedRecordsLastMonth + $NumberOfWaivedRecordsLastMonth + $NumberOfRejectedRecordsLastMonth;

    $PercentageOfApprovedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfApprovedRecordsLastMonth / $NumberOfRecordsLastMonth * 100);
    $PercentageOfWaivedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfWaivedRecordsLastMonth / $NumberOfRecordsLastMonth * 100);
    $PercentageOfRejectedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfRejectedRecordsLastMonth / $NumberOfRecordsLastMonth * 100); 
    $PercentageOfDiffRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfDiffRecordsLastMonth / $NumberOfRecordsLastMonth * 100); 

    $PercentageOfApprovedRecordsLastMonth_Absolute = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfApprovedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsLastMonth_Absolute = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfWaivedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsLastMonth_Absolute = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfRejectedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsLastMonth_Absolute = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfDiffRecordsLastMonth / $number_of_all_records_absolute * 100);

// THIS MONTH

    $FirstDayOfThisMonth = date('Y-m-01'); 
    $TodaysDate = date('Y-m-d'); 
    
    $NumberOfApprovedRecordsThisMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->count();

    $NumberOfWaivedRecordsThisMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->count();

    $NumberOfRejectedRecordsThisMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->count();

    $NumberOfDiffRecordsThisMonth = \App\Models\FuelTestRecord::whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('VendorName', NULL)
                                                                    ->count();

    $NumberOfRecordsThisMonth = $NumberOfApprovedRecordsThisMonth + $NumberOfWaivedRecordsThisMonth + $NumberOfRejectedRecordsThisMonth;

    $PercentageOfApprovedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfApprovedRecordsThisMonth / $NumberOfRecordsThisMonth * 100);
    $PercentageOfWaivedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfWaivedRecordsThisMonth / $NumberOfRecordsThisMonth * 100);
    $PercentageOfRejectedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfRejectedRecordsThisMonth / $NumberOfRecordsThisMonth * 100); 
    $PercentageOfDiffRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfDiffRecordsThisMonth / $NumberOfRecordsThisMonth * 100); 
  
    $PercentageOfApprovedRecordsThisMonth_Absolute = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfApprovedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsThisMonth_Absolute = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfWaivedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsThisMonth_Absolute = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfRejectedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsThisMonth_Absolute = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfDiffRecordsThisMonth / $number_of_all_records_absolute * 100);

// YESTERDAYS BREAKDOWN
    $NumberOfApprovedRecordsYesterday = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
    ->count();

    $NumberOfWaivedRecordsYesterday = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'WAIVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
    ->count();

    $NumberOfRejectedRecordsYesterday = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'REJECTED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
    ->count();

    $NumberOfDiffRecordsYesterday = \App\Models\FuelTestRecord::select('id')
    ->where('VendorName', NULL)
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
    ->count();

    $NumberOfRecordsYesterday = $NumberOfApprovedRecordsYesterday + $NumberOfWaivedRecordsYesterday + $NumberOfRejectedRecordsYesterday;

    $PercentageOfApprovedRecordsYesterday = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfApprovedRecordsYesterday / $NumberOfRecordsYesterday * 100);
    $PercentageOfWaivedRecordsYesterday = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfWaivedRecordsYesterday / $NumberOfRecordsYesterday * 100);
    $PercentageOfRejectedRecordsYesterday = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfRejectedRecordsYesterday / $NumberOfRecordsYesterday * 100); 
    $PercentageOfDiffRecordsYesterday = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfDiffRecordsYesterday / $NumberOfRecordsYesterday * 100); 

    $PercentageOfApprovedRecordsYesterday_Absolute = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfApprovedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsYesterday_Absolute = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfWaivedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsYesterday_Absolute = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfRejectedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsYesterday_Absolute = $NumberOfRecordsYesterday == 0 ? 0 : ($NumberOfDiffRecordsYesterday / $number_of_all_records_absolute * 100);

    //TODAY BREAKDOWN
    
    $NumberOfApprovedRecordsToday = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d'))
    ->count();
    
    $NumberOfWaivedRecordsToday = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d'))
        ->count();
        
    $NumberOfRejectedRecordsToday = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d'))
        ->count();

        $NumberOfDiffRecordsToday = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d'))
        ->count();
        
    $NumberOfRecordsToday = $NumberOfApprovedRecordsToday + $NumberOfWaivedRecordsToday + $NumberOfRejectedRecordsToday;

    $PercentageOfApprovedRecordsToday = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfApprovedRecordsToday / $NumberOfRecordsToday * 100);
    $PercentageOfWaivedRecordsToday = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfWaivedRecordsToday / $NumberOfRecordsToday * 100);
    $PercentageOfRejectedRecordsToday = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfRejectedRecordsToday / $NumberOfRecordsToday * 100);
    $PercentageOfDiffRecordsToday = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfDiffRecordsToday / $NumberOfRecordsToday * 100);

    $PercentageOfApprovedRecordsToday_Absolute = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfApprovedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsToday_Absolute = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfWaivedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsToday_Absolute = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfRejectedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsToday_Absolute = $NumberOfRecordsToday == 0 ? 0 : ($NumberOfDiffRecordsToday / $number_of_all_records_absolute * 100);

    //DAY BEFORE BREAKDOWN

    $NumberOfApprovedRecordsTwoDaysAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
    ->count();
    
    $NumberOfWaivedRecordsTwoDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
        ->count();
        
    $NumberOfRejectedRecordsTwoDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
        ->count();

        $NumberOfDiffRecordsTwoDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-2 day")))
        ->count();
        
    $NumberOfRecordsTwoDaysAgo = $NumberOfApprovedRecordsTwoDaysAgo + $NumberOfWaivedRecordsTwoDaysAgo + $NumberOfRejectedRecordsTwoDaysAgo;

    $PercentageOfApprovedRecordsTwoDaysAgo = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsTwoDaysAgo / $NumberOfRecordsTwoDaysAgo * 100);
    $PercentageOfWaivedRecordsTwoDaysAgo = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsTwoDaysAgo / $NumberOfRecordsTwoDaysAgo * 100);
    $PercentageOfRejectedRecordsTwoDaysAgo = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsTwoDaysAgo / $NumberOfRecordsTwoDaysAgo * 100);
    $PercentageOfDiffRecordsTwoDaysAgo = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsTwoDaysAgo / $NumberOfRecordsTwoDaysAgo * 100);

    $PercentageOfApprovedRecordsTwoDaysAgo_Absolute = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsTwoDaysAgo_Absolute = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsTwoDaysAgo_Absolute = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsTwoDaysAgo_Absolute = $NumberOfRecordsTwoDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);

    //3 DAYS AGO BREAKDOWN

    $NumberOfApprovedRecordsThreeDaysAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
    ->count();
    
    $NumberOfWaivedRecordsThreeDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
        ->count();
        
    $NumberOfRejectedRecordsThreeDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
        ->count();

        $NumberOfDiffRecordsThreeDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-3 day")))
        ->count();
        
    $NumberOfRecordsThreeDaysAgo = $NumberOfApprovedRecordsThreeDaysAgo + $NumberOfWaivedRecordsThreeDaysAgo + $NumberOfRejectedRecordsThreeDaysAgo;

    $PercentageOfApprovedRecordsThreeDaysAgo = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsThreeDaysAgo / $NumberOfRecordsThreeDaysAgo * 100);
    $PercentageOfWaivedRecordsThreeDaysAgo = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsThreeDaysAgo / $NumberOfRecordsThreeDaysAgo * 100);
    $PercentageOfRejectedRecordsThreeDaysAgo = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsThreeDaysAgo / $NumberOfRecordsThreeDaysAgo * 100);
    $PercentageOfDiffRecordsThreeDaysAgo = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsThreeDaysAgo / $NumberOfRecordsThreeDaysAgo * 100);

    $PercentageOfApprovedRecordsThreeDaysAgo_Absolute = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsThreeDaysAgo_Absolute = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsThreeDaysAgo_Absolute = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsThreeDaysAgo_Absolute = $NumberOfRecordsThreeDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);

    //4 DAYS AGO BREAKDOWN

    $NumberOfApprovedRecordsFourDaysAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
    ->count();
    
    $NumberOfWaivedRecordsFourDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
        ->count();
        
    $NumberOfRejectedRecordsFourDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
        ->count();

        $NumberOfDiffRecordsFourDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-4 day")))
        ->count();
        
    $NumberOfRecordsFourDaysAgo = $NumberOfApprovedRecordsFourDaysAgo + $NumberOfWaivedRecordsFourDaysAgo + $NumberOfRejectedRecordsFourDaysAgo;

    $PercentageOfApprovedRecordsFourDaysAgo = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsFourDaysAgo / $NumberOfRecordsFourDaysAgo * 100);
    $PercentageOfWaivedRecordsFourDaysAgo = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsFourDaysAgo / $NumberOfRecordsFourDaysAgo * 100);
    $PercentageOfRejectedRecordsFourDaysAgo = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsFourDaysAgo / $NumberOfRecordsFourDaysAgo * 100);
    $PercentageOfDiffRecordsFourDaysAgo = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsFourDaysAgo / $NumberOfRecordsFourDaysAgo * 100);

    $PercentageOfApprovedRecordsFourDaysAgo_Absolute = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsFourDaysAgo_Absolute = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsFourDaysAgo_Absolute = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsFourDaysAgo_Absolute = $NumberOfRecordsFourDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsFourDaysAgo / $number_of_all_records_absolute * 100);

    //5 DAYS AGO BREAKDOWN

    $NumberOfApprovedRecordsFiveDaysAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
    ->count();
    
    $NumberOfWaivedRecordsFiveDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
        ->count();
        
    $NumberOfRejectedRecordsFiveDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
        ->count();

        $NumberOfDiffRecordsFiveDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-5 day")))
        ->count();
        
    $NumberOfRecordsFiveDaysAgo = $NumberOfApprovedRecordsFiveDaysAgo + $NumberOfWaivedRecordsFiveDaysAgo + $NumberOfRejectedRecordsFiveDaysAgo;

    $PercentageOfApprovedRecordsFiveDaysAgo = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsFiveDaysAgo / $NumberOfRecordsFiveDaysAgo * 100);
    $PercentageOfWaivedRecordsFiveDaysAgo = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsFiveDaysAgo / $NumberOfRecordsFiveDaysAgo * 100);
    $PercentageOfRejectedRecordsFiveDaysAgo = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsFiveDaysAgo / $NumberOfRecordsFiveDaysAgo * 100);
    $PercentageOfDiffRecordsFiveDaysAgo = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsFiveDaysAgo / $NumberOfRecordsFiveDaysAgo * 100);

    $PercentageOfApprovedRecordsFiveDaysAgo_Absolute = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsFiveDaysAgo_Absolute = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsFiveDaysAgo_Absolute = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsFiveDaysAgo_Absolute = $NumberOfRecordsFiveDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);

    //6 DAYS AGO BREAKDOWN

    $NumberOfApprovedRecordsSixDaysAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
    ->count();
    
    $NumberOfWaivedRecordsSixDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
        ->count();
        
    $NumberOfRejectedRecordsSixDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
        ->count();

        $NumberOfDiffRecordsSixDaysAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', date('Y-m-d', strtotime("-6 day")))
        ->count();
        
    $NumberOfRecordsSixDaysAgo = $NumberOfApprovedRecordsSixDaysAgo + $NumberOfWaivedRecordsSixDaysAgo + $NumberOfRejectedRecordsSixDaysAgo;

    $PercentageOfApprovedRecordsSixDaysAgo = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsSixDaysAgo / $NumberOfRecordsSixDaysAgo * 100);
    $PercentageOfWaivedRecordsSixDaysAgo = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsSixDaysAgo / $NumberOfRecordsSixDaysAgo * 100);
    $PercentageOfRejectedRecordsSixDaysAgo = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsSixDaysAgo / $NumberOfRecordsSixDaysAgo * 100);
    $PercentageOfDiffRecordsSixDaysAgo = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsSixDaysAgo / $NumberOfRecordsSixDaysAgo * 100);

    $PercentageOfApprovedRecordsSixDaysAgo_Absolute = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfApprovedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsSixDaysAgo_Absolute = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfWaivedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsSixDaysAgo_Absolute = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfRejectedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsSixDaysAgo_Absolute = $NumberOfRecordsSixDaysAgo == 0 ? 0 : ($NumberOfDiffRecordsSixDaysAgo / $number_of_all_records_absolute * 100);

    //1 WEEK AGO BREAKDOWN

    $NumberOfApprovedRecordsOneWeekAgo = \App\Models\FuelTestRecord::select('id')
    ->where('ApprovalForUse', 'APPROVED')
    ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
    ->count();
    
    $NumberOfWaivedRecordsOneWeekAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'WAIVED')
        ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
        ->count();
        
    $NumberOfRejectedRecordsOneWeekAgo = \App\Models\FuelTestRecord::select('id')
        ->where('ApprovalForUse', 'REJECTED')
        ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
        ->count();

        $NumberOfDiffRecordsOneWeekAgo = \App\Models\FuelTestRecord::select('id')
        ->where('VendorName', NULL)
        ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 week")))
        ->count();
        
    $NumberOfRecordsOneWeekAgo = $NumberOfApprovedRecordsOneWeekAgo + $NumberOfWaivedRecordsOneWeekAgo + $NumberOfRejectedRecordsOneWeekAgo;

    $PercentageOfApprovedRecordsOneWeekAgo = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfApprovedRecordsOneWeekAgo / $NumberOfRecordsOneWeekAgo * 100);
    $PercentageOfWaivedRecordsOneWeekAgo = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfWaivedRecordsOneWeekAgo / $NumberOfRecordsOneWeekAgo * 100);
    $PercentageOfRejectedRecordsOneWeekAgo = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfRejectedRecordsOneWeekAgo / $NumberOfRecordsOneWeekAgo * 100);
    $PercentageOfDiffRecordsOneWeekAgo = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfDiffRecordsOneWeekAgo / $NumberOfRecordsOneWeekAgo * 100);

    $PercentageOfApprovedRecordsOneWeekAgo_Absolute = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfApprovedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsOneWeekAgo_Absolute = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfWaivedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsOneWeekAgo_Absolute = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfRejectedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsOneWeekAgo_Absolute = $NumberOfRecordsOneWeekAgo == 0 ? 0 : ($NumberOfDiffRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
