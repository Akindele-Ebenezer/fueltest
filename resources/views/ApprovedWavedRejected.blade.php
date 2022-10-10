<div>
    <form action="" class="Passed">
        <label>
            <input type="hidden" name="Title" value="{{ $title }}">
            <input type="submit" name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) || isset($_GET['FilterDateBetweenForCurrentVendor']) ? 'FilterPassedTestsForCurrentVendor' : 'FilterPassedTests' }}">
            <img src="images/approved.png">
            APPROVED [{{ Route::is('previous_records') ? $number_of_passed_records_ : '' }}{{ Route::is('all_records') ? $number_of_passed_records : '' }}]
        </label>
        <section class="tooltip">{{ Route::is('previous_records') ? $number_of_passed_records_ : '' }}{{ Route::is('all_records') ? $number_of_passed_records : '' }} DIESEL Tests = Approved</section> 
    </form> 
    <form action="" class="Waved">
        <label>
            <input type="hidden" name="Title" value="{{ $title }}">
            <input type="submit" name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) || isset($_GET['FilterDateBetweenForCurrentVendor']) ? 'FilterWavedTestsForCurrentVendor' : 'FilterWavedTests' }}">
            <img src="images/waved.png">
            WAVED [{{ Route::is('previous_records') ? $number_of_waved_records_ : '' }}{{ Route::is('all_records') ? $number_of_waved_records : '' }}]
        </label>
        <section class="tooltip">{{ Route::is('previous_records') ? $number_of_waved_records_ : '' }}{{ Route::is('all_records') ? $number_of_waved_records : '' }} DIESEL Tests = Waved</section> 
    </form> 
    <form action="" class="Failed">
        <label>
            <input type="hidden" name="Title" value="{{ $title }}">
            <input type="submit" name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) || isset($_GET['FilterDateBetweenForCurrentVendor']) ? 'FilterFailedTestsForCurrentVendor' : 'FilterFailedTests' }}">
            <img src="images/rejected.png">
            REJECTED [{{ Route::is('previous_records') ? $number_of_failed_records_ : '' }}{{ Route::is('all_records') ? $number_of_failed_records : '' }}]
        </label>
        <section class="tooltip">{{ $number_of_failed_records }} DIESEL Tests = Rejected</section> 
    </form> 
    <form action="" class="Diff">
        <label>
            <input type="hidden" name="Title" value="{{ $title }}">
            <input type="submit" name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) || isset($_GET['FilterDateBetweenForCurrentVendor']) ? 'FilterDiffTestsForCurrentVendor' : 'FilterDiffTests' }}">
            <img src="images/diff.png">
            DIFF [{{ Route::is('previous_records') ? $number_of_diff_records_ : '' }}{{ Route::is('all_records') ? $number_of_diff_records : '' }}]
        </label>
        <section class="tooltip">{{ $number_of_diff_records }} Non DIESEL Tests = Diff</section> 
    </form>  
</div>