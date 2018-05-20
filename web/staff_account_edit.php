<?php
require_once('common.php');
$title="Edit Account ".$_GET["username"];
require_once('header.php');
?>
<div class="container">
    <br>
    <h1>
        Edit Account <?php echo $_GET["username"]; ?>
    </h1>
    <form accept-charset="utf-8" onsubmit="return editAccount(this.password.value, this.type.value)">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" required maxlength=40/>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type">
                <option>student</option>
                <option>professor</option>
                <option>staff</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
</div>

<script>
  let username = '<?php echo $_GET["username"];?>';
  function editAccount(password, type){
    queryPromise('edit_one_account', username, password, type)
    .then(result=>{
      let status = JSON.parse(result)[0][0];
      if(status == 'success'){
        window.location.replace("staff_account.php");
      }
      else{
        alert("Some error happened");
      }
    })
    return false
  }
</script>

<?php
require_once('footer.php');