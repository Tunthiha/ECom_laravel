@extends('Admin.layout.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')

<div>
    <h1>Coupon Create</h1>
    <a href="{{route('coupon.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('coupon.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Enter Cupon</label>
        <input type="text" required name="name" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Discount</label>
        <input type="number" required name="discount" max="100" class="form-control" id="">
    </div>
    <div class="form-group">
        <label for="">Date</label>
        <input type="datetime-local" required name="exp_date"  class="form-control" placeholder="pick a date"id="expdate">
    </div>

    <input type="submit" class="btn btn-danger" value="Create">
</form>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // config = {
    //     enableTime:true,
    //     dateFormat:"Y-m-d",
    // }
    flatpickr("#expdate", {});

</script>
@endsection
