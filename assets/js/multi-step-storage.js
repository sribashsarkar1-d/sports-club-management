document.addEventListener("DOMContentLoaded", function () {

const STORAGE_KEY = "scm_registration_form";

/*
=========================================
GET FORM
=========================================
*/

const form = document.querySelector("form");

if (!form) return;

/*
=========================================
LOAD STORED DATA
=========================================
*/

const savedData =
JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};

/*
=========================================
RESTORE INPUT VALUES
=========================================
*/

const fields =
form.querySelectorAll("input, select, textarea");

fields.forEach(field => {

const name = field.name;

if (!name) return;

if (
savedData[name] !== undefined &&
field.type !== "file"
) {

if (
field.type === "radio" ||
field.type === "checkbox"
) {

field.checked =
savedData[name] == field.value;

} else {

field.value =
savedData[name];

}

}

});

/*
=========================================
AUTO SAVE
=========================================
*/

fields.forEach(field => {

field.addEventListener("input", saveFormData);
field.addEventListener("change", saveFormData);

});

function saveFormData() {

let formData =
JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};

fields.forEach(field => {

if (!field.name) return;

if (field.type === "file") return;

if (
field.type === "checkbox" ||
field.type === "radio"
) {

if (field.checked) {
formData[field.name] = field.value;
}

} else {

formData[field.name] = field.value;

}

});

localStorage.setItem(
STORAGE_KEY,
JSON.stringify(formData)
);

}

/*
=========================================
CLEAR STORAGE AFTER FINAL SUBMIT
=========================================
*/

if (
window.location.href.includes("success.php")
) {

localStorage.removeItem(STORAGE_KEY);

}

/*
=========================================
REALTIME VALIDATION
=========================================
*/

fields.forEach(field => {

field.addEventListener("input", function () {

validateField(this);

});

field.addEventListener("change", function () {

validateField(this);

});

});

/*
=========================================
FORM SUBMIT VALIDATION
=========================================
*/

form.addEventListener("submit", function (e) {

let valid = true;

fields.forEach(field => {

if (!validateField(field)) {

valid = false;

}

});

if (!valid) {

e.preventDefault();

const firstError =
form.querySelector(".is-invalid");

if (firstError) {

firstError.focus();

}

}

});

/*
=========================================
VALIDATE FIELD
=========================================
*/

function validateField(field) {

const value =
field.value.trim();

removeError(field);

/*
=========================================
REQUIRED VALIDATION
=========================================
*/

if (
field.hasAttribute("required") &&
value === ""
) {

showError(
field,
"This field is required"
);

return false;

}

/*
=========================================
EMAIL VALIDATION
=========================================
*/

if (field.type === "email" && value !== "") {

const emailPattern =
/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (!emailPattern.test(value)) {

showError(
field,
"Enter a valid email address"
);

return false;

}

}

/*
=========================================
INDIAN MOBILE VALIDATION
=========================================
*/

if (
field.name.toLowerCase().includes("mobile") ||
field.name.toLowerCase().includes("contact")
) {

const mobilePattern =
/^[6-9][0-9]{9}$/;

if (
value !== "" &&
!mobilePattern.test(value)
) {

showError(
field,
"Enter valid Indian mobile number"
);

return false;

}

}

/*
=========================================
MINIMUM AGE VALIDATION
=========================================
*/

if (field.name === "age") {

const age = parseInt(value);

if (age < 5) {

showError(
field,
"Minimum age must be 5 years"
);

return false;

}

}

/*
=========================================
VALID
=========================================
*/

field.classList.remove("is-invalid");
field.classList.add("is-valid");

return true;

}

/*
=========================================
SHOW ERROR
=========================================
*/

function showError(field, message) {

field.classList.remove("is-valid");
field.classList.add("is-invalid");

let feedback =
field.parentElement.querySelector(
".dynamic-error"
);

if (!feedback) {

feedback =
document.createElement("span");

feedback.className =
"invalid-feedback dynamic-error";

field.parentElement.appendChild(feedback);

}

feedback.innerText = message;

feedback.style.display = "block";

}

/*
=========================================
REMOVE ERROR
=========================================
*/

function removeError(field) {

field.classList.remove("is-invalid");

const feedback =
field.parentElement.querySelector(
".dynamic-error"
);

if (feedback) {

feedback.remove();

}

}

});