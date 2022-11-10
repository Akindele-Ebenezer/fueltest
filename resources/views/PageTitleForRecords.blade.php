<center>  
    <div>
        <h1>{{ $title }} ({{ Route::is('all_records') ? $number_of_all_records_absolute : '' }}{{ Route::is('previous_records') ? $number_of_previous_records_absolute : '' }})</h1> <br> <span>({{ Route::is('all_records') ? $number_of_all_records : '' }}{{ Route::is('previous_records') ? $number_of_previous_records : '' }})</span>
    </div>
    <div>
        <form action="/export">
            <button type="submit" name="export">Export to Excel</button>
        </form>
        <a href="{{ route('fuel_test') }}"><button>Add Record +</button></a>                
    </div>
    @include('ApprovedWavedRejected')
</center> 
<section class="search">
    <form action="">
        <input type="text" name="SearchValue" placeholder="Search..">
        <input type="submit" class="button" name="Search" value="Filter">
        <input type="submit" class="button" name="Clear" value="Clear">
    </form>
</section> 