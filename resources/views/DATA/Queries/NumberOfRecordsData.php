<?php 
 
    $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::where('VendorNo', $Vendor->VendorNo)
                                                                    ->get()
                                                                    ->count();  

    $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                                        ->get()
                                                                        ->count(); 

    $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'WAVED')
                                                                    ->where('VendorNo', $Vendor->VendorNo)
                                                                    ->get()
                                                                    ->count(); 

    $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                                        ->get()
                                                                        ->count(); 
 
