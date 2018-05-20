<?php
require_once('common.php');
$title="My course";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    My course
  </h1>
  <hr>
  <section>
    <h2>
      Teaching course
    </h2>
    <div class="my-3 row" id="registeredCourseResult">
      Loading
    </div>
  </section>
  <hr>
  <section>
    <h2>
      Timetable
    </h2>
    <div class="my-4 row" id="timeTableResult">
      Loading
    </div>
  </section>
</div>

<script>
  
  let username = '<?php echo $_SESSION["account_username"]; ?>';
      
  function updateTimeTable(timeTable){
    $("#timeTableResult").html(ejs.render(`
<% forEachIn(data, (dayNum, timeInDay) => { %>
<div class="col-12">
<h3><%= formatDate(dayNum) %></h3>
<table class="table" >
  <% timeInDay.sort((a,b)=> a.class_start_time.localeCompare(b.class_start_time) ) %>
  <% timeInDay.forEach(interval => { %>
    <tr>
      <td style="width:30%"><%= interval.course_abbrev %>[<%= interval.course_section %>]</td>
      <td style="width:40%"><%=interval.class_start_time%> - <%=interval.class_finish_time%></td>
      <td style="width:30%"><%=interval.building_id%>/<%=interval.room_no%></td>
    </tr>
  <% }) %>
</table>
</div>
<% }) %>
`,{data:timeTable}))
  }
  async function getRegisteredCourse() {
    // get registered course
    let current_semester = getCurrentSemester();
    let data = JSON.parse(await queryPromise('get_course_of_professor_with_time',username, current_semester.course_year, current_semester.course_semester ));

    let resultHTML = ejs.render(`
<% forEachGroup(data, ['course_id','course_year','course_semester'], ([cid,cyear,csem], sub) => { %>
<div class="p-2 col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">
        <%= sub[0].course_abbrev %>
        <span class="badge badge-primary"><%= cid %></span>  
      </h4>
      <a href="professor_grade.php?course_id=<%= cid %>&course_year=<%= cyear %>&course_semester=<%= csem %>" class="btn btn-success">Enter Grade</a>

      <div class="row">
        <% forEachGroup(sub, ['course_section'], ([csec],sec) => { %>
        <div class="p-2 col-md-6">
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">Section <%= csec %></h5>
              <a href="professor_news.php?course_id=<%= cid %>&course_section=<%= csec %>" class="btn btn-warning">News</a>
              <a href="professor_courseStudentList.php?course_id=<%= cid %>&course_year=<%= cyear %>&course_semester=<%= csem %>&course_section=<%= csec %>" class="btn btn-primary ml-3">Student List</a>
            </div>
            <ul class="list-group list-group-flush">
              <% sec.forEach( (interval) => { %> 
              <li class="list-group-item">
                <div class="d-flex align-items-center">
                  <div class="w-100">
                    <span><%= formatDate(interval.class_date) %></span> <span class="float-right"><%=interval.class_start_time%> - <%=interval.class_finish_time%></span>
                  </div>
                </div>
              </li>
              <% }) %>
            </ul>
          </div>
        </div>
        <% }); %>
      </div>
    </div>
  </div>
</div>
<% }) %>`,{data:data});
    
    if(data.length === 0) resultHTML = "<div class='text-center w-100'>No course registered</div>";
    $('#registeredCourseResult').html(resultHTML);
    
    updateTimeTable(groupBy(data,'class_date'))
  }
  getRegisteredCourse()
</script>
<?php
require_once('footer.php');