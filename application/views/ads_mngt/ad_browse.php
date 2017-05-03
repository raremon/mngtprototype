<div id="mainBox" class="box box-success" style="display:none;">
  <div class="box-header with-border">
    <h3 class="box-title">Upload Video Ad</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="ad-message"></div>
    <?php echo form_open_multipart('ads_mngt/saveAd', array('id'=>'ads')); ?>
      <div class="form-group">
        <input name="ad_id" type="text" class="form-control hidden">
      </div>
      <div class="form-group">
        <label for="video_title">Title:</label>
        <input name="ad_name" type="text" class="form-control" id="video_title" placeholder="Title">
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
      <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Ad()">Update</button>
    <?php echo form_close(); ?>
  <div class="box-footer">
  </div>
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Advertisement Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="ad-message-2"></div>
          <table id="ad_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>ADVERTISER</th>
                <th>VIDEO</th>
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
  // R E A D
  $("#ad_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('ads_mngt/showAd') ?>",
      "type":"POST"
    },
    "columns": [
      null,
      null,
      null,
      null,
      {"width": "12%"},
    ]
  })
  // U P D A T E
  function edit_ad(ad_id) {
    $(window).scrollTop(0);
    $("#mainBox").show();
    $.ajax({
      url: "<?php echo site_url('ads_mngt/editAd') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'ad_id='+ad_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="ad_id"]').val(data.ad_id);
        $('input[name="ad_name"]').val(data.ad_name);
        $('select[name="advertiser_id"]').val(data.advertiser_id);
      }
    })
  }
  function update_Ad() {
    $.ajax({
      url: "<?php echo site_url('ads_mngt/updateAd') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#ads').serialize(),
      encode:true,
      success:function(data) {
        if(!data.success){
          $(window).scrollTop(0);
          $("#ad-message").fadeIn("slow");
          $('#ad-message').html(data.errors).addClass('alert alert-danger');
          setTimeout(function() {
              $('#ad-message').fadeOut('slow');
          }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_ad(ad_id) {
    if(confirm('Do you really want to delete this Ad Record ??')){
      $.ajax({
        url: "<?php echo site_url('ads_mngt/deleteAd') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'ad_id='+ad_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#ad-message").fadeIn("slow");
              $('#ad-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#ad-message').fadeOut('slow');
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
  ////////////////////////////////////////////////////////////////
  // E  N  D    O  F    C  R  U  D    F  U  N  C  T  I  O  N  S //
  ////////////////////////////////////////////////////////////////
  // END OF ADS BROWSE JAVASCRIPT
</script>