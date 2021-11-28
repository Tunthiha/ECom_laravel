@extends('layout.master')

@section('content')
<style>
   .inumber-decrement,.number-increment,.btn_3{
       cursor: pointer;
   }

button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}

</style>

<div class="product_image_area">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
        <div class="product_img_slide owl-carousel">

            @foreach ($product->image as $img)
            <div class="single_product_img">
                <img src="{{asset('images/'.$img->img_url)}}" alt="#" class="img-fluid">
            </div>
            @endforeach

        </div>
        </div>
        <div class="col-lg-8">
            <form action="{{route('addtocart')}}" method="POST" >
                @csrf
                <div class="single_product_text text-center">
                    <h3>{{$product->name}}</h3>
                    <p>
                    {!!$product->description!!}
                    </p>
                    <input type="hidden" name="id" value="{{$product->id}}" >
                    <div class="card_area">
                        <div class="product_count_area">

                            @if($product->total_quantity == 0)

                                <h5>This item is out of Stock. Please come back later</h5>

                            @else
                            <p>Quantity : {{$product->total_quantity}}</p>
                            <div class="product_count d-inline-block">
                                <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                <input class="product_count_item input-number" name="quantity" readonly type="text" value="1" min="1" max="{{$product->total_quantity}}">
                                <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                            </div>
                            <p>{{$product->price}} Kyats</p>
                            @endif


                        </div>
                        @if ($product->total_quantity !== 0)
                        <div class="add_to_cart">
                            <input type="submit" class="genric-btn success circle large @guest
                            disable
                            @endguest" value="add to cart" @guest
                                disabled
                            @endguest>
                        </div>
                        @else
                        <button type="button" class="genric-btn primary circle large"><a href="{{route('welcome')}}">Back</a></button>
                        @endif


                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
</div>
@endsection
