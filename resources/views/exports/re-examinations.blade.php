<table>
  <thead>
    <tr>
      <th>Mã lớp</th>
      <th>Tên Lớp</th>
      <th>Mã học viên</th>
      <th>Tên học viên</th>
      <th>Địa Chỉ</th>
      <th>Ngày Giờ Thi</th>
      <th>Phòng Thi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($dataTypeContent as $data)
    <tr>
      <td>{{ $data->classroom->HP_id }}</td>
      <td>{{ $data->classroom->name }}</td>
      <td>{{ $data->student->id_card }}</td>
      <td>{{ $data->student->fullname }}</td>
      <td>{{ $data->student->address }}</td>
      <td>Ngày: {{ $data->classroom->retestSchedule[0]->start_day }} - Giờ: {{ $data->classroom->retestSchedule[0]->start_time }}</td>
      <td>{{ $data->classroom->retestSchedule[0]->room->name }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
