<?php
require_once('common.php');
$title="Request management";
require_once('header.php');
?>
<div class="container">
  <br>
  <h1>
    Request List
  </h1>
  <br>
  <div class="row" id="requestResult">
    Loading ...
  </div>
</div>

<script>
  async function getPendingRequestList(){
    let data=JSON.parse(await queryPromise('get_pending_request_list'))
    $("#requestResult").html(ejs.render(`
<% data.forEach(r => { %>
<div class="col-lg-6">
  <div class="card mb-3 <%= {'Pending':'border-warning','Accepted':'border-success','Rejected':'border-danger'}[r.status] %> ">
    <div class="card-body">
      <h5 class="card-title">
        <%= r.form_name %>
        <span class="badge badge-<%={'Pending':'warning','Accepted':'success','Rejected':'danger'}[r.status]%>" ><%= r.status %></span>  
      </h5>
      <p>Requester: <%= r.student_id %></p>
      <p class="card-text"><%= r.details %></p>
  
      <button class="btn btn-danger" onclick="updateRequestStatus(<%= r.student_id %>, '<%= r.request_time %>','Rejected')">Reject</button>
      <button class="btn btn-success ml-3" onclick="updateRequestStatus(<%= r.student_id %>,'<%= r.request_time %>','Accepted')">Accept</button>
    </div>
    <div class="card-footer">
      <small class="text-muted"><%= r.request_time %></small>
    </div>
  </div>
</div>
<% }) %>
`,{data:data}));
    
    if(data.length === 0) $("#requestResult").html(`<div class='text-center w-100'>No pending request</div>`);
  }
  
  getPendingRequestList();
  
  async function updateRequestStatus(sid,reqTime,status) {
    try {
      await queryPromise('set_request_status',sid,reqTime,status);
      // success
      toastr.success('Change status successfully')  
    }
    catch(e) {
      console.log(e);
      // fail
      toastr.error('Something went wrong :(');
      
    }
    
    await getPendingRequestList();
    
  }
</script>

<?php
require_once('footer.php');