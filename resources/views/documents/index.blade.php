@extends('layout')
@section('title', 'Tài Liêụ')
@section('extra-css')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <style>
    #myTable {
      font-size: 1.6rem;
    }
    label {
      font-size: 1.4rem;
    }
    div#myTable_info {
      font-size: 1.4rem;
    }
    a#myTable_previous, a#myTable_next {
      font-size: 1.4rem;
    }
    .min-vh-40 {
      min-height: 30rem;
    }
  </style>
@endsection
@section('content')
  <div class="container mt-5  p-3">
    <div class="row pb-5">
      <div class="col-md-12 min-vh-40">
        <table id="myTable" class="table table-bordered">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Tải Về</th>
          </tr>
          </thead>
          <tbody>
          @foreach($files as $key => $item)
            <tr>
              <th scope="row">{{ $key + 1 }}</th>
              <td>{{ $item->name }}</td>
              <td><a href="{{ route('student.document.download', ['slug' => $item->slug]) }}" target="_blank">
                  <i class="fa fa-download" aria-hidden="true"></i>
                  Tải về
                </a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script src="{{ URL::asset('/libs/datatables/js/dataTables.min.js') }}"></script>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable({
        "language": {
          "paginate": {
            "first":      "Đầu",
            "last":       "Cuối",
            "next":       "Sau",
            "previous":   "Trước"
          },
          "zeroRecords":    "Không tìm thấy.",
          "search": "Tìm Kiếm",
          "info": "Hiển thị _START_ to _END_ of _TOTAL_ kết quả",
          "infoEmpty": "Hiển thị 0 to 0 of 0 đối tượng",
          "lengthMenu": "Hiển thị _MENU_ đối tượng",
        }
      });
    } );
  </script>

@endsection
