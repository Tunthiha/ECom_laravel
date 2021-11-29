@extends('Admin.layout.master')
@section('content')

<div>
    <a href="{{route('coupon.create')}}" class="btn btn-success">Create Coupon</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Expiration Date</th>
            <th>Discount</th>
            <th>Created at</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($cupon as $c)

        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
            <td>{{$c->Expire_date}}</td>
            <td>{{$c->discount}}</td>
            <td>{{$c->created_at->format('Y-m-d')}}</td>
            <td>
                <a href="{{route('coupon.edit',$c->id)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('coupon.destroy',$c->id)}}" class="d-inline"
                    onsubmit="return confirm('are you sure?')" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete" name="" id="">
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{$cupon->links("pagination::bootstrap-4")}}
@endsection


