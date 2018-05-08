<?php
require_once('common.php');
$title="Building Infomation";
require_once('header.php');
?>
<div class="container my-5">
  <h1 class="text-center">
    Building Information
  </h1>
  <hr>
  <section>
    <h2>
      Building List
    </h2>  
    <table class="table" id="result">
      
    </table>
  </section>
</div>

<script>
  
  async function getAll() {
    let req = JSON.parse(await queryPromise('get_all_building'))
    
$("#result").html(ejs.render(`
<thead>
  <th>ID</th>
  <th>Name</th>
  <th>Abbrev</th>
  <th>Faculty</th>
</thead>
<% data.forEach(b => { %>
<tr>

  <td><a href="detail_building.php?bid=<%= b.building_id %>"><%= b.building_id %></a></td>
  <td><%= b.name_en %></td>
  <td><%= b.name_abbrev %></td>
  <td><%= b.faculty_name %></td>

</tr>
<% }) %>`,{data:req}));
    
  }
  
  getAll();
</script>
<?php
require_once('footer.php');