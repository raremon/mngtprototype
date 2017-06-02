<div class="modal fade" id="approve-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Media Details</h4>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
        <?php echo form_open('', array('id'=>'order')); ?>
          <div class="col-md-12">
            <div class="form-group" id="order-message"></div>            
          </div>
          <input type="text" class="form-control hidden" id="order_id" name="order_id">
          <div class="col-md-12">
            <div class="form-group">
            <label>Agency/Advertiser:</label>
            <input type="text" class="form-control" id="advertiser_id" readonly>
            </div>            
          </div>

          <div class="col-md-12">
            <input type="text" class="form-control hidden" id="deleted_route" name="deleted_route">
            <label>Routes:</label>
            <table id="route_id" class="table table-hover" width="100%">
              <thead>
                <tr>
                  <th>Route Name</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="col-md-12">
            <input type="text" class="form-control hidden" id="deleted_tslot" name="deleted_tslot">
            <label>Time Slots:</label>
            <table id="tslot_id" class="table table-hover" width="100%">
              <thead>
                <tr>
                  <th>Time Slot</th>
                  <th>Screen Size</th>
                  <th>Frequency</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="col-md-12">
             <div class="form-group">
             <label>Duration:</label>
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
               </div>
               <input name="date_reg" type="text" class="form-control pull-left" id="reservation" readonly>
             </div>
             </div> 
          </div>

          <div class="col-md-12">
            <input type="text" class="form-control hidden" id="ad_id" name="ad_id">
             <div class="form-group">
             <label>Select Ad:</label>
                <table id="advertisement_id" class="table table-hover" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Play</th>
                      <th>Ad Name</th>
                      <th>Video Length</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
             </div> 
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Ad Duration Ordered:</label>
            <input type="text" class="form-control" id="ad_duration" readonly>
            </div>            
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Sales Agent:</label>
            <input type="text" class="form-control" id="sales_id" readonly>
            </div>            
          </div>
        <?php echo form_close(); ?>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="approveOrder()">Approve Order</button>
        <button type="button" class="btn btn-danger" onclick="cancelOrder()">Cancel Order</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Process Ad Order</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div class="container-fluid">
      <div class="col-md-12">
        <label>List:</label>
        <table id="order_data" class="table table-hover" width="100%">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Advertiser</th>
              <th>Date Created</th>
              <th>Manage Order</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><button type="button" class="btn btn-success" onclick="openModal()">Manage Order</button></td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
  <div class="box-footer">
  </div>
</div>

<script>

  var route_deleted = [];
  var tslot_deleted = [];

  function openModal(order_id) {
    $('#approve-modal').modal('show');

    $.ajax({
      url: "<?php echo site_url('program/editOrders') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'order_id='+order_id,
      encode:true,
      success:function (data) {
        // $('.update').removeAttr('disabled');
        $('#order_id').val(data.order_id);

        $('#advertiser_id').val(data.advertiser_name);

        $('#route_id').dataTable().fnClearTable();
        $('#route_id').dataTable().fnAddData(data.route_id);
        route_deleted = [];
        $('#deleted_route').val('');

        $('#tslot_id').dataTable().fnClearTable();
        $('#tslot_id').dataTable().fnAddData(data.tslot_id);
        tslot_deleted = [];
        $('#deleted_tslot').val('');

        $('#reservation').val(data.dates);

        $('#ad_duration').val(data.ad_duration+" seconds");

        $('#sales_id').val(data.salesman);

        $('#advertisement_id').dataTable().fnClearTable();
        $('#advertisement_id').dataTable().fnAddData(data.advertisement_id);

        $('#ad_id').val('');
      }
    }) 

  }


  function deleteRoute(route_id) {
    if($('.routeDel:not(:disabled)').length > 1)
    {
      route_deleted.push(route_id);
      $('#route'+route_id).prop('disabled', true);
      $('#route'+route_id).text('Deleted');
      $('#deleted_route').val('');
      $('#deleted_route').val(JSON.stringify(route_deleted));
    }
    else
    {
      alert('LEAVE A ROUTE');
    }
  }

  function deleteSlot(tslot_id) {
    if($('.slotDel:not(:disabled)').length > 1)
    {
      tslot_deleted.push(tslot_id);
      $('#tslot'+tslot_id).prop('disabled', true);
      $('#tslot'+tslot_id).text('Deleted');
      $('#deleted_tslot').val('');
      $('#deleted_tslot').val(JSON.stringify(tslot_deleted));
    }
    else
    {
      alert('LEAVE A TIMESLOT');
    }
  }

  function selectAd(ad_id) {
    $('.selectAd').prop('disabled', true);
    $('#ad'+ad_id).text('Selected');
    $('#ad_id').val('');
    $('#ad_id').val(ad_id);
  }

  // R E A D
  $("#order_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showOrders') ?>",
      "type":"POST"
    }
  })

  function approveOrder() {
    $.ajax({
      url: "<?php echo site_url('program/approveOrder') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#order').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $('.modal').scrollTop(0);
            $("#order-message").fadeIn("slow");
            $('#order-message').html(data.errors).addClass('alert alert-danger');
            setTimeout(function() {
                $('#order-message').fadeOut('slow');
            }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#approve-modal').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }

  function cancelOrder() {
    $.ajax({
      url: "<?php echo site_url('program/cancelOrder') ?>",
      type: 'POST',
      dataType: 'json',
      data: $('#order').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
            $(window).scrollTop(0);
            // $("#user-message").fadeIn("slow");
            // $('#user-message').html(data.errors).addClass('alert alert-danger');
            // setTimeout(function() {
            //     $('#user-message').fadeOut('slow');
            // }, 3000);
        }else {
          $('#message-text').html(data.message);
          $('#approve-modal').modal('hide');
          $('#successModal').modal('show');
        }
      }
    })
  }

</script>