<!-- modal for deletion and it is a part of livewire component not controller so other operations will be in index.php  -->
<div>

<!-- modal ends here -->
    <div class="row">
        <div class="col-md-12">
        @if(session ('message'))
            <div class="alert alert-message">{{ session('message') }}</div>

        @endif
        <div class="card">
            <div class="card-header">
                <h3>Category
                    <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id}}</td>
                            <td>{{ $category->name}}</td>
                            <td>{{ $category->status == '1' ? 'hidden':'visible'}}</td>
                            <td>
                                <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-success">Edit</a>
                                <button wire:click="delete({{ $category['id']}})" type="button" class="btn btn-danger">Delete</button>
                                <!-- button trigerring delete modal wire:click="deleteCategory({{$category->id}})"-->
                                <!-- <a href="#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" -->
                                <!-- class="btn btn-danger">Delete</a>  -->

                                <!-- <button type="button" class="btn btn-danger" wire:click="$emit('openModal')">Delete</button> -->

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                {{ $categories->links()}}
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- to use script  -->
@push('script')

@endpush

