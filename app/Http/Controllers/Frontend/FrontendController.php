<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider1;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider1::where('status','0')->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivalsProducts = Product::latest()->take(16)->get();
        $featuredProducts = Product::where('featured','1')->latest()->take(14)->get();

        return view('frontend.index',compact('sliders','trendingProducts','newArrivalsProducts','featuredProducts'));
    }



    public function categories()
    {
        $categories = Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
    }



    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            return view('frontend.collections.products.index',compact('category'));
        }
        else{
            return redirect()->back();
        }

    }



    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            $product =$category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collections.products.view',compact('product','category'));
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function newArrivals()
    {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrivals',compact('newArrivalsProducts'));
    }


    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-products',compact('featuredProducts'));
    }


    public function searchProducts(Request $request)
    {
        if($request->search)
        {
            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(10); 
            return view ('frontend.pages.search',compact('searchProducts'));
        }
        else
        {
            return redirect()->back()->with('message','Item not found');
        }
    }


    public function thankyou()
    {
        return view('frontend.thank-you');
    }
}
