<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">City Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="city-message"></div>
          <?php echo form_open('welcome', array('id'=>'city')); ?>
          <div class="form-group">
            <label>Region</label>
            <select name="region_id" class="form-control select2">
              <?php 
                foreach($region as $row)
                {
              ?>
                <option value= <?php echo $row[0];?> >
                  <?php echo $row[1]; ?>
                </option>
              <?php 
                }
              ?>
            </select>
            <a class="btn btn-link pull-right" href="<?php echo site_url('regions/add') ?>">Add Region</a>
          </div>
          <div class="form-group">
            <label>City Name</label>
            <input type="text" name="city_name" class="form-control" placeholder="Enter City Name"/>
          </div>
          <button type="button" class="btn btn-primary save" onclick="save_City()">Save</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // C R E A T E
  function save_City() {
    $.ajax({
      url: "<?php echo site_url('cities/saveCity') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#city').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          if(data.errors){
            $(window).scrollTop(0);
            $("#city-message").fadeIn("slow");
            $('#city-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#city-message').fadeOut('slow');
            }, 3000);
          }
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF REGION ADD JAVASCRIPT
</script>