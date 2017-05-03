<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Upload Video Ad</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="ad-message"></div>
    <?php echo form_open_multipart('ads_mngt/saveAd', array('id'=>'ads')); ?>
      <div class="form-group">
        <label for="video_title">Title:</label>
        <input name="ad_name" type="text" class="form-control" id="video_title" placeholder="Title">
      </div>
      <div class="form-group">
        <input name="ad_duration" type="text" class="form-control hidden" id="video_duration">
      </div>
      <div class="form-group">
        <input name="video_filename" type="text" class="form-control hidden" id="video_filename">
      </div>
      <div id="material" class="hidden">
      </div>
      <div class="form-group">
        <div class="form-group">
          <label>Advertiser</label>
          <select name="advertiser_id" class="form-control">
            <?php 
              foreach($advertiser as $row)
              {
            ?>
              <option value= <?php echo $row[0];?> >
                <?php echo $row[1]; ?>
              </option>
            <?php 
              }
            ?>
          </select>
          <a class="btn btn-link pull-right" href="#">Add Advertisers</a>
        </div>
      </div>
      <div class="form-group">
        <input name="ad_file" id="ad_file" type="file" class="file">
        <div class="input-group col-xs-12">
          <span class="input-group-addon"><i class="glyphicon glyphicon-film"></i></span>
          <input type="text" class="form-control input-md" disabled placeholder="Upload Video">
          <input name="ad_filename" type="text" class="form-control input-md hidden">
          <span class="input-group-btn">
            <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="upload" id="upload" value="upload">Upload</button>
    <?php echo form_close(); ?>
  </div>
  <div class="box-footer">
  </div>
</div>
<script>
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
    $('#ads').on('submit', function(e){
      e.preventDefault();
      if($('#ad_file').val() == '')
      {
        $('#ad-message').html("The file upload cannot be empty!").addClass('alert alert-danger');
      }
      else
      {
        $.ajax({
          url: "<?php echo site_url('ads_mngt/saveAd') ?>",
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function()
          {
            $("#prog").show();
            $("#prog").attr('value','0');
          },
          uploadProgress: function(event,position,total,percentCompelete)
          {
            $("#prog").attr('value', percentCompelete);
          },
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $('#ad-message').html(data.errors).addClass('alert-danger');
              }
            }else {
              $('#material').html(data.message);
              setTimeout(function() {
                $.ajax({
                  url: "<?php echo site_url('ads_mngt/saveAdRecord') ?>",
                  type: 'POST',
                  dataType: 'json',
                  data: $('#ads').serialize(),
                  encode:true,
                  success:function(data) {
                    if(!data.success){
                      if(data.errors){
                        $('#ad-message').html(data.errors).addClass('alert alert-danger');
                      }
                    }else {
                      $('#ad-message').html(data.message).addClass('alert alert-success').removeClass('alert-danger');
                      setTimeout(function() {
                        window.location.reload()
                      }, 1500);
                    }
                  }
                })
              }, 500);
            }
          }
        });
      }
    });
  });

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF ADS JAVASCRIPT

</script>