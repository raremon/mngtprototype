
$(document).ready(function () {

  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $(".connectedSortable .info-box, .connectedSortable .nav-tabs-custom").css("cursor", "move");

  //Date range picker
  $('#reservation').daterangepicker();
  $('#reservation1').daterangepicker();
  $('#reservation2').daterangepicker();
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
  //Date range as a button
  $('#daterange-btn').daterangepicker(
      {
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
  );

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  });
  
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  
  //Timepicker
  $('input[id$="timepicker"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="timepicker1"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="timepicker2"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="timepicker3"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="timepicker4"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="timepicker5"]').inputmask("hh:mm:ss", {
    placeholder: "HH:MM:SS", 
    insertMode: false, 
    showMaskOnHover: false,
    hourFormat: 24
    }
  );
  $('input[id$="airtime_2"]').inputmask("999999999", {
    placeholder: "__________", 
    insertMode: false, 
    showMaskOnHover: false,
    }
  );
});
