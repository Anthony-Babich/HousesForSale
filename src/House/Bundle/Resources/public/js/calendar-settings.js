$(function () {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        lazyFetching: true,
        timeFormat: {
            agenda: 'h:mmt',
            '': 'h:mmt'
        },
        eventSources: [
            {
                url: Routing.generate('fullcalendar_loader'),
                type: 'POST',
                data: {

                }
            }
        ]
    });
});
