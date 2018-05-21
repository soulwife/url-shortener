window.$ = require('jquery');
require('jquery-ui/ui/widgets/datepicker')

$(document).ready(function(){
    $('.js-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
