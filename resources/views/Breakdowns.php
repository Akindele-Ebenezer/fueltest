<?php

// LAST MONTH BREAKDOWN

    $FirstDayOfLastMonth = date("Y-m-d", strtotime("first day of previous month"));  
    $LastDayOfLastMonth = date("Y-m-d", strtotime("last day of previous month")); 

    $NumberOfApprovedRecordsLastMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->count();

    $NumberOfWaivedRecordsLastMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->count();

    $NumberOfRejectedRecordsLastMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->count();

    $NumberOfDiffRecordsLastMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfLastMonth, $LastDayOfLastMonth])
                                                                    ->where('VendorName', NULL)
                                                                    ->count();

    $NumberOfRecordsLastMonth = $NumberOfApprovedRecordsLastMonth + $NumberOfWaivedRecordsLastMonth + $NumberOfRejectedRecordsLastMonth;

    $PercentageOfApprovedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfApprovedRecordsLastMonth / $NumberOfRecordsLastMonth * 100);
    $PercentageOfWaivedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfWaivedRecordsLastMonth / $NumberOfRecordsLastMonth * 100);
    $PercentageOfRejectedRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfRejectedRecordsLastMonth / $NumberOfRecordsLastMonth * 100); 
    $PercentageOfDiffRecordsLastMonth = $NumberOfRecordsLastMonth == 0 ? 0 : ($NumberOfDiffRecordsLastMonth / $NumberOfRecordsLastMonth * 100); 
    $PercentageOfAllRecordsLastMonth = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsLastMonth / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsLastMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsLastMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsLastMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsLastMonth / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsLastMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsLastMonth / $number_of_all_records_absolute * 100);

// THIS MONTH

    $FirstDayOfThisMonth = date('Y-m-01'); 
    $TodaysDate = date('Y-m-d'); 
    
    $NumberOfApprovedRecordsThisMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                    ->count();

    $NumberOfWaivedRecordsThisMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                    ->count();

    $NumberOfRejectedRecordsThisMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                    ->count();

    $NumberOfDiffRecordsThisMonth = \App\Models\FuelTestRecord::select('id')->whereBetween('SampleCollectionDate', [$FirstDayOfThisMonth, $TodaysDate])
                                                                    ->where('VendorName', NULL)
                                                                    ->count();

    $NumberOfRecordsThisMonth = $NumberOfApprovedRecordsThisMonth + $NumberOfWaivedRecordsThisMonth + $NumberOfRejectedRecordsThisMonth;

    $PercentageOfApprovedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfApprovedRecordsThisMonth / $NumberOfRecordsThisMonth * 100);
    $PercentageOfWaivedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfWaivedRecordsThisMonth / $NumberOfRecordsThisMonth * 100);
    $PercentageOfRejectedRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfRejectedRecordsThisMonth / $NumberOfRecordsThisMonth * 100); 
    $PercentageOfDiffRecordsThisMonth = $NumberOfRecordsThisMonth == 0 ? 0 : ($NumberOfDiffRecordsThisMonth / $NumberOfRecordsThisMonth * 100); 
    $PercentageOfAllRecordsThisMonth = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsThisMonth / $number_of_all_records_absolute * 100);
  
    $PercentageOfApprovedRecordsThisMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsThisMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsThisMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsThisMonth / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsThisMonth_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsThisMonth / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsYesterday = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsYesterday / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsYesterday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsYesterday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsYesterday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsYesterday / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsYesterday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsYesterday / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsToday = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsToday / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsToday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsToday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsToday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsToday / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsToday_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsToday / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsTwoDaysAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsTwoDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsTwoDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsTwoDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsTwoDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsTwoDaysAgo / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsThreeDaysAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsThreeDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsThreeDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsThreeDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsThreeDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsThreeDaysAgo / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsFourDaysAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsFourDaysAgo / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsFourDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsFourDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsFourDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsFourDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsFourDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsFourDaysAgo / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsFiveDaysAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsFiveDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsFiveDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsFiveDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsFiveDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsFiveDaysAgo / $number_of_all_records_absolute * 100);

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

    $PercentageOfApprovedRecordsSixDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsSixDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsSixDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfDiffRecordsSixDaysAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfDiffRecordsSixDaysAgo / $number_of_all_records_absolute * 100);
    $PercentageOfAllRecordsSixDaysAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsSixDaysAgo / $number_of_all_records_absolute * 100);

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
    $PercentageOfAllRecordsOneWeekAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOneWeekAgo / $number_of_all_records_absolute * 100);

    $PercentageOfApprovedRecordsOneWeekAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
    $PercentageOfWaivedRecordsOneWeekAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
    $PercentageOfRejectedRecordsOneWeekAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsOneWeekAgo / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsOneWeekAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOneWeekAgo / $number_of_all_records_absolute * 100);

    //2 WEEKS AGO BREAKDOWN

$NumberOfApprovedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
            ->where('ApprovalForUse', 'APPROVED')
            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
            ->count();
            
$NumberOfWaivedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
            ->where('ApprovalForUse', 'WAIVED')
            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
            ->count();
            
$NumberOfRejectedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
            ->where('ApprovalForUse', 'REJECTED')
            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
            ->count();
            
$NumberOfRecordsTwoWeeksAgo = $NumberOfApprovedRecordsTwoWeeksAgo + $NumberOfWaivedRecordsTwoWeeksAgo + $NumberOfRejectedRecordsTwoWeeksAgo;

$PercentageOfApprovedRecordsTwoWeeksAgo = $NumberOfRecordsTwoWeeksAgo == 0 ? 0 : ($NumberOfApprovedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100);
$PercentageOfWaivedRecordsTwoWeeksAgo = $NumberOfRecordsTwoWeeksAgo == 0 ? 0 : ($NumberOfWaivedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100);
$PercentageOfRejectedRecordsTwoWeeksAgo = $NumberOfRecordsTwoWeeksAgo == 0 ? 0 : ($NumberOfRejectedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100);
$PercentageOfAllRecordsTwoWeeksAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsTwoWeeksAgo / $number_of_all_records_absolute * 100);

$PercentageOfApprovedRecordsTwoWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsTwoWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfWaivedRecordsTwoWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsTwoWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfRejectedRecordsTwoWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsTwoWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsTwoWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsTwoWeeksAgo / $number_of_all_records_absolute * 100);
   
//3 WEEKS AGO BREAKDOWN

$NumberOfApprovedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'APPROVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
->count();

$NumberOfWaivedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'WAIVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
->count();

$NumberOfRejectedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'REJECTED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
->count();

$NumberOfRecordsThreeWeeksAgo = $NumberOfApprovedRecordsThreeWeeksAgo + $NumberOfWaivedRecordsThreeWeeksAgo + $NumberOfRejectedRecordsThreeWeeksAgo;

$PercentageOfApprovedRecordsThreeWeeksAgo = $NumberOfRecordsThreeWeeksAgo == 0 ? 0 : ($NumberOfApprovedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100);
$PercentageOfWaivedRecordsThreeWeeksAgo = $NumberOfRecordsThreeWeeksAgo == 0 ? 0 : ($NumberOfWaivedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100);
$PercentageOfRejectedRecordsThreeWeeksAgo = $NumberOfRecordsThreeWeeksAgo == 0 ? 0 : ($NumberOfRejectedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100);
$PercentageOfAllRecordsThreeWeeksAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsThreeWeeksAgo / $number_of_all_records_absolute * 100);

$PercentageOfApprovedRecordsThreeWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsThreeWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfWaivedRecordsThreeWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsThreeWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfRejectedRecordsThreeWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsThreeWeeksAgo / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsThreeWeeksAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsThreeWeeksAgo / $number_of_all_records_absolute * 100);
    //1 MONTH AGO BREAKDOWN

$NumberOfApprovedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'APPROVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
->count();

$NumberOfWaivedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'WAIVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
->count();

$NumberOfRejectedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'REJECTED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
->count();

$NumberOfRecordsOneMonthAgo = $NumberOfApprovedRecordsOneMonthAgo + $NumberOfWaivedRecordsOneMonthAgo + $NumberOfRejectedRecordsOneMonthAgo;

$PercentageOfApprovedRecordsOneMonthAgo = $NumberOfRecordsOneMonthAgo == 0 ? 0 : ($NumberOfApprovedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100);
$PercentageOfWaivedRecordsOneMonthAgo = $NumberOfRecordsOneMonthAgo == 0 ? 0 : ($NumberOfWaivedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100);
$PercentageOfRejectedRecordsOneMonthAgo = $NumberOfRecordsOneMonthAgo == 0 ? 0 : ($NumberOfRejectedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100);
$PercentageOfAllRecordsOneMonthAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOneMonthAgo / $number_of_all_records_absolute * 100);

$PercentageOfApprovedRecordsOneMonthAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsOneMonthAgo / $number_of_all_records_absolute * 100);
$PercentageOfWaivedRecordsOneMonthAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsOneMonthAgo / $number_of_all_records_absolute * 100);
$PercentageOfRejectedRecordsOneMonthAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsOneMonthAgo / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsOneMonthAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOneMonthAgo / $number_of_all_records_absolute * 100);
    //2 MONTHS AGO BREAKDOWN

$NumberOfApprovedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'APPROVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
->count();

$NumberOfWaivedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'WAIVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
->count();

$NumberOfRejectedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'REJECTED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
->count();

$NumberOfRecordsTwoMonthsAgo = $NumberOfApprovedRecordsTwoMonthsAgo + $NumberOfWaivedRecordsTwoMonthsAgo + $NumberOfRejectedRecordsTwoMonthsAgo;

$PercentageOfApprovedRecordsTwoMonthsAgo = $NumberOfApprovedRecordsTwoMonthsAgo == 0 ? 0 : ($NumberOfApprovedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100);
$PercentageOfWaivedRecordsTwoMonthsAgo = $NumberOfWaivedRecordsTwoMonthsAgo == 0 ? 0 : ($NumberOfWaivedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100);
$PercentageOfRejectedRecordsTwoMonthsAgo = $NumberOfRejectedRecordsTwoMonthsAgo == 0 ? 0 : ($NumberOfRejectedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100);
$PercentageOfAllRecordsTwoMonthsAgo = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsTwoMonthsAgo / $number_of_all_records_absolute * 100);

$PercentageOfApprovedRecordsTwoMonthsAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsTwoMonthsAgo / $number_of_all_records_absolute * 100);
$PercentageOfWaivedRecordsTwoMonthsAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsTwoMonthsAgo / $number_of_all_records_absolute * 100);
$PercentageOfRejectedRecordsTwoMonthsAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsTwoMonthsAgo / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsTwoMonthsAgo_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsTwoMonthsAgo / $number_of_all_records_absolute * 100);
    //OLDER BREAKDOWN

$NumberOfApprovedRecordsOlder = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'APPROVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
->count();

$NumberOfWaivedRecordsOlder = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'WAIVED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
->count();

$NumberOfRejectedRecordsOlder = \App\Models\FuelTestRecord::select('id')
->where('ApprovalForUse', 'REJECTED')
->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
->count();

$NumberOfRecordsOlder = $NumberOfApprovedRecordsOlder + $NumberOfWaivedRecordsOlder + $NumberOfRejectedRecordsOlder;

$PercentageOfApprovedRecordsOlder = $NumberOfRecordsOlder == 0 ? 0 : ($NumberOfApprovedRecordsOlder / $NumberOfRecordsOlder * 100);
$PercentageOfWaivedRecordsOlder = $NumberOfRecordsOlder == 0 ? 0 : ($NumberOfWaivedRecordsOlder / $NumberOfRecordsOlder * 100);
$PercentageOfRejectedRecordsOlder = $NumberOfRecordsOlder == 0 ? 0 : ($NumberOfRejectedRecordsOlder / $NumberOfRecordsOlder * 100);
$PercentageOfAllRecordsOlder = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOlder / $number_of_all_records_absolute * 100);

$PercentageOfApprovedRecordsOlder_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfApprovedRecordsOlder / $number_of_all_records_absolute * 100);
$PercentageOfWaivedRecordsOlder_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfWaivedRecordsOlder / $number_of_all_records_absolute * 100);
$PercentageOfRejectedRecordsOlder_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRejectedRecordsOlder / $number_of_all_records_absolute * 100);
$PercentageOfDiffRecordsOlder_Absolute = $number_of_all_records_absolute == 0 ? 0 : ($NumberOfRecordsOlder / $number_of_all_records_absolute * 100);
