<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider1;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public function index()
    {
        $sliders=Slider1::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

  
    public function store(SliderFormRequest $request )
    {
        // dd($request);
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }
        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider1::create([
            'title'=>$validatedData['title'],
            'description'=>$validatedData['description'],
            'image'=>$validatedData['image'],
            'status'=>$validatedData['status']
        ]);
        return redirect('admin/slider')->with('message','Slider added successfully');
    }

     public function edit(Slider1 $slider){

        return view('admin.slider.edit',compact('slider'));
        
     }


     public function update(SliderFormRequest $request, Slider1 $slider){

        // return $slider;
        $validatedData = $request->validated();
            if($request->hasFile('image')){
                
                $destination = $slider->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/slider/',$filename);
                $validatedData['image'] = "uploads/slider/$filename";
            }
            $validatedData['status'] = $request->status == true ? '1':'0';
    
            Slider1::where('id',$slider->id)->update([
                'title'=>$validatedData['title'],
                'description'=>$validatedData['description'],
                'image'=>$validatedData['image'] ?? $slider->image,
                'status'=>$validatedData['status']
            ]);
            return redirect('admin/slider')->with('message','Slider updated successfully');
     }

      public function destroy ( Slider1 $slider)
      {
        if($slider->count() > 0){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
             $slider->delete();
        return redirect()->back()->with('message','slider deleted');
        }
        return redirect()->back()->with('message','something went wrong');
      }
}
