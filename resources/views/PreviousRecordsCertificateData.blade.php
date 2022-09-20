
<input type="hidden" name="">
<input name="SampleNo" type="hidden" value="{{ $previous_record->SampleNo }}">
<input name="SampleCollectionDate" type="hidden" value="{{ $previous_record->SampleCollectionDate }}">
<input name="Color" type="hidden" value="{{ $previous_record->Color }}">
<input name="AppearanceResult" type="hidden" value="{{ $previous_record->AppearanceResult }}">
<input name="TruckPlateNo" type="hidden" placeholder="Enter Plate No." value="{{ $previous_record->TruckPlateNo }}">
<input name="TankNo" type="hidden" placeholder="Input Plate No." value="{{ $previous_record->TankNo }}">
<input name="uid" type="hidden" value="{{ $id }}">
<input name="Density" type="hidden" placeholder="Input Density..." value="{{ $previous_record->Density }}">
<input name="FlashPoint" type="hidden" placeholder="Enter Flash Point..." value="{{ $previous_record->FlashPoint }}">
<input name="Temp" type="hidden" placeholder="Temperature..." value="{{ $previous_record->Temp }}">
<input name="WaterSediment" type="hidden" placeholder="Required..." value="{{ $previous_record->WaterSediment }}">
<input name="Cleanliness" type="hidden" placeholder="Cleanliness..." value="{{ $previous_record->Cleanliness }}">
<input name="DateOfTest" type="hidden" placeholder="Date..." value="{{ $previous_record->DateOfTest }}"> 
<input name="MadeBy" type="hidden" list="MadeBy" name="MadeBy" value="{{ $previous_record->MadeBy }}">
<input name="DeliveredTo" type="hidden" placeholder="Delivered To..." value="{{ $previous_record->DeliveredTo }}">
<input name="Remarks" type="hidden" placeholder="Remarks..." value="{{ $previous_record->Remarks }}"> 
<input name="VendorName" type="hidden" value="{{ $previous_record->VendorName }}"> 
<input name="VendorNo" type="hidden" value="{{ $previous_record->VendorNo }}"> 
<input name="ApprovalForUse" type="hidden" value="{{ $previous_record->ApprovalForUse }}"> 
<input type="submit" class="Certificate">