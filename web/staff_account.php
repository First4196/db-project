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
  <br>
  <a href="staff_account_add.php" class="btn btn-primary">Add New Account</a>
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
      .append($("<th>").html("Edit"))
      .append($("<th>").html("Delete"))
    );
    
    $.post("do.php",makeQuery('get_all_accounts'),(data) => {
      data = JSON.parse(data);
      for(let i in data) {
        let row = data[i];
        let usernameHTML = row["username"];
        if(row["type"]=='student'){
          usernameHTML = '<a href="detail_student.php?sid='+row["username"]+'">'+row["username"]+'</a>';
        }
        if(row["type"]=='professor'){
          usernameHTML = '<a href="detail_professor.php?pid='+row["username"]+'">'+row["username"]+'</a>';
        }
        $("#account_list_div").append(
          $("<tr>")
          .append($("<td>").html(usernameHTML))
          .append($("<td>").html(row["password"]))
          .append($("<td>").html(row["type"]))
          .append($("<td>").append($("<button>",{class:"btn btn-warning"}).click(() => editAccount(row['username'])).html("Edit")))
          .append($("<td>").append($("<button>",{class:"btn btn-danger"}).click(() => deleteAccount(row['username'])).html("Delete")))
        )
      }
    });
  }
  loadAccountList();

  function editAccount(username) {
    window.location.replace('staff_account_edit.php?username='+username);
  }

  function deleteAccount(username) {
    if(confirm('Delete account '+username)) {
      console.log("DEL",username);
      $.post('do.php',makeQuery('remove_one_account',username),data=>{
        data = JSON.parse(data)
        loadAccountList()
      })
    }
  }

</script>

<?php
require_once('footer.php');