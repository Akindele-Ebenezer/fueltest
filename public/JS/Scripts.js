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
                // FuelTestForm.submit();
            }     
        });
    });  

} 

SelectDropdownArray.forEach(SelectDropdownLi => { 
    SelectDropdownLi.addEventListener('click', () => {
        if (SelectDropdownLi.parentElement.parentElement.previousElementSibling.getAttribute("name") === 'VendorNo') {
            SelectDropdownLi.parentElement.parentElement.previousElementSibling.value = SelectDropdownLi.lastElementChild.textContent; 
            SelectDropdownLi.parentElement.parentElement.nextElementSibling.value = SelectDropdownLi.firstElementChild.textContent; 
            SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList');  
        } else {
            SelectDropdownLi.parentElement.parentElement.previousElementSibling.value = SelectDropdownLi.textContent;
            SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList'); 
            
            switch (SelectDropdownLi.parentElement.parentElement.previousElementSibling.className) {
                case 'appearance-result select':
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.value.trim() === 'BRIGHT' 
                    || SelectDropdownLi.parentElement.parentElement.previousElementSibling.value.trim() === 'CLEAR'
                    ? 'Passed' : 'Failed';
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.value.trim() === 'BRIGHT' 
                    || SelectDropdownLi.parentElement.parentElement.previousElementSibling.value.trim() === 'CLEAR'
                    ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a';
                    break;
                case 'choose-color select':
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                    (Number(SelectDropdownLi.parentElement.parentElement.previousElementSibling.value) <= 2.5)  
                    ? 'Passed' : 'Failed';
                    SelectDropdownLi.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                    (Number(SelectDropdownLi.parentElement.parentElement.previousElementSibling.value) <= 2.5)  
                    ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a';
                    break;
                default:
                    break;
            }
        } 
    });

    SelectDropdownLi.parentElement.parentElement.addEventListener('mouseleave', () => {
        SelectDropdownLi.parentElement.parentElement.classList.remove('ToggleList'); 
    });   
});

let TestInputs = document.querySelectorAll('input');

TestInputs.forEach(TestInput => {
    switch (TestInput.className) {
        case 'density-result':
            TestInput.addEventListener('change', () => {
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                (Number(TestInput.value) >= 0.82) && (Number(TestInput.value) <= 0.855)
                ? 'Passed' : 'Failed'; 
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                (Number(TestInput.value) >= 0.82) && (Number(TestInput.value) <= 0.855)
                ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a';
            });
            break;
        case 'flash-point-result':
            TestInput.addEventListener('change', () => {
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                (Number(TestInput.value) >= 52) && (Number(TestInput.value) <= 92)
                ? 'Passed' : 'Failed'; 
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                (Number(TestInput.value) >= 52) && (Number(TestInput.value) <= 92)
                ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a'; 
            });
            break;
        case 'water-sediment-result':
            TestInput.addEventListener('change', () => {
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                (Number(TestInput.value) >= 0) && (Number(TestInput.value) <= 0.050)
                ? 'Passed' : 'Failed'; 
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                (Number(TestInput.value) >= 0) && (Number(TestInput.value) <= 0.050)
                ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a'; 
            });
            break;
        case 'cleanliness-result':
            TestInput.addEventListener('change', () => {
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.textContent = 
                (Number(TestInput.value) >= 0) && (Number(TestInput.value) <= 15)
                ? 'Passed' : 'Failed'; 
                TestInput.previousElementSibling.previousElementSibling.lastElementChild.style.backgroundColor = 
                (Number(TestInput.value) >= 0) && (Number(TestInput.value) <= 15)
                ? 'rgba(43, 168, 145, 0.8)' : '#ff1a1a'; 
            });
            break;
    
        default:
            break;
    }
});


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

 