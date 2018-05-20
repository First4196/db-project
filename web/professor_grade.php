<?php
require_once('common.php');
$title="Grade";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
   <?php echo "Grade of ".$_GET['course_id']." (".$_GET['course_year']."/".$_GET['course_semester'].")" ?>
  </h1>
  <hr>
  <button onclick="createGrade()" class="btn btn-primary mb-3">
    Create grade record
  </button>
  <br>
  <section class="row" id="gradeResult">
    
  </section>
</div>

<script>
  
  let username = '<?php echo $_SESSION["account_username"]; ?>';
      
  let course_id = '<?php echo $_GET['course_id'] ?>';
  let course_year = '<?php echo $_GET['course_year'] ?>';
  let course_semester = '<?php echo $_GET['course_semester'] ?>';
  
  async function getGrade() {
    // get registered course
    let data = JSON.parse(await queryPromise('get_all_grade_of_student_of_course',course_id,course_year,course_semester));
    console.log(data);

    let resultHTML = ejs.render(`
<table class="table">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student name</th>
      <th>Section</th>
      <th>Grade</th>
      <th>Hidden</th>
    </tr>
  </thead>
  <% data.forEach(grade => { %> 
  <tr>
    <td style="width:20%;"><a href="detail_student.php?sid=<%= grade.student_id %>"><%= grade.student_id %></a></td>
    <td style="width:50%;"><%= grade.student_fname %> <%= grade.student_lname %></td>
    <td style="width:10%;"><%= grade.course_section %></td>
    <td style="width:10%;">
      <div class="form-group">
        <select class="form-control">
          <% ['A','B+','B','C+','C','D+','D','F','W','S','U','X','I','M'].forEach(gradeLetter => { %>
          <option value="<%= gradeLetter %>" <%= grade.grade==gradeLetter?'selected':''%> ><%=gradeLetter%></option>
          <% }); %>
        </select> 
      </div>
    </td>
    <td style="width:10%;"><input class="form-control" type="checkbox" <%= grade.hidden==1?'checked':'' %>></td>
  </tr>
  <%})%>
</table>

<button id="saveButton" class="btn btn-primary ml-auto" onclick="saveGrade()">Save all</button>
`,{data:data});
    
    if(data.length === 0) resultHTML = "<div class='text-center'>No grade record</div>";
    $('#gradeResult').html(resultHTML)
  }
  
  getGrade();
  
  
  async function createGrade() {
    try {
      let result = JSON.parse(await queryPromise('create_grade_of_student_of_course',course_id,course_year,course_semester));
      
      toastr.success('Grade record created successfully');
    }
    catch(e) {
      console.log(e);
      toastr.error('Something went wrong :(');
    }
    
    await getGrade();
  }
  
  async function saveGrade() {
    let x = $("#gradeResult").find("tr").toArray();
    $("#saveButton").html("Saving ...");
    $("#saveButton").attr("class","btn btn-warning ml-auto");
    for(let i in x) {
      let elem = x[i];
      if(i >= 1) {
        let td = $(elem).find("td");
        let sid = $(td[0]).html();
        let grade = $(td[3]).find("select").first().val();
        let hidden = $(td[4]).find("input").first().prop('checked');
        try {
          await queryPromise('set_grade_of_student_of_course',course_id,course_year,course_semester,sid,grade,hidden?1:0);
          //toastr.success(`Updated grade for ${sid}`);
        }
        catch(e) {
          console.log(e);
          toastr.error(`Can't update grade for ${sid}`);
        }
      }
    };

    toastr.success('Grade update completed');
    
    await getGrade();
  }
</script>
<?php
require_once('footer.php');