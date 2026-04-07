<?php

include('../../config/db.php');
include('../../templates/header.php');

$teacher_id = $_SESSION['user_id'];

$query = "

SELECT 
get_subjects.id,
get_subjects.subject_name,

COUNT(submit_form.id) AS pending_count

FROM get_subjects

LEFT JOIN request_form
ON request_form.subject_id = get_subjects.id

LEFT JOIN submit_form
ON submit_form.request_id = request_form.id

WHERE get_subjects.teacher_id = '$teacher_id'
AND submit_form.status = 'Submitted'

GROUP BY get_subjects.id

";

$result = mysqli_query($conn,$query);

?>


<link rel="stylesheet" href="../../assets/css/student-dashboard.css">
<link rel="stylesheet" href="../../assets/css/teacher-dashboard.css">

<nav class="navbar">

<div class="nav-container">

<div class="logo">Exam<span>Pass</span></div>


<div class="nav-actions">


<button class="notif-btn" id="notifBtn">

<i class="fa-regular fa-bell"></i>

<span class="notif-badge">0</span>

</button>


<div class="notif-dropdown hidden" id="notifDropdown">

<div class="notif-header">

<h3>Notifications</h3>

<p>No new requests</p>

</div>

</div>



<div class="user-profile" id="userProfileBtn">

<div class="user-details">

<span class="user-name">Teacher</span>

<span class="user-role">Program Head</span>

</div>

<div class="avatar teacher-avatar">TH</div>


<div class="profile-dropdown hidden" id="profileDropdown">

<ul>

<li>

<a href="../../auth/logout.php">

<i class="fa-solid fa-arrow-right-from-bracket"></i>

Logout

</a>

</li>

</ul>

</div>


</div>


</div>


</div>

</nav>



<div class="container">

<div class="page-header">

<div>

<h1>Pending Applications</h1>

<p class="sub-title">

Review student requests

</p>

</div>


</div>



<div class="dashboard-grid">

<?php while($row = mysqli_fetch_assoc($result)): ?>

<a href="subject_requests.php?subject_id=<?=$row['id']?>"
class="card-link">

<div class="card teacher-card">

<div class="card-icon-container">

<i class="fa-solid fa-book-open"></i>

<?php if($row['pending_count']>0): ?>

<span class="count-badge">
<?=$row['pending_count']?>
</span>

<?php endif; ?>

</div>

<div class="card-info">

<h3>
<?=$row['subject_name']?>
</h3>

<?php if($row['pending_count']>0): ?>

<p class="pending-text">
<?=$row['pending_count']?> pending approvals
</p>

<?php else: ?>

<p class="sub-title">
No pending requests
</p>

<?php endif; ?>

</div>

</div>

</a>

<?php endwhile; ?>

</div>



</div>


<script src="../../assets/js/teacher-dashboard.js"></script>

<?php include('../../templates/footer.php'); ?>
