@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    @include('ShowRecord')
    @php 
        include '../resources/views/Breakdowns.php';
    @endphp
    
    @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'login_page')
        <div class="log-in-alert alert">You are LOGGED IN</div>
    @endif
    <section class="previous-records">
        @include('PageTitleForRecords')
        <div class="table">
            <form class="DeleteRecords_" action="">
            <table>
                <tr> 
                    <th class="resizable">Days/Weeks/Months </th> 
                    <th class="resizable">Sample No.
                    <form action="" method="get">
                        <label>
                            <input type="submit" name="SortBySampleNo" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    </form>    
                    <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Sample Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterSampleNo">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterSampleNo as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckSampleNo[]" value="{{ $filter->SampleNo }}"> {{ $filter->SampleNo }}
                                        </li>   
                                    @endforeach
                                </section>
                            </form>
                        </ul>
                    </div></th>
                    <th class="vendors resizable">Vendors 
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
                                <h1>Vendor Catalogue</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterVendorName">Filter</button>
                                </center>
                                @foreach($FilterVendorName as $filter)
                                    @if ($filter->VendorName === NULL)
                                        @continue
                                    @endif
                                        <li>
                                            <input type="checkbox" name="CheckVendorName[]" value="{{ $filter->VendorName }}"> {{ $filter->VendorName }}
                                        </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    @if(Session::get('Role') === 'ADMIN') 
                    <th class="resizable">
                        Action
                    </th>
                    @endif
                    <th class="resizable">Sample Collection Date 
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
                                <br> 
                                <p>Select Fields</p> <br>
                                <span><center>Select range to genaerate your Fuel Test Report.</center></span>
                                <section>
                                    <li class="date"><span>From</span> <input type="date" name="DateFrom"> </li>
                                    <li class="date"><span>To</span> <input type="date" name="DateTo"> </li>
                                    <input type="hidden" name="Title" value="{{ $title }}">
                                    <button name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) ? 'FilterDateBetweenForCurrentVendor' : 'FilterDateBetween' }}">Generate Report</button>
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
                                <h1>Collection Dates</h1> 
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterSampleCollectionDate">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterSampleCollectionDate as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckSampleCollectionDate[]" value="{{ $filter->SampleCollectionDate }}"> {{ $filter->SampleCollectionDate }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Truck Plate Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTruckPlateNo">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterTruckPlateNo as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckTruckPlateNo[]" value="{{ $filter->TruckPlateNo }}"> {{ $filter->TruckPlateNo }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Tank Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTankNo">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterTankNo as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckTankNo[]" value="{{ $filter->TankNo }}"> {{ $filter->TankNo }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Appearance Result</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterAppearanceResult">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterAppearanceResult as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckAppearanceResult[]" value="{{ $filter->AppearanceResult }}"> {{ $filter->AppearanceResult }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Colors</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterColor">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterColor as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckColor[]" value="{{ $filter->Color }}"> {{ $filter->Color }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Density</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDensity">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterDensity as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckDensity[]" value="{{ $filter->Density }}"> {{ $filter->Density }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Flash Point</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterFlashPoint">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterFlashPoint as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckFlashPoint[]" value="{{ $filter->FlashPoint }}"> {{ $filter->FlashPoint }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Temperature</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterTemp">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterTemp as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckTemp[]" value="{{ $filter->Temp }}"> {{ $filter->Temp }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Water Sediment</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterWaterSediment">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterWaterSediment as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckWaterSediment[]" value="{{ $filter->WaterSediment }}"> {{ $filter->WaterSediment }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Cleanliness</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterCleanliness">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterCleanliness as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckCleanliness[]" value="{{ $filter->Cleanliness }}"> {{ $filter->Cleanliness }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Date of Test</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDateOfTest">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterDateOfTest as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckDateOfTest[]" value="{{ $filter->DateOfTest }}"> {{ $filter->DateOfTest }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Made By</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterMadeBy">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterMadeBy as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckMadeBy[]" value="{{ $filter->MadeBy }}"> {{ $filter->MadeBy }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Delivered To</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterDeliveredTo">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterDeliveredTo as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckDeliveredTo[]" value="{{ $filter->DeliveredTo }}"> {{ $filter->DeliveredTo }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                <h1>Remarks</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('all_records') }}">Cancel</a></button> <button name="FilterRemarks">Filter</button>
                                </center>
                                <section>
                                    @foreach($FilterRemarks as $filter)
                                        <li>
                                            <input type="checkbox" name="CheckRemarks[]" value="{{ $filter->Remarks }}"> {{ $filter->Remarks }}
                                        </li>   
                                    @endforeach
                                </section>
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
                                @php
                                    
                                     $number_of_yesterdays_records = App\Models\FuelTestRecord::where('SampleCollectionDate', date('Y-m-d', strtotime("-1 day")))
                                                                                                ->count();

                                @endphp
                                <td>Yesterday <span>{{ $NumberOfRecordsYesterday }} (100%)</span> </td> 
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsYesterday }} ({{ round($PercentageOfApprovedRecordsYesterday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsYesterday_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsYesterday }} ({{ round($PercentageOfWaivedRecordsYesterday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsYesterday_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsYesterday }} ({{ round($PercentageOfRejectedRecordsYesterday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsYesterday_Absolute, 1) }}%</em></td> 
                            </tr> 
                        @elseif($record->SampleCollectionDate === date('Y-m-d')) 
                            <tr class="Today history">
                                @php
                                    
                                     $number_of_todays_records = App\Models\FuelTestRecord::where('SampleCollectionDate', date('Y-m-d'))
                                                                                            ->count();

                                @endphp
                                <td>Today <span>{{ $number_of_todays_records }} (100%)</span></td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsToday }} ({{ round($PercentageOfApprovedRecordsToday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsToday_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsToday }} ({{ round($PercentageOfWaivedRecordsToday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsToday_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsToday }} ({{ round($PercentageOfRejectedRecordsToday, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsToday_Absolute, 1) }}%</em></td> 
                            </tr>
                        @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-2 day"))) 
                            <tr class="Two-Days-Ago history"> 
                                <td>Two days ago <span>{{ $NumberOfRecordsTwoDaysAgo }} (100%)</span></td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsTwoDaysAgo }} ({{ round($PercentageOfApprovedRecordsTwoDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsTwoDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsTwoDaysAgo }} ({{ round($PercentageOfWaivedRecordsTwoDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsTwoDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsTwoDaysAgo }} ({{ round($PercentageOfRejectedRecordsTwoDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsTwoDaysAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-3 day"))) 
                            <tr class="Three-Days-Ago history"> 
                                <td>Three days ago <span>{{ $NumberOfRecordsThreeDaysAgo }} (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsThreeDaysAgo }} ({{ round($PercentageOfApprovedRecordsThreeDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsThreeDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsThreeDaysAgo }} ({{ round($PercentageOfWaivedRecordsThreeDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsThreeDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsThreeDaysAgo }} ({{ round($PercentageOfRejectedRecordsThreeDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsThreeDaysAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-4 day"))) 
                            <tr class="Four-Days-Ago history"> 
                                <td>Four days ago <span>{{ $NumberOfRecordsFourDaysAgo }} (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsFourDaysAgo }} ({{ round($PercentageOfApprovedRecordsFourDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsFourDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsFourDaysAgo }} ({{ round($PercentageOfWaivedRecordsFourDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsFourDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsFourDaysAgo }} ({{ round($PercentageOfRejectedRecordsFourDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsFourDaysAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-5 day"))) 
                            <tr class="Five-Days-Ago history"> 
                                <td>Five days ago <span>{{ $NumberOfRecordsFiveDaysAgo }} (100%)</span></td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsFiveDaysAgo }} ({{ round($PercentageOfApprovedRecordsFiveDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsFiveDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsFiveDaysAgo }} ({{ round($PercentageOfWaivedRecordsFiveDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsFiveDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsFiveDaysAgo }} ({{ round($PercentageOfRejectedRecordsFiveDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsFiveDaysAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate === date('Y-m-d', strtotime("-6 day"))) 
                            <tr class="Six-Days-Ago history"> 
                                <td>Six days ago <span>{{ $NumberOfRecordsSixDaysAgo }} (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsSixDaysAgo }} ({{ round($PercentageOfApprovedRecordsSixDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsSixDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsSixDaysAgo }} ({{ round($PercentageOfWaivedRecordsSixDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsSixDaysAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsSixDaysAgo }} ({{ round($PercentageOfRejectedRecordsSixDaysAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsSixDaysAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 week"))) 
                            <tr class="Last-Week history"> 
                                <td>Last week  <span>{{ $NumberOfRecordsOneWeekAgo }}  (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsOneWeekAgo }} ({{ round($PercentageOfApprovedRecordsOneWeekAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfApprovedRecordsOneWeekAgo_Absolute, 1) }}%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsOneWeekAgo }} ({{ round($PercentageOfWaivedRecordsOneWeekAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfWaivedRecordsOneWeekAgo_Absolute, 1) }}%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsOneWeekAgo }} ({{ round($PercentageOfRejectedRecordsOneWeekAgo, 1) }})%</em> <em>&nbsp;+  {{ round($PercentageOfRejectedRecordsOneWeekAgo_Absolute, 1) }}%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 week")))
                        @php
                            $NumberOfApprovedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'APPROVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfWaivedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'WAIVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRejectedRecordsTwoWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'REJECTED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRecordsTwoWeeksAgo = $NumberOfApprovedRecordsTwoWeeksAgo + $NumberOfWaivedRecordsTwoWeeksAgo + $NumberOfRejectedRecordsTwoWeeksAgo;

                            $PercentageOfApprovedRecordsTwoWeeksAgo = $NumberOfApprovedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100;
                            $PercentageOfWaivedRecordsTwoWeeksAgo = $NumberOfWaivedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100;
                            $PercentageOfRejectedRecordsTwoWeeksAgo = $NumberOfRejectedRecordsTwoWeeksAgo / $NumberOfRecordsTwoWeeksAgo * 100;
                        @endphp
                            <tr class="Two-Weeks-Ago history"> 
                                <td>Two weeks ago    <span>{{ $NumberOfRecordsTwoWeeksAgo }}  (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsTwoWeeksAgo }} ({{ round($PercentageOfApprovedRecordsTwoWeeksAgo, 1) }})%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsTwoWeeksAgo }} ({{ round($PercentageOfWaivedRecordsTwoWeeksAgo, 1) }})%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsTwoWeeksAgo }} ({{ round($PercentageOfRejectedRecordsTwoWeeksAgo, 1) }})%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-3 week")))
                        @php
                            $NumberOfApprovedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'APPROVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfWaivedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'WAIVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRejectedRecordsThreeWeeksAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'REJECTED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 week")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRecordsThreeWeeksAgo = $NumberOfApprovedRecordsThreeWeeksAgo + $NumberOfWaivedRecordsThreeWeeksAgo + $NumberOfRejectedRecordsThreeWeeksAgo;

                            $PercentageOfApprovedRecordsThreeWeeksAgo = $NumberOfApprovedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100;
                            $PercentageOfWaivedRecordsThreeWeeksAgo = $NumberOfWaivedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100;
                            $PercentageOfRejectedRecordsThreeWeeksAgo = $NumberOfRejectedRecordsThreeWeeksAgo / $NumberOfRecordsThreeWeeksAgo * 100;
                        @endphp
                            <tr class="Three-Weeks-Ago history"> 
                                <td>Three weeks ago <span>{{ $NumberOfRecordsThreeWeeksAgo }}  (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsThreeWeeksAgo }} ({{ round($PercentageOfApprovedRecordsThreeWeeksAgo, 1) }})%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsThreeWeeksAgo }} ({{ round($PercentageOfWaivedRecordsThreeWeeksAgo, 1) }})%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsThreeWeeksAgo }} ({{ round($PercentageOfRejectedRecordsThreeWeeksAgo, 1) }})%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 month")))
                        @php
                            $NumberOfApprovedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'APPROVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
                                                                                            ->count();
                                                                                            
                            $NumberOfWaivedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'WAIVED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRejectedRecordsOneMonthAgo = \App\Models\FuelTestRecord::select('id')
                                                                                            ->where('ApprovalForUse', 'REJECTED')
                                                                                            ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-1 month")))
                                                                                            ->count();
                                                                                            
                            $NumberOfRecordsOneMonthAgo = $NumberOfApprovedRecordsOneMonthAgo + $NumberOfWaivedRecordsOneMonthAgo + $NumberOfRejectedRecordsOneMonthAgo;

                            $PercentageOfApprovedRecordsOneMonthAgo = $NumberOfApprovedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100;
                            $PercentageOfWaivedRecordsOneMonthAgo = $NumberOfWaivedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100;
                            $PercentageOfRejectedRecordsOneMonthAgo = $NumberOfRejectedRecordsOneMonthAgo / $NumberOfRecordsOneMonthAgo * 100;
                        @endphp
                            <tr class="Last-Month history"> 
                                <td>Last month <span>{{ $NumberOfRecordsOneMonthAgo }}  (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsOneMonthAgo }} ({{ round($PercentageOfApprovedRecordsOneMonthAgo, 1) }})%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsOneMonthAgo }} ({{ round($PercentageOfWaivedRecordsOneMonthAgo, 1) }})%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsOneMonthAgo }} ({{ round($PercentageOfRejectedRecordsOneMonthAgo, 1) }})%</em></td>
                            </tr>
                        @elseif($record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month")))
                            @php
                                $NumberOfApprovedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'APPROVED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
                                                                                                ->count();
                                                                                                
                                $NumberOfWaivedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'WAIVED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
                                                                                                ->count();
                                                                                                
                                $NumberOfRejectedRecordsTwoMonthsAgo = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'REJECTED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-2 month")))
                                                                                                ->count();
                                                                                            
                            $NumberOfRecordsTwoMonthsAgo = $NumberOfApprovedRecordsTwoMonthsAgo + $NumberOfWaivedRecordsTwoMonthsAgo + $NumberOfRejectedRecordsTwoMonthsAgo;

                            $PercentageOfApprovedRecordsTwoMonthsAgo = $NumberOfApprovedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100;
                            $PercentageOfWaivedRecordsTwoMonthsAgo = $NumberOfWaivedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100;
                            $PercentageOfRejectedRecordsTwoMonthsAgo = $NumberOfRejectedRecordsTwoMonthsAgo / $NumberOfRecordsTwoMonthsAgo * 100;
                            @endphp
                            <tr class="Two-Months-Ago history"> 
                                <td>Two months ago <span>{{ $NumberOfRecordsTwoMonthsAgo }}  (100%)</span></td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsTwoMonthsAgo }} ({{ round($PercentageOfApprovedRecordsTwoMonthsAgo, 1) }})%</em></td>
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsTwoMonthsAgo }} ({{ round($PercentageOfWaivedRecordsTwoMonthsAgo, 1) }})%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsTwoMonthsAgo }} ({{ round($PercentageOfRejectedRecordsTwoMonthsAgo, 1) }})%</em></td>
                            </tr> 
                        @else
                            @php
                                $NumberOfApprovedRecordsOlder = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'APPROVED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
                                                                                                ->count();
                                                                                                
                                $NumberOfWaivedRecordsOlder = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'WAIVED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
                                                                                                ->count();
                                                                                                
                                $NumberOfRejectedRecordsOlder = \App\Models\FuelTestRecord::select('id')
                                                                                                ->where('ApprovalForUse', 'REJECTED')
                                                                                                ->where('SampleCollectionDate', '>=', date('Y-m-d', strtotime("-3 month")))
                                                                                                ->count();
                                                                                            
                            $NumberOfRecordsOlder = $NumberOfApprovedRecordsOlder + $NumberOfWaivedRecordsOlder + $NumberOfRejectedRecordsOlder;

                            $PercentageOfApprovedRecordsOlder = $NumberOfApprovedRecordsOlder / $NumberOfRecordsOlder * 100;
                            $PercentageOfWaivedRecordsOlder = $NumberOfWaivedRecordsOlder / $NumberOfRecordsOlder * 100;
                            $PercentageOfRejectedRecordsOlder = $NumberOfRejectedRecordsOlder / $NumberOfRecordsOlder * 100;
                            @endphp
                            <tr class="Older history"> 
                                <td>Older  <span>{{ $NumberOfRecordsOlder }}  (100%)</span> </td>
                                <td><p>Approved =></p> <em class="Passed">{{ $NumberOfApprovedRecordsOlder }} ({{ round($PercentageOfApprovedRecordsOlder, 1) }})%</em></td> 
                                <td><p>Waived =></p> <em class="Waved">{{ $NumberOfWaivedRecordsOlder }} ({{ round($PercentageOfWaivedRecordsOlder, 1) }})%</em></td>
                                <td><p>Rejected =></p> <em class="Failed">{{ $NumberOfRejectedRecordsOlder }} ({{ round($PercentageOfRejectedRecordsOlder, 1) }})%</em></td>
                            </tr>
                        @endif   

                    <tr class="rows">  
                        <td class="pdf-and-edit">
                            <form action="/GenerateCertificate/{{ $record->SampleNo }}" method="post" target="_blank">@csrf
                                <input type="image" src="/images/pdf.png"> 
                                @include('DATA.CertificateData')                            
                            </form> 
                            <form class="GenerateChart" action="{{ route('fuel_test_stats') }}" method="get">
                                <label>
                                    <input class="hide" type="submit" src="/images/approved.png" name="GenerateChartForCurrentVendor" value="{{ $record->VendorNo }}"> 
                                    <img src="/images/chart.png">
                                </label>
                            </form>
                            @if($record->ApprovalForUse === 'APPROVED')
                                <img src="images/approved.png"> <section class="records-tooltip tooltip">{{ $record->SampleNo }} <br> [ Passed ]</section>  
                            @endif
                            
                            @if($record->ApprovalForUse === 'REJECTED')
                                <img src="images/rejected.png"> <section class="records-tooltip tooltip">{{ $record->SampleNo }} <br> [ Failed ]</section>  
                            @endif

                            @if($record->ApprovalForUse === 'WAIVED')
                                <img src="images/waved.png"> <section class="records-tooltip tooltip">{{ $record->SampleNo }} <br> [ Waived ]</section>  
                            @endif

                            @if($record->ApprovalForUse === NULL)
                                <img src="images/diff.png"> <section class="records-tooltip tooltip">{{ $record->SampleNo }} <br> [ Diff ]</section>  
                            @endif
                            <section class="time">
                                ({{ empty($record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at)->format('H:i A') }})
                            </section>
                        </td> 
                        <td class="sample-no">
                            <form action="">
                                <label class="LoaderElement">
                                    @include('DATA.CertificateData')
                                    {{ $record->SampleNo }} 
                                </label>
                                <section class="records-tooltip tooltip">{{ $record->SampleNo }} <br> <hr> Created at {{ empty($record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at)->format('H:i A') }}</section> 
                            </form> 
                        </td>
                        <td class="vendors">
                            <form action="">
                                <label class="LoaderElement">
                                    @include('DATA.CertificateData')
                                    {{ $record->VendorName }} 
                                </label>
                            </form>
                            <section class="records-tooltip tooltip">  
                                @include('SwitchCases.SwitchCasesForVendors')  
                            </section>
                        </td>
                        @if(Session::get('Role') === 'ADMIN') 
                        <td class="action"> 
                            <input type="checkbox" name="DeleteRecord[]" value="{{ $record->id }}">
                        </td>
                        @endif
                        <td class="sample-collection-date">{{ $record->SampleCollectionDate }} ({{ empty($record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->created_at)->format('H:i A') }})</td>
                        <td class="truck-plate-no">{{ $record->TruckPlateNo }}</td>
                        <td class="tank-no">{{ $record->TankNo }}</td>
                        <td class="appearance-result"><p class="{{ $record->AppearanceResult === 'BRIGHT' ? 'Bright' : '' }}  {{ $record->AppearanceResult === 'Bright' ? 'Bright' : '' }} {{ $record->AppearanceResult === 'MUDDY' ? 'Muddy' : '' }}  {{ $record->AppearanceResult === 'Muddy' ? 'Muddy' : '' }} {{ $record->AppearanceResult === 'CLEAR' ? 'Clear' : '' }}  {{ $record->AppearanceResult === 'Clear' ? 'Clear' : '' }} {{ $record->AppearanceResult === 'C/M' ? 'CM' : '' }} Appearance">{{ $record->AppearanceResult }} </p></td>
                        <td>{{ str_replace("Choose Color...", "null", $record->Color) }}</td>
                        <td class="density">{{ $record->Density }}</td>
                        <td class="flash-point">{{ $record->FlashPoint }}</td>
                        <td class="temp">{{ $record->Temp }}</td>
                        <td>{{ $record->WaterSediment }} </td>
                        <td>{{ $record->Cleanliness }}</td>
                        <td>{{ $record->DateOfTest }}</td>
                        <td>{{ $record->MadeBy }}</td>
                        <td>{{ $record->DeliveredTo }}</td>  
                        <td class="remarks">{{ substr($record->Remarks, 0, 17) }}{{ strlen($record->Remarks) > 17 ? '..' : '' }}</td>
                    </tr>
                @endforeach 
                <div class="links">  
                    {{ $all_records->onEachSide(1)->links() }}   
                </div>   
            </table> 
            @if(Session::get('Role') === 'ADMIN') 
            <button type="submit" name="Delete_">Delete</button>
            @endif
            </form>
        </div>
    </section>

    <script src="/JS/Alert.js"></script>  
    <script src="JS/Tooltips.js"></script>
    <script src="JS/Resizable.js"></script> 
    <script src="JS/Records/Scripts.js"></script> 

@endsection