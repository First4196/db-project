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
        </p>
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
</div>
`,{student_info: student_info_data[0]}))
    
  }
  loadInfo();
  
</script>

<?php
require_once('footer.php');