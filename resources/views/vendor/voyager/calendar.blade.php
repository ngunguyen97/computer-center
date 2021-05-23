@extends('voyager::master')

@section('css')
  <style>
    #schedulers .fc-month-view .fc-widget-content .fc-widget-content,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content {
      height: auto;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event {
      margin-bottom: 1.7rem;
      margin-left: 0.7rem;
      margin-right: 0.7rem;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content {
      white-space: normal;
      padding: 1rem;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-time,
    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-title,
    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__teacher,
    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__time,
    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__room,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-time,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-title,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__teacher,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__time,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__room {
      display: block;
      color: #003763;
      font-size: 1rem;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-time,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-time {
      display: none;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-title,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content .fc-title {
      font-weight: bold;
      padding-bottom: 1rem;
      font-size: 1rem;
    }

    #schedulers .fc-month-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__time,
    #schedulers .fc-basicWeek-view .fc-widget-content .fc-widget-content .fc-content-skeleton .fc-event-container .fc-day-grid-event .fc-content__time {
      font-weight: bold;
    }
    .pb-3 {
      padding-bottom: 1rem !important;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/vi.min.js"></script>

@endsection

@section('content')
  <div id='schedulers' style="font-size: 1rem;"></div>
@endsection

@section('javascript')
  <script>
    $(document).ready(function() {
      setTimeout(function() {
        $data = {!! $newData !!}

        $data.map(function (element, index) {
          if(element.dowstart) {
            element.dowstart = new Date(element.dowstart);
            element.dowend = new Date(element.dowend);
          }
        });


        $('#schedulers').fullCalendar({
          eventRender: function(event, element, view) {
            element.find('.fc-title').after('<span class="fc-content__room">Phòng: ' + event.room + '</span>');
            element.find('.fc-title').after('<span class="fc-content__time pb-3">Thời gian: ' + moment(event.start).format('HH:mm a') + ' - ' + moment(event.end).format('HH:mm a') + '</span>');
            element.find('.fc-title').after('<span class="fc-content__teacher pb-3">Giáo Viên: ' + event.teacher + '</span>');


            var theDate = event.start;
            var endDate = event.dowend;
            var startDate = event.dowstart;

            if (theDate >= endDate) {
              return false;
            }

            if (theDate <= startDate) {
              return false;
            }

          },
          locale: 'vi',
          minTime: "06:00:00",
          maxTime: "20:00:00",
          allDaySlot: false,
          defaultView: 'basicWeek',
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'basicWeek,month'
          },
          defaultDate: new Date(),
          views: {
            basicWeek: {
              columnFormat: 'ddd D/M'
            }
          },
          events: $data
          // events: [
          //   {
          //     id: 1,
          //     title:"Tin Học Văn Phòng",
          //     start:'10:00',
          //     end:  '13:00',
          //     dow: [2, 4, 6],
          //     dowstart: new Date('2021/05/03'),
          //     dowend: new Date('2021/06/05'),
          //     teacher: 'Kiều Trung Tiến',
          //     room: 'A2.01',
          //     backgroundColor: '#e5eaf2',
          //     borderColor: '#e5eaf2'
          //   },
          //   {
          //     id: 2,
          //     title:"Cơ Sở Dữ Liệu",
          //     start:'08:00',
          //     end:  '10:00',
          //     dowstart: new Date('2021/05/12'),
          //     dowend: new Date('2021/05/13'),
          //     teacher: 'Kiều Trung Tiến',
          //     room: 'A2.01',
          //     backgroundColor: '#fff0d8',
          //     borderColor: '#fff0d8'
          //   }
          // ]

        })
      }, 0);


    });
  </script>
@endsection
