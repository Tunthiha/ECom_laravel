@extends('admin.layout.master')
@section('content')


<div>
    <a href="order"> All </a>
    <a href="order?status=pending"> Pending </a>
    <a href="order?status=success"> Success </a>
    <a href="order?status=cancel"> Cancel </a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>User</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($order as $o)
        <tr>
            <td>{{$o->user->name}}</td>
            <td>{{$o->product->name}}</td>
            <td>{{$o->quantity}}</td>
            <td>{{$o->total_price}}</td>
            <td>{{$o->status}}</td>

            @if ($o->status == "pending")


            <td>



                <a href="{{url('/admin/approve?order_id='.$o->id.'&product_id='.$o->product->id.'&status=success')}}"
                    class="badge badge-success">make success</a>
                <a href="{{url('/admin/approve?order_id='.$o->id.'&product_id='.$o->product->id.'&status=cancel')}}"
                    class="badge badge-danger">make cancel</a>


            </td>
            @endif
        </tr>
        @endforeach

    </tbody>
</table>

{{$order->links("pagination::bootstrap-4")}}
@endsection
