@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content') 
 
<style>
    .fuel-test-dashboard-inner canvas#myChart6 {
        width: unset !important;
    }
    .fuel-test-left-nav {
        display: none;   
    } 
</style>

<div class="insights"> 
    @include('PageTitle')
    <div class="fuel-test-dashboard">
        <div class="fuel-test-dashboard-inner">
            <h1>VENDORS</h1>
            <canvas id="myChart6"></canvas>
        </div> 
        <div class="fuel-test-dashboard-inner">
            <div class="inner">
                <h1>FUEL LAB Report</h1>
                <div>
                    <h2>{{ round($PercentageOfFailedRecords) }}%</h2>
                    <h2>{{ round($PercentageOfPassedRecords) }}%</h2>
                    <h2>{{ round($PercentageOfWavedRecords) }}%</h2>
                    <h2>{{ round($PercentageOfDiffRecords) }}%</h2>
                </div>
            </div>
            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        </div>    
        <div class="fuel-test-dashboard-inner">
            <h1>Monthly</h1>
            <canvas id="myChart3" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="fuel-test-dashboard-inner">
            <h1>Recent</h1>
            <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="fuel-test-dashboard-inner">
            <h1>Daily/Recent</h1>
            <canvas id="myChart4" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="fuel-test-dashboard-inner">
            <h1>Daily/Recent</h1>
            <canvas id="myChart5" style="width:100%;max-width:700px"></canvas>
        </div>
    </div>
</div>
<input type="hidden" id="Labels" name="Labels">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script> 

let FuelTestResults = new Chart("myChart", {
    type: "horizontalBar",
    data: {
            labels: ["Failed", "Passed", "Waved", "Diff", "Previous Records", "Total Records"],
            datasets: [{
                backgroundColor: ["#ea5545", "#6cd4c5","#e6d817","#a4a2a8","#9080ff", "#ddd"],
                data: [{{ $number_of_failed_records }}, {{ $number_of_passed_records }}, {{ $number_of_waved_records }}, {{ $number_of_diff_records }}, {{ $number_of_previous_records }}, {{ $number_of_all_records }}],
            }]
        },
        options: {
            legend: {display: false},
            title: { 
                display: true,  
            }
        }
    });
  
    let FuelTestResults2 = new Chart("myChart2", {
        type: "line",
        data: {
            labels: ['Last Month', 'This Month', 'Last Seven Days'],
            datasets: [{
                backgroundColor: ['#d7e1ee', '#a4a2a8', '#edbf33'],
                fill: false,
                data: [{{ $number_of_all_records_last_month }}, {{ $number_of_all_records_this_month }}, {{ $number_of_all_records_last_seven_days }}]
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true, 
            }
        }
    });
 
    
    let FuelTestResults3 = new Chart("myChart3", {
        type: "bar",
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                backgroundColor: ['#9b19f5', '#8bd3c7', '#edbf33', '#1a53ff', '#fd7f6f', '#7eb0d5', '#b2e061', '#bd7ebe', '#ffb55a', '#ffee65', '#beb9db', '#fdcce5'],
                data: [{{ $January }}, {{ $February }}, {{ $March }}, {{ $April }}, {{ $May }}, {{ $June }}, {{ $July }}, {{ $August }}, {{ $September }}, {{ $October }}, {{ $November }}, {{ $December }}]
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true, 
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
            legend: {display: false},
            title: {
                display: true, 
            }
        }
    });
 
    let FuelTestResults5 = new Chart("myChart5", {
        type: "pie",
        data: {
            labels: ['Today', 'Yesterday', 'Day Before', '3 Days', '4 Days', '5 Days', '6 Days', 'One Week'],
            datasets: [{
                backgroundColor: ['#9b19f5', '#8bd3c7', '#edbf33', '#fdcce5', '#b2e061', '#bd7ebe', '#fd7f6f', '#d7e1ee'],
                data: [{{ $number_of_todays_records }}, {{ $number_of_yesterday_records }}, {{ $number_of_two_days_ago_records }}, {{ $number_of_three_days_ago_records }}, {{ $number_of_four_days_ago_records }}, {{ $number_of_five_days_ago_records }}, {{ $number_of_six_days_ago_records }}, {{ $number_of_all_records_last_seven_days }}]
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true, 
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

    @foreach($vendors as $vendor) 

        @php 
        
            $NumberOfTotalRecordsForEachVendor = App\Models\FuelTestRecord::where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfApprovedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'APPROVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfWavedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'WAVED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
        
            $NumberOfRejectedRecordsForEachVendor = App\Models\FuelTestRecord::where('ApprovalForUse', 'REJECTED')
                                                ->where('VendorNo', $vendor->VendorNo)
                                                ->get()
                                                ->count(); 
                                                
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
        NewLabels.push(Label.substring(1, 6));
    });

    let FuelTestResults6 = new Chart("myChart6", {
        type: "horizontalBar",
        data: { 
            labels: [...NewLabels], 
            datasets: [{  
                data: [...NumberOfWavedRecordsForEachVendor],
                backgroundColor: "#F5D6D0",
                fill: false,
                label: 'Waved', 
            }, 
            { 
                data: [...NumberOfRejectedRecordsForEachVendor],
                backgroundColor: "#CE050F",
                fill: false,
                label: 'Rejected',
            }, 
            { 
                data: [...NumberOfApprovedRecordsForEachVendor],
                backgroundColor: "#2BC5AE",
                fill: false,
                label: 'Approved', 
            }, 
            { 
                data: [...NumberOfTotalRecordsForEachVendor],
                backgroundColor: "#afb5AE",
                fill: false,
                label: 'Total', 
            }]
        },
        options: {
            legend: {
                display: true, 
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
        }
    }); 
</script>
@endsection    