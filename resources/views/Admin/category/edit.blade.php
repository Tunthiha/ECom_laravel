@extends('admin.layout.master')
@section('content')

<div>
    <a href="{{route('category.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('category.update',$category->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Enter Category</label>
        <input type="text" value="{{$category->name}}" name="name" class="form-control" id="">
    </div>
    <input type="submit" class="btn btn-danger" value="Update">
</form>
@endsection
