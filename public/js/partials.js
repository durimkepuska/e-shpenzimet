$(document).ready(function()
  {
      $("#myTable").tablesorter();
  }
 );

$('#flash_message').delay(4000).fadeOut('slow');


$('#myForm').submit(function() {
  return confirm("Shtype OK nese jeni i sigurt per ta fshire kete shpenzim!");
 });


$(document).ready(function() {
    $('.datepicker').datepicker();
})



//important
var Privileges = jQuery('#expenditure_status');
var select = this.value;
Privileges.change(function () {
    if ($(this).val() == 2) {

        $('.dept').show();
        $('.paid').hide();
    }
    else if ($(this).val() == 1) {
        $('.paid').show();
        $('.dept').hide();
   } else {
     $('.paid').show();
     $('.dept').show();
   }
});


$(document).ready(function() {
    if($('#expenditure_status').val() == 2)
    {
        $('.dept').show();
        $('.paid').hide();
    } else if($('#expenditure_status').val() == 1)  {
            $('.paid').show();
            $('.dept').hide();
       } else {
         $('.paid').show();
         $('.dept').show();
       }

});
