<?php
require_once('common.php');
$title="News";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    News
  </h1>
  <hr>
  <section class="row" id="newsResult">
    
  </section>
</div>

<script>
  
  let username = <?php echo $_SESSION["account_username"]; ?>
      
  let course_id = <?php echo $_GET['course_id'] ?>
  
  async function getNews() {
    // get registered course
    let current_semester = getCurrentSemester();
    let data = JSON.parse(await queryPromise('get_news_of_course_of_student',course_id,current_semester.course_year,current_semester.course_semester ,username ));
    console.log(data);

    let resultHTML = ejs.render(`
<% data.forEach(news => { %>
<div class="col-md-4 mb-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><%= news.title %></h5>
      <p class="card-text"><%= news.detail %></p>
    </div>
    <div class="card-footer">
      <small class="text-muted"><%= news.publish_time %></small>
    </div>
  </div>
</div>
<% }) %>`,{data:data});
    
    if(data.length === 0) resultHTML = "<div class='text-center'>No news</div>";
    $('#newsResult').html(resultHTML)
  }
  getNews()
</script>
<?php
require_once('footer.php');