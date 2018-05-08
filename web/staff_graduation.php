<?php
require_once('common.php');
$title="Graduation";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Graduation Manager
  </h1>
  <hr>
  <section >
    <h2>
      Pending Student
    </h2>  
    <table class="table" id="studentResult">
      
    </table>
  </section>
</div>

<script>
  
  async function getAll() {
    let req = JSON.parse(await queryPromise('get_graduation_pending_student'))
    $("#studentResult").html(ejs.render(`
<thead>
  <th>ID</th>
  <th>Name</th>
  <th>GPAX</th>
  <th>action</th>
</thead>
<% data.forEach(s => { %>
<tr>

  <td><%= s.student_id %></td>
  <td><%= s.fname_en+' '+s.lname_en %></td>
  <td><%= parseFloat(s.gpax).toFixed(2) %></td>
  <td><button 
        class="btn btn-outline-success" 
        onclick="queryPromise('graduatedplusplus',<%= s.student_id %>).then(getAll)">
        <span class="oi oi-check"></span>
  </td>
</tr>
<% }) %>`,{data:req}));
    
  }
  
  getAll();
</script>
<?php
require_once('footer.php');