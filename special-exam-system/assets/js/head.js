
document.addEventListener('DOMContentLoaded', () => {

/* NOTIFICATION DROPDOWN */

const notifBtn = document.getElementById('notifBtn');
const notifMenu = document.getElementById('notifDropdown');

const profileBtn = document.getElementById('userProfileBtn');
const profileMenu = document.getElementById('profileDropdown');

if(notifBtn){
notifBtn.addEventListener('click', (e)=>{
e.stopPropagation();
notifMenu.classList.toggle('hidden');

if(profileMenu){
profileMenu.classList.add('hidden');
}

});
}

if(profileBtn){
profileBtn.addEventListener('click', (e)=>{
e.stopPropagation();
profileMenu.classList.toggle('hidden');

if(notifMenu){
notifMenu.classList.add('hidden');
}

});
}


/* ACCEPT REQUEST */

document.querySelectorAll('.btn-accept').forEach(btn=>{

btn.addEventListener('click', function(){

const row = this.closest('.student-row');

row.style.opacity="0";
row.style.transform="translateX(20px)";

setTimeout(()=>{

row.remove();

},300);

});

});


/* REJECT REQUEST */

let selectedRow = null;

document.querySelectorAll('.btn-reject').forEach(btn=>{

btn.addEventListener('click', function(){

selectedRow = this.closest('.student-row');

const requestId = this.getAttribute('data-id');

document.getElementById('rejectRequestId')

.value = requestId;

document.getElementById('rejectModal')

.classList.remove('hidden');

});

});



document.getElementById('closeReject')

?.addEventListener('click', ()=>{

document.getElementById('rejectModal')

.classList.add('hidden');

});


document.getElementById('confirmReject')

?.addEventListener('click', ()=>{

const reason = document.getElementById('rejectReason').value;

if(reason.trim()==""){

alert("Enter reason");

return;

}

if(selectedRow){

selectedRow.remove();

}

document.getElementById('rejectModal')

.classList.add('hidden');

document.getElementById('rejectReason').value="";

});


/* CLOSE DROPDOWN OUTSIDE */

document.addEventListener('click', ()=>{

notifMenu?.classList.add('hidden');

profileMenu?.classList.add('hidden');

});

});
