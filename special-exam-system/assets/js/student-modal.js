
/* MODAL CONTROL */

const modal = document.querySelector(".modal-overlay");

const closeBtn = document.querySelector(".close-btn");

const cancelBtn = document.querySelector(".btn-cancel");


function closeModal(){

modal.classList.add("hidden");

/* reset form */

document.querySelector("form").reset();

/* clear signature */

if(typeof clearSignature === "function"){

clearSignature();

}

}


/* close button (X) */

if(closeBtn){

closeBtn.addEventListener("click", closeModal);

}


/* cancel button */

if(cancelBtn){

cancelBtn.addEventListener("click", closeModal);

}


/* close when clicking outside box */

modal.addEventListener("click", function(e){

if(e.target === modal){

closeModal();

}

});


console.log("Student Request Modal Loaded");

