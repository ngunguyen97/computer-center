@extends('layout')

@section('title', 'Thanh toán')

@section('extra-css')
  <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
 <div class="container">
   <h1 class="checkout">Thanh toán</h1>
   @if(session()->has('success_message'))
    <div class="alert alert-success">
      {{ session()->get('success_message') }}
    </div>
   @endif
   @if(session()->has('error_message'))
    <div class="alert alert-danger">
      {{ session()->get('error_message') }}
    </div>
   @endif

   <div class="row">
     <div class="col-md-12">
       <div class="checkout-section">
         <div>
           <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
            {{ csrf_field() }}
             {{ method_field('POST') }}
             <h2>Chi tiết thanh toán</h2>
             <div class="form-group">
               <label for="fullname">Họ và tên</label>
               <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" />
               @if($errors->has('fullname'))
                 <p class="error"> {{ $errors->first('fullname') }}</p>
               @endif
             </div> <!--end  full name input -->
             <div class="form-group">
               <label for="id_card">Chứng minh nhân dân</label>
               <input type="text" class="form-control" id="id_card" name="id_card" value="{{ old('id_card') }}" />
               @if($errors->has('id_card'))
                 <p class="error"> {{ $errors->first('id_card') }}</p>
               @endif
             </div> <!--end  full name input -->
             <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
               @if($errors->has('email'))
                 <p class="error"> {{ $errors->first('email') }}</p>
               @endif
             </div> <!-- end email input -->
             <div class="form-group">
               <label for="address">Địa chỉ</label>
               <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" />
               @if($errors->has('address'))
                 <p class="error"> {{ $errors->first('address') }}</p>
               @endif
             </div> <!--end  address input -->
             <div class="form-group">
               <label for="phone">Điện thoại</label>
               <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" />
               @if($errors->has('phone'))
                 <p class="error"> {{ $errors->first('phone') }}</p>
               @endif
             </div> <!--end  phone input -->

             <div class="form-group">
               <label for="selected_object">Đối tượng</label>
               <select class="custom-select" name="selected_object">
                 <option>Chọn đối tượng</option>
                 <option value="HSSV">Học sinh, sinh viên</option>
                 <option value="HVC">Học Viên cũ TTTH</option>
                 <option value="DDL">Đã đi làm</option>
                 <option value="Another">Khác</option>
               </select>
             </div> <!--end  phone input -->

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
                  <label for="name">Name on Card</label>
                  <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}">
                </div>

                <div class="form-group">
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
                <h3>Trụ sở chính</h3>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    117 Nguyễn Văn Nghi, Gò Vấp, Tp HCM
                  </li>
                </ul>
              </div>
            </div>
             <div class="spacer"></div>
             <input type="submit" id="complete-order" class="button-primary full-width" value="Thanh toán">
           </form>

         </div>

         <div class="checkout-table-container">
           <h2>Thông tin khóa học</h2>
           <div class="checkout-table">
             @foreach (Cart::instance('default')->content() as $item)
               <div class="checkout-table-row">
                 <div class="checkout-table-row-left">
                   <div class="checkout-item-details">
                     <div class="checkout-table-item">{{ $item->model->name }}</div>
                     <div class="checkout-table-description">{{ $item->model->schedule }}</div>
                   </div>
                 </div> <!-- end checkout-table -->

                 <div class="checkout-table-row-right">
                   <div class="checkout-table-quantity">{{ $item->qty }}</div>
                 </div>
               </div> <!-- end checkout-table-row -->
             @endforeach
           </div> <!-- end checkout-table -->

           <div class="checkout-totals">
             <div class="checkout-totals-left">
               <span class="checkout-total-total">Tổng</span>
             </div>
             <div class="checkout-totals-right">
               <span class="cart-totals-total">{{ presentPrice($item->model->fee) }}</span>
             </div>
           </div> <!-- end checkout-totals -->
         </div>

       </div> <!-- end checkout-section -->
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
    (function () {
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
    })();
  </script>
@endsection
