<?php
require_once('common.php');
$title="Course information";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Course information
  </h1>
  <section>
    <h2>
      Search course
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
  
  async function searchCourse() {
    $("#courseResult").html("Searching ...");
    let query = '%'+$('#course_name').val()+'%';
    let current_semester = getCurrentSemester();
    let data = await queryParsed('search_course_of_year',current_semester.course_year,current_semester.course_semester,query);
    let resultHTML = ejs.render(`
<% forEachGroup(data,['course_id'], ([cid],course) => { %>
<div class="p-2 col-md-6">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">
        <%= course[0].course_abbrev %>
        <span class="badge badge-primary"><%= cid %></span>
      </h4>
      <p><b>Leader:</b> <%= course[0].leader %><br>
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
    </div>
    <ul class="list-group list-group-flush">
      <% forEachGroup(course,['course_section'],([csec],secs) => { var secInfo = secs[0]; %>
      <li class="list-group-item">
        <div class="d-flex align-items-center">
          <div>
            Sec <%=secInfo.course_section%> (<%=secInfo.student_count%>/<%=secInfo.capacity%>)
          </div>
        </div>
        <p> 
          <b>Teacher: </b> <%= secInfo.teachingProf %>
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
  </div>
</div>
<% }); %>
    `,{data:data});
    
    if(data.length === 0) resultHTML = "No course found";
    $("#courseResult").html(resultHTML);
  }
</script>
<?php
require_once('footer.php');