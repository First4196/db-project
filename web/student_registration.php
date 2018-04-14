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
    <div class="my-3 row" id="registeredCourseResult"></div>
  </section>
  <hr>
  <section>
    <h2>
      Add new course
    </h2>
    <div class="input-group my-3">
      <input type="text" class="form-control" placeholder="Course ID" id="course_id">
      <input type="text" class="form-control" placeholder="Course Name" id="course_name">
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
    
    console.log(data);
    
    $("#registeredCourseResult").html("None");
    
    let subject = {};
    for(let x of data){
      if(subject[x["course_id"]] === undefined) subject[x["course_id"]]=[];
      subject[x['course_id']].push(x)
    }
    
    let resultHTML = "";
    for(let id in subject){
      let sub = subject[id];
      let secHTML = ''
      for(let sec of sub){
        secHTML+=
          `<li class="list-group-item">
            <div class="d-flex align-items-center">
              <div>
                Sec ${sec.course_section} (${sec.student_count}/${sec.capacity})
              </div>`
            +(sec.my_section=="YES"?
              `<button class="btn btn-danger ml-auto" onclick="removeCourse(${sec.course_id},${sec.course_year},${sec.course_semester},${sec.course_section})">
                  Remove
                </button>`
            :
              `<button class="btn btn-warning ml-auto" onclick="changeSection(${sec.course_id},${sec.course_year},${sec.course_semester},${sec.course_section})">
                  Change
                </button>`
             )
            +
            `</div>
          </li>`
      }
      let courseHTML = `<div class="p-2 col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">${sub[0].course_id}</h4>
                              <p class="card-text">${sub[0].course_abbrev}</p>
                            </div>
                            <ul class="list-group list-group-flush">`+secHTML+`</ul>
                          </div>
                        </div>`
      resultHTML += courseHTML;
    }
    if(resultHTML == "") resultHTML = "none";
    $('#registeredCourseResult').html(resultHTML);
  }
  
  getRegisteredCourse();
  
  function searchCourse(){
    let course_id = $('#course_id').val();
    let course_name = '%'+$('#course_name').val()+'%';
    let current_semester = getCurrentSemester();
    $.post('do.php',makeQuery('search_course_for_student',current_semester.course_year,current_semester.course_semester,course_id,course_name,username)
      ,data=>{
        data=JSON.parse(data);
        console.log(data);
        
        
      
        let subject = {};
        for(let x of data){
          if(subject[x["course_id"]] === undefined) subject[x["course_id"]]=[];
          subject[x['course_id']].push(x);
        }
        
        let resultHTML = "";
        for(let id in subject){
          let sub = subject[id];
          console.log(sub);
          let secHTML = ''
          for(let sec of sub){
            secHTML+=
              `<li class="list-group-item">
                <div class="d-flex align-items-center">
                  <div>
                    Sec ${sec.course_section} (${sec.student_count}/${sec.capacity})
                  </div>
                  <button class="btn btn-success ml-auto" onclick="addCourse(${sec.course_id},${sec.course_year},${sec.course_semester},${sec.course_section})">
                    Add
                  </button>
                </div>
              </li>`
          }
          let courseHTML = "";
          if(sub[0].already_registered == 'YES') {
            courseHTML = `<div class="p-2 col-md-4">
                              <div class="card bg-dark text-white">
                                <div class="card-body">
                                  <h4 class="card-title">${sub[0].course_id}</h4>
                                  <p class="card-text">${sub[0].course_abbrev}</p>
                                </div>
                                <ul class="list-group list-group-flush"><li class="list-group-item bg-dark text-center">Registered</li></ul>
                              </div>
                            </div>`
          }
          else {
            courseHTML = `<div class="p-2 col-md-4">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">${sub[0].course_id}</h4>
                                  <p class="card-text">${sub[0].course_abbrev}</p>
                                </div>
                                <ul class="list-group list-group-flush">${secHTML}</ul>
                              </div>
                            </div>`
          }
          resultHTML += courseHTML;
        }
      $("#courseResult").html(resultHTML);
    })
  }
  
  async function addCourse(id,year,sem,sec) {
    let result = await queryPromise('add_course_for_student',username,id,year,sem,sec);
    if(result["success"]) console.log("Success");
    await getRegisteredCourse();
  }
  
  async function removeCourse(id,year,sem,sec) {
    if(confirm("Are you sure you want to remove this course?")) {
      let result = await queryPromise('remove_course_for_student',username,id,year,sem,sec);
      if(result["success"]) console.log("Success");
      await getRegisteredCourse();
    }
  }
  
   async function changeSection(id,year,sem,sec) {
    if(confirm("Are you sure you want to change section of this course?")) {
      let result = await queryPromise('change_course_section_for_student',username,id,year,sem,sec);
      console.log(result);
      await getRegisteredCourse();
    }
  }
</script>
<?php
require_once('footer.php');