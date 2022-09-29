 
    {{ Route::is('previous_records') ? $previous_record->VendorName : '' }}{{ Route::is('all_records') ? $record->VendorName : '' }} 

    @if(Route::is('previous_records'))
    
        [{{ $previous_record->ApprovalForUse === 'APPROVED' ? 'Passed' : '' }}{{ $previous_record->ApprovalForUse === 'REJECTED' ? 'Rejected' : '' }}{{ $previous_record->ApprovalForUse === 'WAVED' ? 'Waved' : '' }}] <br> 
        @elseif(Route::is('all_records'))
        [{{ $record->ApprovalForUse === 'APPROVED' ? 'Passed' : '' }}{{ $record->ApprovalForUse === 'REJECTED' ? 'Rejected' : '' }}{{ $record->ApprovalForUse === 'WAVED' ? 'Waved' : '' }}] <br> 

    @endif


{{-- @switch((Route::is('all_records') ? $record->VendorName : '') || (Route::is('previous_records') ? $previous_record->VendorName : '') || (Route::is('vendors') ? $Vendor->VendorName : '')) --}}
@switch(Route::is('all_records') ? $record->VendorName : (Route::is('previous_records') ? $previous_record->VendorName : $Vendor->VendorName))
    @case('DAUZ GLOBAL VENTURES')
        [{{ 'AP : ' . $ApprovedTestsForDAUZGLOBALVENTURES }}] [{{ 'RJ : ' . $RejectedTestsForDAUZGLOBALVENTURES }}] [{{ 'WV : ' . $WavedTestsForDAUZGLOBALVENTURES }}] 
        @break

    @case('BLUEFIN ENERGY LIMITED')
    [{{ 'AP : ' . $ApprovedTestsForBLUEFINENERGYLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForBLUEFINENERGYLIMITED }}] [{{ 'WV : ' . $WavedTestsForBLUEFINENERGYLIMITED }}] 
        @break
                                
    @case('FOURPOINTS INTEGRATED SOLUTIONS')
        [{{ 'AP : ' . $ApprovedTestsForFOURPOINTSINTEGRATEDSOLUTIONS }}] [{{ 'RJ : ' . $RejectedTestsForFOURPOINTSINTEGRATEDSOLUTIONS }}] [{{ 'WV : ' . $WavedTestsForFOURPOINTSINTEGRATEDSOLUTIONS }}] 
        @break

    @case('INTEGRATED OSMOSIS CONCEPT LIMITED')
        [{{ 'AP : ' . $ApprovedTestsForINTEGRATEDOSMOSISCONCEPTLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForINTEGRATEDOSMOSISCONCEPTLIMITED }}] [{{ 'WV : ' . $WavedTestsForINTEGRATEDOSMOSISCONCEPTLIMITED }}] 
        @break

    @case('JESSICON GLOBAL')
        [{{ 'AP : ' . $ApprovedTestsForJESSICONGLOBAL }}] [{{ 'RJ : ' . $RejectedTestsForJESSICONGLOBAL }}] [{{ 'WV : ' . $WavedTestsForJESSICONGLOBAL }}] 
        @break

    @case('LEKSYD ENERGY LTD')
        [{{ 'AP : ' . $ApprovedTestsForLEKSYDENERGYLTD }}] [{{ 'RJ : ' . $RejectedTestsForLEKSYDENERGYLTD }}] [{{ 'WV : ' . $WavedTestsForLEKSYDENERGYLTD }}] 
        @break

    @case('MATRIX ENERGY RESOURCES LTD')
        [{{ 'AP : ' . $ApprovedTestsForMATRIXENERGYRESOURCESLTD }}] [{{ 'RJ : ' . $RejectedTestsForMATRIXENERGYRESOURCESLTD }}] [{{ 'WV : ' . $WavedTestsForMATRIXENERGYRESOURCESLTD }}] 
        @break

    @case('NAVAHO PETROLEUM LIMITED')
        [{{ 'AP : ' . $ApprovedTestsForNAVAHOPETROLEUMLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForNAVAHOPETROLEUMLIMITED }}] [{{ 'WV : ' . $WavedTestsForNAVAHOPETROLEUMLIMITED }}] 
        @break

    @case('NIPCO PLC')
        [{{ 'AP : ' . $ApprovedTestsForNIPCOPLC }}] [{{ 'RJ : ' . $RejectedTestsForNIPCOPLC }}] [{{ 'WV : ' . $WavedTestsForNIPCOPLC }}] 
        @break

    @case('PRACTIC ENERGY SOLUTIONS LIMITED')
        [{{ 'AP : ' . $ApprovedTestsForPRACTICENERGYSOLUTIONSLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForPRACTICENERGYSOLUTIONSLIMITED }}] [{{ 'WV : ' . $WavedTestsForPRACTICENERGYSOLUTIONSLIMITED }}] 
        @break

    @case('SADESH ENERGY LIMITED')
        [{{ 'AP : ' . $ApprovedTestsForSADESHENERGYLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForSADESHENERGYLIMITED }}] [{{ 'WV : ' . $WavedTestsForSADESHENERGYLIMITED }}] 
        @break

    @case('SKID GLOBAL RESOURCES LTD')
        [{{ 'AP : ' . $ApprovedTestsForSKIDGLOBALRESOURCESLTD }}] [{{ 'RJ : ' . $RejectedTestsForSKIDGLOBALRESOURCESLTD }}] [{{ 'WV : ' . $WavedTestsForSKIDGLOBALRESOURCESLTD }}] 
        @break

    @case('TOTAL NIGERIA PLC (LAGOS)')
        [{{ 'AP : ' . $ApprovedTestsForTOTALNIGERIAPLC }}] [{{ 'RJ : ' . $RejectedTestsForTOTALNIGERIAPLC }}] [{{ 'WV : ' . $WavedTestsForTOTALNIGERIAPLC }}] 
        @break

    @case('WHITEHILL INTEGRATED SERVICES LIMITED')
        [{{ 'AP : ' . $ApprovedTestsForWHITEHILLINTEGRATEDSERVICESLIMITED }}] [{{ 'RJ : ' . $RejectedTestsForWHITEHILLINTEGRATEDSERVICESLIMITED }}] [{{ 'WV : ' . $WavedTestsForWHITEHILLINTEGRATEDSERVICESLIMITED }}] 
        @break

    @case('YURT ENERGY LTD')
        [{{ 'AP : ' . $ApprovedTestsForYURTENERGYLTD }}] [{{ 'RJ : ' . $RejectedTestsForYURTENERGYLTD }}] [{{ 'WV : ' . $WavedTestsForYURTENERGYLTD }}] 
        @break

    @case('Z\'LURTOY OIL & GAS LTD')
        [{{ 'AP : ' . $ApprovedTestsForZLURTOYOILGASLTD }}] [{{ 'RJ : ' . $RejectedTestsForZLURTOYOILGASLTD }}] [{{ 'WV : ' . $WavedTestsForZLURTOYOILGASLTD }}] 
        @break

    @default
        {{ '' }}
@endswitch  