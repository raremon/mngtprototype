<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Upload Video Ad</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
      <form role="form">
        <div class="form-group">
          <label for="video_title">Title:</label>
          <input type="text" class="form-control" id="video_title" placeholder="Title">
        </div>
        <div class="form-group">
          <input type="file" name="#" class="file">
          <div class="input-group col-xs-12">
            <span class="input-group-addon"><i class="glyphicon glyphicon-film"></i></span>
            <input type="text" class="form-control input-md" disabled placeholder="Upload Video">
            <span class="input-group-btn">
              <button class="browse btn btn-success input-md" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
            </span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
      </form>
  </div><!-- /.box-body -->
  <div class="box-footer">
  </div><!-- box-footer -->
</div><!-- /.box -->

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
</script>