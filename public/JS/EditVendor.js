let EditIcon = document.querySelectorAll('.admin-edit');
let VendorProfile = document.querySelector('.show-record');
let CancelRecordModal = document.querySelector('.CancelRecordModal');
let VendorNoInput = document.querySelector('.show-record-side-bar ul li input[name="VendorNo"]');
let VendorNameInput = document.querySelector('.show-record-side-bar ul li input[name="VendorName"]');
let VendorName_PROFILE = document.querySelector('.VendorName_PROFILE');
let VendorNo_PROFILE = document.querySelector('.VendorNo_PROFILE');
let Approved = document.querySelector('.Approved');
let Waived = document.querySelector('.Waived_');
let Rejected = document.querySelector('.Rejected');
let Total = document.querySelector('.Total');
let UpdateVendor = document.querySelector('.UpdateVendor');

EditIcon.forEach(Edit => {
    Edit.addEventListener('click', () => {
        VendorProfile.classList.toggle('show');
        VendorNo_PROFILE.textContent = Edit.nextElementSibling.nextElementSibling.textContent;
        VendorName_PROFILE.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        VendorNoInput.value = VendorNo_PROFILE.textContent;
        VendorNameInput.value = VendorName_PROFILE.textContent;

        Approved.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Waived.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Rejected.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Total.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

        UpdateVendor.setAttribute('action', '/UpdateVendor/' + VendorNoInput.value);
    });
});

CancelRecordModal.addEventListener('click', () => {
    VendorProfile.classList.remove('show');
});