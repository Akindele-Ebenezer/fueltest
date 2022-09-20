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

let VendorNoInputBox = document.querySelector('section.fuel-test .fuel-test-main .form input[placeholder="Vendor No..."]');
let ChooseColorBox = document.querySelector('section.fuel-test .fuel-test-main .form .choose-color');
let ChooseAppearanceResult = document.querySelector('section.fuel-test .fuel-test-main .form .appearance-result');
let ChooseMadeBy = document.querySelector('section.fuel-test .fuel-test-main .form .made-by');
let ApprovalForUse = document.querySelector('section.fuel-test .fuel-test-main .form .approval-for-use');
 
let SelectFields = [
    VendorNoInputBox,
    ChooseColorBox,
    ChooseAppearanceResult,
    ChooseMadeBy, 
    ApprovalForUse, 
];
    
let VendorsList = document.querySelectorAll('section.fuel-test .fuel-test-main .form div section ul li'); 
let ColorList = document.querySelectorAll('section.fuel-test .fuel-test-main .form .Colors ul li');
let AppearanceResultList = document.querySelectorAll('section.fuel-test .fuel-test-main .form .AppearanceResult ul li');
let MadeByList = document.querySelectorAll('section.fuel-test .fuel-test-main .form .MadeBy ul li');

let SelectDropdownArray = [
    VendorsList,
    ColorList,
    AppearanceResultList,
    MadeByList,
];

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

SelectDropdownArray.forEach(SelectDropdown => {
    SelectDropdown.forEach(SelectDropdownLi => {
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
})

let VendorNames = document.querySelectorAll('section.fuel-test .fuel-test-main .form .VendorList li');

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
  
 