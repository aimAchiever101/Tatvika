<?php

namespace App\Livewire\Frontend;
use Illuminate\Support\Facades\Event;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        // dd($wishlistId);
        $wishlist =Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->dispatch('wishlistAddedUpdated');
        session()->flash('message','the item removed successfully');

    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}
