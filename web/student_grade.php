<?php
require_once('common.php');
$title="Grade";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1>
    Grade Report
  </h1>
  <br>
  <div id="grade_div">
    
  </div>
</div>

<script>
  function loadGrade() {
    $("#grade_div").empty();
    
    $.post("do.php",makeQuery('get_grade_of_student',<?php echo $_SESSION['account_username']; ?>),(data) => {
      data = JSON.parse(data);
      // build grade data by grouping courses with year/semester
      let grade = {};
      for(let row of data) {
        let yearString = row["course_year"]+'/'+row["course_semester"];
        if(grade[yearString] === undefined) grade[yearString] = [];
        grade[yearString].push(row);
      }
      
      // for each year/sem, build grade report
      for(let yearString of Object.keys(grade).sort()) {
        let gradeTable = $("<table>",{class:"table"});
        gradeTable.append(
          $("<tr>")
          .append($("<th>").html("Course ID"))
          .append($("<th>").html("Course Abbrev"))
          .append($("<th>").html("Grade"))
          .append($("<th>").html("Credit"))
        )
        for(let row of grade[yearString]) {
          gradeTable.append(
            $("<tr>")
            .append($("<td>").html(row["course_id"]))
            .append($("<td>").html(row["course_abbrev"]))
            .append($("<td>").html(row["grade"]))
            .append($("<td>").html(row["credit"]))
          )
        }
        
        $("#grade_div").append(
          $("<div>")
            .append($("<h2>").html(yearString))
            .append(gradeTable)
        );
      }
    });
  }
  loadGrade();
</script>

<?php
require_once('footer.php');