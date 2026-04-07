<?php include('../../templates/header.php'); ?>

<script src="../../assets/js/student-modal.js"></script>

<link rel="stylesheet" href="../../assets/css/student-form.css">


<div class="modal-box wide">

<form method="POST"
action="submit_request.php"
enctype="multipart/form-data">

<div class="modal-header">

<h2>Special Exam Request Form</h2>

<button type="button" class="close-btn" onclick="history.back()">✕</button>

</div>


<div class="form-grid">

<!-- LEFT SIDE -->

<div>

<p class="section-title">Student Information</p>

<label>Student Number</label>
<input type="text" name="student_number" required>


<div class="input-row">

<div class="input-group">
<label>Last Name</label>
<input type="text" name="Lname" required>
</div>

<div class="input-group">
<label>First Name</label>
<input type="text" name="Fname" required>
</div>

<div class="input-group">
<label>Middle Name</label>
<input type="text" name="Mname">
</div>

</div>


<label>Program</label>

<select name="program" id="program" required>

<option value="">Select Program</option>
<option value="BSIT">BSIT</option>
<option value="BSHM">BSHM</option>

</select>


<label>Section</label>

<select name="section" required>

<option value="">Select Section</option>

<option value="BSIT 1A">BSIT 1A</option>
<option value="BSIT 1B">BSIT 1B</option>
<option value="BSIT 2A">BSIT 2A</option>
<option value="BSIT 2B">BSIT 2B</option>

<option value="BSHM 1A">BSHM 1A</option>

</select>


<label>Year Level</label>

<select name="year_level">

<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
<option>4th Year</option>

</select>


<label>Subject</label>

<select name="subject" id="subject" required>

<option value="">Select Subject</option>

</select>

<input type="hidden" name="subject_code" id="subject_code">


<label>Exam Type</label>

<select name="exam_type">

<option>Prelim</option>
<option>Midterm</option>
<option>Prefinal</option>
<option>Final</option>

</select>


<label>Term</label>
<input type="text" name="term" placeholder="1st Term">


<label>School Year</label>
<input type="text" name="school_year" placeholder="2025-2026">


<label>Contact Number</label>
<input type="text" name="contact_number" required>


<label>Teacher Name</label>
<input type="text" name="teacher_name">


<label>Reason</label>

<select name="reason_type" required>

<option value="">Select reason</option>

<option value="medical">Medical</option>

<option value="death">Death of Relative</option>

<option value="personal">Personal</option>

<option value="others">Others</option>

</select>

</div>



<!-- RIGHT SIDE -->

<div>

<p class="section-title">Parent Consent Verification</p>


<label>Parent ID (Front)</label>

<div class="upload-area">

<input type="file" name="parent_id_front" accept=".jpg,.jpeg,.png,.pdf">

<p>Upload or capture image</p>

<span>Camera supported</span>

</div>

<canvas id="preview_parent_id_front"></canvas>
<p id="result_parent_id_front"></p>



<label>Parent ID (Back)</label>

<div class="upload-area">

<input type="file" name="parent_id_back" accept=".jpg,.jpeg,.png,.pdf">

<p>Upload or capture image</p>

</div>

<canvas id="preview_parent_id_back"></canvas>
<p id="result_parent_id_back"></p>



<label>Parent Selfie with ID</label>

<div class="capture-area">

<input type="file" name="parent_selfie" accept=".jpg,.jpeg,.png,.pdf">

<p>Take selfie holding ID</p>

</div>

<canvas id="preview_parent_selfie"></canvas>
<p id="result_parent_selfie"></p>



<label>Parent Signature</label>

<input
type="file"
name="parent_signature"
accept=".jpg,.jpeg,.png,.pdf"
required>

<small>

Parent signs on paper,

take photo,

then upload image.

</small>

<br>

<button
type="button"
class="btn-cancel"
onclick="clearSignature()">

Clear Signature

</button>

<input type="hidden" name="signature" id="signature">

<p id="signature-status"></p>



<p class="section-title">Supporting Documents</p>


<label>Medical Certificate</label>

<div class="upload-area">

<input type="file" name="medical_certificate" accept=".jpg,.jpeg,.png,.pdf">

<p>Upload if reason is medical</p>

</div>

<canvas id="preview_medical_certificate"></canvas>
<p id="result_medical_certificate"></p>



<label>Death Certificate</label>

<div class="upload-area">

<input type="file" name="death_certificate" accept=".jpg,.jpeg,.png,.pdf">

<p>Upload if reason is death</p>

</div>

<canvas id="preview_death_certificate"></canvas>
<p id="result_death_certificate"></p>



<label>Other Document</label>

<div class="upload-area">

<input type="file" name="supporting_document" accept=".jpg,.jpeg,.png,.pdf">

</div>






<div class="modal-footer">

<button
type="button"
class="btn-cancel"
onclick="history.back()">

Cancel

</button>


<button
type="submit"
class="btn-submit">

Submit Request

</button>

</div>


</form>

</div>

</div>



<script>

/* SIGNATURE */

var canvas = document.getElementById("signature-pad");

var ctx = canvas.getContext("2d");

var drawing=false;


canvas.addEventListener("mousedown",()=>{

drawing=true;

ctx.beginPath();

});


canvas.addEventListener("mouseup",()=>{

drawing=false;

});


canvas.addEventListener("mousemove",(e)=>{

if(!drawing) return;

ctx.lineWidth=2;

ctx.lineCap="round";

ctx.lineTo(e.offsetX,e.offsetY);

ctx.stroke();

});


canvas.addEventListener("touchmove",(e)=>{

if(!drawing) return;

var rect = canvas.getBoundingClientRect();

var x = e.touches[0].clientX - rect.left;

var y = e.touches[0].clientY - rect.top;

ctx.lineTo(x,y);

ctx.stroke();

});


canvas.addEventListener("touchstart",()=>{

drawing=true;

ctx.beginPath();

});


canvas.addEventListener("touchend",()=>{

drawing=false;

});


function clearSignature(){

ctx.clearRect(0,0,canvas.width,canvas.height);

document.getElementById("signature-status").innerHTML="";

}


function validateSignature(){

var data = ctx.getImageData(0,0,canvas.width,canvas.height).data;

let pixels=0;

for(let i=0;i<data.length;i+=4){

if(data[i]<250) pixels++;

}


if(pixels<500){

document.getElementById("signature-status").innerHTML=

"Signature not clear";

document.getElementById("signature-status").style.color="red";

return false;

}


document.getElementById("signature").value = canvas.toDataURL();

return true;

}


document.querySelector("form")

.addEventListener("submit",(e)=>{

if(!validateSignature()){

e.preventDefault();

}

});


/* BLUR DETECTION */

function checkBlur(input, canvasId, resultId){

input.addEventListener("change",()=>{

const file=input.files[0];

if(!file) return;

const img=new Image();

img.onload=()=>{

const canvas=document.getElementById(canvasId);

const ctx=canvas.getContext("2d");

canvas.width=250;

canvas.height=img.height*(250/img.width);

ctx.drawImage(img,0,0,canvas.width,canvas.height);

const data=ctx.getImageData(0,0,canvas.width,canvas.height).data;

let sum=0;

for(let i=0;i<data.length;i+=4){

sum+=Math.abs(data[i]-data[i+1]);

}


let score=sum/data.length;

const result=document.getElementById(resultId);


if(score<20){

result.innerHTML="Image blurry";

result.style.color="red";

input.value="";

}else{

result.innerHTML="Image clear";

result.style.color="green";

}

};


img.src=URL.createObjectURL(file);

});

}


checkBlur(

document.querySelector("[name=parent_id_front]"),

"preview_parent_id_front",

"result_parent_id_front"

);


checkBlur(

document.querySelector("[name=parent_id_back]"),

"preview_parent_id_back",

"result_parent_id_back"

);


checkBlur(

document.querySelector("[name=parent_selfie]"),

"preview_parent_selfie",

"result_parent_selfie"

);


checkBlur(

document.querySelector("[name=medical_certificate]"),

"preview_medical_certificate",

"result_medical_certificate"

);


checkBlur(

document.querySelector("[name=death_certificate]"),

"preview_death_certificate",

"result_death_certificate"

);



/* PROGRAM -> SUBJECT */

document.getElementById("program")

.addEventListener("change",()=>{

fetch("get_subjects.php?program="+

document.getElementById("program").value)

.then(res=>res.json())

.then(data=>{

let subject=document.getElementById("subject");

subject.innerHTML="";


data.forEach(s=>{

let opt=document.createElement("option");

opt.value=s.subject_title;

opt.text=s.subject_title;

opt.dataset.code=s.subject_code;

subject.appendChild(opt);

});

});

});


document.getElementById("subject")

.addEventListener("change",()=>{

document.getElementById("subject_code").value=

document.getElementById("subject")

.selectedOptions[0]

.dataset.code;

});


</script>


<?php include('../../templates/footer.php'); ?>
