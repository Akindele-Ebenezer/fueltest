let Filter = document.querySelectorAll('section.previous-records table tr th .filter');
let FilterSvg = document.querySelectorAll('section.previous-records table tr th svg:last-of-type'); 

document.addEventListener('click', (e) => {                
    for (let i = 0; i < Filter.length; i++) { 
        Filter[i].classList.remove('filter-toggle');  
        e.stopPropagation();
    } 
});

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

let Yesterday = document.querySelectorAll('section.previous-records table tr.Yesterday');
let Today = document.querySelectorAll('section.previous-records table tr.Today');
let TwoDaysAgo = document.querySelectorAll('section.previous-records table tr.Two-Days-Ago');
let ThreeDaysAgo = document.querySelectorAll('section.previous-records table tr.Three-Days-Ago');
let FourDaysAgo = document.querySelectorAll('section.previous-records table tr.Four-Days-Ago');
let FiveDaysAgo = document.querySelectorAll('section.previous-records table tr.Five-Days-Ago');
let SixDaysAgo = document.querySelectorAll('section.previous-records table tr.Six-Days-Ago');
let LastWeek = document.querySelectorAll('section.previous-records table tr.Last-Week');
let TwoWeeksAgo = document.querySelectorAll('section.previous-records table tr.Two-Weeks-Ago');
let ThreeWeeksAgo = document.querySelectorAll('section.previous-records table tr.Three-Weeks-Ago');
let LastMonth = document.querySelectorAll('section.previous-records table tr.Last-Month');
let TwoMonthsAgo = document.querySelectorAll('section.previous-records table tr.Two-Months-Ago');
let Older = document.querySelectorAll('section.previous-records table tr.Older');

let History = [
    Yesterday,
    Today,
    TwoDaysAgo,
    ThreeDaysAgo,
    FourDaysAgo,
    FiveDaysAgo,
    SixDaysAgo,
    LastWeek,
    TwoWeeksAgo,
    ThreeWeeksAgo,
    LastMonth,
    TwoMonthsAgo,
    Older,
]

let HistoryTotal = document.querySelectorAll('section.previous-records table tr.history span');
let HistoryTotalArray = [];

for (let i = 0; i < History.length; i++) {
    for (let j = 0; j < History[i].length; j++) { 
        History[i][0].style.display = 'block';
        
        let HistoryTotal_ = History[i].length;
        let HistoryArray = [];
            HistoryArray.push(HistoryTotal_);
            HistoryTotalArray.push(HistoryTotal_); 
    } 
}  

// for (let i = 0; i < HistoryTotal.length; i++) { 
//     for (let j = 0; j < HistoryTotalArray.length; j++) {
//         HistoryTotal[i].textContent = HistoryTotalArray[i]; 
//     }
// }

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
