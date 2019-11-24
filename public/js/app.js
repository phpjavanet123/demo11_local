$(function () {
    //autoclose: true, - NO SUCH option
    //FIX
    //https://stackoverflow.com/questions/40300390/how-to-autoclose-datetimepicker-of-bootstrap-using-dp-change-event
    var bindDatePicker = function() {
        $(".date").datetimepicker({
            format:'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.change', function(e){
            if( !e.oldDate || !e.date.isSame(e.oldDate, 'day')){
                $(this).data('DateTimePicker').hide();
            }
        });
    };
    bindDatePicker();
});
