/*
-----------------------------------
ELEMENTS
-----------------------------------
*/

const countrySelect =
document.querySelector("#country");

const stateSelect =
document.querySelector("#state");

const districtSelect =
document.querySelector("#district");

const citySelect =
document.querySelector("#city");

const pinInput =
document.querySelector("#pin_code");

/*
-----------------------------------
DEFAULT COUNTRY
-----------------------------------
*/

if(countrySelect){

countrySelect.innerHTML =

`
<option value="India">
India
</option>
`;

countrySelect.value =
"India";

}

/*
-----------------------------------
LOAD STATES
-----------------------------------
*/

async function loadStates(){

try{

const response =
await fetch(

'https://countriesnow.space/api/v0.1/countries/states',

{
method:'POST',

headers:{
'Content-Type':'application/json'
},

body:JSON.stringify({
country:'India'
})

}

);

const result =
await response.json();

stateSelect.innerHTML =

`
<option value="">
Select State
</option>
`;

result.data.states.forEach(function(state){

stateSelect.innerHTML +=

`
<option value="${state.name}">
${state.name}
</option>
`;

});

}catch(error){

console.log(
"State Load Error",
error
);

}

}

/*
-----------------------------------
LOAD DISTRICT/CITY
-----------------------------------
*/

async function loadCities(state){

try{

const response =
await fetch(

'https://countriesnow.space/api/v0.1/countries/state/cities',

{
method:'POST',

headers:{
'Content-Type':'application/json'
},

body:JSON.stringify({

country:'India',
state:state

})

}

);

const result =
await response.json();

districtSelect.innerHTML =

`
<option value="">
Select District
</option>
`;

citySelect.innerHTML =

`
<option value="">
Select City / Town
</option>
`;

result.data.forEach(function(city){

districtSelect.innerHTML +=

`
<option value="${city}">
${city}
</option>
`;

citySelect.innerHTML +=

`
<option value="${city}">
${city}
</option>
`;

});

}catch(error){

console.log(
"City Load Error",
error
);

}

}

/*
-----------------------------------
PINCODE AUTO FILL
-----------------------------------
*/

async function loadPincode(pin){

if(pin.length !== 6) return;

try{

const response =
await fetch(

'https://api.postalpincode.in/pincode/' + pin

);

const result =
await response.json();

if(result[0].Status === "Success"){

const post =
result[0].PostOffice[0];

stateSelect.value =
post.State;

/*
-----------------------------------
DISTRICT
-----------------------------------
*/

districtSelect.innerHTML =

`
<option value="${post.District}">
${post.District}
</option>
`;

/*
-----------------------------------
CITY
-----------------------------------
*/

citySelect.innerHTML =

`
<option value="${post.Block}">
${post.Block}
</option>
`;

}

}catch(error){

console.log(
"Pincode Error",
error
);

}

}

/*
-----------------------------------
STATE CHANGE
-----------------------------------
*/

if(stateSelect){

stateSelect.addEventListener(

"change",

function(){

loadCities(this.value);

}

);

}

/*
-----------------------------------
PINCODE INPUT
-----------------------------------
*/

if(pinInput){

pinInput.addEventListener(

"keyup",

function(){

this.value =
this.value.replace(
/[^0-9]/g,
''
);

if(this.value.length > 6){

this.value =
this.value.slice(0,6);

}

loadPincode(this.value);

}

);

}

/*
-----------------------------------
INIT
-----------------------------------
*/

loadStates();