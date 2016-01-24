$(document).ready(function() {
    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : 'yy-mm-dd'
    });
    $('.month').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : 'yy-mm',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
    $('#dateFrom').datepicker("setDate", new Date(from * 1000) );
    $('#dateTo').datepicker("setDate", new Date(to * 1000));
    $('#month').datepicker("setDate", new Date(from * 1000));

    $('#submitDate').click('click', submitDate);
    $('#submitDateChart').click('click', submitDateChart);
});

var submitDate = function () {
    var dateFrom = $('#dateFrom').val();
    var dateTo = $('#dateTo').val();
    window.location.href = window.location.pathname + '?type=' + type + '&from=' + dateFrom + '&to=' + dateTo;
};

var submitDateChart = function () {
    var date = $('#month').val();
    window.location.href = window.location.pathname + '?from=' + date;
};