"use strict";

var KTCalendarBasic = function () {

    return {
        //main function to initiate the module
        init: function () {
            var todayDate = moment().startOf('day');
            var TODAY = todayDate.format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {
                    left: 'prev,next today',
                    center: 'title',
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,
                locale: 'ua',
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: '/instructor/get-calendar-events',
                eventRender: function (info) {
                    var element = $(info.el);

                    var id = info.event.id;

                    if (info.event.extendedProps && info.event.extendedProps.description) {

                        $(element).data('id', id);
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                },
            });

            calendar.render();
            return calendar;
        }
    };
}();

jQuery(document).ready(function () {

    var calendar = KTCalendarBasic.init();
    $(document).on('click', '.fc-day-grid-event', function (e) {
        e.preventDefault();

        if (confirm('Відмінити запис?')){
            var id = $(this).data('id');
            var event = calendar.getEventById(id);

            $.ajax({
                url: '/remove-calendar-event/' + id ,
                success: function (response) {
                    event.remove();
                }
            });
        }
    });
});

