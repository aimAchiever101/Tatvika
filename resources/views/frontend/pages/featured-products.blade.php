@extends('layouts.app')

@section('title','featured products') 

@section('content')

<div class="py-5 bg-white">
  <div class="container">
    <div class="row">
      
      <div class="col-md-12">
        <h4>featured products</h4>
        <div class="underline"></div>
      </div>  

    
      
        @forelse($featuredProducts as $productItem)
        <div class="col-md-3">
                <div class="product-card">
                <div class="product-card-img">
                   <label class="stock bg-danger">New</label>
                       @if($productItem->productImages->count() > 0)
                        <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                          <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{$productItem->name}}">
                        </a>
                       @endif
                </div>
                <div class="product-card-body">
                  <p class="product-brand">{{$productItem->brand}}</p>
                     <h5 class="product-name">
                       <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                         {{$productItem->name}}
                       </a>
                     </h5>
                </div>
                <div>
                  <span class="selling-price"> ₹{{$productItem->selling_price}}</span>
                  <strike><span class="original-price">₹{{$productItem->original_price}}</span></strike>
                </div>
                </div>
        </div>
        @empty
                <div class="p-2 col-md-12">
                    <h4>No featured products available</h4>
                </div> 
        @endforelse  
        <div class="text-center">
            <a href="{{url('collections')}}" class="btn btn-warning px-3">Shop more here</a>
        </div>               
     
    
    </div>
  </div>
</div>
@endsection

