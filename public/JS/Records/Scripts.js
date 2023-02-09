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
        History[i][0].style.display = '-webkit-box';
        History[i][0].style.width = '20em';
        
        let HistoryTotal_ = History[i].length;
        let HistoryArray = [];
            HistoryArray.push(HistoryTotal_);
            HistoryTotalArray.push(HistoryTotal_);  
    } 
}  

for (let i = 0; i < HistoryTotal.length; i++) { 
    for (let j = 0; j < HistoryTotalArray.length; j++) {
        if(HistoryTotal[i].parentElement.parentElement.className == 'Today history') {
            continue;
        }
        // HistoryTotal[i].textContent = HistoryTotalArray[i];
        console.log(HistoryTotal[i].parentElement.parentElement.className) 
    }
}

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

let SampleNumbers = document.querySelectorAll('section.previous-records table tr td.sample-no .SampleNumber');
let Vendors = document.querySelectorAll('section.previous-records table tr td.vendors .VendorName');

let ShowRecordArr = [
    SampleNumbers,
    Vendors
];

let ShowRecord = document.querySelector('.ShowRecord');
let ShowRecordInner = document.querySelector('.ShowRecordInner');
let CancelRecordModal = document.querySelectorAll('.CancelRecordModal');

let ShowRecord_NumberOfTotalRecordsForEachVendor = document.querySelector('.ShowRecord .NumberOfTotalRecordsForEachVendor');
let ShowRecord_SampleNo = document.querySelector('.ShowRecord .SampleNo');
let ShowRecord_VendorName = document.querySelector('.ShowRecord .VendorName');
let ShowRecord_VendorName_ = document.querySelector('.ShowRecord .VendorName_');
let ShowRecord_VendorNo = document.querySelector('.ShowRecord .VendorNo');
let ShowRecord_SampleCollectionDate = document.querySelectorAll('.ShowRecord .SampleCollectionDate');
let ShowRecord_TruckPlateNo = document.querySelector('.ShowRecord .TruckPlateNo');
let ShowRecord_TankNo = document.querySelector('.ShowRecord .TankNo');
let ShowRecord_Temp = document.querySelector('.ShowRecord .Temp');
let ShowRecord_AppearanceResult = document.querySelector('.ShowRecord .AppearanceResult');
let ShowRecord_Color = document.querySelector('.ShowRecord .Color');
let ShowRecord_Density = document.querySelector('.ShowRecord .Density');
let ShowRecord_FlashPoint = document.querySelector('.ShowRecord .FlashPoint');
let ShowRecord_WaterSediment = document.querySelector('.ShowRecord .WaterSediment');
let ShowRecord_Cleanliness = document.querySelector('.ShowRecord .Cleanliness');
let ShowRecord_MadeBy = document.querySelector('.ShowRecord .MadeBy');
let ShowRecord_ApprovalForUse = document.querySelectorAll('.ShowRecord .ApprovalForUse'); 
let ShowRecord_DeliveredTo = document.querySelector('.ShowRecord .DeliveredTo');
let ShowRecord_Remarks = document.querySelector('.ShowRecord .Remarks');

let ShowRecord_OpenPdf = document.querySelector('section.ShowRecord .ShowRecordInner .pdf-and-edit .open-pdf');
 
let EditIcons = document.querySelectorAll('.EditIcon');  
let EditIcon_ = document.querySelectorAll('.EditIcon_');  
let ShowRecord_EditPdf = document.querySelector('section.edit-this-record');

let UpdateMyRecord = document.querySelector('.UpdateMyRecord');

let EditSampleNo = document.querySelector('.EditSampleNo');
let EditVendorName = document.querySelector('.EditVendorName');
let EditVendorNo = document.querySelector('.EditVendorNo');
let EditSampleCollectionDate = document.querySelectorAll('.EditSampleCollectionDate');
let EditTruckPlateNo = document.querySelector('.EditTruckPlateNo');
let EditTankNo = document.querySelector('.EditTankNo');
let EditTemp = document.querySelector('.EditTemp');
let EditAppearanceResult = document.querySelector('.EditAppearanceResult');
let EditColor = document.querySelector('.EditColor');
let EditDensity = document.querySelector('.EditDensity');
let EditFlashPoint = document.querySelector('.EditFlashPoint');
let EditWaterSediment = document.querySelector('.EditWaterSediment');
let EditCleanliness = document.querySelector('.EditCleanliness');
let EditMadeBy = document.querySelector('.EditMadeBy');
let EditApprovalForUse = document.querySelector('.EditApprovalForUse'); 
let EditDeliveredTo = document.querySelector('.EditDeliveredTo');
let EditRemarks = document.querySelector('.EditRemarks');

let SampleNo_ = document.querySelectorAll('.SampleNo_');
let VendorName_ = document.querySelector('.VendorName_');
let VendorNo_ = document.querySelector('.VendorNo_');
let MadeBy_ = document.querySelector('.MadeBy_');
 
    SampleNumbers.forEach(SampleNo => {
        SampleNo.addEventListener('click', () => { 
            ShowRecord.classList.toggle('show');
            ShowRecord.classList.add('show-record');
            ShowRecordInner.classList.add('show-record-side-bar');
    
            let Elements = SampleNo.parentElement.parentElement.children;
     
            for (let i = 0; i < Elements.length; i++) { 
                if (Elements[i].firstElementChild.classList.contains('TruckPlateNo')) {
                    ShowRecord_TruckPlateNo.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('VendorName')) {
                    ShowRecord_VendorName.textContent = Elements[i].firstElementChild.textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('SampleCollectionDate')) {  
                    ShowRecord_SampleCollectionDate.forEach(SampleCollectionDate => {
                        SampleCollectionDate.textContent = Elements[i].textContent; 
                    });
                } else if (Elements[i].firstElementChild.classList.contains('TankNo')) {
                    ShowRecord_TankNo.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('Temp')) {
                    ShowRecord_Temp.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('AppearanceResult')) {
                    ShowRecord_AppearanceResult.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('Color')) {
                    ShowRecord_Color.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('Density')) {
                    ShowRecord_Density.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('FlashPoint')) {
                    ShowRecord_FlashPoint.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('WaterSediment')) {
                    ShowRecord_WaterSediment.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('Cleanliness')) {
                    ShowRecord_Cleanliness.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('MadeBy')) {
                    ShowRecord_MadeBy.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('DeliveredTo')) {
                    ShowRecord_DeliveredTo.textContent = Elements[i].textContent; 
                } else if (Elements[i].firstElementChild.classList.contains('Remarks')) {
                    ShowRecord_Remarks.textContent = Elements[i].textContent; 
                }      
            }
    
            ShowRecord_OpenPdf.setAttribute('href', '/GenerateCertificate/' + SampleNo.textContent + '?Certificate');
            
            if(window.location.pathname == '/PreviousRecords') { 
                    UpdateMyRecord.setAttribute('action', '/UpdateMyRecord/' + SampleNo.textContent);
    
                    EditIcons.forEach(EditIcon => {
                        EditIcon.addEventListener('click', () => {
                            ShowRecord.classList.add('hide');
                            ShowRecord.classList.remove('show');
                            ShowRecord_EditPdf.classList.add('show');
        
                            EditSampleNo.value = ShowRecord_SampleNo.textContent;
                            SampleNo_.forEach(SampleNo => {
                                SampleNo.textContent = ShowRecord_SampleNo.textContent;
                            });
                            EditVendorName.value = ShowRecord_VendorName.textContent;
                            EditVendorNo.value = ShowRecord_VendorNo.textContent;
                            VendorName_.textContent = ShowRecord_VendorName.textContent;
                            VendorNo_.textContent = ShowRecord_VendorNo.textContent;
                            EditSampleCollectionDate.forEach(SampleCollectionDate => {
                                SampleCollectionDate.value = ShowRecord_SampleCollectionDate[0].textContent.substring(0, 10);
                            });
                            EditTruckPlateNo.value = ShowRecord_TruckPlateNo.textContent;
                            EditTankNo.value = ShowRecord_TankNo.textContent;
                            EditTemp.value = ShowRecord_Temp.textContent;
                            EditAppearanceResult.value = ShowRecord_AppearanceResult.textContent;
                            EditColor.value = ShowRecord_Color.textContent;
                            EditDensity.value = ShowRecord_Density.textContent;
                            EditFlashPoint.value = ShowRecord_FlashPoint.textContent;
                            EditWaterSediment.value = ShowRecord_WaterSediment.textContent;
                            EditCleanliness.value = ShowRecord_Cleanliness.textContent;
                            EditMadeBy.value = ShowRecord_MadeBy.textContent;
                            MadeBy_.textContent = ShowRecord_MadeBy.textContent;
                            EditApprovalForUse.value = ShowRecord_ApprovalForUse[0].textContent; 
                            EditDeliveredTo.value = ShowRecord_DeliveredTo.textContent;
                            EditRemarks.value = ShowRecord_Remarks.textContent;
        
                        });
                    });
                }
    

            ShowRecord_SampleNo.textContent = SampleNo.textContent;  
            ShowRecord_VendorName_.textContent = ShowRecord_VendorName.textContent;  
            ShowRecord_VendorNo.textContent = SampleNo.nextElementSibling.textContent; 
            ShowRecord_NumberOfTotalRecordsForEachVendor.textContent = SampleNo.nextElementSibling.nextElementSibling.textContent; 
            ShowRecord_ApprovalForUse.forEach(ApprovalForUse => {
                ApprovalForUse.textContent = SampleNo.nextElementSibling.nextElementSibling.nextElementSibling.textContent
            });  
        });  
    }); 
//  
    // EditIcon_.forEach(EditIcon => {
    //     EditIcon.addEventListener('click', () => { 
    //         ShowRecord_EditPdf.classList.add('show');

    //         EditSampleNo.value = ShowRecord_SampleNo.textContent;
    //         SampleNo_.forEach(SampleNo => {
    //             SampleNo.textContent = ShowRecord_SampleNo.textContent;
    //         });
    //         EditVendorName.value = ShowRecord_VendorName.textContent;
    //         EditVendorNo.value = ShowRecord_VendorNo.textContent;
    //         VendorName_.textContent = ShowRecord_VendorName.textContent;
    //         VendorNo_.textContent = ShowRecord_VendorNo.textContent;
    //         EditSampleCollectionDate.forEach(SampleCollectionDate => {
    //             SampleCollectionDate.value = ShowRecord_SampleCollectionDate[0].textContent.substring(0, 10);
    //         });
    //         EditTruckPlateNo.value = ShowRecord_TruckPlateNo.textContent;
    //         EditTankNo.value = ShowRecord_TankNo.textContent;
    //         EditTemp.value = ShowRecord_Temp.textContent;
    //         EditAppearanceResult.value = ShowRecord_AppearanceResult.textContent;
    //         EditColor.value = ShowRecord_Color.textContent;
    //         EditDensity.value = ShowRecord_Density.textContent;
    //         EditFlashPoint.value = ShowRecord_FlashPoint.textContent;
    //         EditWaterSediment.value = ShowRecord_WaterSediment.textContent;
    //         EditCleanliness.value = ShowRecord_Cleanliness.textContent;
    //         EditMadeBy.value = ShowRecord_MadeBy.textContent;
    //         MadeBy_.textContent = ShowRecord_MadeBy.textContent;
    //         EditApprovalForUse.value = ShowRecord_ApprovalForUse[0].textContent; 
    //         EditDeliveredTo.value = ShowRecord_DeliveredTo.textContent;
    //         EditRemarks.value = ShowRecord_Remarks.textContent;
    //     });   
    // });   
// 
Vendors.forEach(Vendor => {
    Vendor.addEventListener('click', () => {
        ShowRecord.classList.toggle('show');
        ShowRecord.classList.add('show-record');
        ShowRecordInner.classList.add('show-record-side-bar');

        ShowRecord_SampleNo.textContent = Vendor.nextElementSibling.textContent;  
        ShowRecord_VendorName.textContent = Vendor.textContent;  
        ShowRecord_VendorName_.textContent = Vendor.textContent;  
        ShowRecord_VendorNo.textContent = Vendor.nextElementSibling.nextElementSibling.textContent;  
        ShowRecord_NumberOfTotalRecordsForEachVendor.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.textContent;   
        ShowRecord_SampleCollectionDate.forEach(SampleCollectionDate => { 
            SampleCollectionDate.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        });
        ShowRecord_TruckPlateNo.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_TankNo.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_AppearanceResult.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_Color.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_Density.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_FlashPoint.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_WaterSediment.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_Cleanliness.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_MadeBy.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_ApprovalForUse.forEach(ApprovalForUse => { 
                ApprovalForUse.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        }); 
        ShowRecord_DeliveredTo.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_Remarks.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        ShowRecord_Temp.textContent = Vendor.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;  
    })
});

CancelRecordModal.forEach(Modal => {
    Modal.addEventListener('click', () => {
        ShowRecord.classList.remove('show'); 
        ShowRecord_EditPdf.classList.remove('show'); 
    });
});

