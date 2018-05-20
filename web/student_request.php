<?php
require_once('common.php');
$title="Request Form";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Request Form
  </h1>
  <hr>
  <section>
    <h2>
      New Form
    </h2>
    <form accept-charset="utf-8" onsubmit="return newForm(this.exampleFormControlSelect1.value,this.exampleFormControlTextarea1.value)">
      <div class="form-group">
        <label for="exampleFormControlSelect1">Form Name</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option>ถอนรายวิชา</option>
          <option>ลงเกินหน่วยกิต</option>
          <option>ลงเต็มที่นั่ง</option>
          <option>แก้ไขข้อมูลส่วนตัว</option>
          <option>ขอใบรับรอง</option>
          <option>อื่น ๆ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Details</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </section>
  <hr>
  <section >
    <h2>
      My Forms
    </h2>  
    <div class="row" id="requestList">
      
    </div>
  </section>
</div>

<script>  
  let username = <?php echo $_SESSION["account_username"]; ?>

  //code here
  function newForm(x,y){
    queryPromise('add_request_of_student',username,x,y)
    .then(result=>{
      if(result == 'true'){
        //ok - clear form
        $('#exampleFormControlSelect1').val('')
        $('#exampleFormControlTextarea1').val('')
        getMyRequest()
      }
      else{
        //error fix pls
        alert("Some error happened");
      }
    })
    return false
  }
  
  async function getMyRequest() {
    let req = JSON.parse(await queryPromise('get_request_of_student',username))
    
$("#requestList").html(ejs.render(`
<% data.forEach(r => { %>
<div class="col-lg-6">
  <div class="card mb-3 <%= {'Pending':'border-warning','Accepted':'border-success','Rejected':'border-danger'}[r.status] %> ">
    <div class="card-body">
      <h5 class="card-title">
        <%= r.form_name %>
        <span class="badge badge-<%={'Pending':'warning','Accepted':'success','Rejected':'danger'}[r.status]%>" ><%= r.status %></span>  
      </h5>
      <p class="card-text"><%= r.details %></p>
      
    </div>
    <div class="card-footer">
      <small class="text-muted"><%= r.request_time %></small>
    </div>
  </div>
</div>
<% }) %>`,{data:req}));
    
  }
  
  getMyRequest();

  queryPromise('set_last_request_visit',username);

</script>
<?php
require_once('footer.php');