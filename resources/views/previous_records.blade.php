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
                    <th>Sample No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-sample-no-svg" class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Sample Collection Date <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-sample-collection-date-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-collection-date">
                        <ul>
                            <form action="" method="get">
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
                    <th>Truck Plate No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-truck-plate-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Tank No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-tank-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Appearance Result <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-appearance-result-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Color <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Density in Kg/m<sup>3</sup> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-density-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Flash Point <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-flash-point-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Temp °C <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-temp-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Water/Sediment %  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-water-sediment-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Cleanliness <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-cleanliness-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Date Of Test <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-date-of-test-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Made By (Name) <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-made-by-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Delivered To <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-delivered-to-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <th>Remarks <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
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
                    <td class="remarks">{{ $previous_record->Remarks }}</td> 
                </tr>
                @endforeach 
            </table>
        </div>
    </section>

    <script>

        let Filter = document.querySelectorAll('section.previous-records table tr th .filter');
        let FilterSvg = document.querySelectorAll('section.previous-records table tr th svg:last-of-type'); 

        for (let i = 0; i < FilterSvg.length; i++) {  
            FilterSvg[i].addEventListener('click', () => {
                FilterSvg[i].nextElementSibling.classList.toggle('filter-toggle');  
            });
        }

        for (let i = 0; i < Filter.length; i++) {  
            Filter[i].addEventListener('mouseleave', () => {
                Filter[i].classList.toggle('filter-toggle');
            });
        } 

    </script>
@endsection 
