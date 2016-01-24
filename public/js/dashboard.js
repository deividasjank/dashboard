$(document).ready(function() {
    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : 'yy-mm-dd'
    });
    $('#dateFrom').datepicker("setDate", new Date(from * 1000) );
    $('#dateTo').datepicker("setDate", new Date(to * 1000));

    $('#submitDate').click('click', submitDate);
});

var submitDate = function () {
    var dateFrom = $('#dateFrom').val();
    var dateTo = $('#dateTo').val();
    window.location.href = window.location.pathname + '?type=' + type + '&from=' + dateFrom + '&to=' + dateTo;
};