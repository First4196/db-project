<?php
require_once('common.php');
$title="STUDENT";
require_once('header.php');
?>

<div class="jumbotron">
  <div class="container">
    <h1>
      Hello, <?php echo $_SESSION["account_username"]; ?>.
    </h1>
    <p>
      Welcome to Reg Chula++
    </p>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4 my-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">My info</h5>
          <p class="card-text">View your personal information including your contact information, advisor contact information, and billing status.</p>
          <a href="student_info.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Registration</h5>
          <p class="card-text">Add, remove, or change section of your courses here.</p>
          <a href="student_registration.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">My course</h5>
          <p class="card-text">View your courses and information about them including timetable and news.</p>
          <a href="student_course.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Grade</h5>
          <p class="card-text">View your grade and print the unofficial transcript here.</p>
          <a href="student_grade.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Request</h5>
          <p class="card-text">View your submitted requests status and submit a new request.</p>
          <a href="student_request.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    
  </div>
</div>

<?php
require_once('footer.php');