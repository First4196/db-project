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
      Registered course
    </h2>
    <div class="my-3 row" id="registeredCourseResult">
      Loading
    </div>
  </section>
  <hr>
  <section class="card my-3">
    <div class="card-body">
      <h2 class="card-title">
        Timetable
      </h2>
      <div class="my-4 row" id="timeTableResult">
        Loading
      </div>
    </div>
  </section>
  <section class="card my-3">
    <div class="card-body">
      <h2 class="card-title">
        Midterm exam table
      </h2>
      <div class="my-4 row" id="midtermTableResult">
        Loading
      </div>
    </div>
  </section>
  <section class="card my-3">
    <div class="card-body">
      <h2 class="card-title">
        Final exam table
      </h2>
      <div class="my-4 row card-body" id="finalTableResult">
        Loading
      </div>
    </div>
  </section>
</div>

<script>
  
  let username = <?php echo $_SESSION["account_username"]; ?>
      
  function updateMidtermExamTable(timeTable) {
    $("#midtermTableResult").html(ejs.render(`
<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Course</th>
        <th>Time</th>
        <th>Building/Room</th>
      </tr>
    </thead>
    <% data.forEach(subj => { %>
    <tr>
      <td style="width:20%"><%= subj.midterm_date %></td>
      <td style="width:30%"><%= subj.course_abbrev %></td>
      <td style="width:30%"><%= subj.midterm_start%> - <%=subj.midterm_finish%></td>
      <td style="width:20%"><%= subj.building_id%>/<%=subj.room_no%></td>
    </tr>
    <% }) %>
  </table>
</div>
`,{data:timeTable}))
  }
  
  function updateFinalExamTable(timeTable) {
    console.log(timeTable);
    $("#finalTableResult").html(ejs.render(`
<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Course</th>
        <th>Time</th>
        <th>Building/Room</th>
      </tr>
    </thead>
    <% data.forEach(subj => { %>
    <tr>
      <td style="width:20%"><%= subj.final_date %></td>
      <td style="width:30%"><%= subj.course_abbrev %></td>
      <td style="width:30%"><%= subj.final_start%> - <%=subj.final_finish%></td>
      <td style="width:20%"><%= subj.building_id%>/<%=subj.room_no%></td>
    </tr>
    <% }) %>
  </table>
</div>
`,{data:timeTable}))
  }
      
  function updateTimeTable(timeTable){
    $("#timeTableResult").html(ejs.render(`
<% forEachIn(data, (dayNum, timeInDay) => { %>
<div class="col-12">
<h3><%= formatDate(dayNum) %></h3>
<table class="table" >
  <thead>
    <tr>
      <th>Course</th>
      <th>Time</th>
      <th>Building/Room</th>
    </tr>
  </thead>
  <% timeInDay.sort((a,b)=> a.class_start_time.localeCompare(b.class_start_time) ) %>
  <% timeInDay.forEach(interval => { %>
    <tr>
      <td style="width:30%"><%= interval.course_abbrev %>[<%= interval.course_section %>]</td>
      <td style="width:40%"><%=interval.class_start_time%> - <%=interval.class_finish_time%></td>
      <td style="width:30%"><%=interval.class_building%>/<%=interval.class_room%></td>
    </tr>
  <% }) %>
</table>
</div>
<% }) %>
`,{data:timeTable}));
    console.log(timeTable);
  }
  async function getRegisteredCourse() {
    // get registered course
    let current_semester = getCurrentSemester();
    let data = JSON.parse(await queryPromise('get_course_of_student_with_time',username, current_semester.course_year, current_semester.course_semester ));
    console.log(data);
    let subject = groupBy(data,'course_id');

    let resultHTML = ejs.render(`
<% forEachIn(subject, (course_id, sub) => { %>
<div class="p-2 col-md-4">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">
        <%= sub[0].course_abbrev %>
        <span class="badge badge-primary"><%= sub[0].course_id %></span>  
        
      </h4>
      <p class="card-text">Section <%= sub[0].course_section %></p>
      
      <b>Leader:</b> <%= sub[0].leader %><br>
      <b>Credit:</b> <%= sub[0].credit %><br>

      <p> 
        <b>Teacher: </b> <%= sub[0].teachingProf %>
      </p>

      <a href="student_news.php?course_id=<%= sub[0].course_id %>" class="card-link">View news</a>
    </div>
    <ul class="list-group list-group-flush">
      <% sub.forEach( (interval) => { %> 
      <% if(interval.class_date !== null) { %>
      <li class="list-group-item">
        <div class="d-flex align-items-center">
          <div class="w-100">
            <span><%= formatDate(interval.class_date) %></span> <span class="float-right"><%=interval.class_start_time%> - <%=interval.class_finish_time%></span>
          </div>
        </div>
      </li>
      <% } %>
      <% }) %>
    </ul>
  </div>
</div>
<% }) %>`,{subject:subject});
    
    if(data.length === 0) resultHTML = "<div class='text-center w-100'>No course registered</div>";
    $('#registeredCourseResult').html(resultHTML);

    let dataWithoutNull = data.filter(x => x.class_date !== null);
    updateTimeTable(groupBy(dataWithoutNull,'class_date'))
    
    /*let examData = [];
    
    forEachIn(groupBy(data,'course_id'),(cid,secs) => {
      let secData = groupBy(secs,'course_section');
      
      secData[Object.keys(secData)[0]].forEach(exam => {
        examData.push(exam);
      })
    })
    updateMidtermExamTable(examData.filter(x => x.midterm_exam !== null).sort((a,b) => {
      Date.parse(a.midterm_date)==Date.parse(b.midterm_date)?
        a.midterm_start.localeCompare(b.midterm_start):
      Date.parse(a.midterm_date)<Date.parse(b.midterm_date)
    }));
    updateFinalExamTable(examData.filter(x => x.final_exam !== null).sort((a,b) => {
      Date.parse(a.final_date)==Date.parse(b.final_date)?
        a.final_start.localeCompare(b.final_start):
      Date.parse(a.final_date)<Date.parse(b.final_date)
    }));*/
  }

  async function getMidterm() {
    let current_semester = getCurrentSemester();
    let data = await queryParsed('get_course_midterm_of_student',username, current_semester.course_year, current_semester.course_semester );
    updateMidtermExamTable(data.filter(x => x.midterm_exam !== null).sort((a,b) => {
      Date.parse(a.midterm_date)==Date.parse(b.midterm_date)?
        a.midterm_start.localeCompare(b.midterm_start):
      Date.parse(a.midterm_date)<Date.parse(b.midterm_date)
    }));
  }
  
  async function getFinal() {
    let current_semester = getCurrentSemester();
    let data = await queryParsed('get_course_final_of_student',username, current_semester.course_year, current_semester.course_semester );
    console.log(data.filter(x => x.final_exam !== null))
    updateFinalExamTable(data.filter(x => x.final_exam !== null).sort((a,b) => 
      (Date.parse(a.final_date)==Date.parse(b.final_date)?
        a.final_start.localeCompare(b.final_start):
      (Date.parse(a.final_date)<=Date.parse(b.final_date)?-1:1))
    ));
  }
  getRegisteredCourse();
  getMidterm();
  getFinal();
</script>
<?php
require_once('footer.php');