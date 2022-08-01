@php 
    ob_start();

    $id = Session::get('id'); 
    $name = Session::get('name');
    $email = Session::get('email');
    $title = 'Filter Records';
    $header_info = 'Manage all your Records effectively. Log In';
    
@endphp 

@extends('layouts.layout_1')
 
 @section('name', $name)
 @section('email', $email)
 @section('header_info', $title)
 @section('title', $title)
 @section('content')

 <section class="previous-records">
        <center>
            <h1>{{ $title }}</h1>
            <form action="/export">
                <button type="submit" name="export">Export to Excel</button>
            </form>
        </center>
        <div>
            <table>
                <tr> 
                    <th> </th> 
                    <th>Sample No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Sample Collection Date <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-sample-collection-date-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Truck Plate No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-truck-plate-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Tank No. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-tank-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Appearance Result <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-appearance-result-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Color <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Density in Kg/m<sup>3</sup> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-density-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Flash Point <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-flash-point-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Temp °C <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-temp-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Water/Sediment %  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-water-sediment-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Cleanliness <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-cleanliness-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Date Of Test <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-date-of-test-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Made By (Name) <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-made-by-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Delivered To <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-delivered-to-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                    <th>Remarks <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg> <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg></th>
                </tr>
                @if($number_of_all_records == 0)
                <tr>
                    <td>
                         There are no RECORDS.. 
                    </td>
                </tr>
                @endif
                @isset($_GET['FilterSampleNo'])
                    @foreach($FilteredRecords as $record)
                    <tr>  
                        <td class="pdf-and-edit">
                            <form action="/generate_certificate/{{ $record->SampleNo }}" method="get" target="_blank">@csrf
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
                @endisset
            </table> 
            <!-- Pagination links -->
        </div>
    </section>
 @endsection