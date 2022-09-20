
<input type="hidden" name="">
<input name="SampleNo" type="hidden" value="{{ $record->SampleNo }}">
<input name="SampleCollectionDate" type="hidden" value="{{ $record->SampleCollectionDate }}">
<input name="Color" type="hidden" value="{{ $record->Color }}">
<input name="AppearanceResult" type="hidden" value="{{ $record->AppearanceResult }}">
<input name="TruckPlateNo" type="hidden" placeholder="Enter Plate No." value="{{ $record->TruckPlateNo }}">
<input name="TankNo" type="hidden" placeholder="Input Plate No." value="{{ $record->TankNo }}">
<input name="uid" type="hidden" value="{{ $id }}">
<input name="Density" type="hidden" placeholder="Input Density..." value="{{ $record->Density }}">
<input name="FlashPoint" type="hidden" placeholder="Enter Flash Point..." value="{{ $record->FlashPoint }}">
<input name="Temp" type="hidden" placeholder="Temperature..." value="{{ $record->Temp }}">
<input name="WaterSediment" type="hidden" placeholder="Required..." value="{{ $record->WaterSediment }}">
<input name="Cleanliness" type="hidden" placeholder="Cleanliness..." value="{{ $record->Cleanliness }}">
<input name="DateOfTest" type="hidden" placeholder="Date..." value="{{ $record->DateOfTest }}"> 
<input name="MadeBy" type="hidden" list="MadeBy" name="MadeBy" value="{{ $record->MadeBy }}">
<input name="DeliveredTo" type="hidden" placeholder="Delivered To..." value="{{ $record->DeliveredTo }}">
<input name="Remarks" type="hidden" placeholder="Remarks..." value="{{ $record->Remarks }}"> 
<input name="VendorName" type="hidden" value="{{ $record->VendorName }}"> 
<input name="VendorNo" type="hidden" value="{{ $record->VendorNo }}"> 
<input name="ApprovalForUse" type="hidden" value="{{ $record->ApprovalForUse }}"> 
<input type="submit" class="Certificate">