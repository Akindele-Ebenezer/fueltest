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
                    <th>Vendor No.</th>
                    <th>Vendor Name</th> 
                </tr>  
                <tr> 
                    <td class="vendor-no">73737892</td>
                    <td class="vendor-name">Vendor Name One</td>  
                </tr> 
                <tr> 
                    <td class="vendor-no">73737892</td>
                    <td class="vendor-name">Vendor Name Two</td>  
                </tr> 
                <tr> 
                    <td class="vendor-no">73737892</td>
                    <td class="vendor-name">Vendor Name Three</td>  
                </tr> 
                <tr> 
                    <td class="vendor-no">73737892</td>
                    <td class="vendor-name">Vendor Name Four</td>  
                </tr> 
                <tr> 
                    <td class="vendor-no">73737892</td>
                    <td class="vendor-name">Vendor Name Five</td>  
                </tr> 
            </table> 
            <!-- Pagination links -->
        </div>
    </section>
@endsection