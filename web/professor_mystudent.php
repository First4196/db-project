<?php
require_once('common.php');
$title="My student";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1>
    My student
  </h1>
  <br>
  <div id="studentList">
    
  </div>
</div>

<script>
  let username = '<?php echo $_SESSION["account_username"]; ?>';
  
  async function loadStudent() {
    let data = JSON.parse(await queryPromise('get_advised_students',username));
    
    let resultHTML = ejs.render(`
<table class="table">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student name</th>
      <th>Student name (TH)</th>
      <th>Email</th>
      <th>Mobile no</th>
      <th>GPAX</th>
    </tr>
  </thead>
  <% data.forEach(student => { %> 
  <tr>
    <td><%=student.student_id%></td>
    <td><%=student.fname_en%> <%=student.lname_en%></td>
    <td><%=student.fname_th%> <%=student.lname_th%></td>
    <td><%=student.email%></td>
    <td><%=student.mobile_no%></td>
    <td><%=parseFloat(student.gpax).toFixed(2)%></td>
  </tr>
  <%})%>
</table>
`,{data:data});
    
    if(data.length === 0) resultHTML = "<div class='text-center'>No advised student</div>";
    $('#studentList').html(resultHTML);
  }
  loadStudent();
</script>

<?php
require_once('footer.php');