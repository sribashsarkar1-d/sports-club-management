document.addEventListener(
"DOMContentLoaded",

function(){

const sidebar =
document.querySelector(".sidebar");

const menuToggle =
document.querySelector(".menu-toggle");

if(menuToggle){

menuToggle.addEventListener(
"click",

function(){

sidebar.classList.toggle(
"active"
);

});
}

const searchInput =
document.querySelector(
"#searchInput"
);

if(searchInput){

searchInput.addEventListener(
"keyup",

function(){

let value =
this.value.toLowerCase();

let rows =
document.querySelectorAll(
".athlete-row"
);

rows.forEach(function(row){

row.style.display =
row.innerText
.toLowerCase()
.includes(value)

? ""

: "none";

});

});
}

});