<div class="box box-success hidden" id="form-box">
  <div class="box-header with-border">
    <h3 class="box-title">Route Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="route-message"></div>
          <?php echo form_open('welcome', array('id'=>'route')); ?>
            <div class="form-group hidden">
              <input type="text" name="route_id" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Region From</label>
              <select id="region_from" class="form-control">
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
              <label>City From</label>
              <select id="city_from" name="city_from" class="form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
            </div>
            <div class="form-group">
              <label>Region To</label>
              <select id="region_to" class="form-control">
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
              <label>City To</label>
              <select id="city_to" name="city_to" class="form-control">
              </select>
              <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
            </div>
            <div class="form-group">
              <label>Route Name</label>
              <input type="text" name="route_name" class="form-control" placeholder="Enter Route Name"/>
            </div>
            <div class="form-group">
              <label>Route Description</label>
              <textarea name="route_description" class="form-control" cols="30" rows="7" placeholder="Enter Route Description"></textarea>
            </div>
            <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Route()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Route Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="route-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="route_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ROUTE NAME</th>
                <th>ROUTE DESCRIPTION</th>
                <th>CITY FROM</th>
                <th>CITY TO</th>
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

  var cities = [];
  <?php 
    foreach($city as $row)
    {
  ?>
    cities.push([
      <?php echo $row[0]; ?>,
      "<?php echo $row[1]; ?>",
      <?php echo $row[2]; ?>,
    ]);
  <?php 
    }
  ?>

  var filtered_from = [];
  var filtered_to = [];

  $( document ).ready(function() {
    filter_from();
    filter_to();
    filter_to($("#city_from").val());
    filter_from($("#city_to").val());
  });

  function filter_from(selected_to) {
    filtered_from=[];
    for(var a = 0 ; a < cities.length ; a++)
    {
      if(cities[a][2] == $('#region_from').val())
      {
        if(cities[a][0] != selected_to)
        {
          filtered_from.push([
            cities[a][0],
            cities[a][1],
          ]);
        }
      }
      else
      {
      }
    }
    $('#city_from')
      .find('option')
      .remove()
      .end()
    ;
    if(filtered_from.length<1)
    {
      $('#city_from')
        .append('<option value=0>NO CITY ON THAT REGION</option>')
        .val(0)
      ;
    }
    else
    {
      $.each(filtered_from, function(key, value) {   
        $('#city_from')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  function filter_to(selected_from) {
    filtered_to=[];
    for(var a = 0 ; a < cities.length ; a++)
    {
      if(cities[a][2] == $('#region_to').val())
      {
        if(cities[a][0] != selected_from)
        {
          filtered_to.push([
            cities[a][0],
            cities[a][1],
          ]);
        }
      }
      else
      {
      }
    }
    $('#city_to')
      .find('option')
      .remove()
      .end()
    ;
    if(filtered_to.length<1)
    {
      $('#city_to')
        .append('<option value=0>NO CITY ON THAT REGION</option>')
        .val(0)
      ;
    }
    else
    {
      $.each(filtered_to, function(key, value) {   
        $('#city_to')
          .append($('<option>', { value : value[0] })
          .text(value[1])); 
      });
    }
  }

  $( "#region_from" ).change(function() {
    filter_from($("#city_to").val());
  });

  $( "#region_to" ).change(function() {
    filter_to($("#city_from").val());
  });

  $( "#city_from" ).change(function() {
    var city2 = $("#city_to").val();
    filter_to($("#city_from").val());
    $("#city_to").val(city2);
  });

  $( "#city_to" ).change(function() {
    var city1 = $("#city_from").val();
    filter_from($("#city_to").val());
    $("#city_from").val(city1);
  });

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////
  // O T H E R
  function closebox() {
    $('#form-box').addClass('hidden');
  }
  // R E A D
  $("#route_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('routes/showRoute') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_route(route_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('routes/editRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'route_id='+route_id,
      encode:true,
      success:function (data) {
        console.log(data[0]['region_to']);
        $('.update').removeAttr('disabled');
        $('input[name="route_id"]').val(data.route_id);
        $('input[name="route_name"]').val(data.route_name);
        $('textarea[name="route_description"]').val(data.route_description);
        $('select[id="region_from"]').val(data[0]['region_from']);
        $('select[id="region_to"]').val(data[0]['region_to']);
        $( "#region_from" ).change();
        $( "#region_to" ).change();
        $('select[name="city_to"]').val(data.city_to);
        $('select[name="city_from"]').val(data.city_from);
      }
    })
  }
  function update_Route() {
    $.ajax({
      url: "<?php echo site_url('routes/updateRoute') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#route').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#route-message").fadeIn("slow");
            $('#route-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#route-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_route(route_id) {
    if(confirm('Do you really want to delete this Route Record ??')){
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
          url: "<?php echo site_url('routes/delete_Route') ?>",
          type: 'POST',
          dataType: 'json',
          data: 'route_id='+route_id,
          encode:true,
          success:function(data) {
            if(!data.success){
              if(data.errors){
                $(window).scrollTop(0);
                $("#route-delete-message").fadeIn("slow");
                $('#route-delete-message').html(data.errors).addClass('alert alert-danger');
                setTimeout(function() {
                    $('#route-delete-message').fadeOut('slow');
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

  // END OF REGION ADD JAVASCRIPT
</script>