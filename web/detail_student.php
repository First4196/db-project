<?php
require_once('common.php');
$title="Details of ".$_GET["sid"];
require_once('header.php');
?>
<div class="container">
  <br>
  <h1 class="text-center">
    Details of <?php echo $_GET["sid"]; ?>
  </h1>
  <hr>
  <br>
  <div id="infoResult">
    Loading ...
  </div>
  <br>
</div>

<script>
  let sid = '<?php echo $_GET["sid"];?>';
  async function loadInfo() {
    let student_info_data = JSON.parse(await queryPromise('get_student_info',sid))
    let lesson_plan_data = JSON.parse(await queryPromise('get_lesson_plan_of_student',sid));
    $("#infoResult").html(ejs.render(`
<div class="row">
  <div class="col-md-3">
    <div class="card">
      <img class="card-img-top" src="https://www.gravatar.com/avatar/<%= student_info.hash %>?f=y&d=wavatar&s=2048" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><%= student_info.student_id %></h5>
        <p class="card-text">
          <%= student_info.fname_th + ' ' + student_info.lname_th %><br>
          <%= student_info.fname_en + ' ' + student_info.lname_en %><br>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Personal Info</h5>
        <p class="card-text">
          <b>Gender:</b> <%= student_info.gender %><br>
          <b>Address:</b> <%= student_info.address %><br>
          <b>Mobile No.:</b> <%= student_info.mobile_no %><br>
          <b>Email:</b> <%= student_info.email %><br>
          <b>Curriculum:</b> <%= student_info.curriculum %><br>
          <b>Department:</b> <%= student_info.department %><br>
          <b>Faculty:</b> <%= student_info.faculty %><br>
          <b>Credit Gain:</b> <%= student_info.credit_gain %><br>
          <b>GPAX:</b> <%= parseFloat(student_info.gpax).toFixed(2) %><br>
        </p>
        <a href="detail_student_grade.php?sid=<%= student_info.student_id %>" class="btn btn-primary">More Grade Details</a>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Advisor Info</h5>
        <p class="card-text">
          <%= student_info.prof_fname_th + ' ' + student_info.prof_lname_th %><br>
          <%= student_info.prof_fname_en + ' ' + student_info.prof_lname_en %><br>
          <b>Department:</b> <%= student_info.prof_department %><br>
          <b>Address:</b> <%= student_info.prof_address %><br>
          <b>Mobile No.:</b> <%= student_info.prof_mobile_no %><br>
          <b>Email:</b> <%= student_info.prof_email %><br>
        </p>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Graduation</h5>
        <p class="card-text">Status: <%= ['No','Pending','Graduated'][parseInt(student_info.graduated)] %></p>
        View required courses <button type="button" class="btn btn-light" data-toggle="collapse" data-target="#collapseExample"><span class="oi oi-chevron-bottom"></span></button>
        <div class="collapse" id="collapseExample">
          <table class="table" >
            <thead>
              <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <% lesson_plan.forEach(lesson => { %>
            <tr>
              <td><%=lesson.course_id%></td>
              <td><%=lesson.course_name%></td>
              <td><% if(lesson.pass==1){ %>
                <span class="oi oi-circle-check text-success"></span>
                <% }else{ %>
                <span class="oi oi-circle-x text-danger"></span>
                <% } %>
              </td>
            </tr>
            <% }) %>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
`,{student_info: student_info_data[0], 
   lesson_plan: lesson_plan_data}))
    
  }
  loadInfo();
  
</script>

<?php
require_once('footer.php');