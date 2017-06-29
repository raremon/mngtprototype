<div class="modal fade" id="advertiser-image" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" id="advertiser-img" style='border-radius: 50%; width: 600px; height: 600px; border: 15px solid #339440;'>
    </div>
  </div>
</div>
<div class="modal fade" id="advertiser-add" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open_multipart('advertisers/saveAdvertiser', array('id'=>'advertiser-add-form')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertiser Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="advertiser-message-add"></div>
                <div class="form-group">
                  <label>Agency</label>
                  <select name="agency_id-add" class="form-control select2">
                    <?php 
                      foreach($agency as $row)
                      {
                    ?>
                      <option value= <?php echo $row[0];?> >
                        <?php echo $row[1]; ?>
                      </option>
                    <?php 
                      }
                    ?>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('agencies/browse') ?>">Browse Agencies</a>
                </div>
                <div class="form-group">
                  <label>Advertiser Name</label>
                  <input type="text" name="advertiser_name-add" class="form-control" placeholder="Enter Name"/>
                </div>
                <div class="form-group">
                  <label>Company Address</label>
                  <input type="text" name="advertiser_address-add" class="form-control" placeholder="Enter Address"/>
                </div>
                <div class="form-group">
                  <label>Contact Information</label>
                  <input type="text" name="advertiser_contact-add" class="form-control" placeholder="Enter Contact Information"/>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" name="advertiser_email-add" class="form-control" placeholder="Enter Email Address"/>
                </div>
                <div class="form-group">
                  <label>Company Website</label>
                  <input type="text" name="advertiser_website-add" class="form-control" placeholder="Enter Company Website"/>
                </div>
                <div class="form-group">
                  <label>Company Logo</label>
                  <input name="image_file" id="image_file" type="file" class="file">
                  <div class="input-group col-xs-12">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                    <input type="text" class="form-control input-md" disabled placeholder="Upload Image">
                    <input name="advertiser_image-add" type="text" class="form-control input-md hidden">
                    <span class="input-group-btn">
                      <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                    </span>
                  </div>
                  <img id="loading_img" src="<?php echo base_url('assets/public/loading.gif') ?>" class="hidden">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="advertiser_description-add" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
                </div>
            </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="modal fade" id="advertiser-box" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertiser Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <div id="advertiser-message"></div>
              <?php echo form_open('welcome', array('id'=>'advertiser')); ?>
                <div class="form-group hidden">
                  <input type="text" name="advertiser_id" class="form-control"/>
                </div>
                <div class="form-group">
                  <label>Agency</label>
                  <select name="agency_id" class="form-control select2">
                    <?php 
                      foreach($agency as $row)
                      {
                    ?>
                      <option value= <?php echo $row[0];?> >
                        <?php echo $row[1]; ?>
                      </option>
                    <?php 
                      }
                    ?>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('agencies/browse') ?>">Browse Agencies</a>
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
              <?php echo form_close(); ?>
            </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Advertiser()">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ad-list" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertisements List</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-md-12">
              <table id="advertiser_ads" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>AD DURATION</th>
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
    <h3 class="box-title">Advertiser Data</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-link add-link" href="javascript:void(0);" data-toggle="modal" data-target="#advertiser-add"><i class="fa fa-plus-square-o">&nbsp;</i>New Advertiser</a>
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
                <th>NO. OF ADS</th>
                <!--<th>COMPANY ADDRESS</th>-->
                <th>CONTACT DETAILS</th>
                <th>EMAIL ADDRESS</th>
                <!--<th>COMPANY WEBSITE</th>
                <th>AGENCY</th>
                <th>DESCRIPTION</th>-->
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
  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  $(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  $(document).ready(function(){
    $('#advertiser-add-form').on('submit', function(e){
      e.preventDefault();
      if($('#image_file').val() == '')
      {
        $('#advertiser-message-add').html("The file upload cannot be empty!").addClass('alert alert-danger');
      }
      else
      {
        $('#loading_img').removeClass('hidden');
        $.ajax({
          url: "<?php echo site_url('advertisers/saveAdvertiser') ?>",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#advertiser-message-add").fadeIn("slow");
                $('#advertiser-message-add').html(data.errors).addClass('alert alert-danger');
                $('#loading_img').addClass('hidden');
                setTimeout(function() {
                    $('#advertiser-message-add').fadeOut('slow');
                }, 3000);
              }
            }else {
              $('#loading_img').addClass('hidden');
              $('#message-text').html(data.message);
              $('#advertiser-add').modal('hide');
              $('#successModal').modal('show');
            }
          }
        });
      }
    });
  });
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
    ]
  })
  $("#advertiser_ads").DataTable({
    "paging":   false,
    "bFilter": false,
  });
  function show_image(image) {
    var advertiserimg = "<?php echo base_url('assets/company_logo/'); ?>" + image;
    $(window).scrollTop(0);
    $("#advertiser-image").modal('show');
    $("#advertiser-img").html("<img src='"+advertiserimg+"' class='img img-circle' style='border-radius: 50%; width: 580px; height: 580px; margin: -5px;'>");
  }
  function see_ad(ad_id) {
    $(window).scrollTop(0);
    $("#ad-list").modal('show');
    $.get("<?php echo site_url('advertisers/getAds/"+ad_id+"') ?>", function(data){
      var basic = $.map(data, function(el) { return el; });
      $("#advertiser_ads").dataTable().fnClearTable();
      if(basic.length > 0)
      {
        $("#advertiser_ads").dataTable().fnAddData(basic);
      }
    });
  }
  function edit_advertiser(advertiser_id) {
    $(window).scrollTop(0);
    $("#advertiser-box").modal('show');
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
        $('select[name="agency_id"]').val(data.agency_id);
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
          $('#advertiser-box').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }
  function delete_advertiser(advertiser_id) {
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
  // END OF BUS ADD JAVASCRIPT
</script>