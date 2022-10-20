<center>
    <form action="/ShowCertificate/{{ $SampleNo }}" target="_blank" method="post">@csrf
        <input type="image" src="/images/pdf.png">
        <input name="SampleNo" type="hidden" value="{{ $SampleNo }}">
        <input name="SampleCollectionDate" type="hidden" value="{{ $SampleCollectionDate }}">
        <input name="Color" type="hidden" value="{{ $Color }}">
        <input name="AppearanceResult" type="hidden" value="{{ $AppearanceResult }}">
        <input name="TruckPlateNo" type="hidden" placeholder="Enter Plate No." value="{{ $TruckPlateNo }}">
        <input name="TankNo" type="hidden" placeholder="Input Plate No." value="{{ $TankNo }}">
        <input name="uid" type="hidden" value="{{ $id }}">
        <input name="Density" type="hidden" placeholder="Input Density..." value="{{ $Density }}">
        <input name="FlashPoint" type="hidden" placeholder="Enter Flash Point..." value="{{ $FlashPoint }}">
        <input name="Temp" type="hidden" placeholder="Temperature..." value="{{ $Temp }}">
        <input name="WaterSediment" type="hidden" placeholder="Required..." value="{{ $WaterSediment }}">
        <input name="Cleanliness" type="hidden" placeholder="Cleanliness..." value="{{ $Cleanliness }}">
        <input name="DateOfTest" type="hidden" placeholder="Date..." value="{{ $DateOfTest }}"> 
        <input name="MadeBy" type="hidden" list="MadeBy" name="MadeBy" value="{{ $MadeBy }}">
        <input name="DeliveredTo" type="hidden" placeholder="Delivered To..." value="{{ $DeliveredTo }}">
        <input name="Remarks" type="hidden" placeholder="Remarks..." value="{{ $Remarks }}"> 
        <input name="VendorName" type="hidden" value="{{ Route::is('record_success') ? $VendorName_ : $VendorName }} ">
        <input name="VendorNo" type="hidden" value="{{ Route::is('record_success') ? $VendorNo_ : $VendorNo }}">
        <input name="ApprovalForUse" type="hidden" value="{{ $ApprovalForUse }}">
    </form>
</center>