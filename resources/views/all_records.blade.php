@php
    ob_start();
    
    $id = Session::get('id');
    $name = Session::get('name');
    $email = Session::get('email');
    $title = 'All Records';
    $header_info = 'Manage all your Records effectively. Log In';
     
    if (isset($_GET['export'])) {
        
        ob_clean(); 
        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=DEPASA Fuel Test Records.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        header("X-Accel-Buffering: no");
        
    }
      
@endphp

@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        <center>
            <h1>{{ $title }}</h1>
            <form action="/export">
                <button type="submit" name="export">Export to Excel</button>
            </form>
        </center>
        <div>
            <table>
                <tr> 
                    <th> </th> 
                    <th>Sample No.</th>
                    <th>Sample Collection Date</th>
                    <th>Truck Plate No.</th>
                    <th>Tank No.</th>
                    <th>Appearance Result</th>
                    <th>Color</th>
                    <th>Density in Kg/m<sup>3</sup></th>
                    <th>Flash Point</th>
                    <th>Temp °C</th>
                    <th>Water/Sediment % </th>
                    <th>Cleanliness</th>
                    <th>Date Of Test</th>
                    <th>Made By (Name)</th>
                    <th>Delivered To</th>
                    <th>Remarks</th>
                </tr>
                @if($number_of_all_records == 0)
                <tr>
                    <td>
                         There are no RECORDS.. 
                    </td>
                </tr>
                @endif
                @foreach($all_records as $record)
                <tr>  
                    <td class="pdf-and-edit">
                        <form action="/generate_certificate/{{ $record->SampleNo }}" method="get" target="_blank">@csrf
                            <input type="image" src="/images/pdf.png"> 
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
                        </form> 
                        <!-- <form action="/edit/{{ $record->SampleNo }}" method="post" target="_blank">@csrf 
                            <input type="image" src="/images/edit.png"> 
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
                        </form>  -->
                    </td>  
                    <td class="sample-no">{{ $record->SampleNo }}</td>
                    <td class="sample-collection-date">{{ $record->SampleCollectionDate }}</td>
                    <td class="truck-plate-no">{{ $record->TruckPlateNo  }}</td>
                    <td class="tank-no">{{ $record->TankNo }}</td>
                    <td class="appearance-result"><p class="{{ $record->AppearanceResult === 'Bright' || 'BRIGHT' ? 'Bright' : '' }} {{ $record->AppearanceResult === 'Muddy' ? 'Muddy' : '' }} {{ $record->AppearanceResult === 'Clear' ? 'Clear' : '' }} {{ $record->AppearanceResult === 'C/M' ? 'CM' : '' }}">{{ $record->AppearanceResult }} </p></td>
                    <td>{{ str_replace("Choose Color...", "null", $record->Color) }}</td>
                    <td class="density">{{ $record->Density }}</td>
                    <td class="flash-point">{{ $record->FlashPoint }}</td>
                    <td class="temp">{{ $record->Temp }}</td>
                    <td>{{ $record->WaterSediment }} </td>
                    <td>{{ $record->Cleanliness }}</td>
                    <td>{{ $record->DateOfTest }}</td>
                    <td>{{ $record->MadeBy }}</td>
                    <td>{{ $record->DeliveredTo }}</td> 
                    <td>{{ $record->Remarks }}</td>
                </tr>
                @endforeach
            </table> 
            <!-- Pagination links -->
        </div>
    </section>
@endsection