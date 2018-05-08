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
  <hr>
  <h2>
    Create news on <?php echo $_GET['course_id'] ?> - Section <?php echo $_GET['course_section'] ?>
  </h2>
  <form accept-charset="utf-8" onsubmit="return newNews(this.newsTitle.value,this.newsDetail.value)">
    <div class="form-group">
      <label for="newsTitle">Title</label>
      <input class="form-control" type="text" id="newsTitle"></input>
    </div>
    <div class="form-group">
      <label for="newsDetail">Details</label>
      <textarea class="form-control" id="newsDetail" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
  
  let username = '<?php echo $_SESSION["account_username"]; ?>';;
      
  let course_id = '<?php echo $_GET['course_id'] ?>';
  let course_section = '<?php echo $_GET['course_section'] ?>';
  async function getNews() {
    // get registered course
    let current_semester = getCurrentSemester();
    let data = JSON.parse(await queryPromise('get_news_of_course',course_id,current_semester.course_year,current_semester.course_semester ,course_section ));
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
  getNews();
  
  
  async function addNews(title,detail) {
    try {
      let currSem = getCurrentSemester();
      let result = JSON.parse(await queryPromise('add_news_to_course',course_id,currSem.course_year,currSem.course_semester ,course_section, title,detail ));
      
      $('#newsTitle').val('')
      $('#newsDetail').val('')
      
      toastr.success('News created successfully');
    }
    catch(e) {
      console.log(e);
      toastr.error('Something went wrong :(');
    }
    
    await getNews();
  }
  
  function newNews(title,detail) {
    addNews(title,detail);
    return false;
  }
</script>
<?php
require_once('footer.php');