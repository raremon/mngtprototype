<div class="box box-success">
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
            <button type="button" class="btn btn-primary save" onclick="save_Route()">Save</button>
          <?php echo form_close(); ?>
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
  // C R E A T E
  function save_Route() {
    if($("#city_to").val() == 0 || $("#city_from").val() == 0)
    {
      $(window).scrollTop(0);
      $("#route-message").fadeIn("slow");
      $('#route-message').html("Please select a valid city").addClass('alert alert-danger');
      setTimeout(function() {
          $('#route-message').fadeOut('slow');
      }, 3000);
    }
    else
    {
      $.ajax({
        url: "<?php echo site_url('routes/saveRoute') ?>",
        type: 'POST',
        dataType: 'json',
        data: $('#route').serialize(),
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#route-message").fadeIn("slow");
              $('#route-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#route-message').fadeOut('slow');
              }, 3000);
            }
          }else {
            $('#message-text').html(data.message);
            $('#successModal').modal('show');
          }
        }
      })
    }
  }
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF REGION ADD JAVASCRIPT
</script>