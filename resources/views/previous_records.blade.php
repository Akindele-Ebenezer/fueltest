@php

    if(isset($_GET['FilterVendorName'])) {
        $FilteredRecords[] = $_GET['CheckVendorName']; 

        foreach ($FilteredRecords as $VendorName) {
            $title = $VendorName[0];
            $previous_records = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                                            ->where('uid', $id)
                                                            ->orderBy('SampleNo', 'DESC')
                                                            ->get();  
            
            $number_of_previous_records = count($previous_records);

            $number_of_passed_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                            ->where('uid', $id)
                                            ->where('ApprovalForUse', "APPROVED")
                                            ->orderBy('SampleNo', 'DESC')->count(); 
            
            $number_of_failed_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                            ->where('uid', $id)
                                            ->where('ApprovalForUse', "REJECTED")
                                            ->orderBy('SampleNo', 'DESC')->count(); 
            
            $number_of_waved_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                            ->where('uid', $id)
                                            ->where('ApprovalForUse', "WAVED")
                                            ->orderBy('SampleNo', 'DESC')->count(); 
            
            $number_of_diff_records_ = \App\Models\FuelTestRecord::whereIn('VendorName', $VendorName)
                                            ->where('uid', $id)
                                            ->where('ApprovalForUse', NULL)
                                            ->count(); 
        }
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
            <div>
                <h1>{{ $title }} ({{ $number_of_previous_records }})</h1>
            </div>
            <div>
                <form action="/export">
                    <button type="submit" name="export">Export to Excel</button>
                </form>
                <a href="{{ route('fuel_test') }}"><button>Add Record +</button></a>                
            </div> 
            @include('ApprovedWavedRejected')
        </center>
        <div>
            <table>
                <tr>
                    <th class="resizable">Days/Weeks/Months </th>
                    <th class="resizable">Sample No. 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortBySampleNo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>    
                    <svg class="filter-sample-no-svg" class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterSampleNo">Filter</button>
                                </center>
                                @foreach($FilterSampleNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleNo[]" value="{{ $filter->SampleNo }}"> {{ $filter->SampleNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="vendors-th resizable">Vendors 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByVendorName">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterVendorName">Filter</button>
                                </center>
                                @foreach($FilterVendorName as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckVendorName[]" value="{{ $filter->VendorName }}"> {{ $filter->VendorName }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Sample Collection Date 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortBySampleCollectionDate">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-sample-collection-date-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-collection-date">
                        <ul>
                            <form action="" method="get">
                                <br> 
                                <p>Select Fields</p>
                                <section>
                                    <li class="date"><span>From</span> <input type="date" name="DateFrom"> </li>
                                    <li class="date"><span>To</span> <input type="date" name="DateTo"> </li>
                                    <button name="FilterDateBetween">Apply</button>
                                </section> <br>
                                <section class="DatesFilter"> 
                                    <input type="hidden" name="RecordsOfToday" value="{{ date('Y-m-d') }}">
                                    <button name="FilterRecordsOfToday">Today</button>
                                </section>
                                <section class="DatesFilter"> 
                                    <input type="hidden" name="RecordsOfYesterday" value="{{ date('Y-m-d', strtotime( '-1 day' )) }}">
                                    <button name="FilterRecordsOfYesterday">Yesterday</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfLastSevenDays">Last Seven Days</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfThisMonth">This Month</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfLastMonth">Last Month</button>
                                </section> <br>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterSampleCollectionDate">Filter</button>
                                </center>
                                @foreach($FilterSampleCollectionDate as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleCollectionDate[]" value="{{ $filter->SampleCollectionDate }}"> {{ $filter->SampleCollectionDate }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Truck Plate No. 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByTruckPlateNo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-truck-plate-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTruckPlateNo">Filter</button>
                                </center>
                                @foreach($FilterTruckPlateNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTruckPlateNo[]" value="{{ $filter->TruckPlateNo }}"> {{ $filter->TruckPlateNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Tank No. 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByTankNo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-tank-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTankNo">Filter</button>
                                </center>
                                @foreach($FilterTankNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTankNo[]" value="{{ $filter->TankNo }}"> {{ $filter->TankNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Appearance Result
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByAppearanceResult">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-appearance-result-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterAppearanceResult">Filter</button>
                                </center>
                                @foreach($FilterAppearanceResult as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckAppearanceResult[]" value="{{ $filter->AppearanceResult }}"> {{ $filter->AppearanceResult }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Color
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByColor">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterColor">Filter</button>
                                </center>
                                @foreach($FilterColor as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckColor[]" value="{{ $filter->Color }}"> {{ $filter->Color }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Density in Kg/m<sup>3</sup>
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByDensity">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-density-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDensity">Filter</button>
                                </center>
                                @foreach($FilterDensity as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDensity[]" value="{{ $filter->Density }}"> {{ $filter->Density }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Flash Point 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByFlashPoint">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-flash-point-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterFlashPoint">Filter</button>
                                </center>
                                @foreach($FilterFlashPoint as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckFlashPoint[]" value="{{ $filter->FlashPoint }}"> {{ $filter->FlashPoint }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Temp °C
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByTemp">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-temp-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTemp">Filter</button>
                                </center>
                                @foreach($FilterTemp as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTemp[]" value="{{ $filter->Temp }}"> {{ $filter->Temp }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Water/Sediment % 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByWaterSediment">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-water-sediment-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterWaterSediment">Filter</button>
                                </center>
                                @foreach($FilterWaterSediment as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckWaterSediment[]" value="{{ $filter->WaterSediment }}"> {{ $filter->WaterSediment }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Cleanliness
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByCleanliness">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form> 
                    <svg class="filter-cleanliness-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterCleanliness">Filter</button>
                                </center>
                                @foreach($FilterCleanliness as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckCleanliness[]" value="{{ $filter->Cleanliness }}"> {{ $filter->Cleanliness }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Date Of Test
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByDateOfTest">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-date-of-test-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDateOfTest">Filter</button>
                                </center>
                                @foreach($FilterDateOfTest as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDateOfTest[]" value="{{ $filter->DateOfTest }}"> {{ $filter->DateOfTest }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Made By (Name)
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByMadeBy">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-made-by-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterMadeBy">Filter</button>
                                </center>
                                @foreach($FilterMadeBy as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckMadeBy[]" value="{{ $filter->MadeBy }}"> {{ $filter->MadeBy }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Delivered To
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByDeliveredTo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-delivered-to-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDeliveredTo">Filter</button>
                                </center>
                                @foreach($FilterDeliveredTo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDeliveredTo[]" value="{{ $filter->DeliveredTo }}"> {{ $filter->DeliveredTo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Remarks
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortByRemarks">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterRemarks">Filter</button>
                                </center>
                                @foreach($FilterRemarks as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckRemarks[]" value="{{ $filter->Remarks }}"> {{ $filter->Remarks }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                </tr>
                @if($number_of_previous_records == 0)
                <tr>
                    <td>
                         Your RECORD is currently empty.. 
                    </td>
                </tr>
                @endif
                @foreach($previous_records as $previous_record) 
                    @if($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-1 day")))
                        <tr class="Yesterday history">
                            <td>Yesterday <span></span> </td>  
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d'))
                        <tr class="Today history">
                            <td>Today <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-2 day")))
                        <tr class="Two-Days-Ago history">
                            <td>Two days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-3 day")))
                        <tr class="Three-Days-Ago history">
                            <td>Three days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-4 day")))
                        <tr class="Four-Days-Ago history">
                            <td>Four days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-5 day")))
                        <tr class="Five-Days-Ago history">
                            <td>Five days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-6 day")))
                        <tr class="Six-Days-Ago history">
                            <td>Six days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 week")))
                        <tr class="Last-Week history">
                            <td>Last week  <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 week")))
                        <tr class="Two-Weeks-Ago history">
                            <td>Two weeks ago    <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-3 week")))
                        <tr class="Three-Weeks-Ago history">
                            <td>Three weeks ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 month")))
                        <tr class="Last-Month history">
                            <td>Last month <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month")))
                        <tr class="Two-Months-Ago history">
                            <td>Two months ago <span></span> </td>
                        </tr>
                    @else($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month - 1 day")))
                        <tr class="Older history">
                            <td>Older  <span></span> </td>
                        </tr>
                    @endif   

                <tr>
                    <td class="pdf-and-edit">
                        <form action="/GenerateCertificate/{{ $previous_record->SampleNo }}" method="post" target="_blank">@csrf
                            <input type="image" src="/images/pdf.png"> 
                            @include('PreviousRecordsCertificateData')                            
                        </form> 
                        <form action="/Edit/{{ $previous_record->SampleNo }}" > 
                            <input type="image" src="/images/edit.png"> 
                            @include('PreviousRecordsCertificateData')   
                        </form> 
                            @if($previous_record->ApprovalForUse === 'APPROVED')
                                <img src="images/approved.png"> <section class="records-tooltip">{{ $previous_record->SampleNo }} <br> [ Passed ]</section> 
                            @endif

                            @if($previous_record->ApprovalForUse === 'REJECTED')
                                <img src="images/rejected.png"> <section class="records-tooltip">{{ $previous_record->SampleNo }} <br> [ Rejected ]</section>  
                            @endif

                            @if($previous_record->ApprovalForUse === 'WAVED')
                                <img src="images/waved.png"> <section class="records-tooltip">{{ $previous_record->SampleNo }} <br> [ Waved ]</section>  
                            @endif
                            
                            @if($previous_record->ApprovalForUse === NULL)
                                <img src="images/diff.png"> <section class="records-tooltip">{{ $previous_record->SampleNo }} <br> [ Diff ]</section>  
                            @endif
                    </td>
                    <td class="sample-no">
                            <form action="/GenerateCertificate/{{ $previous_record->SampleNo }}" method="post" target="_blank">@csrf
                                <label>
                                    @include('PreviousRecordsCertificateData')
                                    {{ $previous_record->SampleNo }}  
                                </label>
                            </form>
                        </td> 
                    </td>
                    <td class="vendors">{{ $previous_record->VendorName }}</td> 
                    <td class="sample-collection-date">{{ $previous_record->SampleCollectionDate }}</td> 
                    <td class="truck-plate-no">{{ $previous_record->TruckPlateNo  }}</td>
                    <td class="tank-no">{{ $previous_record->TankNo }}</td>
                    <td class="appearance-result"><p class="{{ $previous_record->AppearanceResult === 'BRIGHT' ? 'Bright' : '' }}  {{ $previous_record->AppearanceResult === 'Bright' ? 'Bright' : '' }} {{ $previous_record->AppearanceResult === 'MUDDY' ? 'Muddy' : '' }}  {{ $previous_record->AppearanceResult === 'Muddy' ? 'Muddy' : '' }} {{ $previous_record->AppearanceResult === 'CLEAR' ? 'Clear' : '' }}  {{ $previous_record->AppearanceResult === 'Clear' ? 'Clear' : '' }} {{ $previous_record->AppearanceResult === 'C/M' ? 'CM' : '' }} Appearance">{{ $previous_record->AppearanceResult }} </p></td> 
                    <td>{{ str_replace("Choose Color...", "null", $previous_record->Color) }}</td>
                    <td class="density">{{ $previous_record->Density }}</td>
                    <td class="flash-point">{{ $previous_record->FlashPoint }}</td>
                    <td class="temp">{{ $previous_record->Temp }}</td>
                    <td>{{ $previous_record->WaterSediment }} </td>
                    <td>{{ $previous_record->Cleanliness }}</td>
                    <td>{{ $previous_record->DateOfTest }}</td>
                    <td>{{ $previous_record->MadeBy }}</td>
                    <td>{{ $previous_record->DeliveredTo }}</td> 
                    <td class="remarks">{{ substr($previous_record->Remarks, 0, 17) }}{{ strlen($previous_record->Remarks) > 17 ? '..' : '' }}</td> 
                </tr>
                @endforeach 
            </table>
        </div>
    </section>

    <script src="JS/Tooltips.js"></script>
    <script src="JS/Resizable.js"></script>

    <script>
 
        let Filter = document.querySelectorAll('section.previous-records table tr th .filter');
        let FilterSvg = document.querySelectorAll('section.previous-records table tr th svg:last-of-type'); 
        
       document.addEventListener('click', (e) => {                
           for (let i = 0; i < Filter.length; i++) { 
               Filter[i].classList.remove('filter-toggle');  
               e.stopPropagation();
           } 
       });

        for (let i = 0; i < FilterSvg.length; i++) {  
            FilterSvg[i].addEventListener('click', () => { 
                FilterSvg[i].nextElementSibling.classList.toggle('filter-toggle');        
            });
        }

        for (let i = 0; i < FilterSvg.length; i++) {  
            FilterSvg[i].addEventListener('click', (e) => {        
                e.stopPropagation(); 
            });
        } 

        let Yesterday = document.querySelectorAll('section.previous-records table tr.Yesterday');
        let Today = document.querySelectorAll('section.previous-records table tr.Today');
        let TwoDaysAgo = document.querySelectorAll('section.previous-records table tr.Two-Days-Ago');
        let ThreeDaysAgo = document.querySelectorAll('section.previous-records table tr.Three-Days-Ago');
        let FourDaysAgo = document.querySelectorAll('section.previous-records table tr.Four-Days-Ago');
        let FiveDaysAgo = document.querySelectorAll('section.previous-records table tr.Five-Days-Ago');
        let SixDaysAgo = document.querySelectorAll('section.previous-records table tr.Six-Days-Ago');
        let LastWeek = document.querySelectorAll('section.previous-records table tr.Last-Week');
        let TwoWeeksAgo = document.querySelectorAll('section.previous-records table tr.Two-Weeks-Ago');
        let ThreeWeeksAgo = document.querySelectorAll('section.previous-records table tr.Three-Weeks-Ago');
        let LastMonth = document.querySelectorAll('section.previous-records table tr.Last-Month');
        let TwoMonthsAgo = document.querySelectorAll('section.previous-records table tr.Two-Months-Ago');
        let Older = document.querySelectorAll('section.previous-records table tr.Older');
        
        let History = [
            Yesterday,
            Today,
            TwoDaysAgo,
            ThreeDaysAgo,
            FourDaysAgo,
            FiveDaysAgo,
            SixDaysAgo,
            LastWeek,
            TwoWeeksAgo,
            ThreeWeeksAgo,
            LastMonth,
            TwoMonthsAgo,
            Older,
        ]
        
        let HistoryTotal = document.querySelectorAll('section.previous-records table tr.history span');
        let HistoryTotalArray = [];

        for (let i = 0; i < History.length; i++) {
            for (let j = 0; j < History[i].length; j++) { 
                History[i][0].style.display = 'block';
                
                let HistoryTotal_ = History[i].length;
                let HistoryArray = [];
                    HistoryArray.push(HistoryTotal_);
                    HistoryTotalArray.push(HistoryTotal_); 
            } 
        }  

        for (let i = 0; i < HistoryTotal.length; i++) { 
            for (let j = 0; j < HistoryTotalArray.length; j++) {
                HistoryTotal[i].textContent = HistoryTotalArray[i]; 
            }
        }

        let CheckBoxLists = document.querySelectorAll('section.previous-records table tr th .filter ul li');
        
        for (let i = 0; i < CheckBoxLists.length; i++) { 
            CheckBoxLists[i].addEventListener('click', (e) => {
                e.stopPropagation();
                
                if(CheckBoxLists[i].firstElementChild.checked == false) {
                    CheckBoxLists[i].firstElementChild.checked = true; 
                }
                else {
                    if(CheckBoxLists[i].firstElementChild.checked == true) {
                        CheckBoxLists[i].firstElementChild.checked = false; 
                    }   
                } 
            });
        }
        
        let CheckBoxInput = document.querySelectorAll('section.previous-records table tr th .filter ul li input');
        
        for (let i = 0; i < CheckBoxInput.length; i++) { 
            CheckBoxInput[i].addEventListener('click', () => {
                if(CheckBoxInput[i].checked == false) {
                    CheckBoxInput[i].checked = true; 
                }
                else {
                    if(CheckBoxInput[i].checked == true) {
                        CheckBoxInput[i].checked = false; 
                    }   
                } 
            });
        }

    </script>
@endsection 
