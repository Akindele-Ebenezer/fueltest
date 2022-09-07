@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        @include('PageTitle')
        <div>
            <table class="vendors"> 
                <tr>  
                    <th>#</th>
                    <th>Vendor No.</th>
                    <th class="vendor-name">Vendor Name</th> 
                </tr>  
                @foreach($vendors as $Vendor)
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