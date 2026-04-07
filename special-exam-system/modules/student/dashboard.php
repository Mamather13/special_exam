<?php include('../../templates/header.php'); ?>

<link rel="stylesheet" href="../../assets/css/student-dashboard.css">
<link rel="stylesheet" href="../../assets/css/student-form.css">

<nav class="navbar">

<div class="nav-container">

<div class="logo">Exam<span>Pass</span></div>


<div class="nav-actions">

<button class="notif-btn" id="notifBtn">

<i class="fa-regular fa-bell"></i>

</button>


<div class="notif-dropdown hidden" id="notifDropdown">

<div class="notif-header">

<h3>Notifications</h3>

<p>No new notifications</p>

</div>

</div>



<div class="user-profile" id="userProfileBtn">

<div class="user-details">

<span class="user-name">Student</span>

<span class="user-role">Student</span>

</div>

<div class="avatar">ST</div>

</div>

</div>

</div>

</nav>



<div class="container">

<div class="page-header">

<div>

<h1>My Special Exam Applications</h1>

<p class="sub-title">

Track your requests

</p>

</div>


<button class="btn-primary" id="openRegModal">

+ New Request

</button>


</div>



<div class="dashboard-grid">


<!-- SAMPLE CARD -->

<div class="card">

<div class="card-info">

<h3>No requests yet</h3>

<p class="sub-title">

Submit your first request

</p>

<span class="badge">

<?=$row['status']?>

</span>
<?php if($row['reject_reason']!=""): ?>

<p class="reject-text">

Reason:
<?=$row['reject_reason']?>

</p>

<?php endif; ?>


</div>

</div>


</div>


</div>



<!-- PROGRESS MODAL -->

<div id="progressModal" class="modal-overlay hidden">

<div class="modal-box wide">

<div class="modal-header">

<div>

<h2>Subject</h2>

<p class="sub-title">

status

</p>

</div>


<button class="close-btn"

onclick="closeModal('progressModal')">

✕

</button>


</div>



<div class="progress-container-bg">


<p class="stepper-title">

Application Progress

</p>



<div class="pro-stepper-container">


<div class="step">

<span>1</span>

<p>Submitted</p>

</div>


<div class="step">

<span>2</span>

<p>Program Head Review</p>

</div>


<div class="step">

<span>3</span>

<p>Payment</p>

</div>


<div class="step">

<span>4</span>

<p>Scheduled</p>

</div>


</div>


</div>


<button class="btn-secondary pro-close"

onclick="closeModal('progressModal')">

Close

</button>


</div>

</div>



<!-- IMPORT YOUR REQUEST FORM -->

<div id="regModal" class="modal-overlay hidden">

<?php include('request_form.php'); ?>

</div>



<script src="../../assets/js/student-dashboard.js"></script>

<?php include('../../templates/footer.php'); ?>
