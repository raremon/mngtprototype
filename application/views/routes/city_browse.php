<div class="box box-success hidden" id="form-box">
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
          <div class="form-group hidden">
            <input type="text" name="city_id" class="form-control"/>
          </div>
          <div class="form-group">
            <label>Region</label>
            <select name="region_id" class="form-control">
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
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_City()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">City Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="city-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="city_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>CITY NAME</th>
                <th>REGION NAME</th>
                <th>DATE CREATED</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
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
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#city_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('cities/showCity') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_city(city_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('cities/editCity') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'city_id='+city_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="city_id"]').val(data.city_id);
        $('input[name="city_name"]').val(data.city_name);
        $('select[name="region_id"]').val(data.region_id);
      }
    })
  }
  function update_City() {
    $.ajax({
      url: "<?php echo site_url('cities/updateCity') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#city').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#city-message").fadeIn("slow");
            $('#city-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#city-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_city(city_id) {
    if(confirm('Do you really want to delete this City Record ??')){
      // DITO ILALAGAY YUNG CONDITION NA PAG MAY BUS PANG NAKAASSIGN DUN SA DRIVER, YUN MUNA YUNG IDIDELETE MO
      if(false)
      {
        // $(window).scrollTop(0);
        // $("#user-delete-message").fadeIn("slow");
        // $('#user-delete-message').html("Cannot delete your own account!").addClass('alert alert-danger');
        // setTimeout(function() {
        //     $('#user-delete-message').fadeOut('slow');
        // }, 3000);
      }
      else
      {
        $.ajax({
          url: "<?php echo site_url('cities/delete_City') ?>",
          type: 'POST',
          dataType: 'json',
          data: 'city_id='+city_id,
          encode:true,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#city-delete-message").fadeIn("slow");
                $('#city-delete-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#city-delete-message').fadeOut('slow');
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
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF CITY BROWSE JAVASCRIPT
</script>