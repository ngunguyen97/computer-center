@extends('layout')

@section('title', 'Đăng ký thi lại')

@section('extra-css')
  <style>
    .payment-section {
      max-width: 54rem;
      display: none;
    }
    select#classroom {
      font-size: 1.4rem;
    }
    .payment-section > .half-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }
    .payment-section > .half-form > .form-check > .form-check-input {
      margin-top: 0.5rem;
    }
    .payment-section > .half-form > .form-check > .form-check-label {
      margin-left: 1rem;
    }

    .payment-section > .checkout-payment-section > #checkout-online-payment >.form-group > #name_on_card {
      padding: 2rem;
      background-color: transparent;
      font-size: 1.6rem;
    }
    .checkout-offline-payment {
      display: none;
    }
    .payment-section > .btn-payment {
      color: white !important;
      background: #2b96c1d1;
      padding: 12px 40px;
      border-color: #50a8cb;
    }
    .payment-section > input#complete-order {
      font-size: 1.5rem;
      transition: all 0.5s;
    }
    input#complete-order:hover {
      transform: translateY(-5px);
    }
  </style>
  {{--https://www.google.com/recaptcha/admin/site/450618043/setup--}}
  <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
  <div class="my-profile-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-2 mt-5" style="font-size: 1.6rem;">
          @if (session()->has('success_message'))
            <div class="alert alert-success">
              {{ session()->get('success_message') }}
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="products-section container-fluid">
      <div class="sidebar list-group list-group-flush">
        @include('partials.menus.sidebar-left')
      </div> <!-- End Sidebar -->
      <div class="re-examination">
        <div class="products-header">
          <h1 class="stylish-heading">Đăng ký thi lại</h1>
        </div>
        <div>
          @if($newData->count() > 0 )
            <form action="{{ route('student.reexamination.store') }}" method="POST" id="payment-form">

              {{ method_field('POST') }}
              {{ csrf_field() }}

              <div class="form-group">
                <label for="classroom">Chọn khóa học</label>
                <select class="form-control" id="classroom" name="classroom">
                  <option selected="selected" value="0">--Chọn khóa học--</option>
                  @foreach($newData as $item)
                    <option value="{{ $item->classroomId }}"> {{ $item->HP }} - {{ $item->roomName }}</option>
                  @endforeach
                </select>
              </div>

              <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên Khóa Học</th>
                  <th scope="col">Ngày Thi</th>
                  <th scope="col">Lệ phí</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>


              <div class="payment-section">
                <div class="spacer"></div>
                <h2>Phương thức thanh toán</h2>
                <div class="half-form">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_types" id="onlinePayment" value="onlinePayment" checked>
                    <label class="form-check-label" for="onlinePayment">
                      Thanh toán trực tuyến
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_types" id="offlinePayment" value="offlinePayment">
                    <label class="form-check-label" for="offlinePayment">
                      Thanh toán tại trung tâm
                    </label>
                  </div>
                </div>

                <div class="checkout-payment-section">
                  <div class="checkout-payment-section__online-payment show" id="checkout-online-payment">
                    <div class="form-group">
                      <label for="name">Tên Thẻ</label>
                      <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}">
                    </div>

                    <div class="form-group">
                      <input type="hidden" class="form-control" id="address" name="address" value="{{ Auth::guard('student')->user()->address }}">
                      <div class="form-rows">
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                      </div>
                    </div>
                  </div>
                  <div class="checkout-offline-payment" id="checkout-offline-payment">
                    <div class="spacer"></div>
                    <h3>Trụ sở chính</h3>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        117 Nguyễn Văn Nghi, Gò Vấp, Tp HCM
                      </li>
                    </ul>
                    <p class="note" style="margin-top: 1rem;"><strong>Lưu ý: </strong>Trung tâm chỉ làm việc giờ hành chính.</p>
                  </div>
                </div>

                <div class="spacer"></div>
                <input type="submit" id="complete-order" class="btn btn-outline-primary btn-block btn-payment" value="Xác Nhận">
              </div>

            </form>
          @else
            <p>Chưa mở lớp thi lại.</p>
          @endif

        </div>

        <div class="spacer"></div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script>
    var FormStuff = (function () {
      var bindUIAction = function() {
        var classname = document.querySelectorAll('input[type="radio"]');
        Array.from(classname).forEach(function (e) {
          e.addEventListener('change', applyConditionalRequired);
        });
      };

      var  applyConditionalRequired = function () {
        if(this.value === 'onlinePayment') {
          document.getElementById('checkout-online-payment').classList.toggle('hide');
          document.getElementById('checkout-offline-payment').classList.toggle('show');
          document.getElementById('checkout-online-payment').classList.toggle('show');
        }else {
          document.getElementById('checkout-offline-payment').classList.toggle('show');
          document.getElementById('checkout-online-payment').classList.toggle('show');
          document.getElementById('checkout-online-payment').classList.toggle('hide');
        }
      };

      return {
        init: function () {
          bindUIAction();
        }
      }
    })();
    FormStuff.init();
  </script>

  <script>
    $(document).ready(function() {
      const classname = document.querySelectorAll('#classroom');
      Array.from(classname).forEach(function(element){
        element.addEventListener('change', function() {
          const id = this.value;
          axios.post(`/student/re-examination/${id}`,{
            classroom: this.value
          })
            .then(function(response){
              var data = response.data;
              var res='', payment_section = $('.payment-section');
              if(data.length) {
                payment_section.css("display","none");
                $.each(data, function(key, value) {
                  var currency = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumSignificantDigits: 3 }).format(value.fee);
                  //console.log(currency);
                  res += `<tr>
                   <td>${value.HP}<input type="hidden" name="classroom" value="${value.classroom}"></td>
                   <td>${value.roomName}</td>
                   <td>${value.start_day}</td>
                   <td>${currency} <input type="hidden" name="fee" value="${value.fee}"></td>
                  </tr>`;
                });
                $('tbody').html(res);
                payment_section.toggle('show');
              }else {
                $('tbody').html(res);
                payment_section.toggle('show');
              }
              //window.location.href = '{{ route('cart.index') }}';
            })
            .catch(function(error){
              console.log(error);
              //window.location.href = '{{ route('cart.index') }}';
            });
        });
      });
    });
  </script>


  <script>
    $(document).ready(function() {
      // Create a Stripe client.
      var stripe = Stripe('pk_test_51Hy7gwJBQhDYkjsgggINkPBkrL3fL2uLW0T5PlJHnU0NODDSHJQ2J67KVfnIf0npGQndkSZFirodvXeiVS6X5PJ900RQ0ztxRA');

      // Create an instance of Elements.
      var elements = stripe.elements();

      // Custom styling can be passed to options when creating an Element.
      // (Note that this demo uses a wider set of styles than the guide below.)
      var style = {
        base: {
          color: '#32325d',
          fontFamily: '"Roboto", "Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };

      // Create an instance of the card Element.
      var card = elements.create('card', {
        style: style,
        hidePostalCode: true
      });

      // Add an instance of the card Element into the `card-element` <div>.
      card.mount('#card-element');
      // Handle real-time validation errors from the card Element.
      card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });

      // Handle form submission.
      var form = document.getElementById('payment-form');
      var radios = document.querySelectorAll('input[type="radio"]');
      Array.from(radios).forEach(function (e) {
        if(e.checked) {
          form.addEventListener('submit', HandleEvent);
        }
        e.addEventListener('change', function () {
          if(this.value === 'onlinePayment') {
            form.addEventListener('submit', HandleEvent);
          }else {
            form.removeEventListener('submit', HandleEvent);
            form.addEventListener('submit', function () {
              stripeTokenHandler(null);
            });
          }
        });
      });

      function HandleEvent(event) {
        event.preventDefault();

        //Disable the submit button to prevent repeared clicks
        document.getElementById('complete-order').disabled = true;

        var options = {
          name: document.getElementById('name_on_card').value,
          address_line1: document.getElementById('address').value
        }

        stripe.createToken(card, options).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            document.getElementById('complete-order').disabled = false;
          } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
          }
        });
      }


      // Submit the form with the token ID.
      function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
      }
    });
  </script>


@endsection
