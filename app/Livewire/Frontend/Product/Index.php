<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInput;
    
    // for filtering by brands using query strings
    protected $queryString = [
        'brandInputs'=>['except'=>'' , 'as' =>'brand'],
        'priceInput'=>['except'=>'' , 'as' =>'price']
    ]; 

    public function mount($category)
    {
        $this->category = $category;
    }

    public function applyFilter()
    {
        $this->products = Product::where('category_id',$this->category->id)
            ->when($this->brandInputs,function($q){
            $q->whereIn('brand',$this->brandInputs);
            })
            ->where('status','0')
            ->get();
    }
    public function applyFilter2()
    {
        $this->products = Product::where('category_id',$this->category->id)
        ->when($this->priceInput,function($q){
            $q->when($this->priceInput == "high to low", function($q2){
                    $q2->orderBy('selling_price','DESC');
                })
                ->when($this->priceInput == "low to high", function($q2){
                    $q2->orderBy('selling_price','ASC');
                });    
        })
        ->where('status','0')
        ->get();
    }

    public function render()
    {
        $this->products = Product::where('category_id',$this->category->id)
        ->when($this->brandInputs,function($q){
            $q->whereIn('brand',$this->brandInputs);
        })
        ->when($this->priceInput,function($q){
            $q->when($this->priceInput == "high to low", function($q2){
                    $q2->orderBy('selling_price','DESC');
                })
                ->when($this->priceInput == "low to high", function($q2){
                    $q2->orderBy('selling_price','ASC');
                });    
        })
        ->where('status','0')
        ->get();

        return view('livewire.frontend.product.index',[
            'products' =>$this->products,
            'category' =>$this->category,
        ]);
    }

}
