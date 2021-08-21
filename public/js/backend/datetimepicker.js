$(function() {
    $('.datetimepicker').daterangepicker({
      singleDatePicker: true,
      timePicker:true,
      showDropdowns: true,
      minYear: moment(),
      maxYear: parseInt(moment().format('YYYY'),10),
      locale: { format: 'YYYY-MM-DD HH:mm:ss' }
    });
  });