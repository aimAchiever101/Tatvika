<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;


class PaymentRequest extends Component
{
    public $name, $phone, $amount;
    

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem)
        {
            $this->totalProductAmount += $cartItem->product->selling_price*$cartItem->quantity;
        }
        return $this->totalProductAmount;
    }


    public function payment_request(){
        try{
            $API_KEY="test_4f01a3897b975cb155caffbd459";
            $API_AUTH_TOKEN="test_50048e65f549e74220ff3969bb7";
            $API_SALT="50b96f2f863044f89662de4d10608541";
            $API_WEBSITE="test.instamojo.com";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://$API_WEBSITE/api/1.1/payment-requests/");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
                array("X-Api-Key:$API_KEY",
                  "X-Auth-Token:$API_AUTH_TOKEN"));
    $payload = Array(
        'purpose' => 'Advance Payments',
        'amount' => $this->amount,
        'phone' => $this->phone,
        'buyer_name' => $this->name,
        'redirect_url' => 'http://www.example.com/redirect/',
        'send_email' => true,
        'webhook' => 'http://www.example.com/webhook/',
        'send_sms' => true,
        'email' => 'foo@example.com',
        'allow_repeated_payments' => false
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    $response = curl_exec($ch);
    curl_close($ch); 

    echo $response;
    // dd($response);

    $result =json_decode($response,true);
    // dd($result);

    // $longurl=$result['payment_request']['longutl']

 //  when we have to go other domain
        // return redirect()->away($longurl);
       return redirect()->route("payment-request-details");
 

        }   
        catch (\Throwable $th) {
            dd($th->getMessage());
        }    
    }

    public function render()
    {
        $this->name = auth()->user()->name;
        $this->amount = $this->totalProductAmount();
        return view('livewire.frontend.payment-request')->extends('layouts.app');
    }
}
