<?php
require_once('common.php');
$title="Bill";
require_once('header.php');
?>
<div class="container my-5" style="border:2px solid black;">
  <h1 class="text-center">
    Bill
  </h1>
  <hr>
  <section id="billDiv" class="row">
    <div class="col-md-4">
      <h5>Student ID: <?php echo $_GET['sid'] ?></h5>
      <h5>Year: <?php echo $_GET['year'] ?></h5>
      <h5>Status: <?php echo $_GET['status'] ?></h5>
      <h5>Print time: <?php echo date("j F Y, g:i:s a"); ?></h5>
    </div>
    <div class="col-md-8 text-right">
      <span style="font-size:72px;"><?php echo $_GET['amount'] ?> Baht</span>
    </div>
    <!--<p style="font-size:128px;"></p>-->
  </section>
</div>
  
<script>
  if('<?php echo $_GET['status'] ?>' == 'Paid') {
    $("#billDiv").addClass('text-success');
  }
  else {
    $("#billDiv").addClass('text-danger');
    print()
  }
</script>

<?php
require_once('footer.php');