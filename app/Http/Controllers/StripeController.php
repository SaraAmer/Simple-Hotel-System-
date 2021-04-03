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
        
        //dd($request->accompany_number);
        $client=Client::where('email', Auth::user()->email)->first();
        $reservedRoom= Room::where('room_number', $room)->first();
       
        return view('client.checkout', [
            'room'=>$room,
            'client'=>$client,
            'reservedRoom' => $reservedRoom,
            'accompany_number'=> $request->accompany_number
            
        ]);
    }



    public function postPaymentWithStripe($room, $accompany_number, Request $request)
    {   
       // dd($accompany_number);  
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
                    return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
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
                   // $reservedRoom->update(['status'=> 'unavailable']);
                  // dd($reservedRoom);
                    $reservedRoom->update(['status'=> 'unavailable']);
                    $client->update(['has_reservations'=> 'yes']);
                    $reservation= new Reservation;
                    $reservation->client_id= $client['id'];
                    $reservation->accompany_number= $accompany_number;
                    $reservation->room_number= $room;
                   
                    $reservation['paid price']= $reservedRoom['price'];
                    $reservation->save();




                    \Session::put('success','Money add successfully in wallet');
                    return redirect()->route('checkout', ['room' => $room , 'accompany_number' => $accompany_number]);
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
            }
        }
        \Session::put('error','All fields are required!!');
        return redirect()->route('checkout', ['room' => $room, 'accompany_number' => $accompany_number]);
    }    
}