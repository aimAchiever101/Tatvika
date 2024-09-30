@extends('layouts.admin')

@section('title','My orders') 

@section('content')
  
    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-4">My Orders</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Filter By Date</label>
                                    <input type="date" name="date" value="{{Request::get('date') ?? date('y-m-d')}}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Filter By Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Select All Status</option>
                                        <option value="in progress"{{ Request::get('status') =='in progress' ? 'selected':''}}>In progress</option>
                                        <option value="completed"{{ Request::get('status') =='completed' ? 'selected':''}}>Completed</option>
                                        <option value="pending"{{ Request::get('status') =='pending' ? 'selected':''}}>Pending</option>
                                        <option value="cancelled"{{ Request::get('status')=='cancelled' ? 'selected':''}}>Cancelled</option>
                                        <option value="out-for-delivery"{{Request::get('status')=='out-for-delivery' ? 'selected':''}}>Out for Delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>Username</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered date</th>
                                        <th>Status message</th>
                                        <th>Action</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    @forelse($orders as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->fullname}}</td>
                                        <td>{{$item->payment_mode}}</td>
                                        <td>{{$item->created_at->format('d-m-y')}}</td>                                        
                                        <td>{{$item->status_message}}</td>
                                        <td><a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">No orders available</td>
                                    </tr>
                                    @endforelse
                                    <tr></tr>
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                       
                </div>
            </div>
        </div>

@endsection