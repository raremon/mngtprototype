<div class="box box-success hidden" id="form-box">
  <div class="box-header with-border">
    <h3 class="box-title">TV Details</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
      <div class="container-fluid">
        <div class="col-md-12">
          <div id="tv-message"></div>
          <?php echo form_open('welcome', array('id'=>'tv')); ?>
          <div class="form-group">
            <input type="text" name="tv_id" class="form-control hidden"/>
          </div>
          <div class="form-group">
            <label>TV Serial</label>
            <input type="text" name="tv_serial" class="form-control" placeholder="Enter Television's Serial"/>
          </div>
          <div class="form-group">
            <label>TV Description</label>
            <textarea name="tv_description" class="form-control" cols="30" rows="7" placeholder="Enter Television's Description"></textarea>
          </div>
          <button type="button" class="btn btn-success update" disabled="disabled" onclick="update_Tv()">Update</button>
          <?php echo form_close(); ?>
        </div>
      </div> 
  </div>
  <div class="box-footer">
  </div>
</div>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Tv Data</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="tv-delete-message"></div>
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-12">
          <table id="tv_data" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>TV SERIAL</th>
                <th>TV DESCRIPTION</th>
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
  $("#tv_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('tvs/showTv') ?>",
      "type":"POST"
    }
  })
  // U P D A T E
  function edit_tv(tv_id) {
    $('#form-box').removeClass('hidden');
    $.ajax({
      url: "<?php echo site_url('tvs/editTv') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'tv_id='+tv_id,
      encode:true,
      success:function (data) {
        $('.update').removeAttr('disabled');
        $('input[name="tv_id"]').val(data.tv_id);
        $('input[name="tv_serial"]').val(data.tv_serial);
        $('textarea[name="tv_description"]').val(data.tv_description);
      }
    })
  }
  function update_Tv() {
    $.ajax({
      url: "<?php echo site_url('tvs/updateTv') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#tv').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            $("#tv-message").fadeIn("slow");
            $('#tv-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#tv-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#successModal').modal('show');
        }
      }
    })
  }
  // D E L E T E
  function delete_tv(tv_id) {
    if(confirm('Do you really want to delete this Tv Record ??')){
      $.ajax({
        url: "<?php echo site_url('tvs/delete_Tv/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+tv_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#tv-delete-message").fadeIn("slow");
              $('#tv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#tv-delete-message').fadeOut('slow');
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
  // U N A S S I G N
  function unassign_tv(tv_id) {
    if(confirm('Do you really want to unassign this Tv Record ??')){
      $.ajax({
        url: "<?php echo site_url('tvs/unassign_Tv/') ?>",
        type: 'POST',
        dataType: 'json',
        data: 'tv_id='+tv_id,
        encode:true,
        success:function(data) {
          if(!data.success){
            if(data.errors){
              $(window).scrollTop(0);
              $("#tv-delete-message").fadeIn("slow");
              $('#tv-delete-message').html(data.errors).addClass('alert alert-danger');
              setTimeout(function() {
                  $('#tv-delete-message').fadeOut('slow');
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
  // END OF TV BROWSE JAVASCRIPT
</script>