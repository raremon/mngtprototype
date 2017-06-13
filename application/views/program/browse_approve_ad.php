<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJAq_K8XorLcD2nKKsrmB7BserF3Wh3Ss&libraries=places" type="text/javascript"></script>

<div class="modal fade" id="advertiser" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertiser Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4 col-md-offset-1" id="advertiser_image">
                </div>
                <div class="col-md-6 col-md-offset-1">
                  <h1 class="text-center" id="advertiser_name"></h1>
                  <h4 class="text-right" id="advertiser_address"></h4>  
                  <h4 class="text-right" id="advertiser_contact"></h4>  
                  <h4 class="text-right" id="advertiser_email"></h4>  
                  <h4 class="text-right" id="advertiser_website"></h4>  
                </div>
              </div>
              <br/>
              <br/>
              <div class="row">
                <div class="col-md-12" id="advertiser_description">
                </div>
              </div>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="advertisement" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertisement Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-7" id="ad_filename">
                </div>
                <div class="col-md-5">
                  <h1 class="text-center" id="ad_name"></h1>
                  <h3 class="text-right" id="ad_duration"></h3>
                </div>
              </div>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="more_data" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <table id="route_id" class="table table-hover" width="100%">
                  <thead>
                    <tr>
                      <th>Route Name</th>
                      <th>Route Description</th>
                      <th>Location</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table id="tslot_id" class="table table-hover" width="100%">
                  <thead>
                    <tr>
                      <th>Timeslot</th>
                      <th>Screen Size</th>
                      <th>Frequency</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3 id="salesman"></h3>
              </div>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="approve-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?php echo form_open_multipart('', array('id'=>'order')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Media Details</h4>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="form-group" id="order-message"></div>            
          </div>
          <input type="text" class="form-control hidden" id="pending_order_id" name="order_id">
          <div class="col-md-12">
            <div class="form-group">
            <label>Agency/Advertiser:</label>
            <input type="text" class="form-control" id="pending_advertiser_id" readonly>
            </div>            
          </div>

          <div class="col-md-12">
            <input type="text" class="form-control hidden" id="deleted_route" name="deleted_route">
            <label>Routes:</label>
            <table id="pending_route_id" class="table table-hover" width="100%">
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
            <table id="pending_tslot_id" class="table table-hover" width="100%">
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
            <input type="text" class="form-control hidden" id="pending_ad_id" name="ad_id">
             <div class="form-group">
             <label>Select Ad:</label>
                <table id="pending_advertisement_id" class="table table-hover" width="100%">
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
            <div class="form-group">
                <label>Select Filler Image:</label>
                  <div class="image-editor">
                    <label for="browsebutton" class="browselabel">Browse your image.</label>
                    <input type="file" name="filler_image" id="browsebutton" class="cropit-image-input">
                    <div class="cropit-preview"></div>
                    <div class="image-size-label" style="font-size: 24px;">
                            s &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp; B
                    </div>
                    <input type="range" id="slider" class="cropit-image-zoom-input">
                    <button class="rotate-ccw" id="rotatebutton">&olarr;</button>
                    <button class="rotate-cw" id="rotatebutton2">&orarr;</button>
                    <input type="hidden" name="image-data" class="hidden-image-data" />
                </div>
            </div>
          <div class="col-md-12">
            <div class="form-group">
            <label>Ad Duration Ordered:</label>
            <input type="text" class="form-control" id="pending_ad_duration" readonly>
            </div>            
          </div>

          <div class="col-md-12">
            <div class="form-group">
            <label>Sales Agent:</label>
            <input type="text" class="form-control" id="pending_sales_id" readonly>
            </div>            
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Approve Order</button>
        <button type="button" class="btn btn-danger" onclick="cancelOrder()">Cancel Order</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Ad Order List</h3>
    <div class="box-tools pull-right">
        <a class="btn btn-link add-link" href="<?php echo base_url('salesman/schedules') ?>"><i class="fa fa-plus-square-o">&nbsp;</i>New Order</a>
    </div>
  </div>
  <div class="box-body">
    <div class="nav-tabs-custom tab-success">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#advertiser_tab_0" data-toggle="tab">Pending Orders</a></li>
        <li><a href="#advertiser_tab_1" data-toggle="tab">Approved Orders</a></li>
        <li><a href="#advertiser_tab_2" data-toggle="tab">Cancelled Orders</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="advertiser_tab_0">
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
          </div>
        </div>

        <div class="tab-pane" id="advertiser_tab_1">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Approved Ad Order List</h3>
              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="approved" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Advertiser</th>
                        <th>Ad Title</th>
                        <th>Ad Duration</th>
                        <th>Air Dates</th>
                        <th>Date Ordered</th>
                        <th>Date Approved</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </div>
          </div>
        </div>
                      
        <div class="tab-pane" id="advertiser_tab_2">  
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Cancelled Ad Order List</h3>
              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
              <div class="container-fluid">
                <div class="col-md-12">
                  <table id="cancelled" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Advertiser</th>
                        <th>Ad Duration</th>
                        <th>Air Dates</th>
                        <th>Date Ordered</th>
                        <th>Date Cancelled</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
    </div>
  </div>
</div>

<script>
  $('.image-editor').cropit();
  $('body').on('hidden.bs.modal', '.modal', function () {
  $('video').trigger('pause');
  });
  // R E A D
  $("#approved").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showApprovedOrders') ?>",
      "type":"POST"
    }
  })
  $("#cancelled").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showCancelledOrders') ?>",
      "type":"POST"
    }
  })

  $("#route_id").DataTable({
  })
  $("#tslot_id").DataTable({
  })

  function getAdvertiserData(id) {
    $('#advertiser').modal('show');
    $.ajax({
      url: "<?php echo site_url('advertisers/editAdvertiser') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'advertiser_id='+id,
      encode:true,
      success:function (data) {
        var companyLogo = '<?php echo base_url('assets/company_logo/') ?>'+data.advertiser_image;
        $('#advertiser_image').html('<img class="img img-circle img-responsive" src="'+companyLogo+'" alt="'+data.advertiser_name+'">');
        $('#advertiser_name').html(data.advertiser_name);
        $('#advertiser_address').html(data.advertiser_address+'&nbsp;&nbsp;<span class="fa fa-map-marker"></span>');
        $('#advertiser_contact').html(data.advertiser_contact+'&nbsp;&nbsp;<span class="fa fa-phone"></span>');
        $('#advertiser_email').html(data.advertiser_email+'&nbsp;&nbsp;<span class="fa fa-envelope"></span>');
        $('#advertiser_website').html(data.advertiser_website+'&nbsp;&nbsp;<span class="fa fa-globe"></span>');
        $('#advertiser_website').html('<a href="'+data.advertiser_website+'" target="_blank">'+data.advertiser_website+'&nbsp;&nbsp;<span class="fa fa-globe"></span></a>');
        $('#advertiser_description').html('<p class="">&nbsp;&nbsp&nbsp&nbsp&nbsp'+data.advertiser_description+'</p>');
      }
    })
  }

  function getAdvertisementData(id) {
    $("#advertisement").modal('show');
    $.ajax({
      url: "<?php echo site_url('ads_mngt/editAd') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'ad_id='+id,
      encode:true,
      success:function (data) {
        var adFilename = '<?php echo base_url('assets/ads/') ?>'+data.ad_filename;
        $('#ad_filename').html('<video width="100%" controls><source src="'+adFilename+'" type="video/mp4">Your browser does not support HTML4 video.</video>');
        $('#ad_name').html(data.ad_name);
        $('#ad_duration').html(data.ad_duration+' seconds&nbsp;&nbsp;<span class="fa fa-clock-o"></span>');
      }
    })
  }

  function seeMore(id) {
    $("#more_data").modal('show');

    $.ajax({
      url: "<?php echo site_url('program/seeMore') ?>",
      type: 'POST',
      dataType: 'json',
      data: 'order_id='+id,
      encode:true,
      success:function (data) {
        console.log(data);
        $('#route_id').dataTable().fnClearTable();
        $('#route_id').dataTable().fnAddData(data.route_data);
        $('#tslot_id').dataTable().fnClearTable();
        $('#tslot_id').dataTable().fnAddData(data.tslot_data);
        $('#salesman').html('Salesman : '+data.salesman_data);
        // var adFilename = '<?php echo base_url('assets/ads/') ?>'+data.ad_filename;
        // $('#ad_filename').html('<video width="100%" controls><source src="'+adFilename+'" type="video/mp4">Your browser does not support HTML4 video.</video>');
        // $('#ad_name').html(data.ad_name);
        // $('#ad_duration').html(data.ad_duration+' seconds&nbsp;&nbsp;<span class="fa fa-clock-o"></span>');
      }
    })

  }
    // new-ad-order

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
        $('#pending_order_id').val(data.order_id);

        $('#pending_advertiser_id').val(data.advertiser_name);

        $('#pending_route_id').dataTable().fnClearTable();
        $('#pending_route_id').dataTable().fnAddData(data.route_id);
        route_deleted = [];
        $('#deleted_route').val('');

        $('#pending_tslot_id').dataTable().fnClearTable();
        $('#pending_tslot_id').dataTable().fnAddData(data.tslot_id);
        tslot_deleted = [];
        $('#deleted_tslot').val('');

        $('#reservation').val(data.dates);

        $('#pending_ad_duration').val(data.ad_duration+" seconds");

        $('#pending_sales_id').val(data.salesman);

        $('#pending_advertisement_id').dataTable().fnClearTable();
        $('#pending_advertisement_id').dataTable().fnAddData(data.advertisement_id);

        $('#pending_ad_id').val('');
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
    $('#pending_ad_id').val('');
    $('#pending_ad_id').val(ad_id);
  }

  // R E A D
  $("#order_data").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showOrders') ?>",
      "type":"POST"
    }
  })

  // function approveOrder() {
  //   $.ajax({
  //     url: "<?php echo site_url('program/approveOrder') ?>",
  //     type: 'POST',
  //     dataType: 'json',
  //     data: $('#order').serialize(),
  //     encode:true,
  //     success:function (data) {
  //       if(!data.success){
  //           $('.modal').scrollTop(0);
  //           $("#order-message").fadeIn("slow");
  //           $('#order-message').html(data.errors).addClass('alert alert-danger');
  //           setTimeout(function() {
  //               $('#order-message').fadeOut('slow');
  //           }, 3000);
  //       }else {
  //         $('#message-text').html(data.message);
  //         $('#approve-modal').modal('hide');
  //         $('#successModal').modal('show');
  //       }
  //     }
  //   })
  // }

  $(document).ready(function(){
    $('#order').on('submit', function(e){
      e.preventDefault();

      $.ajax({
        url: "<?php echo site_url('program/approveOrder') ?>",
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success:function(data) {
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
      });

    });
  });

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

  $(document).on('hidden.bs.modal', function (event) {
    $('video').trigger('pause');
    if ($('.modal:visible').length) {
      $('body').addClass('modal-open');
    }
  });
</script>