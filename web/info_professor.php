<?php
require_once('common.php');
$title="Professor Infomation";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Professor Information
  </h1>
  <hr>
  <section >
    <h2>
      Professor List
    </h2>  
    <table class="table" id="professorResult">
      
    </table>
  </section>
</div>

<script>
  
  async function getAllProfessor() {
    let req = JSON.parse(await queryPromise('get_all_professor'))
    
$("#professorResult").html(ejs.render(`
<thead>
  <th>ID</th>
  <th>Name</th>
  <th>Department</th>
</thead>
<% data.forEach(p => { %>
<tr>

  <td><a href="detail_professor.php?pid=<%= p.professor_id %>"><%= p.professor_id %></a></td>
  <td><%= p.fname_en+' '+p.lname_en %></td>
  <td><%= p.department_name %></td>

</tr>
<% }) %>`,{data:req}));
    
  }
  
  getAllProfessor();
</script>
<?php
require_once('footer.php');