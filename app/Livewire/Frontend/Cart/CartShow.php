<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0; 

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();

        if($cartData)
        {
            $cartData->decrement('quantity');
            session()->flash('message','Quantity updated');
        }
        else
        {
            session()->flash('message','Something went wrong');
        }
        
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();

        if($cartData)
        {
            if($cartData->product()->where('id',$cartData->product_color_id)->exists())
            {
                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity)
                {
                    $cartData->increment('quantity');
                    session()->flash('message','Quantity updated');

                }
                else
                {
                    session()->flash('message','only'.$productColor->quantity.'Quantity available');
                }
            }
            else
            {
                if($cartData->product->quantity > $cartData->quantity)
                {
                    $cartData->increment('quantity');
                    session()->flash('message','Quantity updated');
                }

            }
            
        }
        else
        {
            session()->flash('message','Something went wrong');
        }
    }

    public function removeCartItem(int $cartId)
    {
      $cartRemoveData=  Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
      if($cartRemoveData){
        $cartRemoveData->delete();
        $this->dispatch('cartAddedUpdated');
        session()->flash('message','the item removed successfully');

      }
      else
      {
        session()->flash('message','something went wrong');
      }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }
} 
