<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;
use App\Models\Room;

use Illuminate\Support\Arr;

use App\Models\User;
use App\Models\Reservation;
// use App\Http\Auth;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeClient;
use Notifiable;
use Validator;
use URL;
use Session;
use Redirect;
use Input;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class StripeController extends Controller
{

    public function payWithStripe($room, Request $request){
        dd($request->getContent());
        $client=Client::where('email', Auth::user()->email)->first();
        $reservedRoom= Room::where('room_number', $room)->first();
       
        return view('client.checkout', [
            'room'=>$room,
            'client'=>$client,
            'reservedRoom' => $reservedRoom
            
        ]);
    }



    public function postPaymentWithStripe(Request $request, $room)
    {   
        $reservedRoom= Room::where('room_number', $room)->first();

        $client=Client::where('email', Auth::user()->email)->first();


        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'required',
        ]);
        
        $input = $request->all();
        if ($validator->passes()) {           
            $input = Arr::has($input,array('_token'));            
            $stripe = Stripe::make('sk_test_51IbCDpAaLrjgDGnFr307xPlcFLdtrhLbLljqrk4pZZjSbqDnE9b9CnyIC0pbBkAepe8FHc7EjSLZ0w2dAZb97QGf00lPdZerIw');
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year'  => $request->get('ccExpiryYear'),
                        'cvc'       => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('checkout', ['room' => $room]);
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->get('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                     /**
                    * Write Here Your Database insert logic.
                   
                    */
                    $client->update(['has_reservations'=> 'yes']);
                   

                    \Session::put('success','Money add successfully in wallet');
                    return redirect()->route('checkout', ['room' => $room]);
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('checkout', ['room' => $room]);
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room]);
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room]);
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room]);
            }
        }
        \Session::put('error','All fields are required!!');
        return redirect()->route('checkout', ['room' => $room]);
    }    
}