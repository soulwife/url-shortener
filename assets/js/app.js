window.$ = require('jquery');
require('jquery-ui/ui/widgets/datepicker')
window.Popper = require('popper.js');
require('bootstrap');

$(document).ready(function(){
    $('.js-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

});

