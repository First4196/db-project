<?php
require_once('common.php');
$title="Building detail";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1 class="text-center">
    Details of <?php echo $_GET["bid"]; ?>
  </h1>
  <hr>
  <div id="infoResult">
    
  </div>
  <br>
</div>

<script>
  let bid = '<?php echo $_GET["bid"];?>';
  async function loadInfo() {
    let data = JSON.parse(await queryPromise('get_building_detail',bid));
    
    $("#infoResult").html(ejs.render(`
<div class="row mb-3">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><%= data[0].name_abbrev %></h5>
        <p class="card-text">
          <b>Name :</b> <%= data[0].name_en %> <br>
          <b>Name (TH) :</b> <%= data[0].name_th %> <br>
          <b>Faculty :</b> <%= data[0].faculty_name %> <br>
          <a class="btn btn-info" href="https://www.google.com/maps/?q=<%= data[0].latitude %>,<%= data[0].longitude %>">Location<a/><br>
        </p>
      </div>
    </div>
  </div>
</div>
<h2>Room list</h2>
<div class="row">
  <div class="col-12">
    <% if(data[0].room_id !== null){ %>
      <table class="table">
        <thead>
          <th>Room No.</th>
          <th>Type</th>
          <th>Capacity</th>
        </thead>
        <% data.forEach( r=> { %>
        <tr>
          <td><%= r.room_no %></td>
          <td><%= r.room_type %></td>
          <td><%= r.seat_capacity %></td>
        </tr>
        <% }) %>
      </table>
    <% }else{ %>
      No room in this building
    <% } %>
  </div>
</div>
`,{data:data}));
    
  }
  loadInfo();
  
</script>

<?php
require_once('footer.php');