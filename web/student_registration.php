<?php
require_once('common.php');
$title="Account management";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Registration
  </h1>
  <hr>
  <section>
    <h2>
      Registered course
    </h2>
    <div class="my-3 row" id="registeredCourseResult">Loading ...</div>
  </section>
  <hr>
  <section>
    <h2>
      Add new course
    </h2>
    <div class="input-group my-3">
      <input type="text" class="form-control" placeholder="Course Name or ID" id="course_name">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" onclick="searchCourse()">Search</button>
      </div>
    </div>
    <div class="my-3 row" id="courseResult"></div>
  </section>
</div>

<script>
  
  let username = <?php echo $_SESSION["account_username"]; ?>
  
  async function getRegisteredCourse() {
    // get registered course
    let current_semester = getCurrentSemester();
    let data = JSON.parse(await queryPromise('get_current_course_of_student',current_semester.course_year, current_semester.course_semester, username));
    
    let resultHTML = ejs.render(`
<% forEachGroup(data,['course_id'], ([cid],course) => { %>
<div class="p-2 col-md-4">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">
        <%= course[0].course_abbrev %>
        <span class="badge badge-primary"><%= cid %></span>
      </h4>
      <p>
        <b>Credit:</b> <%= course[0].credit %><br>
      </p>
    </div>
    <ul class="list-group list-group-flush">
      <% course.forEach(sec => { %>
      <li class="list-group-item">
        <div class="d-flex align-items-center">
          <div>
            Sec <%=sec.course_section%> (<%=sec.student_count%>/<%=sec.capacity%>)
          </div>
          <% if(sec.my_section == "YES") { %>
          <button class="btn btn-danger ml-auto" onclick="removeCourse(<%=sec.course_id%>,<%=sec.course_year%>,<%=sec.course_semester%>,<%=sec.course_section%>)">
            Remove
          </button>
          <% } else { %>
          <button class="btn btn-warning ml-auto" onclick="changeSection(<%=sec.course_id%>,<%=sec.course_year%>,<%=sec.course_semester%>,<%=sec.course_section%>)">
            Change
          </button>
          <% } %>
        </div>
      </li>
      <% }); %>
    </ul>
  </div>
</div>
<% }); %>
    `,{data:data});
    
    if(data.length === 0) resultHTML = "No course found";
    $("#registeredCourseResult").html(resultHTML);
  }
  
  getRegisteredCourse();
  
  async function searchCourse() {
    $("#courseResult").html("Searching ...");
    let query = '%'+$('#course_name').val()+'%';
    let current_semester = getCurrentSemester();
    let data = await queryParsed('search_course_for_student',current_semester.course_year,current_semester.course_semester,query,username);
    let prerequisiteData = await queryParsed('search_course_with_prerequisite_for_student',current_semester.course_year,current_semester.course_semester,query,username);
    
    let resultHTML = ejs.render(`
<% forEachGroup(data,['course_id'], ([cid],course) => { %>
<div class="p-2 col-md-6">
  <div class="card <%= course[0].already_registered=='YES'?'bg-dark text-white':'' %> ">
    <div class="card-body">
      <h4 class="card-title">
        <%= course[0].course_abbrev %>
        <span class="badge badge-primary"><%= cid %></span>
      </h4>
      <p><b>Leader:</b> <a href="detail_professor.php?pid=<%= course[0].leader %>"><%= course[0].leader %></a><br>
      <b>Credit:</b> <%= course[0].credit %><br>
      <% if(course[0].midterm_exam !== null) {%><b>Midterm</b>: 
        <% filterDuplicate(course,['midterm_date','midterm_start','midterm_finish']).forEach(examTime => {%>
          <%=examTime.midterm_date%> (<%=examTime.midterm_start%> - <%=examTime.midterm_finish%>),
        <% }); %>
        <br>
      <% } %>
      <% if(course[0].final_exam !== null) {%><b>Final</b>: 
        <% filterDuplicate(course,['final_date','final_start','final_finish']).forEach(examTime => {%>
          <%=examTime.final_date%> (<%=examTime.final_start%> - <%=examTime.final_finish%>),
        <% }); %>
        <br>
      <% } %>
      </p>
      
      <p><b>Prerequisite</b><br>
      <% var hasPrer = false; %>
      <% prerData.forEach(row => { %>
      <% if(row.course_id == cid) { hasPrer = true; %>
      <b><%= row.precourse %> - <%= row.precourse_name %></b> 
      <span class="oi <%= row.prerequisite_pass=="YES"?'oi-circle-check text-success':'oi-circle-x text-danger' %>"></span>
      <br>
      <% } %>
      <% }) %>
      <% if(!hasPrer) {%> No prerequisite <% } %>
      </p>
    </div>
    <% if(course[0].already_registered == "YES") { %> 
    <ul class="list-group list-group-flush"><li class="list-group-item bg-dark text-center">Registered</li></ul> 
    <% } else { %>
    <ul class="list-group list-group-flush">
      <% forEachGroup(course,['course_section'],([csec],secs) => { var secInfo = secs[0]; %>
      <li class="list-group-item">
        <div class="d-flex align-items-center">
          <div>
            Sec <%=secInfo.course_section%> (<%=secInfo.student_count%>/<%=secInfo.capacity%>)
          </div>
          <button class="btn btn-success ml-auto" onclick="addCourse(<%= cid %>,<%= secInfo.course_year %>,<%= secInfo.course_semester %>,<%= secInfo.course_section %>)">
            Add
          </button>
        </div>
        <p>
          <b>Teacher: </b>
          <% if(secInfo.teachingProf){ %>
            <% var teachers = secInfo.teachingProf.split(", "); %>
            <% for(var i=0;i<teachers.length;i++){ %>
              <% if(i>0){ %>
                , 
              <% } %>
              <a href="detail_professor.php?pid=<%= teachers[i] %>"><%= teachers[i] %></a>
            <% } %>
          <% } %>
        </p>
        <table class="table">
          <% filterDuplicate(secs.filter(clas => clas.class_date !== null),['room_no','building_id','class_date','class_start_time']).forEach(clas => { %>
          <tr>
            <td><%= formatDate(clas.class_date) %></td>
            <td><%= clas.class_start_time+'-'+clas.class_finish_time %></td>
            <td><%= clas.building_id+'/'+clas.room_no %></td>
          </tr>
          <% }) %>
        </table>
      </li>
      <% }); %>
    </ul>
    <% } %>
  </div>
</div>
<% }); %>
    `,{data:data,prerData:prerequisiteData});
    
    if(data.length === 0) resultHTML = "No course found";
    $("#courseResult").html(resultHTML);
  }
  
  async function addCourse(id,year,sem,sec) {
    let result = (await queryParsed('add_course_for_student',username,id,year,sem,sec))[0];
    if(result["result"] === 'OK') toastr.success("Add course successfully");
    else toastr.error(result["result"]);
    await searchCourse()
    getRegisteredCourse();
  }
  
  async function removeCourse(id,year,sem,sec) {
    if(confirm("Are you sure you want to remove this course?")) {
      let result = (await queryParsed('remove_course_for_student',username,id,year,sem,sec))[0];
      if(result["result"] === 'OK') toastr.success("Remove course successfully");
      else toastr.error(result["result"]);
      await searchCourse()
      getRegisteredCourse();
    }
  }
  
   async function changeSection(id,year,sem,sec) {
    if(confirm("Are you sure you want to change section of this course?")) {
      let result = (await queryParsed('change_course_section_for_student',username,id,year,sem,sec))[0];
      if(result["result"] === 'OK') toastr.success("Change section successfully");
      else toastr.error(result["result"]);
      getRegisteredCourse();
    }
  }
</script>
<?php
require_once('footer.php');