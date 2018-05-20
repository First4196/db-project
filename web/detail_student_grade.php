<?php
require_once('common.php');
$title="Grade of ".$_GET["sid"];
require_once('header.php');
?>
<style>
#gg{
  width:1086px;
  height:1575px;
  border:black solid 2px;
  padding:2px;
}
  #gg > span{
    display:block;
    width:100%;
    border-bottom: 2px solid black;
  }
#ez{
  height:20%;
}
#ez > div{
  width:360px;
}

</style>
<div class="container d-print-none">
  <br>
  <h1>
    Grade of <?php echo $_GET["sid"]; ?>
  </h1>
  <br>
  <div id="grade_div">
    
  </div>
</div>

<script>
  let sid = '<?php echo $_GET["sid"];?>';
  
  async function loadGrade() {
    $("#grade_div").empty();
    let data = await queryParsed('get_grade_of_student',sid);
    //$.post("do.php",makeQuery('get_grade_of_student',username),(data) => {
      //data = JSON.parse(data);
      // build grade data by grouping courses with year/semester
      let grade = {};
      for(let row of data) {
        let yearString = row["course_year"]+'/'+row["course_semester"];
        if(grade[yearString] === undefined) grade[yearString] = [];
        grade[yearString].push(row);
      }
      
      // for each year/sem, build grade report
      let gradeTotal = 0;
      let creditForGPAX = 0;
      let creditTotal = 0;
      let normalGrade = {'A':4, 'B+':3.5, 'B':3, 'C+':2.5, 'C':2, 'D+':1.5, 'D':1, 'F':0};
      
      for(let yearString of Object.keys(grade).sort()) {
        let gradeThisSem = 0;
        let creditForGPA = 0;
        let creditAttempted = 0;
        let creditGain = 0;
        let validGrade = true;
        
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
        
        grade[yearString].forEach(rec => {
          rec.credit = parseInt(rec.credit);
          if(rec.grade in normalGrade) gradeThisSem += normalGrade[rec.grade] * rec.credit;
          if(rec.grade in normalGrade) creditForGPA += rec.credit;
          creditAttempted += rec.credit;
          if((rec.grade != 'F' && rec.grade in normalGrade) || rec.grade == 'S') creditGain += rec.credit;
          if(!(rec.grade in normalGrade || rec.grade == 'S' || rec.grade == 'U')) validGrade = false;
        }); // grade
        
        console.log(yearString,{creditGain:creditGain,gradeThisSem:gradeThisSem,creditForGPA:creditForGPA,creditTotal:creditTotal,gradeTotal:gradeTotal,creditForGPAX:creditForGPAX,validGrade:validGrade});
        
        gradeTotal += gradeThisSem;
        creditForGPAX += creditForGPA;
        creditTotal += creditGain;
        if(creditForGPA == 0) creditForGPA = 1; // prevent divided by 0
        if(creditForGPAX == 0) creditForGPAX = 1; // prevent divided by 0
        
        $("#grade_div").append(
          $("<div>",{class:"p-3"})
            .append($("<h2>").html(yearString))
            .append(gradeTable)
            .append(ejs.render(`
<table class="table">
  <% if(validGrade) { %>
  <thead><tr><th>Credit</th><th>GPA</th><th>Total credit</th><th>GPAX</th></tr></thead>
  <tr><td><%=creditGain%></td><td><%=(gradeThisSem/creditForGPA).toFixed(2)%></td><td><%=creditTotal%></td><td><%=(gradeTotal/creditForGPAX).toFixed(2)%></td>
  <% } else { %>
  <tr><td>Grade for this semester is not ready</td></tr>
  <% } %>
</table>
`,{creditGain:creditGain,gradeThisSem:gradeThisSem,creditForGPA:creditForGPA,creditTotal:creditTotal,gradeTotal:gradeTotal,creditForGPAX:creditForGPAX,validGrade:validGrade}))
        );
      }
      
      $("#ez").html($("#grade_div").html());
    //});
  }
  loadGrade();
</script>

<?php
require_once('footer.php');