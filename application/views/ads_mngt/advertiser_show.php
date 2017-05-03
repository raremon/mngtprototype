<div id="mainBox" class="box box-success" style="display:none;">
  <div class="box-header with-border">
    <h3 class="box-title">Advertiser Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="advertiser-message"></div>
          <?php echo form_open('welcome', array('id'=>'advertiser')); ?>
            <div class="form-group hidden">
              <input type="text" name="advertiser_id" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Advertiser Name</label>
              <input type="text" name="advertiser_name" class="form-control" placeholder="Enter Name"/>
            </div>
            <div class="form-group">
              <label>Company Address</label>
              <input type="text" name="advertiser_address" class="form-control" placeholder="Enter Address"/>
            </div>
            <div class="form-group">
              <label>Contact Information</label>
              <input type="text" name="advertiser_contact" class="form-control" placeholder="Enter Contact Information"/>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="text" name="advertiser_email" class="form-control" placeholder="Enter Email Address"/>
            </div>
            <div class="form-group">
              <label>Company Website</label>
              <input type="text" name="advertiser_website" class="form-control" placeholder="Enter Company Website"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="advertiser_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
            <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Advertiser()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
    </div>
  </div>
  <div class="box-footer">      
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Advertiser Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="advertiser-message-2"></div>
          <table id="advertiser_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ADVERTISER NAME</th>
                <th>COMPANY ADDRESS</th>
                <th>CONTACT DETAILS</th>
                <th>EMAIL ADDRESS</th>
                <th>COMPANY WEBSITE</th>
                <th>DESCRIPTION</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>        
    </div>
 </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // R E A D
  $("#advertiser_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('advertisers/showAdvertiser') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      null,
      null,
      null,
      null,
      null,
    ]
  })
  // U P D A T E
  function edit_advertiser(advertiser_id) {
    $(window).scrollTop(0);
    $("#mainBox").show();
    $.ajax({
      url: "<?php echo site_url('advertisers/editAdvertiser') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'advertiser_id='+advertiser_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="advertiser_id"]').val(data.advertiser_id);
        $('input[name="advertiser_name"]').val(data.advertiser_name);
        $('input[name="advertiser_address"]').val(data.advertiser_address);
        $('input[name="advertiser_contact"]').val(data.advertiser_contact);
        $('input[name="advertiser_email"]').val(data.advertiser_email);
        $('input[name="advertiser_website"]').val(data.advertiser_website);
        $('textarea[name="advertiser_description"]').val(data.advertiser_description);
      }
    })
  }
  function update_Advertiser() {
    $.ajax({
      url: "<?php echo site_url('advertisers/updateAdvertiser') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#advertiser').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          $(window).scrollTop(0);
          $("#advertiser-message").fadeIn("slow");
          $('#advertiser-message').html(data.errors).addClass('alert alert-danger');
          setTimeout(function() {
              $('#advertiser-message').fadeOut('slow');
          }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_advertiser(advertiser_id) {
    if(confirm('Do you really want to delete this Advertiser Record ??')){
      $.ajax({
        url: "<?php echo site_url('advertisers/deleteAdvertiser') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'advertiser_id='+advertiser_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#advertiser-message").fadeIn("slow");
              $('#advertiser-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#advertiser-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      });
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF BUS ADD JAVASCRIPT
</script>