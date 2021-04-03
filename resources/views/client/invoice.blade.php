  @extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
            <!-- Main content -->
            
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>Invoice
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Client details
                  <address>
                    <strong>{{$client['name']}}</strong><br>
                    {{$client['country']}}<br>
                    {{$client['mobile']}}<br>
                    Email: {{$client['email']}}
                  </address>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <div class="col-sm-4 invoice-col">
                
                 <img style="width: 100%;" src="{{asset($room['image'])}}" alt="">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
             
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>
<form action="{{ route('checkout', ['room' => $room['room_number']]) }}" method="GET">
                  @csrf
                  <div class="table-responsive">
                    <table class="table">
                      
                      <tr>
                        <th>Room Capacity</th>
                        <td>{{$room['capacity']}}</td>
                      </tr>
                      <tr>
                        <th>accompany number:</th>
                        <td> <input name="accompany_number" type="number" >note: your accompany number must be less than or equal room capacity</td>
                      
                         </tr>
                      <tr>
                      
                        <th style="width:50%">Total:</th>
                        <td>{{$room['price']}}$</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">

                  <button  class="btn btn-success float-right"><i class="far fa-credit-card"></i> Checkout
</button>
              
                  </form>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
         @endsection