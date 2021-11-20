//http://techlaboratory.net/smartwizard

let smart = document.querySelector('#object000');
if (smart != null) {
    function () {
        //$(document).on('load', function(){
        $(document).ready(function () {
            $('#object').smartWizard({
                keyNavigation: true,
                autoAdjustHeight: true,
                cycleSteps: false,
                showPreviousButton: false,
                showNextButton: false,
            })
        });
    }
}
