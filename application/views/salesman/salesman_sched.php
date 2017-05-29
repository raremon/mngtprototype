<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
    <div id="sched_wizard">
        <h3>Select Region<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                <label>Region</label>
                <select name="region_id" class="form-control select2" style="width:100%;">
                  <option>ALL</option>
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
            </form>
        </section>
        <h3>Select City/Province<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                <label>Selected Region</label>
                <select name="region_id" class="form-control select2" style="width:100%;">
                  <option>All</option>
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
                  <label>City/Province</label>
                  <select id="#" name="#" class="form-control select2" style="width:100%;">
                  <option>All</option>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
                </div>         
            </form>
        </section>
        <h3>Select Route<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
            <form>
                <div class="form-group">
                <label>Selected Region</label>
                <select name="region_id" class="form-control select2" style="width:100%;">
                  <option>All</option>
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
                  <label>Selected City/Province</label>
                  <select id="#" name="#" class="form-control select2" style="width:100%;">
                  <option>All</option>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('cities/add') ?>">Add City</a>
                </div> 
                <div class="form-group">
                  <label>Route</label>
                  <select id="#" name="#" class="form-control select2" style="width:100%;">
                  <option>All</option>
                  </select>
                  <a class="btn btn-link pull-right" href="<?php echo site_url('routes/add') ?>">Add Routes</a>
                </div>          
            </form>
        </section>
        <h3>Select Schedule<i class="fa fa-angle-double-right" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
         <form>
          <div class="container-fluid">
            <div class="col-md-12">
               <div class="form-group">
               <label>Select Duration:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input name="date_reg" type="text" class="form-control pull-left" id="reservation">
               </div>
               </div>     
            </div>
            <div class="col-md-12">
               <label>Select Timeslot:</label>
               <div class="form-group text-center">
                </br>
                <label>
                  <input id="all-timeslot-box" type="checkbox" class="flat">
                  All Timeslots
                </label>
               </div>  
            </div>    
            <div class="col-md-4">
                  <table id="morning-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-morning-box" type="checkbox" class="flat-grey">Morning</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>4:00 AM - 5:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>5:00 AM - 6:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>6:00 AM - 7:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>7:00 AM - 8:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>8:00 AM - 9:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>9:00 AM - 10:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>10:00 AM - 11:00 AM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat morning-box"></td>
                        <td>11:00 AM - 12:00 NN</td>
                        <td>100%</td>
                      </tr>
                    </tbody>
                  </table>
            </div>  
            <div class="col-md-4">
                  <table id="afternoon-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-afternoon-box" type="checkbox" class="flat-grey">Afternoon</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>12:00 NN - 1:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>1:00 PM - 2:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>2:00 PM - 3:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>3:00 PM - 4:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>4:00 PM - 5:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat afternoon-box"></td>
                        <td>5:00 PM - 6:00 PM</td>
                        <td>100%</td>
                      </tr>
                    </tbody>
                  </table>
            </div>  
            <div class="col-md-4">
                  <table id="afternoon-table" class="table table-hover" width="100%">
                    <thead>
                      <tr>
                        <th><input id="all-evening-box" type="checkbox" class="flat-grey">Evening</th>
                        <th>Time</th>
                        <th>Availability</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" class="flat evening-box"></td>
                        <td>6:00 PM - 7:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat evening-box"></td>
                        <td>7:00 PM - 8:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat evening-box"></td>
                        <td>8:00 PM - 9:00 PM</td>
                        <td>100%</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" class="flat evening-box"></td>
                        <td>9:00 PM - 10:00 PM</td>
                        <td>100%</td>
                      </tr>
                    </tbody>
                  </table>
            </div>  
         </form>
        </section>
        <h3>Ad Order<i class="fa fa-check" style="float:right;font-size:20px;padding-top:5px;"></i></h3>
        <section>
          <form>
              <div class="container-fluid">
                <div class="col-md-12">
                      <div class="form-group">
                      <label>Agency/Advertiser:</label>
                      <select id="#" name="#" class="form-control select2" style="width:100%;">
                      </select>
                      <a class="btn btn-link pull-right" href="<?php echo site_url('advertisers/add') ?>">New Advertiser</a>
                    </div>  
                </div>
                <div class="col-md-6">
                           <div class="form-group">
                            <label>Ad Duration:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="ad-duration" name="">
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                            </div>
                            <span class="help-block"></span>
                          </div>
                </div>  
                <div class="col-md-6">
                           <div class="form-group">
                            <label>Frequency:</label>
                            <div class="input-group">
                              <input type="text" class="form-control" id="ad-frequency" name="">
                              <div class="input-group-addon">
                                <i class="fa fa-refresh"></i>
                              </div>
                            </div>
                            <span class="help-block">*Refers on how many times the ad will be played per timeslot.</span>
                          </div> 
                </div>  
                <div class="col-md-12">
                      <div class="form-group">
                      <label>Sales Agent:</label>
                      <select id="#" name="#" class="form-control select2" style="width:100%;">
                      </select>
                      </div>  
                </div> 
                <div class="col-md-12">
                      <div class="form-group">
                      <label>Select Screen Size:</label>
                      <input type="text" class="form-control" id="screen-size" readonly>
                      </div>  
                </div> 
                <div class="col-md-6">
                    <a id="fullscreen-link" href="#/" onclick="fullscreen();">
                        <div class="form-group fullscreen-div text-center">
                        <label>FULLSCREEN</label>
                        </div>            
                    </a>
                </div>  
                <div class="col-md-4">
                    <a id="split-main-link" href="#/" onclick="splitMain();">
                        <div class="form-group split-main-div text-center">
                        <label>SPLIT-MAIN</label>
                        </div>   
                    </a>
                </div> 
                <div class="col-md-2">
                    <a id="split-top-link" href="#/" onclick="splitTop();">
                        <div class="form-group split-top-div text-center">
                        <label>SPLIT-TOP RIGHT</label>
                        </div>            
                    </a>
                </div> 
                <div class="col-md-2">
                    <a id="split-bottom-link" href="#/" onclick="splitBottom();">
                        <div class="form-group split-bottom-div text-center">
                        <label>SPLIT-BOTTOM</br>RIGHT</label>
                        </div>
                    </a>
                </div> 
             </div>
          </form>
        </section>
  </div>
  </div>
  <div class="box-footer">
  </div>
</div>
<script type="text/javascript">
  $("#sched_wizard").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "fade",
      autoFocus: true,
      onFinished: function (event, currentIndex)
      {
          //DITO YUNG ONCLICK NUNG FINISH
          alert("DONE");
      }
  });
  $(".select2").select2();
  $('.select2-selection__rendered').removeAttr('title');
  $('input[type="checkbox"].flat, input[type="radio"].flat').iCheck({
    checkboxClass: 'icheckbox_flat',
    radioClass: 'iradio_flat'
  });
  $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
    checkboxClass: 'icheckbox_flat-grey',
    radioClass: 'iradio_flat-grey'
  });
  
  $('#all-timeslot-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('check');   
      $('.afternoon-box').iCheck('check');
      $('.evening-box').iCheck('check');
  });
  $('#all-timeslot-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');   
  });
  
  $('#all-morning-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('check');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('uncheck'); 
  });
  $('#all-morning-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
  });
  
  $('#all-afternoon-box').on('ifChecked', function (event){  
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('check');
      $('.evening-box').iCheck('uncheck');
  });
  $('#all-afternoon-box').on('ifUnchecked', function (event) { 
      $('input').iCheck('uncheck');
  });
  
  $('#all-evening-box').on('ifChecked', function (event){
      $('.morning-box').iCheck('uncheck');   
      $('.afternoon-box').iCheck('uncheck');
      $('.evening-box').iCheck('check');
  });
  $('#all-evening-box').on('ifUnchecked', function (event) {
      $('input').iCheck('uncheck');
  });
  
  $( document ).ready(function() {
    $('.select2').trigger('update');
  });

  $('input[id$="ad-duration"]').inputmask("9999", {
    placeholder: "__________", 
    insertMode: false, 
    showMaskOnHover: false,
    });
  $('input[id$="ad-frequency"]').inputmask("99", {
    placeholder: "__________", 
    insertMode: false, 
    showMaskOnHover: false,
    });
    
    function fullscreen() {
        $('#screen-size').attr('value', 'Fullscreen');
    }
    function splitMain() {
        $('#screen-size').attr('value', 'Split - Main');
    }
    function splitTop() {
        $('#screen-size').attr('value', 'Split - Top Right');
    }
    function splitBottom() {
        $('#screen-size').attr('value', 'Split - Bottom Right');
    }
</script>