<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
      <small><?php echo $page_description; ?></small>
    </h1>
    <ol class="breadcrumb">
      <i class="fa fa-plus-square"></i>&nbsp;
      <?php foreach($breadcrumbs as $row) { ?>
        <li><a href="<?php echo base_url($row[1]) ?>"><?php echo $row[0]; ?></a></li>
      <?php } ?>
      <li class="active">Here</li>
    </ol>
  </section>
    
  <section class="content">

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
                 <div class="form-group">
                  <label for="route_list">Select Ad Owner:</label>
                  <select class="form-control select2" id="route_list">
                    <option>Mcdonalds PH</option>
                    <option>Mang Inasal</option>
                    <option>Unilever</option>
                    <option>YKK Zipper</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Duration:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-left" id="reservation">
                  </div>
                </div>
                <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Airing Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control" id="timepicker">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
                <div class="form-group">
                    <label>Select Days:</label><br/> 
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Monday">&nbsp;Monday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Tuesday">&nbsp;Tuesday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Wednesday">&nbsp;Wednesday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Thursday">&nbsp;Thursday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Friday">&nbsp;Friday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Saturday">&nbsp;Saturday
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="minimal" name="days_checked[]" value="Sunday">&nbsp;Sunday
                    </label>
                </div>                
                 <div class="form-group">
                  <label for="route_list">Select Route:</label>
                  <select class="form-control select2" id="route_list">
                    <option>Manila-Tagaytay</option>
                    <option>Batangas-Manila</option>
                    <option>Pasay-Fairview</option>
                    <option>Buendia-North Edsa</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
              </form>
          </form>

      </div><!-- /.box-body -->
      <div class="box-footer">

      </div><!-- box-footer -->
    </div><!-- /.box -->
      
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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