<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Upload Fillers</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="filler-message"></div>
    <?php echo form_open_multipart('fillers/saveFiller', array('id'=>'filler')); ?>
      <div class="form-group">
        <label for="video_title">Title:</label>
        <input name="filler_title" type="text" class="form-control" id="video_title" placeholder="Title">
      </div>
      <div class="form-group">
        <label>Description:</label>
        <textarea name="filler_description" class="form-control" cols="30" rows="7" placeholder="Description"></textarea>
      </div>
      <div class="form-group">
        <input name="filler_duration" type="text" class="form-control hidden" id="video_duration">
      </div>
      <div class="form-group">
        <input name="video_filename" type="text" class="form-control hidden" id="video_filename">
      </div>
      <div id="material" class="hidden">
      </div>
      <div class="form-group">
        <input name="filler_file" id="filler_file" type="file" class="file">
        <div class="input-group col-xs-12">
          <span class="input-group-addon"><i class="glyphicon glyphicon-film"></i></span>
          <input type="text" class="form-control input-md" disabled placeholder="Upload Video">
          <input name="filler_filename" type="text" class="form-control input-md hidden">
          <span class="input-group-btn">
            <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
          </span>
        </div>
        <!-- TAGGING PAUL -->
        <img id="loading_img" src="<?php echo base_url('assets/public/loading.gif') ?>" class="hidden">
      </div>
      
      <button type="submit" class="btn btn-primary" name="upload" id="upload" value="upload">Upload</button>
    <?php echo form_close(); ?>
  </div>
  <div class="box-footer">
  </div>
</div>
<script>
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
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
    $('#filler').on('submit', function(e){
      e.preventDefault();
      if($('#filler_file').val() == '')
      {
        $(window).scrollTop(0);
        $("#filler-message").fadeIn("slow");
        $('#filler-message').html("The file upload cannot be empty!").addClass('alert alert-danger');
        setTimeout(function() {
            $('#filler-message').fadeOut('slow');
        }, 3000);
      }
      else
      {
        $('#loading_img').removeClass('hidden');
        $.ajax({
          url: "<?php echo site_url('fillers/saveFiller') ?>",
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
                $(window).scrollTop(0);
                $("#filler-message").fadeIn("slow");
                $('#filler-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#filler-message').fadeOut('slow');
                }, 3000);
              }
            }else {
              $("#material").html(data.message);
            }
          }
        });
      }
    });
  });
  function save() {
    $.ajax({
      url: "<?php echo site_url('fillers/saveFill') ?>",
      type: "POST",
      dataType: "json",
      data: $("#filler").serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#filler-message").fadeIn("slow");
            $('#filler-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#filler-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#loading_img').addClass('hidden');
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF FILLER JAVASCRIPT
</script>