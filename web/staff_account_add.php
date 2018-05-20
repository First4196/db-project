<?php
require_once('common.php');
$title="Add New Account";
require_once('header.php');
?>
<div class="container">
    <br>
    <h1>
        Add New Account
    </h1>
    <form accept-charset="utf-8" onsubmit="return addAccount(this.username.value, this.password.value, this.type.value)">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" required maxlength=30/>
        </div>
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
  function addAccount(username, password, type){
    queryPromise('add_one_account', username, password, type)
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