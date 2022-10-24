@php
 
    $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::select('VendorName')->where('VendorName', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
                                                                    ->get()
                                                                    ->count(); 

    $ApprovedTestsForEachVendor = [];
    $RejectedTestsForEachVendor = [];
    $WavedTestsForEachVendor = [];

    foreach ($vendors as $ApprovalForUse) {

        ${"ApprovedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))}   = App\Models\FuelTestRecord::where('VendorName', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
                                                                                                                                                                                                                        ->where('ApprovalForUse', 'APPROVED')
                                                                                                                                                                                                                        ->orderBy('VendorName')
                                                                                                                                                                                                                        ->get()
                                                                                                                                                                                                                        ->count();

        ${"RejectedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))}  = App\Models\FuelTestRecord::where('VendorName', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
                                                                                                                                                                                                                        ->where('ApprovalForUse', 'REJECTED')
                                                                                                                                                                                                                        ->orderBy('VendorName')
                                                                                                                                                                                                                        ->get()
                                                                                                                                                                                                                        ->count();

        ${"WavedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))}  = App\Models\FuelTestRecord::where('VendorName', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
                                                                                                                                                                                                                        ->where('ApprovalForUse', 'WAIVED')
                                                                                                                                                                                                                        ->orderBy('VendorName')
                                                                                                                                                                                                                        ->get()
                                                                                                                                                                                                                        ->count();

        array_push($ApprovedTestsForEachVendor, ${"ApprovedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))});                                                                                                                                    
        array_push($RejectedTestsForEachVendor, ${"RejectedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))});                                                                                                                                    
        array_push($WavedTestsForEachVendor, ${"WavedTestsFor" . str_replace(' ', '', Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))});                                                                                                                                    
        
    }

@endphp


({{ $NumberOfTotalRecordsForEachVendor }}) {{ $NumberOfTotalRecordsForEachVendor > 0 ? 'Diesel supplied from' : 'No Diesel Supplied yet from' }} {{ Route::is('previous_records') ? $previous_record->VendorName : '' }}{{ Route::is('all_records') ? $record->VendorName : '' }}{{ Route::is('vendors') ? $Vendor->VendorName : '' }}. 

@if(Route::is('previous_records'))

    [{{ $previous_record->ApprovalForUse === 'APPROVED' ? 'Test for this record created on ' . $previous_record->created_at . ' is Passed' : '' }}{{ $previous_record->ApprovalForUse === 'REJECTED' ? 'Test for this record created on ' . $previous_record->created_at . ' is Rejected' : '' }}{{ $previous_record->ApprovalForUse === 'WAIVED' ? 'Test for this record created on ' . $previous_record->created_at . ' is Waived' : '' }}] <br> 

    @elseif(Route::is('all_records'))

    [{{ $record->ApprovalForUse === 'APPROVED' ? 'Test for this record created on ' . $record->created_at . ' is Passed' : '' }}{{ $record->ApprovalForUse === 'REJECTED' ? 'Test for this record created on ' . $record->created_at . ' is Rejected' : '' }}{{ $record->ApprovalForUse === 'WAIVED' ? 'Test for this record created on ' . $record->created_at . ' is Waived' : '' }}] <br> 

@endif
 
@switch(Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
    @case(Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
        [{{ 'AP : ' . $ApprovedTestsForEachVendor[0] }}] [{{ 'RJ : ' . $RejectedTestsForEachVendor[0] }}] [{{ 'WV : ' . $WavedTestsForEachVendor[0] }}] 
        @break
        
    @default
        {{ '' }}
@endswitch  