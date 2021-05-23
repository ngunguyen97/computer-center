@extends('layout')

@section('title', 'Xem Lịch Học')

@section('extra-css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">


@endsection

@section('content')
  <div class="my-profile-section">
    <div class="products-section container-fluid">
      <div class="sidebar list-group list-group-flush">
        @include('partials.menus.sidebar-left')
      </div> <!-- End Sidebar -->

      <div id='scheduler' style="font-size: 1.4rem;"></div>
    </div>
  </div>


@endsection

@section('extra-js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/vi.min.js"></script>

  <script>
    $(document).ready(function() {
      $data = {!! $newData !!}

      $data.map(function (element, index) {
        if(element.dowstart) {
          element.dowstart = new Date(element.dowstart);
          element.dowend = new Date(element.dowend);
        }
      });



      $('#scheduler').fullCalendar({
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
        //     {
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
    });
  </script>
@endsection
