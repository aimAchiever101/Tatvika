@extends('layouts.app')

@section('title','Home Page') 

@section('content')

<div id="carouselExampleCaptions" class="carousel slide">
  
  <div class="carousel-inner">

    @foreach($sliders as $key => $sliderItem)
        <div class="carousel-item {{ $key == 0 ? 'active':''}}">
            @if($sliderItem->image)
            <img src="{{ asset($sliderItem->image)}}" class="d-block" style="height:90vh; width:95vw; margin-left:35px;" alt="...">
            @endif
            <!-- <div class="carousel-caption d-none d-md-block">
                <h5>{{ $sliderItem->title}}</h5>
                <p>{{ $sliderItem->description}}</p>            
            </div> -->
            <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h1>
                            {{ $sliderItem->title}}
                        </h1>
                        <p>
                             {{ $sliderItem->description}}
                        </p>
                        <div>
                            <a href="{{url('collections')}}" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    @endforeach
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h4>Welcome to Tatvika</h4>
        <div class="underline"></div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, dolorem! Quae autem, labore 
          possimus nemo expedita corrupti, nisi quia reprehenderit ratione asperiores recusandae quam 
          aut nesciunt omnis sapiente deleniti ad.
          Lorem ipsum dolor sit amet consectetur 
          adipisicing elit. Consequuntur nemo fuga dolore error hic nostrum sint facilis laborum 
          magnam dolorem.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- owl carasoul -->
<div class="py-5 bg-white">
  <div class="container">
    <div class="row"> 
      
      <div class="col-md-12">
        <h4>Trending products</h4>
        <div class="underline"></div>
      </div>  

      @if($trendingProducts)
      <div class="col-md-12">
        <div class="owl-carousel owl-theme home-carousel">
        @foreach($trendingProducts as $productItem)

         <div class="item">
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
                  <strike><span class="original-price" >₹{{$productItem->original_price}}</span></strike>
                </div>
            </div>
          </div>
         @endforeach                 
        </div>   
      </div>
      @else              
      <div class="col-md-12">
        <div class="p-2">
            <h4>No products available</h4>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>


<!-- owl carasoul -->

<!-- another one for new arrivals -->

<div class="py-5 bg-white">
  <div class="container">
    <div class="row"> 
      
      <div class="col-md-12">
        <h4>
          New Arrivals
          <a href="{{url('new-arrivals')}}" class="btn btn-warning float-end">view more</a>
        </h4>
        <div class="underline"></div>
      </div>  

      @if($newArrivalsProducts)
      <div class="col-md-12">
        <div class="owl-carousel owl-theme home-carousel">
        @foreach($newArrivalsProducts as $productItem)

         <div class="item">
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
                  <strike><span class="original-price" >₹{{$productItem->original_price}}</span></strike>
                </div>
            </div>
          </div>
         @endforeach                 
        </div>   
      </div>
      @else              
      <div class="col-md-12">
        <div class="p-2">
            <h4>N0 newly Arrived products available</h4>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
<!-- new arrival carasoul ends here  -->


<!-- another one for featured products -->

<div class="py-5 ">
  <div class="container">
    <div class="row"> 
      
      <div class="col-md-12">
        <h4>
          Featured Products
          <a href="{{url('featured-products')}}" class="btn btn-warning float-end">view more</a>

        </h4>
        <div class="underline"></div>
      </div>  

      @if($featuredProducts)
      <div class="col-md-12">
        <div class="owl-carousel owl-theme home-carousel">
        @foreach($featuredProducts as $productItem)

         <div class="item">
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
                  <strike><span class="original-price" >₹{{$productItem->original_price}}</span></strike>
                </div>
            </div>
          </div>
         @endforeach                 
        </div>   
      </div>
      @else              
      <div class="col-md-12">
        <div class="p-2">
            <h4>No Featured products available</h4>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $('.home-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>


@endsection