@extends('Admin.layout.master')
@section('content')

<div>
    <a href="{{route('product.create')}}" class="btn btn-success">Create Product</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Color</th>
            <th>Size</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($product as $c)
        <tr>

            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
            <td>{{$c->category->name}}</td>
            <td>
                @foreach ($c->color as $cc)
                <span class="badge badge-primary">{{$cc->name}}</span>
                @endforeach
            </td>
            <td>
                @foreach ($c->size as $s)
                <span class="badge badge-primary">{{$s->name}}</span>
                @endforeach
            </td>
            <td>
                <a href="{{route('product.edit',$c->id)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('product.destroy',$c->id)}}" class="d-inline"
                    onsubmit="return confirm('are you sure?')" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="_method" value="DELETE" />
                    <input type="submit" class="btn btn-danger" value="Delete" name="" id="">
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection


