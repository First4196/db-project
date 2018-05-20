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
  <div id="alertDiv">
    
  </div>
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
          <h5 class="card-title">My course <span id="newNews"></span></h5>
          <p class="card-text">View your courses and information about them including timetable and news.</p>
          <a href="student_mycourse.php" class="btn btn-primary">Go</a>
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
          <h5 class="card-title">Request <span id="newRequest"></span></h5>
          <p class="card-text">View your submitted requests status and submit a new request.</p>
          <a href="student_request.php" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    
  </div>
</div>

<script>
  
  let username = '<?php echo $_SESSION["account_username"]; ?>';
  
  async function checkAlert() {
    let hasUnpaidBill = await queryParsed('check_unpaid_bill_of_student',username);
    if(hasUnpaidBill[0].result == 'yes') {
      $("#alertDiv").append($(`<div class="alert alert-warning hidden" role="alert">
        You have an unpaid bill. Go to <a href="student_info.php" class="alert-link">My information</a> to view more details.
      </div>`));
    }
    
    let curSem = getCurrentSemester();
    let credit = await queryParsed('get_credit_of_student_of_year',username, curSem.course_year, curSem.course_semester );
    
    if(credit[0].total_credit > 22) {
      $("#alertDiv").append($(`<div class="alert alert-warning hidden" role="alert">
        Your total credit of this semester is ${credit[0].total_credit} which exceeds the limit of 22. Go to <a href="student_registration.php" class="alert-link">Registration</a> to view more details.
      </div>`));
    }
  }
  checkAlert();

  async function checkNewRequest() {
    let hasNewRequest = await queryParsed('check_new_request',username);
    if(hasNewRequest[0].result == 'yes') {
      $("#newRequest").html('<span class="badge badge-danger">New</span>');
    }
  }

  checkNewRequest();
  
  async function checkNewNews() {
    let hasNewNews = await queryParsed('check_new_news',username);
    if(hasNewNews[0].result == 'yes') {
      $("#newNews").html('<span class="badge badge-danger">New</span>');
    }
  }

  checkNewNews();

</script>

<?php
require_once('footer.php');