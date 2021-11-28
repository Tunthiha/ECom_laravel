@extends('Admin.layout.master')
@section('content')

<div>
    <a href="{{route('category.create')}}" class="btn btn-success">Create Category</a>
</div>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($category as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
            <td>
                <a href="{{route('category.edit',$c->id)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('category.destroy',$c->id)}}" class="d-inline"
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

{{$category->links("pagination::bootstrap-4")}}
@endsection


