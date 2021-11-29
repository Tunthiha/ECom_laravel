@extends('Admin.layout.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')

<div>
    <h1>Coupon Create</h1>
    <a href="{{route('coupon.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>


<form action="{{route('coupon.update',$coupon->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Enter Category</label>
        <input type="text" value="{{$coupon->name}}" name="name" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Discount</label>
        <input type="number" value="{{$coupon->discount}}" required name="discount" max="100" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Date</label>
        <input type="datetime-local" value="{{$coupon->Expire_date}}"required name="exp_date"  class="form-control" placeholder="pick a date"id="expdate">
    </div>
    <input type="submit" class="btn btn-danger" value="Update">
</form>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

    flatpickr("#expdate", {

        defaultDate: ["{{ date('Y-m-d', strtotime($coupon->Expire_date)) }} "]

    });

</script>
@endsection
