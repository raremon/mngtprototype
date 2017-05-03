<div class="box box-success">
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
          <?php echo form_open_multipart('advertisers/saveAdvertiser', array('id'=>'advertiser')); ?>
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
              <label>Company Logo</label>
              <input name="image_file" id="image_file" type="file" class="file">
              <div class="input-group col-xs-12">
                <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                <input type="text" class="form-control input-md" disabled placeholder="Upload Image">
                <input name="advertiser_image" type="text" class="form-control input-md hidden">
                <span class="input-group-btn">
                  <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="advertiser_description" class="form-control" cols="30" rows="7" placeholder="Add Description"></textarea>
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
  //Placeholder Text
  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  //Placeholder Text End
  $(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  $(document).ready(function(){
    $('#advertiser').on('submit', function(e){
      e.preventDefault();
      if($('#image_file').val() == '')
      {
        $('#advertiser-message').html("The file upload cannot be empty!").addClass('alert alert-danger');
      }
      else
      {
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
    });
  });
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF ADVERTISER ADD JAVASCRIPT
</script>