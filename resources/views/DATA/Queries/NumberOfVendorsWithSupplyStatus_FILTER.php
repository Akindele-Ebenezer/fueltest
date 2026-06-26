<?php
    if(isset($_GET['FilterVendorStats'])) {
        $VendorStatsFrom = $_GET['VendorStatsFrom'];
        $VendorStatsTo = $_GET['VendorStatsTo'];
            
        $Vendors_ = App\Models\Vendor::select('VendorName')->get();

        $VendorsWithSupplyStatus = App\Models\FuelTestRecord::select('VendorName')
                                                    ->whereBetween('SampleCollectionDate', [$VendorStatsFrom, $VendorStatsTo])
                                                    ->whereNot('VendorName', '') 
                                                    ->whereIn('VendorName', $Vendors_) 
                                                    ->groupBy('VendorName') 
                                                    ->get(); 
                                                    
        $VendorsWithSupplyStatus = count($VendorsWithSupplyStatus); 
        $PercentageOfVendorsWithSupplyStatus = $VendorsWithSupplyStatus / $number_of_vendors * 100;                                                           
    }