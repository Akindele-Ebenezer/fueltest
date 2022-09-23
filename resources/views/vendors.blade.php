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
                    <th class="resizable">#</th>
                    <th class="resizable">Vendor No.</th>
                    <th class="vendor-name resizable">Vendor Name</th> 
                </tr>  
                @foreach($vendors as $Vendor)
                <tr> 
                    <td class="vendor-id">{{ $Vendor->id }}</td>
                    <td class="vendor-no" id="Vend">
                        <form action="{{ route('all_records') }}">
                            <label>
                                <input type="hidden" class="hide" name="FilterVendorName">
                                <input type="submit" class="hide" name="CheckVendorName[]" value="{{ $Vendor->VendorName }}">
                                {{ $Vendor->VendorNo }}
                            </label>
                        </form>  
                        <section class="records-tooltip">{{ $Vendor->VendorNo }} <br> [ ]</section>                      
                    </td>
                    <td class="vendor-name">
                        <form action="{{ route('all_records') }}">
                            <label>
                                <input type="hidden" class="hide" name="FilterVendorName">
                                <input type="submit" class="hide" name="CheckVendorName[]" value="{{ $Vendor->VendorName }}">
                                {{ $Vendor->VendorName }}
                            </label>
                        </form>  
                        <section class="records-tooltip">{{ $Vendor->VendorName }} <br> [ ]</section> 
                    </td>  
                </tr>  
                @endforeach
            </table> 
            <!-- Pagination links -->
        </div>
    </section> 

    <script src="JS/Resizable.js"></script>
@endsection