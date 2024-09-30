<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';

    public $brand_id;
    public $name;
    public $slug;
    public $status;
    public $category_id;

    public function rules(){
        return[
            'name' => 'required|string',
            'slug' => 'required|string',
            'status'=>'nullable',
            'category_id' =>'required|integer',
        ];
    }
     
    public function resetInput(){
        $this->name=NULL;
        $this->slug=NULL;
        $this->status=NULL;
        $this->brand_id=NULL;
        $this->category_id=NULL;

    } 

    public function storeBrand(){
        $validatedData = $this->validate();
        Brand::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1' : '0',
            'category_id'=>$this->category_id,
        ]);
        session()->flash('message','Brand Added Successfully');

        function dispatchBrowserEvent($event, $data = null){
                $this->dispatchBrowserEvent('close-modal'); 
        }

            $this->resetInput();
   }

    public function closeModal()
    {
      $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findorFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;

    }
    
    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findorFail($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1' : '0',
            'category_id'=>$this->category_id,
        ]);
        session()->flash('message','Brand Updated Successfully');

        function dispatchBrowserEvent($event, $data = null){
            $this->dispatchBrowserEvent('close-modal'); 
        }
            $this->resetInput();
        
    }

    // public function deleteBrand($brand_id)
    // {
    //     $this->brand_id= $brand_id;
    // }

    // public function destroyBrand($brand_id){
    //     Brand::findOrFail($brand_id)->delete();
    //     session()->flash('message','Brand Deletted Successfully');
    //     $this->dispatchBrowserEvent('close-model');
    //     $this->resetInput();
    // }

    public function render()
    {
        $categories = Category::where('status','0')->get();
        $brands=Brand::orderBy('id','ASC')->paginate(5);
        return view('livewire.admin.brand.index',['brands' =>$brands,'categories'=> $categories])
        ->extends('layouts.admin')
        ->section('content');
    }
    
    public function delete($id){
        Brand::destroy($id);
        session()->flash('message','brand Deleted');
     }
}


