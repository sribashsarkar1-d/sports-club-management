(() => {

'use strict';

/*
=========================================================
PREVENT MULTIPLE INITIALIZATION
=========================================================
*/

if(window.__SCM_STEP1_INITIALIZED__){

return;

}

window.__SCM_STEP1_INITIALIZED__ = true;

/*
=========================================================
STORAGE KEYS
=========================================================
*/

const STORAGE_KEYS = {

FORM:
'scm_step1_form',

IMAGE:
'scm_step1_image',

STEP:
'scm_current_step'

};

/*
=========================================================
ELEMENTS
=========================================================
*/

const form =
document.querySelector('#step1Form');

if(!form){

return;

}

const fields = {

fullName:
document.querySelector('#full_name'),

email:
document.querySelector('#email'),

mobile:
document.querySelector('#mobile'),

gender:
document.querySelector('#gender'),

dob:
document.querySelector('#dob'),

age:
document.querySelector('#age'),

bloodGroup:
document.querySelector('#blood_group'),

address:
document.querySelector('#address'),

photo:
document.querySelector('#photo'),

preview:
document.querySelector('#preview'),

compressedPhoto:
document.querySelector('#compressed_photo'),

uploadZone:
document.querySelector('#photoZone')

};

const submitButton =
form.querySelector(
'button[type="submit"]'
);

/*
=========================================================
STATE
=========================================================
*/

let isSubmitting = false;

/*
=========================================================
SAFE JSON
=========================================================
*/

function safeJSONParse(data){

try{

return JSON.parse(data);

}catch{

return null;

}

}

/*
=========================================================
SANITIZE
=========================================================
*/

function sanitize(value){

return String(value || '')
.replace(/<[^>]*>?/gm, '')
.replace(/[<>]/g, '')
.trim();

}

/*
=========================================================
SAVE STEP
=========================================================
*/

function saveCurrentStep(){

sessionStorage.setItem(
STORAGE_KEYS.STEP,
'step1'
);

}

/*
=========================================================
RESET BUTTON
=========================================================
*/

function resetSubmitButton(){

isSubmitting = false;

if(submitButton){

submitButton.disabled = false;

submitButton.style.pointerEvents =
'auto';

submitButton.style.opacity = '1';

submitButton.removeAttribute(
'data-loading'
);

submitButton.innerHTML =
'Next Step →';

}

}

/*
=========================================================
LOCK BUTTON
=========================================================
*/

function lockSubmitButton(){

isSubmitting = true;

if(submitButton){

submitButton.disabled = true;

submitButton.style.pointerEvents =
'none';

submitButton.style.opacity = '0.7';

submitButton.setAttribute(
'data-loading',
'true'
);

submitButton.innerHTML =
'Please Wait...';

}

}

/*
=========================================================
CLEAR ERRORS
=========================================================
*/

function clearErrors(){

document
.querySelectorAll('.dynamic-error')
.forEach(el => el.remove());

document
.querySelectorAll('.is-invalid')
.forEach(el => {

el.classList.remove(
'is-invalid'
);

});

}

/*
=========================================================
SHOW ERROR
=========================================================
*/

function showError(input, message){

if(!input) return;

removeError(input);

input.classList.add(
'is-invalid'
);

const parent =
input.parentElement;

if(
parent.querySelector('.dynamic-error')
){

return;

}

const error =
document.createElement('span');

error.className =
'invalid-feedback dynamic-error';

error.style.display =
'block';

error.innerText =
message;

parent.appendChild(error);

}

/*
=========================================================
REMOVE ERROR
=========================================================
*/

function removeError(input){

if(!input) return;

input.classList.remove(
'is-invalid'
);

const parent =
input.parentElement;

const old =
parent.querySelector(
'.dynamic-error'
);

if(old){

old.remove();

}

}

/*
=========================================================
SAVE FORM
=========================================================
*/

function saveFormData(){

const data = {

full_name:
sanitize(
fields.fullName?.value
),

email:
sanitize(
fields.email?.value
),

mobile:
sanitize(
fields.mobile?.value
),

gender:
sanitize(
fields.gender?.value
),

date_of_birth:
sanitize(
fields.dob?.value
),

age:
sanitize(
fields.age?.value
),

blood_group:
sanitize(
fields.bloodGroup?.value
),

address:
sanitize(
fields.address?.value
),

compressed_photo:
fields.compressedPhoto?.value || ''

};

localStorage.setItem(
STORAGE_KEYS.FORM,
JSON.stringify(data)
);

}

/*
=========================================================
PROFESSIONAL REALTIME AGE CALCULATION
=========================================================
*/

function calculateAge(){

if(
!fields.dob ||
!fields.age
){

return false;

}

const dobValue =
fields.dob.value.trim();

/*
=========================================================
EMPTY DOB
=========================================================
*/

if(!dobValue){

fields.age.value = '';

removeError(fields.dob);

saveFormData();

return false;

}

/*
=========================================================
PARSE DOB
=========================================================
*/

const birthDate =
new Date(dobValue);

if(
isNaN(birthDate.getTime())
){

fields.age.value = '';

showError(
fields.dob,
'Invalid date of birth'
);

saveFormData();

return false;

}

/*
=========================================================
CURRENT DATE
=========================================================
*/

const today =
new Date();

birthDate.setHours(0,0,0,0);

today.setHours(0,0,0,0);

/*
=========================================================
FUTURE DATE CHECK
=========================================================
*/

if(birthDate > today){

fields.age.value = '';

showError(
fields.dob,
'Future date is not allowed'
);

saveFormData();

return false;

}

/*
=========================================================
EXACT AGE CALCULATION
LEAP YEAR + BIRTHDAY LOGIC
=========================================================
*/

let age =
today.getFullYear() -
birthDate.getFullYear();

const currentMonth =
today.getMonth();

const birthMonth =
birthDate.getMonth();

const currentDay =
today.getDate();

const birthDay =
birthDate.getDate();

if(

currentMonth < birthMonth ||

(
currentMonth === birthMonth &&
currentDay < birthDay
)

){

age--;

}

/*
=========================================================
NEGATIVE SAFETY
=========================================================
*/

if(age < 0){

fields.age.value = '';

showError(
fields.dob,
'Invalid date of birth'
);

saveFormData();

return false;

}

/*
=========================================================
SET AGE
=========================================================
*/

fields.age.value =
age;

/*
=========================================================
MINIMUM AGE VALIDATION
=========================================================
*/

if(age < 5){

showError(
fields.dob,
'Minimum age must be 5 years'
);

saveFormData();

return false;

}

/*
=========================================================
VALID
=========================================================
*/

removeError(fields.dob);

saveFormData();

return true;

}

/*
=========================================================
RESTORE FORM
=========================================================
*/

function restoreFormData(){

const saved =
safeJSONParse(
localStorage.getItem(
STORAGE_KEYS.FORM
)
);

if(!saved) return;

if(fields.fullName)
fields.fullName.value =
saved.full_name || '';

if(fields.email)
fields.email.value =
saved.email || '';

if(fields.mobile)
fields.mobile.value =
saved.mobile || '';

if(fields.gender)
fields.gender.value =
saved.gender || '';

if(fields.dob)
fields.dob.value =
saved.date_of_birth || '';

if(fields.bloodGroup)
fields.bloodGroup.value =
saved.blood_group || '';

if(fields.address)
fields.address.value =
saved.address || '';

if(
fields.compressedPhoto
){

fields.compressedPhoto.value =
saved.compressed_photo || '';

}

/*
=========================================================
AUTO RECALCULATE AGE
=========================================================
*/

requestAnimationFrame(() => {

calculateAge();

});

}

/*
=========================================================
RESTORE IMAGE
=========================================================
*/

function restoreImage(){

const savedImage =
localStorage.getItem(
STORAGE_KEYS.IMAGE
);

if(
!savedImage ||
!savedImage.startsWith('data:image')
){

return;

}

if(
!fields.preview ||
!fields.compressedPhoto
){

return;

}

requestAnimationFrame(() => {

fields.preview.src =
savedImage;

fields.preview.style.display =
'block';

fields.compressedPhoto.value =
savedImage;

if(fields.uploadZone){

fields.uploadZone.classList.add(
'has-file'
);

}

});

}

/*
=========================================================
AUTO SAVE
=========================================================
*/

function setupAutoSave(){

Object.values(fields)
.forEach(field => {

if(
!field ||
field.type === 'file'
){

return;

}

field.addEventListener(
'input',
saveFormData,
{ passive:true }
);

field.addEventListener(
'change',
saveFormData,
{ passive:true }
);

});

}

/*
=========================================================
VALIDATIONS
=========================================================
*/

function validateFullName(){

const value =
sanitize(
fields.fullName.value
);

if(value.length < 3){

showError(
fields.fullName,
'Enter valid full name'
);

return false;

}

removeError(fields.fullName);

return true;

}

function validateEmail(){

const value =
sanitize(
fields.email.value
);

const pattern =
/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if(!pattern.test(value)){

showError(
fields.email,
'Enter valid email'
);

return false;

}

removeError(fields.email);

return true;

}

function validateMobile(){

fields.mobile.value =
fields.mobile.value.replace(
/[^0-9]/g,
''
);

if(
fields.mobile.value.length > 10
){

fields.mobile.value =
fields.mobile.value.slice(0,10);

}

const pattern =
/^[6-9][0-9]{9}$/;

if(
!pattern.test(
fields.mobile.value
)
){

showError(
fields.mobile,
'Enter valid Indian mobile number'
);

return false;

}

removeError(fields.mobile);

return true;

}

function validateGender(){

if(
fields.gender.value === ''
){

showError(
fields.gender,
'Select gender'
);

return false;

}

removeError(fields.gender);

return true;

}

/*
=========================================================
DOB VALIDATION
=========================================================
*/

function validateDOB(){

return calculateAge();

}

function validateBloodGroup(){

if(
fields.bloodGroup.value === ''
){

showError(
fields.bloodGroup,
'Select blood group'
);

return false;

}

removeError(fields.bloodGroup);

return true;

}

/*
=========================================================
ADDRESS VALIDATION
=========================================================
*/

function validateAddress(){

if(
!fields.address
){

return true;

}

const value =
sanitize(
fields.address.value || ''
);

if(value.length < 5){

showError(
fields.address,
'Enter complete address'
);

return false;

}

removeError(fields.address);

return true;

}

function validatePhoto(){

if(
!fields.compressedPhoto.value
){

showError(
fields.photo,
'Upload profile image'
);

return false;

}

removeError(fields.photo);

return true;

}

/*
=========================================================
REVALIDATE RESTORED DATA
=========================================================
*/

function revalidateRestoredData(){

if(
fields.fullName &&
fields.fullName.value.trim().length >= 3
){

removeError(fields.fullName);

}

if(
fields.email &&
/^[^\s@]+@[^\s@]+\.[^\s@]+$/
.test(fields.email.value.trim())
){

removeError(fields.email);

}

if(
fields.mobile &&
/^[6-9][0-9]{9}$/
.test(fields.mobile.value.trim())
){

removeError(fields.mobile);

}

if(
fields.gender &&
fields.gender.value !== ''
){

removeError(fields.gender);

}

if(
fields.dob &&
fields.dob.value
){

calculateAge();

}

if(
fields.bloodGroup &&
fields.bloodGroup.value !== ''
){

removeError(fields.bloodGroup);

}

if(
fields.address &&
fields.address.value &&
fields.address.value.trim().length >= 5
){

removeError(fields.address);

}

if(
fields.compressedPhoto &&
fields.compressedPhoto.value
){

removeError(fields.photo);

}

}

/*
=========================================================
IMAGE PROCESSOR
=========================================================
*/

async function processImage(file){

return new Promise(

(resolve, reject) => {

if(
!file.type.startsWith(
'image/'
)
){

reject(
new Error(
'Only image files allowed'
)
);

return;

}

const reader =
new FileReader();

reader.onload = function(e){

const img =
new Image();

img.onload = function(){

try{

const canvas =
document.createElement(
'canvas'
);

const ctx =
canvas.getContext('2d');

const MAX_DIMENSION = 1600;

let width =
img.width;

let height =
img.height;

if(width > height){

if(width > MAX_DIMENSION){

height *=
MAX_DIMENSION / width;

width =
MAX_DIMENSION;

}

}else{

if(height > MAX_DIMENSION){

width *=
MAX_DIMENSION / height;

height =
MAX_DIMENSION;

}

}

canvas.width =
width;

canvas.height =
height;

ctx.drawImage(
img,
0,
0,
width,
height
);

let quality = 0.9;

let output =
canvas.toDataURL(
'image/jpeg',
quality
);

while(

getBase64Size(output) > 1024 &&
quality > 0.05

){

quality -= 0.05;

output =
canvas.toDataURL(
'image/jpeg',
quality
);

}

if(output.length > 900000){

throw new Error(
'Compressed image too large'
);

}

localStorage.setItem(
STORAGE_KEYS.IMAGE,
output
);

requestAnimationFrame(() => {

fields.preview.src =
output;

fields.preview.style.display =
'block';

});

canvas.width = 1;
canvas.height = 1;

img.src = '';

resolve(output);

}catch(error){

reject(
new Error(
'Image processing failed'
)
);

}

};

img.onerror = function(){

reject(
new Error(
'Invalid image file'
)
);

};

img.src =
e.target.result;

};

reader.onerror = function(){

reject(
new Error(
'Failed to read image'
)
);

};

reader.readAsDataURL(file);

}

);

}

function getBase64Size(base64){

const stringLength =
base64.length -
'data:image/jpeg;base64,'.length;

const sizeInBytes =
4 *
Math.ceil(stringLength / 3) *
0.5624896334383812;

return sizeInBytes / 1024;

}

/*
=========================================================
IMAGE CHANGE
=========================================================
*/

function setupImageUpload(){

if(!fields.photo) return;

fields.photo.addEventListener(

'change',

async function(e){

const file =
e.target.files[0];

if(!file) return;

try{

removeError(fields.photo);

const processedImage =
await processImage(file);

fields.compressedPhoto.value =
processedImage;

fields.uploadZone?.classList.add(
'has-file'
);

saveFormData();

}catch(error){

showError(
fields.photo,
error.message
);

fields.photo.value = '';

}

},

{ passive:true }

);

}

/*
=========================================================
REALTIME VALIDATION
=========================================================
*/

function setupRealtimeValidation(){

if(fields.fullName){

fields.fullName.addEventListener(
'input',
validateFullName
);

}

if(fields.email){

fields.email.addEventListener(
'input',
validateEmail
);

}

if(fields.mobile){

fields.mobile.addEventListener(
'input',
validateMobile
);

}

if(fields.gender){

fields.gender.addEventListener(
'change',
validateGender
);

}

/*
=========================================================
DOB REALTIME EVENTS
=========================================================
*/

if(fields.dob){

fields.dob.addEventListener(
'input',
calculateAge,
{ passive:true }
);

fields.dob.addEventListener(
'change',
calculateAge,
{ passive:true }
);

}

if(fields.bloodGroup){

fields.bloodGroup.addEventListener(
'change',
validateBloodGroup
);

}

if(fields.address){

fields.address.addEventListener(
'input',
validateAddress
);

}

}

/*
=========================================================
FORM SUBMIT
=========================================================
*/

function setupSubmit(){

form.addEventListener(

'submit',

async function(e){

e.preventDefault();

if(isSubmitting){

return;

}

clearErrors();

resetSubmitButton();

const isValid =

validateFullName() &&
validateEmail() &&
validateMobile() &&
validateGender() &&
validateDOB() &&
validateBloodGroup() &&
validateAddress() &&
validatePhoto();

if(!isValid){

const firstError =
document.querySelector(
'.is-invalid'
);

if(firstError){

firstError.focus();

}

resetSubmitButton();

return;

}

lockSubmitButton();

saveFormData();

saveCurrentStep();

await new Promise(resolve =>
setTimeout(resolve, 80)
);

HTMLFormElement.prototype.submit.call(
form
);

}

);

}

/*
=========================================================
CLEAR REGISTRATION STORAGE
=========================================================
*/

window.clearRegistrationStorage =
function(){

Object.values(STORAGE_KEYS)
.forEach(key => {

localStorage.removeItem(key);

sessionStorage.removeItem(key);

});

};

/*
=========================================================
LOGO RESET
=========================================================
*/

document
.querySelectorAll('.panel-logo')
.forEach(link => {

link.addEventListener(
'click',
clearRegistrationStorage
);

});

/*
=========================================================
BACK/FORWARD CACHE FIX
=========================================================
*/

window.addEventListener(

'pageshow',

function(){

resetSubmitButton();

clearErrors();

restoreFormData();

restoreImage();

revalidateRestoredData();

}

);

/*
=========================================================
POPSTATE FIX
=========================================================
*/

window.addEventListener(

'popstate',

function(){

resetSubmitButton();

}

);

/*
=========================================================
WINDOW FOCUS FIX
=========================================================
*/

window.addEventListener(

'focus',

function(){

resetSubmitButton();

}

);

/*
=========================================================
INIT
=========================================================
*/

restoreFormData();

restoreImage();

setupAutoSave();

setupRealtimeValidation();

setupImageUpload();

setupSubmit();

revalidateRestoredData();

calculateAge();

resetSubmitButton();

})();