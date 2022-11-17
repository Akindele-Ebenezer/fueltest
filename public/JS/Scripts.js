let VendorName = document.querySelector('section.fuel-test .fuel-test-main .form input[placeholder="Name of VENDOR..."]'); 
let FuelTestForm = document.querySelector('section.fuel-test .fuel-test-main .form form');
 
document.addEventListener('click', () => {
    for (let i = 0; i < SelectFields.length; i++) {  
        SelectFields[i].addEventListener('click', (e) => {
            e.stopPropagation();
        }); 
        
        SelectFields[i].nextElementSibling.classList.remove('ToggleList');
    }
});
 
let SelectFields = document.querySelectorAll('.select')  
let SelectDropdownArray = document.querySelectorAll('.dropdown-list');

for (let i = 0; i < SelectFields.length; i++) {       
             
    SelectFields[i].addEventListener('click', (e) => { 
        e.stopPropagation();
        SelectFields[i].nextElementSibling.classList.toggle('ToggleList');         
    });  

    SelectFields[0].addEventListener('click', (SelectFieldsEvent) => {    
        document.addEventListener('click', (e) => {
            if (VendorName.id === "EditVendorName") {
                SelectFieldsEvent.preventDefault();
            } else {
                FuelTestForm.submit();
            }     
        });
    });  

} 

SelectDropdownArray.forEach(SelectDropdownLi => { 
    SelectDropdownLi.addEventListener('click', () => {
        if (SelectDropdownLi.parentElement.parentElement.previousElementSibling.getAttribute("name") === 'VendorNo') {
            SelectDropdownLi.parentElement.parentElement.previousElementSibling.value = SelectDropdownLi.lastElementChild.textContent; 
            SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList'); 
        } else {
            SelectDropdownLi.parentElement.parentElement.previousElementSibling.value = SelectDropdownLi.textContent;
            SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList'); 
        } 
    });

    SelectDropdownLi.parentElement.parentElement.addEventListener('mouseleave', () => {
        SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList'); 
    });   
})

let VendorNames = document.querySelectorAll('section.fuel-test .fuel-test-main .form .VendorList li');
let VendorNoInputBox = document.querySelector('section.fuel-test .fuel-test-main .form input[placeholder="Vendor No..."]');

VendorNoInputBox.addEventListener('input', (VendorNo) => { 
    for (let i = 0; i < VendorNames.length; i++) { 
        let FilterText = VendorNo.target.value.toLocaleLowerCase();
        
        if (VendorNames[i].firstElementChild.textContent.toLocaleLowerCase().indexOf(FilterText) != -1) {
            VendorNames[i].style.display = 'block';
        } else {
            VendorNames[i].style.display = 'none';
        } 
    }        
});
  
 let SubmitButton = document.querySelector('button[name="create_record"]');

 SubmitButton.addEventListener('click', (e) => {
     if(window.location.search.includes('GetRecord') === true) {
         e.preventDefault();
     }
 });