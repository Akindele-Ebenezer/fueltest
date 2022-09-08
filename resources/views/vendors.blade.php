@extends('layouts.layout_1')

@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
    <section class="previous-records">
        @include('PageTitle')
        @if(Session::get('email') == 'awadhesh@depasamarine.com') 
        <section class="add-vendor">
            <form action="/AddVendor" method="post"> @csrf 
                <label for="VendorNo">Vendor No.</label>
                <input type="number" name="VendorNo">
                <label for="VendorName">Vendor Name</label>
                <input type="text" name="VendorName"> 
                <button>Add Vendor</button>
            </form>
        </section>
        @endif
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