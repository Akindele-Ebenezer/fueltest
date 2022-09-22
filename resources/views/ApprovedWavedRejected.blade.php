<div>
    <form action="" class="Passed">
        <label>
            <input type="submit" name="FilterPassedTests">
            <img src="images/approved.png">
            APPROVED [{{ Route::is('previous_records') ? $number_of_passed_records_ : '' }}{{ Route::is('all_records') ? $number_of_passed_records : '' }}]
        </label>
        <section class="tooltip">{{ Route::is('previous_records') ? $number_of_passed_records_ : '' }}{{ Route::is('all_records') ? $number_of_passed_records : '' }} DIESEL Tests = Approved</section> 
    </form> 
    <form action="" class="Waved">
        <label>
            <input type="submit" name="FilterWavedTests">
            <img src="images/waved.png">
            WAVED [{{ Route::is('previous_records') ? $number_of_waved_records_ : '' }}{{ Route::is('all_records') ? $number_of_waved_records : '' }}]
        </label>
        <section class="tooltip">{{ Route::is('previous_records') ? $number_of_waved_records_ : '' }}{{ Route::is('all_records') ? $number_of_waved_records : '' }} DIESEL Tests = Waved</section> 
    </form> 
    <form action="" class="Failed">
        <label>
            <input type="submit" name="FilterFailedTests">
            <img src="images/rejected.png">
            REJECTED [{{ Route::is('previous_records') ? $number_of_failed_records_ : '' }}{{ Route::is('all_records') ? $number_of_failed_records : '' }}]
        </label>
        <section class="tooltip">{{ $number_of_failed_records }} DIESEL Tests = Rejected</section> 
    </form> 
    <form action="" class="Diff">
        <label>
            <input type="submit" name="FilterDiffTests">
            <img src="images/diff.png">
            DIFF [{{ Route::is('previous_records') ? $number_of_diff_records_ : '' }}{{ Route::is('all_records') ? $number_of_diff_records : '' }}]
        </label>
        <section class="tooltip">{{ $number_of_diff_records }} Non DIESEL Tests = Diff</section> 
    </form>  
</div>