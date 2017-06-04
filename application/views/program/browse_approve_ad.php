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

<script>
  // R E A D
  $("#approved").DataTable({
    "ajax":{
      "url":"<?php echo site_url('program/showApprovedOrders') ?>",
      "type":"POST"
    }
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
</script>