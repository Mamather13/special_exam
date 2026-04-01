<?php include('../../templates/header.php'); ?>

<h2>Special Examination Request Form</h2>

<form action="submit_request.php" method="POST" enctype="multipart/form-data">

<label>Student Number:</label><br>
<input type="text" name="student_number" required><br><br>

<label>Last Name:</label><br>
<input type="text" name="Fname" required><br><br>
<label>First Name:</label><br>
<input type="text" name="Lname" required><br><br>
<label>Middle Name:</label><br>
<input type="text" name="Mname" required><br><br>

<label>Program</label>

<select name="program" id="program">

<option value="">Select Program</option>

<option value="BSIT">BSIT</option>

<option value="BSHM">BSHM</option>

<input type="hidden" name="subject_code" id="subject_code">


</select>


<label>Year Level:</label><br>
<select name="year_level">
<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
<option>4th Year</option>
</select><br><br>

<label>Contact Number:</label><br>
<input type="text" name="contact_number" required><br><br>

<label>Term:</label><br>
<input type="text" name="term" placeholder="1st Term"><br><br>

<label>School Year:</label><br>
<input type="text" name="school_year" placeholder="2025-2026"><br><br>

<label>Exam Type:</label><br>
<select name="exam_type">
<option>Pre lim</option>
<option>Midterm</option>
<option>Pre final</option>
<option>Final</option>
</select><br><br>

<label>Subject</label>

<select name="subject" id="subject">

<option value="">Select Subject</option>

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


<label>Teacher Name:</label><br>
<input type="text" name="teacher_name"><br><br>

<label>Reason for Special Exam</label>

<select name="reason_type" required>

<option value="">Select reason</option>

<option value="medical">Medical</option>

<option value="death">Death of Relative</option>

<option value="personal">Personal Reason</option>

<option value="others">Others</option>

</select>


<h3>Parent Verification</h3>

<h3>Parent ID (Front)</h3>

<input 
type="file" 
name="parent_id_front"
accept="image/*"
capture="environment"
required>

<p>Use camera or upload image</p>

<canvas id="preview_parent_id_front" width="250"></canvas>
<p id="result_parent_id_front"></p>


<h3>Parent ID (Back)</h3>

<input 
type="file" 
name="parent_id_back"
accept="image/*"
capture="environment"
required>

<canvas id="preview_parent_id_back" width="250"></canvas>
<p id="result_parent_id_back"></p>


<h3>Parent Selfie with ID</h3>

<input 
type="file" 
name="parent_selfie"
accept="image/*"
capture="user"
required>

<canvas id="preview_parent_selfie" width="250"></canvas>
<p id="result_parent_selfie"></p>


<p>Sign inside the box</p>

<canvas 
id="signature-pad"
width="400"
height="200"
style="border:2px solid black;background:white">
</canvas>

<br>

<button type="button" onclick="clearSignature()">
Clear
</button>

<input type="hidden" name="signature" id="signature">

<p id="signature-status"></p>

<h3>Supporting Documents</h3>

<h3>Medical Certificate (if applicable)</h3>

<input 
type="file" 
name="medical_certificate"
accept="image/*,.pdf">

<canvas id="preview_medical_certificate" width="250"></canvas>
<p id="result_medical_certificate"></p>


<h3>Death Certificate (if applicable)</h3>

<input 
type="file" 
name="death_certificate"
accept="image/*,.pdf">

<canvas id="preview_death_certificate" width="250"></canvas>
<p id="result_death_certificate"></p>


<label>Other Supporting Document:</label><br>
<input type="file" name="supporting_document"><br><br>


<button type="submit">Submit Request</button>

</form>

<script>

var canvas = document.getElementById("signature-pad");
var ctx = canvas.getContext("2d");

var drawing = false;

/* draw */

canvas.addEventListener("mousedown", function(){

drawing = true;

ctx.beginPath();

});

canvas.addEventListener("mouseup", function(){

drawing = false;

});

canvas.addEventListener("mousemove", function(e){

if(!drawing) return;

ctx.lineWidth = 2;
ctx.lineCap = "round";

ctx.lineTo(e.offsetX,e.offsetY);

ctx.stroke();

});

/* touch support for mobile */

canvas.addEventListener("touchstart", function(e){

drawing = true;

ctx.beginPath();

});

canvas.addEventListener("touchend", function(){

drawing = false;

});

canvas.addEventListener("touchmove", function(e){

if(!drawing) return;

var rect = canvas.getBoundingClientRect();

var x = e.touches[0].clientX - rect.left;
var y = e.touches[0].clientY - rect.top;

ctx.lineTo(x,y);

ctx.stroke();

});

/* clear */

function clearSignature(){

ctx.clearRect(0,0,canvas.width,canvas.height);

document.getElementById("signature-status").innerHTML="";

}

/* validate signature */

function validateSignature(){

var imageData = ctx.getImageData(

0,
0,
canvas.width,
canvas.height

);

let pixels = imageData.data;

let drawnPixels = 0;

/* count non-white pixels */

for(let i=0;i<pixels.length;i+=4){

if(
pixels[i] < 250 ||
pixels[i+1] < 250 ||
pixels[i+2] < 250
){

drawnPixels++;

}

}

/* threshold */

if(drawnPixels < 500){

document.getElementById("signature-status").innerHTML=

"❌ Signature not clear. Please sign properly.";

document.getElementById("signature-status").style.color="red";

return false;

}

/* save */

var dataURL = canvas.toDataURL();

document.getElementById("signature").value = dataURL;

document.getElementById("signature-status").innerHTML=

"✔ Signature accepted";

document.getElementById("signature-status").style.color="green";

return true;

}

/* block form submit if signature unclear */

document.querySelector("form").addEventListener(

"submit",

function(e){

if(!validateSignature()){

e.preventDefault();

}

}

);

</script>


<script>

function checkBlur(fileInput, canvasId, resultId){

fileInput.addEventListener("change", function(){

const file = this.files[0];

if(!file) return;

const img = new Image();

img.onload = function(){

const canvas = document.getElementById(canvasId);

const ctx = canvas.getContext("2d");

canvas.width = 250;
canvas.height = img.height * (250/img.width);

ctx.drawImage(img,0,0,canvas.width,canvas.height);

const imageData = ctx.getImageData(
0,
0,
canvas.width,
canvas.height
);

let sum = 0;

for(let i=0;i<imageData.data.length;i+=4){

sum += Math.abs(

imageData.data[i] -
imageData.data[i+1]

);

}

let score = sum / imageData.data.length;

const result = document.getElementById(resultId);

if(score < 20){

result.innerHTML = "⚠ Image may be blurry. Please retake.";

result.style.color="red";

fileInput.value="";

}else{

result.innerHTML = "✔ Image looks clear";

result.style.color="green";

}

};

img.src = URL.createObjectURL(file);

});

}

/* attach blur detection */

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

</script>
<script>

document.getElementById("program")

.addEventListener("change", function(){

var program = this.value;

fetch(

"get_subjects.php?program=" + program

)

.then(response => response.json())

.then(data => {

var subjectDropdown = document.getElementById("subject");

subjectDropdown.innerHTML = "";

data.forEach(subject => {

var option = document.createElement("option");

option.value = subject.subject_title;

option.text = subject.subject_title;

option.dataset.code = subject.subject_code;

subjectDropdown.appendChild(option);

});

});

});

</script>

<script>

document.getElementById("subject")

.addEventListener("change", function(){

var code = this.options[this.selectedIndex]

.dataset.code;

document.getElementById("subject_code").value = code;

});

</script>


<?php include('../../templates/footer.php'); ?>
