<div class="modal fade" id="agency-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agency Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="agency-message"></div>
              <?php echo form_open('agencies/save', array('id'=>'agency')); ?>
                <div class="form-group hidden">
                  <input type="text" name="agency_id" class="form-control"/>
                </div>
                <div class="form-group">
                  <label>Agency Name</label>
                  <input type="text" name="agency_name" class="form-control" placeholder="Enter Name"/>
                </div>
                <div class="form-group">
                  <label>Company Address</label>
                  <input type="text" name="agency_address" class="form-control" placeholder="Enter Address"/>
                </div>
                <div class="form-group">
                  <label>Contact Information</label>
                  <input type="text" name="agency_contact" class="form-control" placeholder="Enter Contact Information"/>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" name="agency_email" class="form-control" placeholder="Enter Email Address"/>
                </div>
                <div class="form-group">
                  <label>Company Website</label>
                  <input type="text" name="agency_website" class="form-control" placeholder="Enter Company Website"/>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="agency_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
                </div>
                <div class="form-group">
                  <label>Billable</label>
                  <input type="text" name="billable" class="hidden" readonly>
                  <div class="switch-wrapper">
                    <input id="billable" type="checkbox">
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Agency()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="advertiser-list" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertisers List</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <table id="agency_advertisers" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>ADVERTISER NAME</th>
                    <th>COMPANY ADDRESS</th>
                    <th>CONTACT DETAILS</th>
                    <th>EMAIL ADDRESS</th>
                    <th>COMPANY WEBSITE</th>
                    <th>DESCRIPTION</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Agency Data</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('agencies/add') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Agency</a>
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="agency-message-2"></div>
          <table id="agency_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>AGENCY NAME</th>
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
  $("#agency_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('agencies/show') ?>",
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
  $("#agency_advertisers").DataTable({
    "paging":   false,
    "bFilter": false,
  });
  function see_advertiser(advertiser_id) {
    $(window).scrollTop(0);
    $("#advertiser-list").modal('show');
    $.get("<?php echo site_url('agencies/getAdvertisers/"+advertiser_id+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      $("#agency_advertisers").dataTable().fnClearTable();
      if(basic.length > 0)
      {
        $("#agency_advertisers").dataTable().fnAddData(basic);
      }
    });
  }
  $('#billable').change(function(){
    if($('#billable').is(':checked'))
    {
      $('input[name="billable"]').val(1);
    }
    else
    {
      $('input[name="billable"]').val(0);
    }
  });

  $("input[type=checkbox]").switchButton({
    on_label: 'yes',
    off_label: 'no',
    labels_placement: "right",
    width: 100,
    height: 40,
    button_width: 60,
  });
  // U P D A T E
  function edit_agency(agency_id) {
    $(window).scrollTop(0);
    $("#agency-box").modal('show');
    $.ajax({
      url: "<?php echo site_url('agencies/edit') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'agency_id='+agency_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="agency_id"]').val(data.agency_id);
        $('input[name="agency_name"]').val(data.agency_name);
        $('input[name="agency_address"]').val(data.agency_address);
        $('input[name="agency_contact"]').val(data.agency_contact);
        $('input[name="agency_email"]').val(data.agency_email);
        $('input[name="agency_website"]').val(data.agency_website);
        $('textarea[name="agency_description"]').val(data.agency_description);
        console.log(data.billable);
        if(data.billable == 1)
        {
          $("#billable").switchButton({checked: true});
        }
        else
        {
          $("#billable").switchButton({checked: false});
        }
        // $("#billable").switchButton({checked: data.billable});
      }
    })
  }
  function update_Agency() {
    $.ajax({
      url: "<?php echo site_url('agencies/update') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#agency').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          $(window).scrollTop(0);
          $("#agency-message").fadeIn("slow");
          $('#agency-message').html(data.errors).addClass('alert alert-danger');
          setTimeout(function() {
              $('#agency-message').fadeOut('slow');
          }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#agency-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_agency(agency_id) {
    swal({
      title: 'Are you sure you want to delete?',
      text: "You cannot revert this action!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: 'btn btn-success btn-fix',
      cancelButtonClass: 'btn btn-default',
      animation: false,
      customClass: 'animated fadeInDown',
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        url: "<?php echo site_url('agencies/delete') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'agency_id='+agency_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#agency-message").fadeIn("slow");
              $('#agency-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#agency-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            swal({
              title: data.message,
              type: 'success',
              confirmButtonText: 'Okay',
              confirmButtonClass: 'btn btn-success btn-fix',
              buttonsStyling: false
            }).then(
              function () {
                window.location.reload();
              }
            )
          }
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Cancelled',
          type: 'error',
          confirmButtonText: 'Okay',
          confirmButtonClass: 'btn btn-default btn-fix',
          buttonsStyling: false,
          timer: 3000
        })
      }
    })
  }    
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF AGENCY BROWSE JAVASCRIPT
</script>