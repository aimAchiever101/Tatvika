<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // for delete modal
    // public $category_id;

    // public function deleteCategory($category_id)
    // {
    //     // dd($category_id);
    //     $this->category_id = $category_id;
    //     // dd($category_id);

    // }

    // public function destroyCategory(){
       
    //     $category=Category::find($this->category_id);
    //     dd($category_id);
    //     $path ='uploads/category/'.$category->image;
    //     if(File::exists($path)){
    //         File::delete($path);
    //     }
    //     $category->delete();
    //     session()->flash('message','Category Deleted');
    // }
    // 
        //  public $showModal = false;

        //     protected $listeners = [
        //     'openModal' => 'showModal',
        //     ];

        //     public function showModal()
        //     {
        //      $this->showModal = true;
        //      }

    // 
    public function render()
    {
        $categories=Category::orderBy('id','ASC')->paginate(10);
        return view('livewire.admin.category.index', ['categories'=> $categories]);
    }
     public function delete($id){
        Category::destroy($id);
        session()->flash('message','Category Deleted');
     }
}
