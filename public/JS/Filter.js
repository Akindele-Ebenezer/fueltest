let Filter = document.querySelectorAll('section.previous-records table tr th .filter');
let FilterSvg = document.querySelectorAll('section.previous-records table tr th svg:last-of-type'); 

for (let i = 0; i < FilterSvg.length; i++) {  

    FilterSvg[i].addEventListener('click', () => {
        FilterSvg[i].nextElementSibling.classList.toggle('filter-toggle'); 
    });

}

for (let i = 0; i < FilterSvg.length; i++) {  
    FilterSvg[i].addEventListener('click', (e) => {        
        e.stopPropagation(); 
    });
} 

document.addEventListener('click', (e) => {                
    for (let i = 0; i < Filter.length; i++) { 
        e.stopPropagation();
        Filter[i].classList.remove('filter-toggle');  
    } 
});
let CheckBoxLists = document.querySelectorAll('section.previous-records table tr th .filter ul li');

for (let i = 0; i < CheckBoxLists.length; i++) { 
    CheckBoxLists[i].addEventListener('click', (e) => {
        e.stopPropagation();

        if(CheckBoxLists[i].firstElementChild.checked == false) {
            CheckBoxLists[i].firstElementChild.checked = true; 
        }
        else {
            if(CheckBoxLists[i].firstElementChild.checked == true) {
                CheckBoxLists[i].firstElementChild.checked = false; 
            }   
        } 
    });
}

let CheckBoxInput = document.querySelectorAll('section.previous-records table tr th .filter ul li input');

for (let i = 0; i < CheckBoxInput.length; i++) { 
    CheckBoxInput[i].addEventListener('click', () => {
        if(CheckBoxInput[i].checked == false) {
            CheckBoxInput[i].checked = true; 
        }
        else {
            if(CheckBoxInput[i].checked == true) {
                CheckBoxInput[i].checked = false; 
            }   
        } 
    });
} 