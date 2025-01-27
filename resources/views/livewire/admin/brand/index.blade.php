<div>
    <!-- including modal-form in the file -->
@include('livewire.admin.brand.modal-form')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Brand List
                <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addBrandModal" >Add Brand</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($brands))
                        @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                @if($brand->category)
                                    {{ $brand->category->name }}
                                @else
                                    No category
                                @endif
                            </td>
                            <td>{{ $brand->slug }}</td>
                            <td>{{ $brand->status == '1' ? 'hidden':'visible' }}</td>
                            <td>
                                <a href="#"wire:click="editBrand('{{$brand->id}}')"
                                 data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-success">Edit</a>
                                <button wire:click="delete({{ $brand['id']}})" type="button" class="btn btn-sm btn-danger">Delete</button>  
                                
                                <!-- <a href="#"wire:click="deleteBrand('{{$brand->id}}')" -->
                                 <!-- data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-sm btn-danger">Delete</a> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan='5'>No  brands found</td>
                        </tr>
                        @endforelse
                        @else
                            <p>No brands found.</p>
                        @endif
                    </tbody>
                </table>
                <!-- for pagination -->
                <div>
                    {{$brands->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- to use script so that modal closes itself automatically  -->
@push('script')
<script>
     window.addEventListener('close-modal',event =>{
        $('#addBrandModal').modal('hide');
        $('#BrandModal').modal('hide');
    });
</script>
   
@endpush
