@extends('Admin.layout.master')
@section('content')

<div>
    <a href="{{route('size.create')}}" class="btn btn-success">Create size</a>
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
        @foreach ($size as $c)
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
            <td>
                <a href="{{route('size.edit',$c->id)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('size.destroy',$c->id)}}" class="d-inline"
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

{{$size->links("pagination::bootstrap-4")}}
@endsection


