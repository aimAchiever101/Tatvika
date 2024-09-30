<div>
    @if($result['success'])
    <table>
        <thead>
            <tr>
                <th>Payment_id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
@foreach($result["payment_requests"] as $payment_request)
            <tr>
                <td>
                    <a href="{{$payment_request['longurl']}}">
                        {{$payment_request['id']}}
                    </a>
                    <a href="{{url('/payment_request_details/'.$payment_request['id'])}}">
                        Get Payment Request Details
                    </a>
                </td>
                <td>
                    {{$payment_request['name']}}
                </td>
                <td>
                    {{$payment_request['phone']}}
                </td>
                 <td>
                    {{$payment_request['amount']}}
                </td>
                <td>
                    {{$payment_request['status']}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        there is no record here
    @endif

</div>
