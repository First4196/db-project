<?php
require_once('common.php');
$title="Professor";
require_once('header.php');
?>
<link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/examples/product/product.css">
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">My course</h1>
        <p class="lead font-weight-normal">View course and timetable. Add grade and announce news.</p>
        <a class="btn btn-outline-secondary" href="professor_mycourse.php">Go to My course</a>
      </div>
      <div class="product-device box-shadow d-none d-md-block"></div>
      <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>

    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
      <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
          <h2 class="display-5">My student</h2>
          <p class="lead">Want to view advised student?</p>
          <a class="btn btn-light" href="professor_mystudent.php">View my student</a>
        </div>
        <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
      </div>
      <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
          <h2 class="display-5">My info</h2>
          <p class="lead">Want your info?</p>
          <a class="btn btn-outline-secondary" href="professor_info.php">View my info</a>
        </div>
        <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
      </div>
    </div>

<?php
require_once('footer.php');