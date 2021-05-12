@extends('voyager::master')
@section('css')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection

@section('content')
  <div class="panel-body">
    <div class="table-responsive">
      <form action="{{ route('grade.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table id="editables" class="table table-bordered table-striped" cellpadding="2" cellspacing="0">
          <thead>

          <tr>
            <th rowspan="2">ID</th>
            <th rowspan="2">First Name</th>
            <th rowspan="2">Address</th>
            <th colspan="2" scope="colgroup" style="text-align: center">Lý Thuyết</th>
            <th colspan="2" scope="colgroup" style="text-align: center">Thực Hành</th>
            <th colspan="2" scope="colgroup" style="text-align: center">Xếp Loại</th>
            <th rowspan="2">Ghi Chú</th>
          </tr>
          <tr>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
            <th scope="col">Lần 1</th>
            <th scope="col">Lần 2</th>
          </tr>
          </thead>
          <tbody>
          @foreach($data as $row)


            <tr>
              <td style="width: 120px;">
                <input type="text" class="form-control" style="border: none" name="id_card" value="{{ $row->id_card }}" readonly data-student-id="{{ $row->student_id }}" data-classroom-id="{{ $row->classroom_id }}">
              </td>
              <td style="width: 160px"><span>{{ $row->fullname }}</span></td>
              <td style="width: 180px;"><span>{{ $row->address }}</span></td>

              <td style="max-width: 30px;">
                @if(isset($row->test_score))
                  <input type="text" class="form-control" data-theory-first="{{ json_decode($row->test_score)->grades->theory->first_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->theory->first_time }}">
                @endif
              </td>
              <td style="max-width: 30px;">
                <input type="text" class="form-control" data-theory-second="{{ json_decode($row->test_score)->grades->theory->second_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->theory->second_time }}">
              </td> <!-- Ly Thuyet -->

              <td style="max-width: 30px;">
                <input type="text" class="form-control" data-practice-first="{{ json_decode($row->test_score)->grades->practice->first_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->practice->first_time }}">
              </td>
              <td style="max-width: 30px;">
                <input type="text" class="form-control" data-practice-second="{{ json_decode($row->test_score)->grades->practice->second_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->practice->second_time }}">
              </td> <!-- Practice -->


              <td style="max-width: 30px;">
                <input type="text" class="form-control" data-classification-first="{{ json_decode($row->test_score)->grades->classification->first_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->classification->first_time }}">
              </td>
              <td style="max-width: 30px;">
                <input type="text" class="form-control" data-classification-second="{{ json_decode($row->test_score)->grades->classification->second_time }}" name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->classification->second_time }}">
              </td> <!-- XEP Loai -->

              <td style="max-width: 60px;" >
                <input type="text" class="form-control" data-note="{{ json_decode($row->test_score)->grades->note->value }}"  name="test_score#{{$row->student_id}}" value="{{ json_decode($row->test_score)->grades->note->value }}">
              </td> <!-- NOTE -->

            </tr>
          @endforeach
          </tbody>
        </table>
        <button type="submit" name="submit" id="submitted-grade" class="btn btn-lg btn-success">Lưu</button>
      </form>
    </div>
  </div>

@endsection

@section('javascript')

  <script>
    $(document).ready(function(){
      const submitBtn = document.querySelector('#submitted-grade');
      var data = {
        'objects': [],
      };

      submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var rows =document.getElementsByTagName("tbody")[0].rows;
        //console.log(rows);
        for(var i=0;i<rows.length;i++){

          var newItem = new Object({
            'classroom_id': null,
            'student_id': null,
            'grades': {
              'theory': {
                'first_time': null,
                'second_time': null
              },
              'practice': {
                'first_time': null,
                'second_time': null
              },
              'classification': {
                'first_time': null,
                'second_time': null
              },
              'note': {
                'value': null
              }
            }
          });
          //var td = rows[i].getElementsByTagName("td")[i];
          const nested = rows[i].getElementsByTagName("input");


          for(var j = 0; j < nested.length; j++) {
            if(nested[j].hasAttribute('data-student-id')) {
              newItem.student_id = nested[j].dataset.studentId;
              newItem.classroom_id = nested[j].dataset.classroomId;
            }
            if(nested[j].hasAttribute('data-theory-first')) {
              newItem.grades.theory.first_time = nested[j].dataset.theoryFirst;
            }
            if(nested[j].hasAttribute('data-theory-second')) {
              newItem.grades.theory.second_time = nested[j].dataset.theorySecond;
            }
            if(nested[j].hasAttribute('data-practice-first')) {
              newItem.grades.practice.first_time = nested[j].dataset.practiceFirst;
            }
            if(nested[j].hasAttribute('data-practice-second')) {
              newItem.grades.practice.second_time = nested[j].dataset.practiceSecond;
            }

            if(nested[j].hasAttribute('data-classification-first')) {
              newItem.grades.classification.first_time = nested[j].dataset.classificationFirst;
            }
            if(nested[j].hasAttribute('data-classification-second')) {
              newItem.grades.classification.second_time = nested[j].dataset.classificationSecond;
            }
            if(nested[j].hasAttribute('data-note')) {
              newItem.grades.note.value = nested[j].dataset.note;
              data.objects.push(newItem);
            }

          }
        }

        axios.post(`/admin/add-grades`,{
          data: data.objects
        })
          .then(function(response) {
            //console.log(response.data);

            setTimeout(function() {
              toastr[response.data.messages.status](response.data.messages.message);
            }, 700);

            setTimeout(function() {
              window.location.reload();
            }, 1500);


          })
          .catch(function(error) {
            console.log(error);
          });

        //console.log(data.objects);
      });



      const input = document.querySelectorAll('input');
      const isEmpty = str => !str.trim().length;

      for(var k=0;k<input.length;k++) {
        test_custom(input[k]);
        input[k].addEventListener('change',function(e) {

          if(this.hasAttribute('data-theory-first')) {
            this.setAttribute('data-theory-first', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-theory-first'));
          }
          if(this.hasAttribute('data-theory-second')) {
            this.setAttribute('data-theory-second', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-theory-second'));
          } // Theory

          if(this.hasAttribute('data-practice-first')) {
            this.setAttribute('data-practice-first', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-practice-first'));
          }
          if(this.hasAttribute('data-practice-second')) {
            this.setAttribute('data-practice-second', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-practice-second'));
          } // word



          if(this.hasAttribute('data-classification-first')) {
            if(isEmpty(e.target.value)) {
              e.target.value = "";
            }
            this.setAttribute('data-classification-first', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-classification-first'));
          }
          if(this.hasAttribute('data-classification-second')) {
            if(isEmpty(e.target.value)) {
              e.target.value = "";
            }
            this.setAttribute('data-classification-second', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-classification-second'));
          } // classification


          if(this.hasAttribute('data-note')) {
            if(isEmpty(e.target.value)) {
              e.target.value = "";
            }
            this.setAttribute('data-note', e.target.value);
            this.value = e.target.value;
            console.log(this.getAttribute('data-note'));
          } // note

        });
      }



      function test_custom(input) {
        const descriptor = Object.getOwnPropertyDescriptor(Object.getPrototypeOf(input), 'value');

        Object.defineProperty(input, 'value', {
          set: function(t) {
            console.log('Input value was changed programmatically');
            return descriptor.set.apply(this, arguments);
          },
          get: function() {
            return descriptor.get.apply(this);
          }
        });
      }
    });
  </script>



@endsection
