<?php 
 
    $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::select('id')->where('VendorNo', $Vendor->VendorNo)
                                                                    ->get()
                                                                    ->count();  

    $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::select('id')->where('ApprovalForUse', 'APPROVED')
                                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                                        ->get()
                                                                        ->count(); 

    $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::select('id')->where('ApprovalForUse', 'WAIVED')
                                                                    ->where('VendorNo', $Vendor->VendorNo)
                                                                    ->get()
                                                                    ->count(); 

    $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::select('id')->where('ApprovalForUse', 'REJECTED')
                                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                                        ->get()
                                                                        ->count(); 
 
