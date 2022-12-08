@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')  

<style>

    .fuel-test {
        display: contents !important;
    } 
    
    .fuel-test-dashboard-inner canvas {
        width: unset !important;
    }
    
    .fuel-test-left-nav {
        display: none;   
    } 

</style>

@php include '../resources/views/Months.php'; @endphp

<div class="insights"> 
    @include('PageTitle')
    @isset($_GET['GenerateChartForCurrentVendor'])
        <div class="Title">
            <h1>DIESEL FUEL ANALYSIS REPORT</h1>
            <img src="/images/depasa-logo.png">
            <h2>{!! $CurrentVendorName !!}</h2>
            <h2>{{ $CurrentVendorNo }}</h2>
        </div>
    @endisset 
    @isset($_GET['RevealVendors'])
        <div class="Title">
            <h1>{{ $_GET['RevealVendors'] }} ACTIVE VENDORS</h1>
            <img src="/images/depasa-logo.png"> 
        </div>
    @endisset 
    <div id="fuel-test-dashboard" class="{{ isset($_GET['RevealVendors']) ? 'reveal-vendors-padding-top' : '' }}"> 
        <div class="fuel-test-dashboard-inner filter-vendor-stats">
            <form action="" method="get">
                <p>(Filter Test Analysis) || From : <input type="date" name="VendorStatsFrom"></p>
                <p>To : <input type="date" name="VendorStatsTo"></p>
                <section>
                    <button name="FilterVendorStats">GO</button>
                    <button name="ClearFilterVendorStats">Reset</button>
                </section>
            </form>
            @if (isset($_GET['FilterVendorStats']))
                @php
                    $VendorStatsFrom = $_GET['VendorStatsFrom'];
                    $VendorStatsTo = $_GET['VendorStatsTo'];
                @endphp

                <p><center>Showing Test ANALYSIS for VENDORS by Filtered Date from {{ $VendorStatsFrom }} to {{ $VendorStatsTo }}.</center></p>
            @endif
        </div>             
        @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
            <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }} {{ isset($_GET['GenerateChartForCurrentVendor']) ? '' : 'analysis' }}"> 
                <canvas width="1000" height="550" id="myChart6" class="{{ $Visibility }}"></canvas> 
                <div>
                    @php                    
                        $NumberOfTotalRecordsForEachVendorArr = [];
                    @endphp

                    @foreach ($absolute_vendors as $Vendor)
                        @php
                            include('../resources/views/DATA/Queries/NumberOfRecordsData.php'); 

                            if($NumberOfTotalRecordsForEachVendor === 0 AND $NumberOfApprovedRecordsForEachVendor === 0 AND $NumberOfWavedRecordsForEachVendor === 0 AND $NumberOfRejectedRecordsForEachVendor === 0) {  
                                continue;
                            }  

                            array_push($NumberOfTotalRecordsForEachVendorArr, $NumberOfTotalRecordsForEachVendor);    
                        @endphp 
                    @endforeach

                    @php 
                    
                        $VendorsWithSupplyStatus = count($NumberOfTotalRecordsForEachVendorArr); 
                        $PercentageOfVendorsWithSupplyStatus = $VendorsWithSupplyStatus / $number_of_vendors * 100;                                                           

                    @endphp

                    <h1>VENDOR STATS</h1>
                    <form action="">
                        <label>
                            <input type="hidden" value="{{ $VendorsWithSupplyStatus }}" name="RevealVendors"> 
                            <input class="hide" type="submit">   
                            <span class="reveal-vendors">Reveal Vendors</span>
                        </label>
                    </form>

                    <p><span>Total Number of Vendors</span> => &nbsp;&nbsp; <span>{{ $number_of_vendors_absolute }} (100%)</span></p> 
                    <p><span>Vendors with Supply Status *</span> => &nbsp;&nbsp; <span>{{ $VendorsWithSupplyStatus }} ({{ round($PercentageOfVendorsWithSupplyStatus) }}%)</span></p>  
                </div> 
            </div>
        @endif 
        <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }}">
            <canvas id="myChart" style="width:100%;min-width:700px"></canvas>
            @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
                <div>
                    <h1>OVERALL SUPPLY</h1>
                    <p><span>Total Number of FUEL Supplied</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_absolute }} (100%)</span></p> 
                    <p><span>Tests with FAILED Results</span> => &nbsp;&nbsp; <span class="Failed">{{ $number_of_failed_records }} ({{ round($AbsolutePercentageOfFailedRecords) }}%)</span></p> 
                    <p><span>Tests with PASSED Results</span> => &nbsp;&nbsp; <span class="Passed">{{ $number_of_passed_records }} ({{ round($AbsolutePercentageOfPassedRecords) }}%)</span></p>
                    <p><span>Tests Approved on a WAIVER</span> => &nbsp;&nbsp; <span class="Waved">{{ $number_of_waved_records }} ({{ round($AbsolutePercentageOfWavedRecords) }}%)</span></p> 
                </div> 
            @endif
            @isset($_GET['GenerateChartForCurrentVendor'])
                <div>
                    <h1>BREAKDOWN</h1>
                    <p><span>Total Number of FUEL Supplied</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records }} (100%)</span></p> 
                    <p><span>Tests with FAILED Results</span> => &nbsp;&nbsp; <span class="Failed">{{ $number_of_failed_records }} ({{ round($PercentageOfFailedRecords) }}%)</span></p> 
                    <p><span>Tests with PASSED Results</span> => &nbsp;&nbsp; <span class="Passed">{{ $number_of_passed_records }} ({{ round($PercentageOfPassedRecords) }}%)</span></p>
                    <p><span>Tests Approved on a WAIVER</span> => &nbsp;&nbsp; <span class="Waved">{{ $number_of_waved_records }} ({{ round($PercentageOfWavedRecords) }}%)</span></p>
                    <p><span>Identification No.</span> => &nbsp;&nbsp; <span>{{ $CurrentVendorNo }}</span></p>
                    <p><span>First Supply Date *</span> => &nbsp;&nbsp; <span>{{ $FirstSupplyDate }}</span></p>
                    <p><span>Recent Supply Date *</span> => &nbsp;&nbsp; <span>{{ $RecentSupplyDate }}</span></p>
                </div> 
                <div>
                    <p>
                        <span class='aggregate'>AGGREGATE [Overall Supply]</span> : : : &nbsp;&nbsp; <span>{{ $number_of_failed_records + $number_of_passed_records + $number_of_waved_records }}</span>
                    </p>
                </div>
            @endisset
        </div>
        <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }}">
            <!-- <h1>Recent</h1> -->
            <canvas id="myChart2" style="width:100%;min-width:700px"></canvas>
            @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
                <div>
                    <h1>BREAKDOWN</h1>
                    <p><span>FUEL Supplied Last Month</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_month }} ({{ round($AbsolutePercentageOfNumberOfRecordsLastMonth, 2) }}%)</span></p> 
                    <p><span>FUEL Supplied This Month</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_this_month }} ({{ round($AbsolutePercentageOfAllRecordsThisMonth, 2) }}%)</span></p> 
                    <p><span>FUEL Supplied Last 7 Days</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_seven_days }} ({{ round($AbsolutePercentageOfNumberOfRecordsLastSevenDays, 2) }}%)</span></p>                      
                </div> 
            @endif
            @isset($_GET['GenerateChartForCurrentVendor'])
                <div>
                    <h1>BREAKDOWN</h1>
                    <p><span>FUEL Supplied Last Month</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_month }} ({{ round($PercentageOfNumberOfRecordsLastMonth, 2) }}%)</span></p> 
                    <p><span>FUEL Supplied This Month</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_this_month }} ({{ round($PercentageOfAllRecordsThisMonth, 2) }}%)</span></p> 
                    <p><span>FUEL Supplied Last 7 Days</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_seven_days }} ({{ round($PercentageOfNumberOfRecordsLastSevenDays, 2) }}%)</span></p> 
                    <p><span>Identification No.</span> => &nbsp;&nbsp; <span>{{ $CurrentVendorNo }}</span></p>
                    <p><span>First Supply Date *</span> => &nbsp;&nbsp; <span>{{ $FirstSupplyDate }}</span></p>
                    <p><span>Recent Supply Date *</span> => &nbsp;&nbsp; <span>{{ $RecentSupplyDate }}</span></p>
                </div> 
                <div>
                    <p>
                        <span class='aggregate'>AGGREGATE [Overall Supply]</span> : : : &nbsp;&nbsp; <span>{{ $number_of_all_records_last_month + $number_of_all_records_this_month + $number_of_all_records_last_seven_days }}</span>
                    </p>
                </div>
            @endisset
        </div>    
        <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }}">
            <!-- <h1>Monthly</h1> refactor -->
            <canvas id="myChart3" style="width:100%;min-width:700px"></canvas>
            @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
                <div>
                    <h1>BREAKDOWN</h1>
                    @for($i = 1; $i < count($MonthNames); $i++)
                        <p><span>{{ $MonthNames[$i] }}</span> => &nbsp;&nbsp; <span>{{ $TotalNumberOfRecordsForEachMonth[$i] }} ({{ round($AbsolutePercentageOfAllRecordsForEachMonth[$i], 1) }}%)</span></p> 
                    @endfor 
                </div> 
            @endif
            @isset($_GET['GenerateChartForCurrentVendor'])
                <div>
                    <h1>BREAKDOWN</h1>
                    @for($i = 1; $i < count($MonthNames); $i++)
                        <p><span>{{ $MonthNames[$i] }}</span> => &nbsp;&nbsp; <span>{{ $TotalNumberOfRecordsForEachMonth_[$i] }} ({{ round(${"PercentageOfAllRecordsIn" . $MonthNames[$i]}, 1) }}%)</span></p> 
                    @endfor  
                    <p><span>Identification No.</span> => &nbsp;&nbsp; <span>{{ $CurrentVendorNo }}</span></p>
                    <p><span>First Supply Date *</span> => &nbsp;&nbsp; <span>{{ $FirstSupplyDate }}</span></p>
                    <p><span>Recent Supply Date *</span> => &nbsp;&nbsp; <span>{{ $RecentSupplyDate }}</span></p>
                </div> 
                <div>
                    <p>
                        <span class='aggregate'>AGGREGATE [Overall Supply]</span> : : : &nbsp;&nbsp; <span>{{ $TotalNumberOfRecordsForEachMonth_[1] + $TotalNumberOfRecordsForEachMonth_[2] + $TotalNumberOfRecordsForEachMonth_[3] + $TotalNumberOfRecordsForEachMonth_[4] + $TotalNumberOfRecordsForEachMonth_[5] + $TotalNumberOfRecordsForEachMonth_[6] + $TotalNumberOfRecordsForEachMonth_[7] + $TotalNumberOfRecordsForEachMonth_[8] + $TotalNumberOfRecordsForEachMonth_[9] + $TotalNumberOfRecordsForEachMonth_[10] + $TotalNumberOfRecordsForEachMonth_[11] + $TotalNumberOfRecordsForEachMonth_[12] }}</span>
                    </p>
                </div>
            @endisset
        </div>
        <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }}"> 
            <canvas id="myChart4" style="width:100%;min-width:700px"></canvas>
            @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
                <div>
                    <h1>BREAKDOWN</h1>
                    <p><span>FUEL Supplied Today</span> => &nbsp;&nbsp; <span>{{ $number_of_todays_records }} ({{ round($AbsolutePercentageOfAllRecordsToday, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied Yesterday</span> => &nbsp;&nbsp; <span>{{ $number_of_yesterday_records }} ({{ round($AbsolutePercentageOfAllRecordsYesterday, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied Day Before</span> => &nbsp;&nbsp; <span>{{ $number_of_two_days_ago_records }} ({{ round($AbsolutePercentageOfAllRecordsTwoDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 3 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_three_days_ago_records }} ({{ round($AbsolutePercentageOfAllRecordsThreeDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 4 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_four_days_ago_records }} ({{ round($AbsolutePercentageOfAllRecordsFourDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 5 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_five_days_ago_records }} ({{ round($AbsolutePercentageOfAllRecordsFiveDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 6 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_six_days_ago_records }} ({{ round($AbsolutePercentageOfAllRecordsSixDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 1 week Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_seven_days }} ({{ round($AbsolutePercentageOfNumberOfRecordsLastSevenDays, 3) }}%)</span></p>  
                </div> 
            @endif
            @isset($_GET['GenerateChartForCurrentVendor'])
                <div>
                    <h1>BREAKDOWN</h1>
                    <p><span>FUEL Supplied Today</span> => &nbsp;&nbsp; <span>{{ $number_of_todays_records }} ({{ round($PercentageOfAllRecordsToday, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied Yesterday</span> => &nbsp;&nbsp; <span>{{ $number_of_yesterday_records }} ({{ round($PercentageOfAllRecordsYesterday, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied Day Before</span> => &nbsp;&nbsp; <span>{{ $number_of_two_days_ago_records }} ({{ round($PercentageOfAllRecordsTwoDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 3 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_three_days_ago_records }} ({{ round($PercentageOfAllRecordsThreeDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 4 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_four_days_ago_records }} ({{ round($PercentageOfAllRecordsFourDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 5 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_five_days_ago_records }} ({{ round($PercentageOfAllRecordsFiveDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 6 Days Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_six_days_ago_records }} ({{ round($PercentageOfAllRecordsSixDaysAgo, 3) }}%)</span></p> 
                    <p><span>FUEL Supplied 1 week Ago</span> => &nbsp;&nbsp; <span>{{ $number_of_all_records_last_seven_days }} ({{ round($PercentageOfAllRecordsSevenDaysAgo, 3) }}%)</span></p> 
                    <p><span>Identification No.</span> => &nbsp;&nbsp; <span>{{ $CurrentVendorNo }}</span></p>
                    <p><span>First Supply Date *</span> => &nbsp;&nbsp; <span>{{ $FirstSupplyDate }}</span></p>
                    <p><span>Recent Supply Date *</span> => &nbsp;&nbsp; <span>{{ $RecentSupplyDate }}</span></p>
                </div> 
            @endisset
            <div>
                <p>
                    <span class='aggregate'>AGGREGATE [Overall Supply]</span> : : : &nbsp;&nbsp; <span>{{ $number_of_todays_records + $number_of_yesterday_records + $number_of_two_days_ago_records + $number_of_three_days_ago_records + $number_of_four_days_ago_records + $number_of_five_days_ago_records + $number_of_six_days_ago_records + $number_of_all_records_last_seven_days }}</span>
                </p>
                <br><br>
                <p><span>Vendor with MAXIMUM Supplies</span> => &nbsp;&nbsp; <span>{{ $VendorWithTheHighestSupply }} <span  class="Passed">({{ round($PercentageForVendorWithTheHighestSupply, 2) }}%)</span></span></p>  
                <p><span>Vendor with MINIMUM Supplies</span> => &nbsp;&nbsp; <span>{{ $VendorWithTheLowestSupply }} <span  class="Failed">({{ round($PercentageForVendorWithTheLowestSupply, 2) }}%)</span></span></p>  
            </div>
        </div> 
        @if (isset($_GET['RevealVendors']))
            @foreach ($vendors as $Vendor)
                @php 
                    include('../resources/views/DATA/Queries/NumberOfRecordsData.php'); 
                    
                    if($NumberOfTotalRecordsForEachVendor === 0 AND $NumberOfApprovedRecordsForEachVendor === 0 AND $NumberOfWavedRecordsForEachVendor === 0 AND $NumberOfRejectedRecordsForEachVendor === 0) {  
                        continue;
                    }              
                @endphp
             

                @php
                
                    $PercentageOfNumberOfApprovedRecordsForEachVendor = $NumberOfApprovedRecordsForEachVendor / $NumberOfTotalRecordsForEachVendor * 100;
                    
                    $PercentageOfNumberOfWavedRecordsForEachVendor = $NumberOfWavedRecordsForEachVendor / $NumberOfTotalRecordsForEachVendor * 100;
                
                    $PercentageOfNumberOfRejectedRecordsForEachVendor = $NumberOfRejectedRecordsForEachVendor / $NumberOfTotalRecordsForEachVendor * 100;
                                                                        
                    $FirstSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                        ->first();         
                                                    
                    $RecentSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')                                                                
                                                        ->where('VendorNo', $Vendor->VendorNo)
                                                        ->orderBy('SampleNo', 'DESC')
                                                        ->first();         
                
                @endphp

                <div class="fuel-test-dashboard-inner"> 
                    <canvas id="VendorChart{{ $Vendor->id }}" style="width:100%;min-width:700px"></canvas>  
                    <div>
                        <h1>BREAKDOWN</h1>
                        <p><span>Total Number of FUEL Supplied</span> => &nbsp;&nbsp; <span>{{ $NumberOfTotalRecordsForEachVendor }} (100%)</span></p> 
                        <p><span>Tests with FAILED Results</span> => &nbsp;&nbsp; <span class="Failed">{{ $NumberOfRejectedRecordsForEachVendor }} ({{ round($PercentageOfNumberOfRejectedRecordsForEachVendor) }}%)</span></p> 
                        <p><span>Tests with PASSED Results</span> => &nbsp;&nbsp; <span class="Passed">{{ $NumberOfApprovedRecordsForEachVendor }} ({{ round($PercentageOfNumberOfApprovedRecordsForEachVendor) }}%)</span></p>
                        <p><span>Tests Approved on a WAIVER</span> => &nbsp;&nbsp; <span class="Waved">{{ $NumberOfWavedRecordsForEachVendor }} ({{ round($PercentageOfNumberOfWavedRecordsForEachVendor) }}%)</span></p> 
                        <p><span>Identification No.</span> => &nbsp;&nbsp; <span>{{ $Vendor->VendorNo }}</span></p>
                        <p><span>First Supply Date *</span> => &nbsp;&nbsp; <span>{{ $FirstSupplyDate->SampleCollectionDate }}</span></p>
                        <p><span>Recent Supply Date *</span> => &nbsp;&nbsp; <span>{{ $RecentSupplyDate->SampleCollectionDate }}</span></p>
                    </div> 
                </div>            
            @endforeach            
        @endif
    </div>
    <div id="fuel-test-dashboard" class="{{ isset($_GET['RevealVendors']) ? 'reveal-vendors-padding-top' : '' }}">              
        @if(!(isset($_GET['GenerateChartForCurrentVendor'])))
            <div class="fuel-test-dashboard-inner {{ isset($_GET['RevealVendors']) ? 'hide' : '' }} {{ isset($_GET['GenerateChartForCurrentVendor']) ? '' : 'analysis' }}"> 
                <canvas width="1000" height="550" id="myChart7" class="{{ $Visibility }}"></canvas> 
                <div>
                    @php                    
                        $NumberOfTotalRecordsForEachVendorArr = [];
                    @endphp

                    @foreach ($absolute_vendors as $Vendor)
                        @php
                            include('../resources/views/DATA/Queries/NumberOfRecordsData.php'); 

                            if($NumberOfTotalRecordsForEachVendor === 0 AND $NumberOfApprovedRecordsForEachVendor === 0 AND $NumberOfWavedRecordsForEachVendor === 0 AND $NumberOfRejectedRecordsForEachVendor === 0) {  
                                continue;
                            }  

                            array_push($NumberOfTotalRecordsForEachVendorArr, $NumberOfTotalRecordsForEachVendor);    
                        @endphp 
                    @endforeach

                    @php 
                    
                        $VendorsWithSupplyStatus = count($NumberOfTotalRecordsForEachVendorArr); 
                        $PercentageOfVendorsWithSupplyStatus = $VendorsWithSupplyStatus / $number_of_vendors * 100;                                                           

                    @endphp

                    <h1>VENDOR STATS</h1>
                    <form action="">
                        <label>
                            <input type="hidden" value="{{ $VendorsWithSupplyStatus }}" name="RevealVendors"> 
                            <input class="hide" type="submit">   
                            <span class="reveal-vendors">Reveal Vendors</span>
                        </label>
                    </form>

                    <p><span>Total Number of Vendors</span> => &nbsp;&nbsp; <span>{{ $number_of_vendors_absolute }} (100%)</span></p> 
                    <p><span>Vendors with Supply Status *</span> => &nbsp;&nbsp; <span>{{ $VendorsWithSupplyStatus }} ({{ round($PercentageOfVendorsWithSupplyStatus) }}%)</span></p>  
                </div> 
            </div>
        @endif 
    </div> 
</div>
 
<footer> 
    <p>
        <strong>Notice :</strong> This analysis provided is based upon thorough testing and sample information received from {{ !(isset($_GET['GenerateChartForCurrentVendor'])) || $CurrentVendorName == '<big style="color: red; font-family: arial;">This Vendor has NO RECORDS yet !</big>' ? 'all Vendors' : $CurrentVendorName }} and the quality of sample supplied.
        This is to ensure continuous supply from the supplier of clean fuel to engine fuel system components for our Vessels.
        Recommendations are provided as a guide only.
    </p> 
</footer>   
<img src="/images/depasa-logo.png"> 

<input type="hidden" id="Labels" name="Labels">
<form action="" class="CurrentVendor">
    <input type="hidden" class="GenerateChartForCurrentVendor" name="GenerateChartForCurrentVendor">
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> 
<script> 

let FuelTestResults = new Chart("myChart", {
    type: "horizontalBar",
    data: {
            labels: ["Failed", "Passed", "Waived",/* @if(!(isset($_GET['GenerateChartForCurrentVendor']))) "Diff", @endif */ "Previous Records", "Total Records"],
            datasets: [{
                backgroundColor: [
                    'rgb(255, 30, 30, 0.3)',
                    'rgb(0, 255, 209, 0.3)',
                    'rgb(255, 255, 0, 0.3)',
                    'rgb(49, 198, 212, 0.3)',
                    'rgb(219, 200, 172, 0.3)',
                    'rgb(162, 181, 187, 0.3)',
                ],
                borderColor: [
                    "rgb(255, 30, 30, 0.3)",
                    "rgb(0, 255, 209)",
                    "rgb(255, 255, 0)",
                    "rgb(49, 198, 212)",
                    "rgb(219, 200, 172)",
                    "rgb(162, 181, 187)",
                ],
                borderWidth: 1,
                data: [
                    {{ $number_of_failed_records }},
                    {{ $number_of_passed_records }}, 
                    {{ $number_of_waved_records }}, 
                    // @if(!(isset($_GET['GenerateChartForCurrentVendor'])))  
                    //     {{ $number_of_diff_records }}, 
                    // @endif 
                    {{ $number_of_previous_records }}, 
                    @if((isset($_GET['GenerateChartForCurrentVendor'])))  
                    {{ $number_of_all_records }},
                    @endif 
                    {{ $number_of_all_records_absolute }}
                ],
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },            
            legend: {display: false},
            title: { 
                display: true,  
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Fuel Tests',
            }            
        }
    });
  
    let FuelTestResults2 = new Chart("myChart2", {
        type: "horizontalBar",
        data: {
            labels: ['Last Month', 'This Month', 'Last Seven Days'],
            datasets: [{
                backgroundColor: ['#d7e1ee', '#a4a2a8', '#edbf33'],
                fill: false,
                data: [
                    {{ $number_of_all_records_last_month }}, 
                    {{ $number_of_all_records_this_month }}, 
                    {{ $number_of_all_records_last_seven_days }}
                ]
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },            
            legend: {display: false},
            title: {
                display: true, 
            },
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Recent',
            }            
        }
    });
 
    
    let FuelTestResults3 = new Chart("myChart3", {
        type: "bar",
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                backgroundColor: ['#9b19f5', '#8bd3c7', '#edbf33', '#1a53ff', '#fd7f6f', '#7eb0d5', '#b2e061', '#bd7ebe', '#ffb55a', '#ffee65', '#beb9db', '#fdcce5'],
                data: [
                    @isset($_GET['GenerateChartForCurrentVendor'])
                        @foreach($TotalNumberOfRecordsForEachMonth_ as $TotalNumberOfRecordsForEachMonth) 
                            @if($loop->index == 0)
                                @continue
                            @endif

                            {{ $TotalNumberOfRecordsForEachMonth }},  
                        @endforeach
                    @endisset 
                    
                    @if(!isset($_GET['GenerateChartForCurrentVendor']))
                        @foreach($TotalNumberOfRecordsForEachMonth as $TotalNumberOfRecordsForEachMonth) 
                            @if($loop->index == 0)
                                @continue
                            @endif

                            {{ $TotalNumberOfRecordsForEachMonth }},  
                        @endforeach 
                    @endif 
                ], 
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },            
            legend: {display: false}, 
            title: {
                display: true, 
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Monthly',
            }            
        }
    });
 
    let FuelTestResults4 = new Chart("myChart4", {
        type: "horizontalBar",
        data: {
            labels: ['Today', 'Yesterday', 'Day Before', '3 Days', '4 Days', '5 Days', '6 Days', 'One Week'],
            datasets: [{
                backgroundColor: ['#333', '#333', '#333', '#333', '#333', '#333', '#333', '#333'],
                data: [{{ $number_of_todays_records }}, {{ $number_of_yesterday_records }}, {{ $number_of_two_days_ago_records }}, {{ $number_of_three_days_ago_records }}, {{ $number_of_four_days_ago_records }}, {{ $number_of_five_days_ago_records }}, {{ $number_of_six_days_ago_records }}, {{ $number_of_all_records_last_seven_days }}]
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },            
            legend: {display: false},
            title: {
                display: true, 
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Recently',
            }            
        }
    });
 
    let FuelTestResults5 = new Chart("myChart5", {
        type: "bar",
        data: {
            labels: ['Today', 'Yesterday', 'Day Before', '3 Days', '4 Days', '5 Days', '6 Days', 'One Week'],
            datasets: [{ 
                backgroundColor: ['#9b19f5', '#8bd3c7', '#edbf33', '#fdcce5', '#b2e061', '#bd7ebe', '#fd7f6f', '#d7e1ee'],
                data: [
                    {{ $number_of_todays_records }},
                    {{ $number_of_yesterday_records }},
                    {{ $number_of_two_days_ago_records }},
                    {{ $number_of_three_days_ago_records }},
                    {{ $number_of_four_days_ago_records }},
                    {{ $number_of_five_days_ago_records }}, 
                    {{ $number_of_six_days_ago_records }}, 
                    {{ $number_of_all_records_last_seven_days }},
                ]
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },            
            legend: {display: false},
            title: {
                display: true, 
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Daily/Recent',
            }            
        }
    });
 
    let Labels = [];   
    let NewLabels = [];  
    let AvailableVendorNames = [];   
    let NumberOfTotalRecordsForEachVendor = [];   
    let NumberOfApprovedRecordsForEachVendor = [];   
    let NumberOfWavedRecordsForEachVendor = [];   
    let NumberOfRejectedRecordsForEachVendor = [];   
    
    @php 
        $AvailableVendorNames = [];
    @endphp

    @foreach($absolute_vendors as $vendor) 

        @php 
            
            if(isset($_GET['ClearFilterVendorStats'])) {
                header('Location: /FuelTestStats');
            }
        
            $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
            
            $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 


            if(isset($_GET['FilterVendorStats'])) {
                $VendorStatsFrom = $_GET['VendorStatsFrom'];
                $VendorStatsTo = $_GET['VendorStatsTo'];

                $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::where('VendorNo', $vendor->VendorNo)
                                                    ->whereBetween('SampleCollectionDate', [$VendorStatsFrom, $VendorStatsTo])
                                                    ->get()
                                                    ->count(); 
            
                $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                    ->whereBetween('SampleCollectionDate', [$VendorStatsFrom, $VendorStatsTo])
                                                    ->where('VendorNo', $vendor->VendorNo)
                                                    ->get()
                                                    ->count(); 
            
                $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                    ->whereBetween('SampleCollectionDate', [$VendorStatsFrom, $VendorStatsTo])
                                                    ->where('VendorNo', $vendor->VendorNo)
                                                    ->get()
                                                    ->count(); 
                
                $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                    ->whereBetween('SampleCollectionDate', [$VendorStatsFrom, $VendorStatsTo])
                                                    ->where('VendorNo', $vendor->VendorNo)
                                                    ->get()
                                                    ->count(); 
            }
                                                
        @endphp
        
        @if($NumberOfTotalRecordsForEachVendor === 0 AND $NumberOfApprovedRecordsForEachVendor === 0 AND $NumberOfWavedRecordsForEachVendor === 0 AND $NumberOfRejectedRecordsForEachVendor === 0)  
            @continue;
        @endif
        
        Labels.push('{{ $vendor->VendorNo }} {{ $vendor->VendorName }}');

        @php 
            array_push($AvailableVendorNames, $vendor->VendorName);
        @endphp

        AvailableVendorNames.push('{{ $vendor->VendorName }}'); 
        NumberOfTotalRecordsForEachVendor.push('{{ $NumberOfTotalRecordsForEachVendor }}'); 
        NumberOfApprovedRecordsForEachVendor.push('{{ $NumberOfApprovedRecordsForEachVendor }}');  
        NumberOfWavedRecordsForEachVendor.push('{{ $NumberOfWavedRecordsForEachVendor }}');  
        NumberOfRejectedRecordsForEachVendor.push('{{ $NumberOfRejectedRecordsForEachVendor }}');  

    @endforeach   
        
    Labels.forEach(Label => {
        NewLabels.push(Label);
    });

    let FuelTestResults6 = new Chart("myChart6", {
        type: "bar",
        data: { 
            labels: [...NewLabels], 
            datasets: [{  
                data: [...NumberOfWavedRecordsForEachVendor],
                backgroundColor: "rgb(255, 255, 0, 0.7)",
                borderColor: "rgb(255, 233, 0, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Waived', 
            }, 
            { 
                data: [...NumberOfRejectedRecordsForEachVendor],
                backgroundColor: "rgb(255, 30, 30, 0.7)",
                borderColor: "rgb(255, 29, 30, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Rejected',
            }, 
            { 
                data: [...NumberOfApprovedRecordsForEachVendor],
                backgroundColor: "rgb(0, 255, 209, 0.7)",
                borderColor: "rgb(0, 295, 209, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Approved',
            }, 
            { 
                data: [...NumberOfTotalRecordsForEachVendor],
                backgroundColor: "rgb(55, 41, 72, 0.7)",
                borderColor: "rgb(55, 41, 72, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Total', 
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },
            legend: {
                display: true,  
                position: 'right', 
            }, 
            scales: {         
                xAxes: [
                    {
                        ticks: {
                            callback: function(label, index, labels) {
                                if (/\s/.test(label)) {
                                    return label.split(" ");
                                }else{
                                    return label;
                                }              
                            },
                            maxRotation: 0,
                            minRotation: 0
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'index',
                callbacks: {
                    title: 
                    function(tooltipItem, data) {   
                        return AvailableVendorNames[tooltipItem[0].index];   
                    }
                }
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Diesel Test Analysis (VENDORS)',
            }, 
            onClick: (a, b) => { 
                let CurrentVendorForm = document.querySelector('.CurrentVendor');
                let CurrentVendorNoInput = document.querySelector('.GenerateChartForCurrentVendor'); 
                 
                CurrentVendorNoInput.value = b[0]._xScale.ticks[b[0]._index][0]; 
                CurrentVendorForm.submit();  
            }
        }
    }); 

    let FuelTestResults7 = new Chart("myChart7", {
        type: "line",
        data: { 
            labels: [...NewLabels], 
            datasets: [{  
                data: [...NumberOfWavedRecordsForEachVendor],
                backgroundColor: "rgb(255, 255, 0, 0.7)",
                borderColor: "rgb(255, 233, 0, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Waived', 
            }, 
            { 
                data: [...NumberOfRejectedRecordsForEachVendor],
                backgroundColor: "rgb(255, 30, 30, 0.7)",
                borderColor: "rgb(255, 29, 30, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Rejected',
            }, 
            { 
                data: [...NumberOfApprovedRecordsForEachVendor],
                backgroundColor: "rgb(0, 255, 209, 0.7)",
                borderColor: "rgb(0, 295, 209, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Approved',
            }, 
            { 
                data: [...NumberOfTotalRecordsForEachVendor],
                backgroundColor: "rgb(55, 41, 72, 0.7)",
                borderColor: "rgb(55, 41, 72, 0.7)",
                borderWidth: 1,
                fill: false,
                label: 'Total', 
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 5,
                }
            },
            legend: {
                display: true,  
                position: 'right', 
            }, 
            scales: {         
                xAxes: [
                    {
                        ticks: {
                            callback: function(label, index, labels) {
                                if (/\s/.test(label)) {
                                    return label.split(" ");
                                }else{
                                    return label;
                                }              
                            },
                            maxRotation: 0,
                            minRotation: 0
                        }
                    }
                ]
            },
            tooltips: {
                mode: 'index',
                callbacks: {
                    title: 
                    function(tooltipItem, data) {   
                        return AvailableVendorNames[tooltipItem[0].index];   
                    },
                    // label: function(tooltipItem, data) {
                    //     console.log(data['labels'][tooltipItem['index']])
                    //     // console.log(data['labels'][tooltipItem['index']])
                    //     // return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';  
                    //     let LabelTitles =  [
                    //         'Waived',
                    //         'Rejected',
                    //         'Approved',
                    //     ];
                        
                    //         return LabelTitles[0] + ': 23%';  
                    // }
                }
            },
            title: {
                display: true,
                fontSize: 20, 
                text: 'Diesel Test Analysis (VENDORS)',
            }, 
            onClick: (a, b) => { 
                let CurrentVendorForm = document.querySelector('.CurrentVendor');
                let CurrentVendorNoInput = document.querySelector('.GenerateChartForCurrentVendor'); 
                 
                CurrentVendorNoInput.value = b[0]._xScale.ticks[b[0]._index][0]; 
                CurrentVendorForm.submit();   
            }
        }
    }); 

    @foreach($vendors as $vendor) 

        @php 
            
            $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'WAIVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 

            $Appearance = App\Models\FuelTestRecord::whereIn('AppearanceResult', ['BRIGHT', 'CLEAR']) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodAppearace = $Appearance; 

            $BadAppearance = App\Models\FuelTestRecord::whereNotIn('AppearanceResult', ['BRIGHT', 'CLEAR']) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadAppearace = $BadAppearance; 

            $Color = App\Models\FuelTestRecord::where('Color', '<=', 2.5) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodColor = $Color; 

            $BadColor = App\Models\FuelTestRecord::where('Color', '>', 2.5) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadColor = $BadColor; 

            $Density = App\Models\FuelTestRecord::whereBetween('Density', [0.82, 0.855]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodDensity = $Density; 

            $BadDensity = App\Models\FuelTestRecord::whereNotBetween('Density', [0.82, 0.855])   
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadDensity = $BadDensity; 

            $FlashPoint = App\Models\FuelTestRecord::whereBetween('Density', [52, 92]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodFlashPoint = $FlashPoint;

            $BadFlashPoint = App\Models\FuelTestRecord::whereNotBetween('Density', [52, 92]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadFlashPoint = $BadFlashPoint; 

            $WaterSediment = App\Models\FuelTestRecord::whereBetween('WaterSediment', [0, 0.050]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodWaterSediment = $WaterSediment; 

            $BadWaterSediment = App\Models\FuelTestRecord::where('WaterSediment', '>', 0.050) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadWaterSediment = $BadWaterSediment; 

            $Cleanliness = App\Models\FuelTestRecord::whereBetween('Cleanliness', [12, 15]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfGoodCleanliness = $Cleanliness; 
                  
            $BadCleanliness = App\Models\FuelTestRecord::whereNotBetween('Cleanliness', [12, 15]) 
                                            ->where('VendorNo', $vendor->VendorNo)
                                            ->count();

            $NumberOfBadCleanliness = $BadCleanliness; 
                              
        @endphp
    
        @if($NumberOfTotalRecordsForEachVendor === 0 AND $NumberOfApprovedRecordsForEachVendor === 0 AND $NumberOfWavedRecordsForEachVendor === 0 AND $NumberOfRejectedRecordsForEachVendor === 0)  
            @continue;
        @endif
        
        let VendorChartResults{{ $vendor->id }} = new Chart("VendorChart{{ $vendor->id }}", {
            type: "bar",
            data: {
                labels: [
                    'APPERANCE', 
                    'COLOR', 
                    'DENSITY', 
                    'FLASH POINT', 
                    'WATER / SEDIMEMT',
                    'CLEANLINESS',
                ],
                datasets: [{ 
                    data: [
                        {{ $NumberOfGoodAppearace }}, 
                        {{ $NumberOfGoodColor }}, 
                        {{ $NumberOfGoodDensity }},
                        {{ $NumberOfGoodFlashPoint }},
                        {{ $NumberOfGoodWaterSediment }},
                        {{ $NumberOfGoodCleanliness }},
                    ], 
                    fill: false,
                    label: 'Good Tests',  
                    backgroundColor: [
                        "rgb(55, 41, 72, 0.7)",
                        "rgb(123, 55, 30, 0.7)",
                        "rgb(0, 225, 209, 0.7)",
                        "rgb(0, 255, 209, 0.7)",
                        "rgb(255, 30, 30, 0.7)",
                        "rgb(255, 233, 0, 0.7)",
                    ],
                    borderWidth: 1,
                    borderColor: [
                        "rgb(55, 41, 72, 0.7)",
                        "rgb(123, 55, 30, 0.7)",
                        "rgb(0, 225, 209, 0.7)",
                        "rgb(0, 255, 209, 0.7)",
                        "rgb(255, 30, 30, 0.7)",
                        "rgb(255, 233, 0, 0.7)",
                    ],
                }, { 
                    data: [
                        {{ $NumberOfBadAppearace }}, 
                        {{ $NumberOfBadColor }}, 
                        {{ $NumberOfBadDensity }},
                        {{ $NumberOfBadFlashPoint }},
                        {{ $NumberOfBadWaterSediment }},
                        {{ $NumberOfBadCleanliness }},
                    ], 
                    fill: false,
                    label: 'Bad Tests',  
                    backgroundColor: [
                        "#2C3639",
                        "#5F7161",
                        "#CEAB93",
                        "#7882A4",
                        "#A3DA8D",
                        "#AE431E",
                    ],
                    borderWidth: 1,
                    borderColor: [
                        "#2C3639",
                        "#5F7161",
                        "#CEAB93",
                        "#7882A4",
                        "#A3DA8D",
                        "#AE431E",
                    ],
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 5,
                        bottom: 5,
                    }
                },            
                legend: {display: true},
                title: {
                    display: true, 
                },
                title: {
                    display: true,
                    fontSize: 20, 
                    text: '{{ $vendor->VendorName }}',
                },           
            }
        });

    @endforeach
</script>
@endsection    