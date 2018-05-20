<?php
require_once('common.php');
$title="Bill management";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1>
    Bill list
  </h1>
  
  <button class="btn btn-warning" onclick="changeStatusToLate()">
    Change to late
  </button>
  <button class="btn btn-success" onclick="createBill()">
    Create bill for this semester
  </button>
  <br>
  <br>
  <div class="" id="billResult">
    Loading ...
  </div>
</div>

<script>
  async function getUnpaidBillList(){
    let data=JSON.parse(await queryPromise('get_all_unpaid_bill'))
    console.log(data);
    $("#billResult").html(ejs.render(`
<table class="table">
  <thead>
    <tr>
      <th>Year</th>
      <th>Student ID</th>
      <th>Amount</th>
      <th>Status</th>
      <th>Change to paid</th>
    </tr>
  </thead>
  <% data.forEach(arr => { %>
  <tr>
    <td><%= arr.academic_year %>/<%= arr.semester %></td>
    <td><%= arr.student_id %></td>
    <td><%= arr.amount %></td>
    <td><%= arr.payment_status %></td>
    <td><img onclick="updateBillStatus('<%= arr.student_id %>',<%= arr.academic_year %>,<%= arr.semester %>)" src="https://cdn.iconscout.com/public/images/icon/premium/png-512/receipt-paid-invoice-bill-payment-successful-3b9784e138d09296-512x512.png" style="height:30px; width:30px; cursor:pointer;" ></td>
  </tr>
  <% }) %>
</table>
`,{data:data}));
    
    if(data.length === 0) $("#billResult").html(`<div class='text-center w-100'>No unpaid bill</div>`);
  }
  
  getUnpaidBillList();
  
  async function updateBillStatus(sid,year,sem) {
    try {
      await queryPromise('set_bill_paid',sid,year,sem);
      // success
      toastr.success('Change status successfully');
    }
    catch(e) {
      console.log(e);
      // fail
      toastr.error('Something went wrong :(');
      
    }
    
    await getUnpaidBillList();
    
  }
  
  async function changeStatusToLate() {
    try {
      let currSem = getCurrentSemester();
      await queryPromise('change_bill_status_to_late',currSem.course_year,currSem.course_semester);
      
      toastr.success('Change bill late successfully');
    }
    catch(e) {
      console.log(e);
      // fail
      toastr.error('Something went wrong :(');
    }
    
    await getUnpaidBillList();
  }
  
  async function createBill() {
    try {
      let currSem = getCurrentSemester();
      await queryPromise('create_bill_sem',currSem.course_year,currSem.course_semester);
      
      toastr.success('Bill created successfully');
    }
    catch(e) {
      console.log(e);
      toastr.error('Something went wrong :(');
    }
    
    await getUnpaidBillList();
  }
  
  
</script>

<?php
require_once('footer.php');