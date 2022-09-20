let ToolTipsParent1 = document.querySelectorAll('.date div a');
let ToolTipsParent2 = document.querySelectorAll('.date div form');
let ToolTipsParent3 = document.querySelectorAll('.date div .todays-date');
let ToolTipsParent4 = document.querySelectorAll('.date div .clock');
let ToolTipsParent5 = document.querySelectorAll('.pdf-and-edit');
let ToolTipsParent6 = document.querySelectorAll('.Passed');
let ToolTipsParent7 = document.querySelectorAll('.Waved');
let ToolTipsParent8 = document.querySelectorAll('.Failed');

let ToolTipsArray = [
    ToolTipsParent1,
    ToolTipsParent2,
    ToolTipsParent3,
    ToolTipsParent4,
    ToolTipsParent5,
    ToolTipsParent6,
    ToolTipsParent7,
    ToolTipsParent8,
]; 

ToolTipsArray.forEach(ToolTipParentElement => {
    ToolTipParentElement.forEach(ToolTipParent => { 
        ToolTipParent.addEventListener('mouseenter', () => {
            ToolTipParent.lastElementChild.classList.add('show');
        });

        ToolTipParent.addEventListener('mouseleave', () => {
            ToolTipParent.lastElementChild.classList.remove('show');
        });
    });
});
    