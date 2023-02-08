let EditIcon = document.querySelectorAll('.admin-edit');
let UserProfile = document.querySelector('.show-record');
let CancelRecordModal = document.querySelector('.CancelRecordModal');
let UserNameInput = document.querySelector('.show-record-side-bar ul li input[name="UserName"]');
let UserEmailInput = document.querySelector('.show-record-side-bar ul li input[name="UserEmail"]');
let UserPasswordInput = document.querySelector('.show-record-side-bar ul li input[name="UserPassword"]');
let UserName_PROFILE = document.querySelector('.UserName_PROFILE');
let UserRoleInput = document.querySelector('.show-record-side-bar ul li select[name="UserRole"]'); 
let Approved = document.querySelector('.Approved');
let Waived = document.querySelector('.Waived_');
let Rejected = document.querySelector('.Rejected');
let Total = document.querySelector('.Total');
let UpdateUser = document.querySelector('.UpdateUser');

EditIcon.forEach(Edit => {
    Edit.addEventListener('click', () => {
        UserProfile.classList.toggle('show');
        UserName_PROFILE.textContent = Edit.nextElementSibling.textContent; 
        UserNameInput.value = UserName_PROFILE.textContent; 
        UserEmailInput.value = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        UserPasswordInput.value = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 
        // UserRoleInput.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent; 

        Approved.textContent = Edit.nextElementSibling.nextElementSibling.textContent;
        Waived.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Rejected.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Total.textContent = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        UserId = Edit.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

        UpdateUser.setAttribute('action', '/UpdateUser/' + UserId);
    });
});

CancelRecordModal.addEventListener('click', () => {
    UserProfile.classList.remove('show');
});