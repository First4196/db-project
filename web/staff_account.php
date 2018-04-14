<?php
require_once('common.php');
$title="Account management";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1>
    Account List
  </h1>
  <button type="button" class="btn btn-primary" onclick="loadAccountList();">Refresh</button>
  <br>
  <br>
  <table id="account_list_div" class="table">
    
  </table>
</div>

<script>
  function loadAccountList() {
    $("#account_list_div").empty();
    $("#account_list_div").append(
      $("<tr>")
      .append($("<th>").html("Username"))
      .append($("<th>").html("Password"))
      .append($("<th>").html("Type"))
      .append($("<th>").html("Delete"))
    );
    
    $.post("do.php",makeQuery('get_all_accounts'),(data) => {
      data = JSON.parse(data);
      for(let i in data) {
        let row = data[i];
        $("#account_list_div").append(
          $("<tr>")
          .append($("<td>").html(row["username"]))
          .append($("<td>").html(row["password"]))
          .append($("<td>").html(row["type"]))
          .append($("<td>").append($("<button>",{class:"btn btn-danger"}).click(() => deleteAccount(row['username'])).html("Delete")))
        )
      }
    });
  }
  loadAccountList();
  
  function deleteAccount(i) {
    console.log("DEL",i);
    $.post('do.php',makeQuery('remove_one_account',i),data=>{
      data = JSON.parse(data)
      loadAccountList()
    })
  }
</script>

<?php
require_once('footer.php');