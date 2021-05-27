<table>
  <thead>
  <tr>
    <th>Mã lớp</th>
    <th>Tên Lớp</th>
    <th>Mã học viên</th>
    <th>Tên học viên</th>
    <th>Địa Chỉ</th>
    <th>Tiêu Chuẩn</th>
  </tr>
  </thead>
  <tbody>
  @if($dataTypeContent->count() > 0)
    @foreach($dataTypeContent as $data)
      <tr>
        <td>{{ $data->classroom->HP_id }}</td>
        <td>{{ $data->classroom->name }}</td>
        <td>{{ $data->student->id_card }}</td>
        <td>{{ $data->student->fullname }}</td>
        <td>{{ $data->student->address }}</td>
        <td>Đạt</td>
      </tr>
    @endforeach
  @else
    <tr>
      <td colspan="7">Không có học viên nào đạt chuẩn để cấp bằng</td>
    </tr>
  @endif

  </tbody>
</table>
