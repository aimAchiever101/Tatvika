@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- using put method to update the record -->
                    @method('PUT')
                    <div class="row">
                        <div class=" col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                            <div class="text-danger">@error('name'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
                            <div class="text-danger">@error('slug'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Description</label>
                            <input type="text" name="description" value="{{ $category->description }}" class="form-control">
                            <div class="text-danger">@error('description'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label><!----->
                            <input type="file" name="image"class="form-control">
                            <img src="{{ asset('/uploads/category/'.$category->image) }}"  width="60px" height="60px" alt="">
                            <div class="text-danger">@error('image'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label></br>
                            <input type="checkbox" name="status" value="{{ $category->status == '1' ? 'checked' : '' }}" >
                            <div class="text-danger">@error('status'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title"  value="{{ $category->meta_title }}"class="form-control">
                            <div class="text-danger">@error('meta_title'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Keyword</label>
                            <textarea type="text" name="meta_keyword"  class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                            <div class="text-danger">@error('meta_keyword'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Description</label>
                            <textarea type="text" name="meta_description"  class="form-control" rows="3">{{ $category->meta_description}}</textarea>
                            <div class="text-danger">@error('meta_description'){{$message}}@enderror</div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>  
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection