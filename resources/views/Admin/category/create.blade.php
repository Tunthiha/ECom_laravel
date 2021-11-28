@extends('Admin.layout.master')
@section('content')

<div>
    <a href="{{route('category.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('category.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Enter Category</label>
        <input type="text" name="name" class="form-control" id="">
    </div>
    <input type="submit" class="btn btn-danger" value="Create">
</form>
@endsection
