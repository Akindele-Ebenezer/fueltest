@extends('layouts.layout_1')

@section('name', $Name)
@section('email', $Email)
@section('header_info', $Title)
@section('title', $Title)
@section('content')
    <section class="previous-records">
        <center>
            <h1>{{ $Title }}</h1>
            <form action="/export">
                <button type="submit" name="export">Export to Excel</button>
            </form>
        </center>
        <div>
            <table> 
                <tr>  
                    <th>Vendor ID</th>
                    <th>Vendor No.</th>
                    <th class="vendor-name">Vendor Name</th> 
                </tr>  
                @foreach($Vendors as $Vendor)
                <tr> 
                    <td class="vendor-id">{{ $Vendor->id }}</td>
                    <td class="vendor-no">{{ $Vendor->VendorNo }}</td>
                    <td class="vendor-name">{{ $Vendor->VendorName }}</td>  
                </tr>  
                @endforeach
            </table> 
            <!-- Pagination links -->
        </div>
    </section>
@endsection