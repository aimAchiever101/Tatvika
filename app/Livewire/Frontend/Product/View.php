<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Wishlist;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishList($productId)
    {
        if(Auth::check())
        {
            if(wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {
                session()->flash('message','Already Added to wishlist');
                // $this->dispatch('message','Already Added to wishlist');

                return false;
            }
            else
            {
                 Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->dispatch('wishlistAddedUpdated');

                session()->flash('message','Added to wishlist successfully');
            }           
        }
        else
        {
            session()->flash('message','Please login to continue');
            // $this->dispatch('message','please Login to continue');
            // ,[
                    // 'text' => 'please Login to continue',
                    // 'type'=>'info',
                    // 'status'=> 409
                // ]);
            
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $this->productColorId = $productColorId;

        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }

    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++ ;
        }
    }

    
    public function addToCart(int $productId)
    {
        if(Auth::check())
        {
            // dd($productId);
            if($this->product->where('id',$productId)->where('status','0')->exists())
            { 
                // check for product color quantity and add to cart
                if($this->product->productColors()->count() > 1)
                {
                    // dd('product color inside');
                    if($this->prodColorSelectedQuantity != NULL)
                    {

                        // dd('color selected');
                        if(Cart::where('user_id',auth()->user()->id)
                        ->where('product_id',$productId)
                        ->where('product_color_id',$this->productColorId)
                        ->exists())
                        {
                            session()->flash('message','This product has been alredy added to the cart .');
                        }
                        else
                        {
                            $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                            if($productColor->quantity > 0)
                            {
                                if($productColor->quantity > $this->quantityCount)
                                {
                                    // inserting product to cart with colors
                                    // dd('add product with colors');
                                    Cart::create([
                                        'user_id'=> auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    $this->dispatch('cartAddedUpdated');
                                    session()->flash('message','product added to cart');    
                                }
                                else
                                {
    
                                    session()->flash('message','Sorry, only'.$productColor->quantity.'pieces are available ');
                                }
                            }
                            else
                            {
                                session()->flash('message','Select your prefered color ');
                            }
                        }
                       
                    }
                    else
                    {
                        session()->flash('message','Select your prefered color ');
                    }
                }
                else
                {
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
                    {
                        session()->flash('message','This product is already to cart. ');
                    }
                    else
                    {
                        if($this->product->quantity > 0)//working here right now
                        {
                        if($this->product->quantity > $this->quantityCount)
                        {
                            // inserting product to cart without colors
                            // dd('add product without colors');
                            Cart::create([
                                'user_id'=> auth()->user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->dispatch('cartAddedUpdated');
                            session()->flash('message','product added to cart');   

                            // $this->dispatch('message',[
                            //     'text'=>'product added to cart']);
                        // $this->dispatchBrowserEvent('addToCart', 
                        // ['success' => 'product added to cart']); 
                        }
                        else
                        {
                            session()->flash('message','Sorry, only'.$this->product->quantity.'pieces are available ');
                        }
                        }   
                        else
                        {
                            session()->flash('message','Sorry, This Product  is  out of stock.');
                        }    
                    }
                      
                }
            }
            else
            {
                session()->flash('message','Sorry , this product is out of stock');
            }
        }
        else
        {
            session()->flash('message','Please login to add to cart');

        }

    }

    public function mount($category,$product)
    {
        $this->category = $category;
        $this->product = $product;

    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
        'category'=> $this->category,
        'product'=> $this->product
        ]);
    }
}
