<img src="images/medal.png" alt="">
<input name="SampleNo" type="hidden" value="{{ isset($_GET['GetRecord']) ? $SampleNo : '' }}">
<input name="SampleCollectionDate" type="hidden" value="{{ isset($_GET['GetRecord']) ? date_format($SampleCollectionDate, "Y-m-d") : '' }}">
<input name="Color" type="hidden" value="{{ isset($_GET['GetRecord']) ? $Color : '' }}">
<input name="AppearanceResult" type="hidden" value="{{ isset($_GET['GetRecord']) ? $AppearanceResult : '' }}">
<input name="TruckPlateNo" type="hidden" placeholder="Enter Plate No." value="{{ isset($_GET['GetRecord']) ? $TruckPlateNo : '' }}">
<input name="TankNo" type="hidden" placeholder="Input Plate No." value="{{ isset($_GET['GetRecord']) ? $TankNo : '' }}">
<input name="uid" type="hidden" value="{{ isset($_GET['GetRecord']) ? $id : '' }}">
<input name="Density" type="hidden" placeholder="Input Density..." value="{{ isset($_GET['GetRecord']) ? $Density : '' }}">
<input name="FlashPoint" type="hidden" placeholder="Enter Flash Point..." value="{{ isset($_GET['GetRecord']) ? $FlashPoint : '' }}">
<input name="Temp" type="hidden" placeholder="Temperature..." value="{{ isset($_GET['GetRecord']) ? $Temp : '' }}">
<input name="WaterSediment" type="hidden" placeholder="Required..." value="{{ isset($_GET['GetRecord']) ? $WaterSediment : '' }}">
<input name="Cleanliness" type="hidden" placeholder="Cleanliness..." value="{{ isset($_GET['GetRecord']) ? $Cleanliness : '' }}">
<input name="DateOfTest" type="hidden" placeholder="Date..." value="{{ isset($_GET['GetRecord']) ? date_format($DateOfTest, "Y-m-d") : '' }}"> 
<input name="MadeBy" type="hidden" list="MadeBy" name="MadeBy" value="{{ isset($_GET['GetRecord']) ? $MadeBy : '' }}">
<input name="DeliveredTo" type="hidden" placeholder="Delivered To..." value="{{ isset($_GET['GetRecord']) ? $DeliveredTo : '' }}">
<input name="Remarks" type="hidden" placeholder="Remarks..." value="{{ isset($_GET['GetRecord']) ? $Remarks : '' }}"> 
<input name="VendorName" type="hidden" value="{{ isset($_GET['GetRecord']) ? $VendorName : '' }}"> 
<input name="VendorNo" type="hidden" value="{{ isset($_GET['GetRecord']) ? $VendorNo : '' }}"> 
<input name="ApprovalForUse" type="hidden" value="{{ isset($_GET['GetRecord']) ? $ApprovalForUse : '' }}"> 
<input type="submit" value="Download Certificate">