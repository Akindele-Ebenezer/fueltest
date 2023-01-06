@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        @include('PageTitle')

        <section class="log-in-alert alert">VENDOR List up-to date</section>
        <p class="error-message">{{ $ErrorMessage }}</p> 
        @if(Session::get('Role') === 'ADMIN') 
        <section class="add-vendor">
            <form action="/AddVendor" method="post"> @csrf 
                <input type="number" placeholder="Vendor No.." name="VendorNo">
                <input type="text" placeholder="Vendor Name.." name="VendorName"> 
                <button>Add Vendor</button>
            </form>
        </section>
        @endif 
        @include('Search')
        <div class="table other-tables"> 
            <form class="DeleteRecords_" action="">
            <table class="vendors"> 
                <tr>  
                    <th class="resizable">#</th>
                    @if(Session::get('Role') === 'ADMIN') 
                    <th class="resizable">
                        Action
                    </th>
                    @endif
                    <th class="resizable th-min-width">
                            <label>
                                <input type="submit" class="hide" name="SortByVendorNo">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        Vendor No.
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-vendor-no">
                            <ul>
                                <form action="" method="get">
                                    <h1>Vendor Numbers</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('vendors') }}">Cancel</a></button> <button name="FilterVendorNo">Filter</button>
                                    </center>
                                    @foreach($FilterVendorNo as $filter)
                                        @if ($filter->VendorNo === NULL)
                                            @continue
                                        @endif
                                        <li>
                                            <input type="checkbox" name="CheckVendorNo[]" value="{{ $filter->VendorNo }}"> {{ $filter->VendorNo }}
                                        </li>   
                                    @endforeach
                                </form>
                            </ul>
                        </div>   
                    </th>
                    <th class="vendor-names resizable">
                            <label>
                                <input type="submit" class="hide" name="SortByVendorName">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                            </label>
                        Vendor Name
                        <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                        <div class="filter filter-vendor-name">
                            <ul>
                                <form action="" method="get">
                                    <h1>Vendor Names</h1>
                                    <center>
                                        <button name="CancelFilter"><a href="{{ route('vendors') }}">Cancel</a></button> <button name="FilterVendorName">Filter</button>
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
                        </div>                        
                    </th> 
                    <th>
                        Chart
                    </th>
                    <th class="Approved resizable"> 
                        Approved                       
                    </th>
                    <th class="Rejected resizable"> 
                        Rejected                       
                    </th>
                    <th class="Waived resizable"> 
                        Waived                       
                    </th>
                    <th class="Supplies resizable"> 
                        Supplies                       
                    </th>
                    <th class="FirstSupplyDate resizable"> 
                        First Supply Date                       
                    </th>
                    <th class="LastSupplyDate resizable"> 
                        Last Supply Date                       
                    </th>
                </tr>  
                @if($number_of_vendors == 0)
                <tr>
                    <td>
                         There are no VENDORS.. 
                    </td>
                </tr>
                @endif  
                @foreach($vendors as $Vendor) 
                <tr> 
                    <td class="vendor-id">{{ $Vendor->id }}</td>
                    @if(Session::get('Role') === 'ADMIN') 
                    <td class="action"> 
                        <input type="checkbox" name="DeleteVendor[]" value="{{ $Vendor->id }}">
                    </td>
                    @endif
                    <td class="vendor-no" id="Vend">
                        <form action="{{ route('all_records') }}">
                            <label>
                                <input type="hidden" class="hide" name="FilterVendorName">
                                <input type="submit" class="hide" name="CheckVendorName[]" value="{{ $Vendor->VendorName }}">
                                {{ $Vendor->VendorNo }} 
                            </label>
                        </form>  
                        <section class="records-tooltip tooltip">{{ $Vendor->VendorNo }}</section>                      
                    </td>
                    <td class="vendor-name">
                        <form action="{{ route('all_records') }}">
                            <label>
                                <input type="hidden" class="hide" name="FilterVendorName">
                                <input type="submit" class="hide" name="CheckVendorName[]" value="{{ $Vendor->VendorName }}">
                                {{ $Vendor->VendorName }}
                            </label>
                        </form>  
                        <section class="records-tooltip tooltip"> 
                            @include('SwitchCases.SwitchCasesForVendors') 
                        </section> 
                    </td>  
                    <td> 
                        <form class="GenerateChart" action="{{ route('fuel_test_stats') }}" method="get">
                            <label>
                                <input class="hide" type="submit" src="/images/approved.png" name="GenerateChartForCurrentVendor" value="{{ $Vendor->VendorNo }}"> 
                                <img class="icon" src="/images/chart.png">
                            </label>
                        </form>
                    </td>
                    <td>
                        @php
                            $TotalTestsForEachVendor = App\Models\FuelTestRecord::select('SampleCollectionDate')
                                                                                    ->where('VendorName', $Vendor->VendorName)
                                                                                    ->count();

                            $TotalTestsForEachVendor_PERCENTAGE_Absolute = $TotalTestsForEachVendor == 0 ? 0 : ($TotalTestsForEachVendor/ $number_of_all_records_absolute * 100);
                                                                       
                            $ApprovedTestsForEachVendor = App\Models\FuelTestRecord::select('id')
                                                                                    ->where('ApprovalForUse', 'APPROVED')
                                                                                    ->where('VendorName', $Vendor->VendorName)
                                                                                    ->count();
                                                                                                 
                            $ApprovedTestsForEachVendor_PERCENTAGE_Absolute = $TotalTestsForEachVendor == 0 ? 0 : ($ApprovedTestsForEachVendor/ $number_of_all_records_absolute * 100);
                            $ApprovedTestsForEachVendor_PERCENTAGE = $TotalTestsForEachVendor == 0 ? 0 : ($ApprovedTestsForEachVendor/ $TotalTestsForEachVendor * 100);


                        @endphp
                        <p class="ApprovedTestsForEachVendor"><span class="Total_">{{ $ApprovedTestsForEachVendor }}</span>&nbsp;&nbsp; <span class="Passed">({{ round($ApprovedTestsForEachVendor_PERCENTAGE, 1) }}%)</span> + <em>{{ round($ApprovedTestsForEachVendor_PERCENTAGE_Absolute, 1)  }}%</em></p>
                    </td>
                    <td>
                        @php
                            $FailedTestsForEachVendor = App\Models\FuelTestRecord::select('id')
                                                                                    ->where('ApprovalForUse', 'REJECTED')
                                                                                    ->where('VendorName', $Vendor->VendorName)
                                                                                    ->count();
                                                                                    
                            $RejectedTestsForEachVendor_PERCENTAGE_Absolute = $TotalTestsForEachVendor == 0 ? 0 : ($FailedTestsForEachVendor/ $number_of_all_records_absolute * 100);
                            $RejectedTestsForEachVendor_PERCENTAGE = $TotalTestsForEachVendor == 0 ? 0 : ($FailedTestsForEachVendor/ $TotalTestsForEachVendor * 100);
                        @endphp
                        <p class="FailedTestsForEachVendor"><span class="Total_">{{ $FailedTestsForEachVendor }}</span>&nbsp;&nbsp; <span class="Failed">({{ round($RejectedTestsForEachVendor_PERCENTAGE, 1) }}%)</span> + <em>{{ round($RejectedTestsForEachVendor_PERCENTAGE_Absolute, 1)  }}%</em></p>
                    </td>
                    <td>
                        @php
                            $WaivedTestsForEachVendor = App\Models\FuelTestRecord::select('id')
                                                                                    ->where('ApprovalForUse', 'WAIVED')
                                                                                    ->where('VendorName', $Vendor->VendorName)
                                                                                    ->count();
                                                                                    
                            $WaivedTestsForEachVendor_PERCENTAGE_Absolute = $TotalTestsForEachVendor == 0 ? 0 : ($WaivedTestsForEachVendor/ $number_of_all_records_absolute * 100);
                            $WaivedTestsForEachVendor_PERCENTAGE = $TotalTestsForEachVendor == 0 ? 0 : ($WaivedTestsForEachVendor/ $TotalTestsForEachVendor * 100);
                        @endphp
                        <p class="WaivedTestsForEachVendor"><span class="Total_">{{ $WaivedTestsForEachVendor }}</span>&nbsp;&nbsp; <span class="Waived">({{ round($WaivedTestsForEachVendor_PERCENTAGE, 1) }}%)</span> + <em>{{ round($WaivedTestsForEachVendor_PERCENTAGE_Absolute, 1)  }}%</em></p>
                    </td>
                    <td>  
                        <p class="TotalTestsForEachVendor"><span class="Total_">{{ $TotalTestsForEachVendor }}</span>&nbsp;&nbsp;  + <em>{{ round($TotalTestsForEachVendor_PERCENTAGE_Absolute, 1)  }}%</em></p>
                    </td>
                    <td>
                        @php
                            $FirstSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')
                                                                                    ->where('VendorName', $Vendor->VendorName) 
                                                                                    ->first();
                        @endphp
                        <p class="FirstSupplyDate">{{ empty($FirstSupplyDate->SampleCollectionDate) ? 'No Supplies' : $FirstSupplyDate->SampleCollectionDate }}</p>
                    </td>
                    <td>
                        @php
                            $LastSupplyDate = App\Models\FuelTestRecord::select('SampleCollectionDate')
                                                                                    ->where('VendorName', $Vendor->VendorName)
                                                                                    ->orderBy('SampleCollectionDate', 'DESC') 
                                                                                    ->first();
                        @endphp
                        <p class="LastSupplyDate">{{ empty($LastSupplyDate->SampleCollectionDate) ? 'No Supplies' : $LastSupplyDate->SampleCollectionDate }}</p>
                    </td>
                </tr>  
                @endforeach 
                <div class="links">  
                    {{ $vendors->onEachSide(1)->links() }}   
                </div>  
            </table> 
            @if(Session::get('Role') === 'ADMIN') 
            <button type="submit" name="Delete_">Delete</button>
            @endif
            </form>
        </div>
    </section> 

    <script src="/JS/Alert.js"></script>  
    <script src="JS/Resizable.js"></script>
    <script src="JS/Filter.js"></script>
@endsection