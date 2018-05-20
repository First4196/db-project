<?php
require_once('common.php');
$title="Personal Infomation";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1 class="text-center">
    Personal Infomation
  </h1>
  <hr>
  <br>
  <div id="infoResult">
    
  </div>
  <br>
</div>

<script>
  let username = '<?php echo $_SESSION["account_username"]; ?>';
  
  async function loadInfo() {
    let professor_data = JSON.parse(await queryPromise('get_professor_info',username));
    //console.log(professor_data);
    $("#infoResult").html(ejs.render(`
<div class="row">
  <div class="col-md-3">
    <div class="card">
      <img class="card-img-top" src="https://www.gravatar.com/avatar/<%= professor_info.hash %>?f=y&d=wavatar&s=2048" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><%= professor_info.professor_id %></h5>
        <p class="card-text">
          <%= professor_info.fname_th + ' ' + professor_info.lname_th %><br>
          <%= professor_info.fname_en + ' ' + professor_info.lname_en %><br>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Personal Info</h5>
        <p class="card-text">
          <b>Address:</b> <%= professor_info.address %><br>
          <b>Mobile No.:</b> <%= professor_info.mobile_no %><br>
          <b>Email:</b> <%= professor_info.email %><br>
          <b>Date of Birth:</b> <%= professor_info.date_of_birth %><br>
          <b>Department:</b> <%= professor_info.department %><br>
          <b>Faculty:</b> <%= professor_info.faculty %><br>
        </p>
      </div>
    </div>
  </div>
</div>
`,{professor_info:professor_data[0]}));
    
  }
  loadInfo();
  
</script>

<?php
require_once('footer.php');