@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        <center>
            <h1>{{ $title }} ({{ $number_of_all_records }})</h1>
            <form action="/export">
                <button type="submit" name="export">Export to Excel</button>
            </form>
            <a href="{{ route('fuel_test') }}"><button>Add Record +</button></a>
        </center>
        <div>
            <table>
                <tr> 
                    <th>Days/Weeks/Months </th> 
                    <th>Sample No.
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortBySampleNo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>    
                    <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterSampleNo">Filter</button>
                                </center>
                                @foreach($FilterSampleNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleNo[]" value="{{ $filter->SampleNo }}"> {{ $filter->SampleNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Sample Collection Date 
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortBySampleCollectionDate">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>
                    <svg class="filter-sample-collection-date-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterSampleCollectionDate">Filter</button>
                                </center>
                                @foreach($FilterSampleCollectionDate as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleCollectionDate[]" value="{{ $filter->SampleCollectionDate }}"> {{ $filter->SampleCollectionDate }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Truck Plate No. 
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTruckPlateNo">Filter</button>
                                </center>
                                @foreach($FilterTruckPlateNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTruckPlateNo[]" value="{{ $filter->TruckPlateNo }}"> {{ $filter->TruckPlateNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Tank No. 
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTankNo">Filter</button>
                                </center>
                                @foreach($FilterTankNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTankNo[]" value="{{ $filter->TankNo }}"> {{ $filter->TankNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Appearance Result
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterAppearanceResult">Filter</button>
                                </center>
                                @foreach($FilterAppearanceResult as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckAppearanceResult[]" value="{{ $filter->AppearanceResult }}"> {{ $filter->AppearanceResult }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Color
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterColor">Filter</button>
                                </center>
                                @foreach($FilterColor as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckColor[]" value="{{ $filter->Color }}"> {{ $filter->Color }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Density in Kg/m<sup>3</sup>
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDensity">Filter</button>
                                </center>
                                @foreach($FilterDensity as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDensity[]" value="{{ $filter->Density }}"> {{ $filter->Density }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Flash Point 
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterFlashPoint">Filter</button>
                                </center>
                                @foreach($FilterFlashPoint as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckFlashPoint[]" value="{{ $filter->FlashPoint }}"> {{ $filter->FlashPoint }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Temp °C
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTemp">Filter</button>
                                </center>
                                @foreach($FilterTemp as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTemp[]" value="{{ $filter->Temp }}"> {{ $filter->Temp }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Water/Sediment % 
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterWaterSediment">Filter</button>
                                </center>
                                @foreach($FilterWaterSediment as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckWaterSediment[]" value="{{ $filter->WaterSediment }}"> {{ $filter->WaterSediment }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Cleanliness
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterCleanliness">Filter</button>
                                </center>
                                @foreach($FilterCleanliness as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckCleanliness[]" value="{{ $filter->Cleanliness }}"> {{ $filter->Cleanliness }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Date Of Test
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDateOfTest">Filter</button>
                                </center>
                                @foreach($FilterDateOfTest as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDateOfTest[]" value="{{ $filter->DateOfTest }}"> {{ $filter->DateOfTest }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Made By (Name)
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterMadeBy">Filter</button>
                                </center>
                                @foreach($FilterMadeBy as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckMadeBy[]" value="{{ $filter->MadeBy }}"> {{ $filter->MadeBy }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Delivered To
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDeliveredTo">Filter</button>
                                </center>
                                @foreach($FilterDeliveredTo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDeliveredTo[]" value="{{ $filter->DeliveredTo }}"> {{ $filter->DeliveredTo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th>Remarks
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
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterRemarks">Filter</button>
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
                @if($number_of_all_records == 0)
                <tr>
                    <td>
                         There are no RECORDS.. 
                    </td>
                </tr>
                @endif
                @foreach($all_records as $record)  
                    @if($record->SampleCollectionDate === date('Y-m-d', strtotime("-1 day")))
                        <tr class="Yesterday history">
                            <td>Yesterday <span></span> </td>  
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d'))
                        <tr class="Today history">
                            <td>Today <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-2 day")))
                        <tr class="Two-Days-Ago history">
                            <td>Two days ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-3 day")))
                        <tr class="Three-Days-Ago history">
                            <td>Three days ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-4 day")))
                        <tr class="Four-Days-Ago history">
                            <td>Four days ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-5 day")))
                        <tr class="Five-Days-Ago history">
                            <td>Five days ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-6 day")))
                        <tr class="Six-Days-Ago history">
                            <td>Six days ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 week")))
                        <tr class="Last-Week history">
                            <td>Last week  <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 week")))
                        <tr class="Two-Weeks-Ago history">
                            <td>Two weeks ago    <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-3 week")))
                        <tr class="Three-Weeks-Ago history">
                            <td>Three weeks ago <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 month")))
                        <tr class="Last-Month history">
                            <td>Last month <span></span> </td>
                        </tr>
                    @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month")))
                        <tr class="Two-Months-Ago history">
                            <td>Two months ago <span></span> </td>
                        </tr>
                    @else($record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month - 1 day")))
                        <tr class="Older history">
                            <td>Older  <span></span> </td>
                        </tr>
                    @endif   

                    <tr>  
                        <td class="pdf-and-edit">
                            <form action="/GenerateCertificate/{{ $record->SampleNo }}" method="get" target="_blank">@csrf
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
                        <td class="remarks">{{ $record->Remarks }}</td>
                    </tr>
                @endforeach
            </table> 
            <!-- Pagination links -->
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
                // console.log(HistoryTotalArray[i]);
            }
        }

        let CheckBoxLists = document.querySelectorAll('section.previous-records table tr th .filter ul li');
        
        for (let i = 0; i < CheckBoxLists.length; i++) { 
            CheckBoxLists[i].addEventListener('click', () => {
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