@php 
    ob_start();

    $id = Session::get('id'); 
    $name = Session::get('name');
    $email = Session::get('email');
    $title = 'Previous Records';
    $header_info = 'Manage all your Records effectively. Log In';
    
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
                @if($number_of_previous_records == 0)
                <tr>
                    <td>
                         Your RECORD is currently empty.. 
                    </td>
                </tr>
                @endif
                @foreach($previous_records as $previous_record)
                <tr>
                    <td class="pdf-and-edit">
                        <form action="/generate_certificate/{{ $previous_record->SampleNo }}" method="get" target="_blank">@csrf
                            <input type="image" src="/images/pdf.png"> 
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
                        </form> 
                        <form action="/edit/{{ $previous_record->SampleNo }}" method="post" target="_blank">@csrf 
                            <input type="image" src="/images/edit.png"> 
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
                        </form> 
                    </td>
                    <td class="sample-no">{{ $previous_record->SampleNo }}</td> 
                    </td>
                    <td class="sample-collection-date">{{ $previous_record->SampleCollectionDate }}</td> 
                    <td class="truck-plate-no">{{ $previous_record->TruckPlateNo  }}</td>
                    <td class="tank-no">{{ $previous_record->TankNo }}</td>
                    <td class="appearance-result"><p class="{{ $previous_record->AppearanceResult === 'Bright' || 'BRIGHT' ? 'Bright' : '' }} {{ $previous_record->AppearanceResult === 'Muddy' ? 'Muddy' : '' }} {{ $previous_record->AppearanceResult === 'Clear' ? 'Clear' : '' }} {{ $previous_record->AppearanceResult === 'C/M' ? 'CM' : '' }}">{{ $previous_record->AppearanceResult }} </p></td> 
                    <td>{{ str_replace("Choose Color...", "null", $previous_record->Color) }}</td>
                    <td class="density">{{ $previous_record->Density }}</td>
                    <td class="flash-point">{{ $previous_record->FlashPoint }}</td>
                    <td class="temp">{{ $previous_record->Temp }}</td>
                    <td>{{ $previous_record->WaterSediment }} </td>
                    <td>{{ $previous_record->Cleanliness }}</td>
                    <td>{{ $previous_record->DateOfTest }}</td>
                    <td>{{ $previous_record->MadeBy }}</td>
                    <td>{{ $previous_record->DeliveredTo }}</td> 
                    <td>{{ $previous_record->Remarks }}</td> 
                </tr>
                @endforeach 
            </table>
        </div>
    </section>
@endsection 
