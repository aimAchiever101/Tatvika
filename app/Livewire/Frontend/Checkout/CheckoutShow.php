<?php

namespace App\Livewire\Frontend\Checkout;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;


class CheckoutShow extends Component
{
    public $carts , $totalProductAmount = 0;

    public $fullname, $email, $phone, $pincode, $address, $payment_mode= NULL, $payment_id=NULL, $tracking_no;

    public function rules()
    {
        return[
            'fullname' =>'required|string|max:121', 
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10', 
            'pincode' => 'required|string|max:6|min:6', 
            'address'  => 'required|string|max:500'
        ];
    }

    public function placeOrder()
    {
         $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'tatvika'.Str::random(10) ,
            'fullname' => $this->fullname,
            'email' =>  $this->email,
            'phone' =>  $this->phone,
            'pincode' =>  $this->pincode,
            'address' => $this->address ,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);
        foreach($this->carts as $cartItem)
        {
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);
            if($cartItem->product_color_id != NULL)
            {
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }
            else
            {
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);

            }
        }
        return $order;
    }
    
    public function codOrder()
    {
       $this->payment_mode ='Cash on Delivery';
       $codOrder = $this->placeOrder();
       if($codOrder)
       {
            Cart::where('user_id',auth()->user()->id)->delete();

            session()->flash('message','Your order has been placed');
            return redirect()->to('thank-you');
       }
       else
       {
            session()->flash('message','Something went wrong.');
       }
    }

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

    public function render()
    {
        $this->fullname = auth()->user()->name;//by this data will be available prior
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount'=> $this->totalProductAmount
        ]);
    }
}
