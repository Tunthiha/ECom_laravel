{{-- @extends('admin.layout.master')

@section('content')
<h2>Your Order List</h2>
<hr>

    <div class="mb-3">
        <a href="{{url('/order')}}" class="genric-btn default circle">All</a>
        <a href="{{url("/order?status=pending")}}" class="genric-btn warning circle">Pending</a>
        <a href="{{url("/order?status=success")}}" class="genric-btn info circle">Success</a>
        <a href="{{url("/order?status=cancel")}}" class="genric-btn danger circle">Cancel</a>
    </div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $c)
        <tr>

            <td>
                <img src="{{asset($c->product->image_url)}}" style="width:50px;border-radius:30%" alt="">
            </td>
            <td>{{$c->product->name}}</td>
            <td>{{$c->quantity}}</td>
            <td>{{$c->total_price}}</td>

            <td>
                @if($c->status=='pending')
                <span class="badge badge-warning">Pending</span>
                @endif
                @if($c->status=='success')
                <span class="badge badge-success">Success</span>
                @endif
                @if($c->status=='cancel')
                <span class="badge badge-danger">Cancel</span>
                @endif
            </td>
            <td>
                {{$c->created_at}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection
<script>


</script> --}}
