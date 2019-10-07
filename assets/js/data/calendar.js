$(document).ready(function() {

    // page is now ready, initialize the calendar...

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        //defaultView: 'basicWeek',
        events: BASEURL + "agenda/calendar_json"
    });


});