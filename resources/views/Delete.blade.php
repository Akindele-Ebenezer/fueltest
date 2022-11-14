<script>
                            
    let DeleteRecord = document.querySelector('section.search form:last-of-type button');
    let DeleteRecordForm = document.querySelectorAll('section.previous-records table td.action form');    

    let DeletedItems = [];

    DeleteRecordForm.forEach((CheckBoxForm) => {
        DeleteRecord.addEventListener('click', (e)  => {
            e.preventDefault();   
            CheckBoxForm.submit();

            // if(CheckBoxForm.firstElementChild.checked == true) {
            //     DeletedItems.push(CheckBoxForm.firstElementChild.value);
                
            //     let DeletedItemSet = new Set(DeletedItems);
            //     console.log(DeletedItems);
                                     

            // } else {
            //     DeletedItems.shift(CheckBoxForm.firstElementChild.value);
            // }
        });
    }); 

    @php 
        // $DeleteItems = App\Models\FuelTestRecord::whereIn('id', [230])
        //                                         ->get();                    
        // print_r($a);

    @endphp 
</script> 