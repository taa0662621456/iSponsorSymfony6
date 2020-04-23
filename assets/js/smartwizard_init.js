import jQuery from 'jquery';
//http://techlaboratory.net/smartwizard

//let smartwizard = document.querySelector('#smartwizard');

//if (smartwizard != undefined) {
    (function ($, undefined) {
        //$(document).on('load', function(){
        $(document).ready(function(){
            $('#smartwizard, #object').smartWizard({
                keyNavigation: true,
                autoAdjustHeight: true,
                cycleSteps: false,
                toolbarSettings: {
                    toolbarPosition: 'button'
                }
            })
        });
    })(jQuery);
//}