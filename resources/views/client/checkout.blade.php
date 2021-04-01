@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')




            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <p class="mb-4">
                            Total Amount is <strong>{{$amount}}$</strong>  
                        </p>
                    </div>
                </div>
            </div>


            <form action="/charge" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
</form>
@endsection