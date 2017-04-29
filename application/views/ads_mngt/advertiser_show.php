<div id="mainBox" class="box box-success" style="display:none;">
  <div class="box-header with-border">
    <h3 class="box-title">Advertiser Details</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="container-fluid">

        <div class="col-md-12">
          <div id="advertiser-message"></div>
          <?php echo form_open('welcome', array('id'=>'advertiser')); ?>
            <div class="form-group hidden">
              <input type="text" name="advertiser_id" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Advertiser Name</label>
              <input type="text" name="advertiser_name" class="form-control" placeholder="McDonalds"/>
            </div>
            <div class="form-group">
              <label>Advertiser Address</label>
              <input type="text" name="advertiser_address" class="form-control" placeholder="16th Floor Citibank Center Bldg. 8741 Paseo de Roxas St. ,Makati City"/>
            </div>
            <div class="form-group">
              <label>Advertiser Contact</label>
              <input type="text" name="advertiser_contact" class="form-control" placeholder="02-8635490"/>
            </div>
            <div class="form-group">
              <label>Advertiser Email</label>
              <input type="text" name="advertiser_email" class="form-control" placeholder="writeus@ph.mcd.com"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="advertiser_description" class="form-control" cols="30" rows="7" placeholder="Our Chairman and Founder, George T. Yang, built the first Golden Arches in the Philippines in 1981. From our first restaurant along Morayta in Manila, we are happy to welcome you in our 375 restaurants nationwide.

With Kenneth S. Yang as the President & CEO and with over 27,000 dedicated employees and crew members, we remain committed in growing and innovating products and services for you.

And with our Chief Happiness Officer, Ronald McDonald, we always aim to spread happiness to communities and to have fun with you guys!"></textarea>
            </div>
            <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Advertiser()">Update</button>
          <?php echo form_close(); ?>
        </div>

      </div> 
    </div>
  </div>
  <div class="box-footer">      
    </div><!-- box-footer -->
</div><!-- /.box -->

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Advertiser Data</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="advertiser-message-2"></div>
          <table id="advertiser_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>ADDRESS</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>DESCRIPTION</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>        
    </div>
 </div>
  <div class="box-footer">
  
  </div><!-- box-footer -->
</div><!-- /.box -->

<script type="text/javascript">

  ////////////////////////////////////////////////////////////////
  //          C  R  U  D    F  U  N  C  T  I  O  N  S           //
  ////////////////////////////////////////////////////////////////

  // R E A D
  $("#advertiser_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('advertisers/showAdvertiser') ?>",
      "type":"POST"
    },

    "columns": [
      null,
      null,
      null,
      null,
      null,
      null,
      null,
    ]
  })

  // U P D A T E
  function edit_advertiser(advertiser_id) {
    $("#mainBox").show();
    $.ajax({
      url: "<?php echo site_url('advertisers/editAdvertiser') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'advertiser_id='+advertiser_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="advertiser_id"]').val(data.advertiser_id);
        $('input[name="advertiser_name"]').val(data.advertiser_name);
        $('input[name="advertiser_address"]').val(data.advertiser_address);
        $('input[name="advertiser_contact"]').val(data.advertiser_contact);
        $('input[name="advertiser_email"]').val(data.advertiser_email);
        $('textarea[name="advertiser_description"]').val(data.advertiser_description);
      }
    })
  }

  function update_Advertiser() {
    $.ajax({
      url: "<?php echo site_url('advertisers/updateAdvertiser') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#advertiser').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          $('#advertiser-message').html(data.errors).addClass('alert alert-danger');
        }else {
          $('#advertiser-message').html(data.message).addClass('alert alert-success');
          setTimeout(function () {
            window.location.reload();
          }, 1000);
        }
      }
    })
  }

  // D E L E T E
  function delete_advertiser(advertiser_id) {
    if(confirm('Do you really want to delete this Advertiser Record ??')){
      $.ajax({
        url: "<?php echo site_url('advertisers/deleteAdvertiser') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'advertiser_id='+advertiser_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $('#advertiser-message-2').html(data.errors).addClass('alert alert-danger');
            }
          }else {
            $('#advertiser-message-2').html(data.message).addClass('alert alert-success');
            setTimeout(function() {
              window.location.reload();
            }, 1000);
          }
        }
      });
    }
  }

  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////

  // END OF BUS ADD JAVASCRIPT
</script>