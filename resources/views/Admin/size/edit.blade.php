@extends('admin.layout.master')
@section('content')

<div>
    <a href="{{route('size.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('size.update',$size->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Enter Size</label>
        <input type="text" value="{{$size->name}}" name="name" class="form-control" id="">
    </div>
    <input type="submit" class="btn btn-danger" value="Update">
</form>
@endsection
