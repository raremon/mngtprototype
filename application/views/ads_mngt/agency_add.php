<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Agency Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="agency-message"></div>
          <?php echo form_open_multipart('agencies/save', array('id'=>'agency')); ?>
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
              <label>Company Logo</label>
              <input name="agency_file" id="agency_file" type="file" class="file">
              <div class="input-group col-xs-12">
                <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                <input type="text" class="form-control input-md" disabled placeholder="Upload Image">
                <input name="agency_image" type="text" class="form-control input-md hidden">
                <span class="input-group-btn">
                  <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                </span>
              </div>
              <!-- TAGGING PAUL -->
              <img id="loading_img" src="<?php echo base_url('assets/public/loading.gif') ?>" class="hidden">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="agency_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
            </div>
            <div class="form-group">
              <label>Billable</label>
              <input type="text" name="billable" class="hidden" readonly>
              <div class="switch-wrapper">
                <input id="billable" type="checkbox" checked>
              </div>
            </div>
            <button type="submit" class="btn btn-primary save">Save</button>
          <?php echo form_close(); ?>
        </div>
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
    $('#agency').on('submit', function(e){
      e.preventDefault();
      if($('#agency_file').val() == '')
      {
        $('#agency-message').html("Please Upload your Company Logo!").addClass('alert alert-danger');
      }
      else
      {
        $('#loading_img').removeClass('hidden');
        $.ajax({
          url: "<?php echo site_url('agencies/save') ?>",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
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
              $('#loading_img').addClass('hidden');
              $('#message-text').html(data.message);
              $('#successModal').modal('show');
            }
          }
        });
      }
    });
  });

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

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF AGENCY ADD JAVASCRIPT
</script>