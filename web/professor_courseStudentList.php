<?php
require_once('common.php');
$title="Student list";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
   <?php echo "Student list of ".$_GET['course_id']." (".$_GET['course_year']."/".$_GET['course_semester'].") - sec ".$_GET['course_section']; ?>
  </h1>
  <hr>
  <section class="row" id="studentList">
    
  </section>
</div>

<script>
  
  let username = '<?php echo $_SESSION["account_username"]; ?>';;
      
  let course_id = '<?php echo $_GET['course_id'] ?>';
  let course_year = '<?php echo $_GET['course_year'] ?>';
  let course_semester = '<?php echo $_GET['course_semester'] ?>';
  let course_section = '<?php echo $_GET['course_section'] ?>';
  async function getStudent() {
    // get registered course
    let data = JSON.parse(await queryPromise('get_student_of_course_section',course_id,course_year,course_semester,course_section));
    console.log(data);

    let resultHTML = ejs.render(`
<table class="table">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student name</th>
      <th>Student name (TH)</th>
    </tr>
  </thead>
  <% data.forEach(student => { %> 
  <tr>
    <td><%= student.student_id %></td>
    <td><%= student.fname_en %> <%= student.lname_en %></td>
    <td><%= student.fname_th %> <%= student.lname_th %></td>
  </tr>
  <%})%>
</table>
`,{data:data});
    
    if(data.length === 0) resultHTML = "<div class='text-center'>No student</div>";
    $('#studentList').html(resultHTML)
  }
  
  getStudent();
  
 
</script>
<?php
require_once('footer.php');