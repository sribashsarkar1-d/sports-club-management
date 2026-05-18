document.addEventListener(
"DOMContentLoaded",

function(){

/*
==================================================
REGISTRATION STORAGE KEYS
==================================================
*/

const REGISTRATION_KEYS = [

"scm_step1_form",
"scm_step1_image",

"scm_step2_form",
"scm_step3_form",
"scm_step4_form",
"scm_step5_form",
"scm_step6_form",

"scm_registration_form",
"scm_registration_cache",

"scm_user_photo",

"registration_step",
"registration_preview",

"compressed_photo"

];

/*
==================================================
CLEAR REGISTRATION STORAGE
==================================================
*/

window.clearRegistrationStorage =
function(){

try{

/*
==================================================
LOCAL STORAGE
==================================================
*/

REGISTRATION_KEYS.forEach(key => {

localStorage.removeItem(key);

});

/*
==================================================
SESSION STORAGE
==================================================
*/

REGISTRATION_KEYS.forEach(key => {

sessionStorage.removeItem(key);

});

/*
==================================================
REMOVE TEMP STEP KEYS
==================================================
*/

Object.keys(localStorage).forEach(key => {

if(
key.startsWith("scm_") ||
key.startsWith("registration_")
){

localStorage.removeItem(key);

}

});

Object.keys(sessionStorage).forEach(key => {

if(
key.startsWith("scm_") ||
key.startsWith("registration_")
){

sessionStorage.removeItem(key);

}

});

/*
==================================================
CLEAR IMAGE CACHE VARIABLES
==================================================
*/

const preview =
document.querySelector("#preview");

if(preview){

preview.src = '';
preview.style.display = 'none';

}

/*
==================================================
RESET FILE INPUT
==================================================
*/

const photoInput =
document.querySelector("#photo");

if(photoInput){

photoInput.value = '';

}

/*
==================================================
RESET HIDDEN IMAGE
==================================================
*/

const compressedPhoto =
document.querySelector(
"#compressed_photo"
);

if(compressedPhoto){

compressedPhoto.value = '';

}

/*
==================================================
REMOVE IMAGE UI STATE
==================================================
*/

const uploadZone =
document.querySelector(
"#photoZone"
);

if(uploadZone){

uploadZone.classList.remove(
"has-file"
);

uploadZone.classList.remove(
"is-processing"
);

}

/*
==================================================
SUCCESS
==================================================
*/

console.log(
"Registration storage cleared successfully"
);

}catch(error){

console.log(
"Storage cleanup error",
error
);

}

};

/*
==================================================
LOGO CLICK RESET
==================================================
*/

const logoLinks =
document.querySelectorAll(
'.panel-logo'
);

logoLinks.forEach(link => {

link.addEventListener(
'click',

function(){

clearRegistrationStorage();

}

);

});

});