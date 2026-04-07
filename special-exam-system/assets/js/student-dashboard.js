
document.addEventListener("DOMContentLoaded", function(){

/* OPEN REQUEST MODAL */

const openBtn = document.getElementById("openRegModal");

const regModal = document.getElementById("regModal");

if(openBtn){

openBtn.addEventListener("click", function(){

regModal.classList.remove("hidden");

});

}


/* CLOSE REQUEST MODAL */

const closeBtn = document.getElementById("closeReg");

const cancelBtn = document.getElementById("cancelReg");

function closeRegistration(){

regModal.classList.add("hidden");

}

if(closeBtn){

closeBtn.addEventListener("click", closeRegistration);

}

if(cancelBtn){

cancelBtn.addEventListener("click", closeRegistration);

}


/* NOTIFICATION DROPDOWN */

const notifBtn = document.getElementById("notifBtn");

const notifDropdown = document.getElementById("notifDropdown");

if(notifBtn){

notifBtn.addEventListener("click", function(e){

e.stopPropagation();

notifDropdown.classList.toggle("hidden");

});

}


/* PROFILE DROPDOWN */

const profileBtn = document.getElementById("userProfileBtn");

const profileDropdown = document.getElementById("profileDropdown");

if(profileBtn){

profileBtn.addEventListener("click", function(e){

e.stopPropagation();

profileDropdown.classList.toggle("hidden");

});

}


/* CLOSE DROPDOWNS WHEN CLICK OUTSIDE */

document.addEventListener("click", function(){

if(notifDropdown) notifDropdown.classList.add("hidden");

if(profileDropdown) profileDropdown.classList.add("hidden");

});


/* CLICK CARD TO VIEW PROGRESS */

const cards = document.querySelectorAll(".card");

cards.forEach(card=>{

card.addEventListener("click", function(){

const subject = this.querySelector("h3").innerText;

const info = this.querySelector(".sub-title").innerText;

const status = this.querySelector(".badge").innerText;

openProgressModal(subject,info,status);

});

});


});


/* PROGRESS MODAL */

function openProgressModal(subject,info,status){

const modal = document.getElementById("progressModal");

modal.querySelector("h2").innerText = subject;

modal.querySelector(".sub-title").innerText = info;


/* STEP LOGIC */

const steps = document.querySelectorAll(".step");

steps.forEach(step=>step.className="step locked");


if(status==="Submitted"){

steps[0].className="step active";

}

if(status==="Program Head Review"){

steps[0].className="step finished";

steps[1].className="step active";

}

if(status==="For Payment"){

steps[0].className="step finished";

steps[1].className="step finished";

steps[2].className="step active";

}

if(status==="Scheduled"){

steps.forEach(step=>step.className="step finished");

}


modal.classList.remove("hidden");

}


function closeModal(id){

document.getElementById(id)

.classList.add("hidden");

}
