@extends('admin.layout.master')
@section('content')

<div>
    <a href="{{route('color.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('color.update',$color->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Enter Color</label>
        <input type="text" value="{{$color->name}}" name="name" class="form-control" id="">
    </div>
    <input type="submit" class="btn btn-danger" value="Update">
</form>
@endsection
