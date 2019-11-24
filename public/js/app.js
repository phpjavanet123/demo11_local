$(function () {
    var bindDatePicker = function() {
        $(".date").datetimepicker({
            format:'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    };
    bindDatePicker();
});
