@extends('layout.master')


@section('content')

<section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($cart as $c)
            <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                        <img src="{{asset('images/'.$c->img)}}" width="200" height="150" alt="">
                    </div>
                    <div class="media-body">
                      <p>{{$c->product->name}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>{{$c->product->price}}</h5>
                </td>
                <td>
                  <div class="product_count">
                    <input type="number" min="1" max="{{$c->product->total_quantity}}" name="quantity[]" onchange="{{$c->product->id}}"  data-id={{$c->id}} data-pid={{$c->product->id}} value="{{$c->quantity}}" class="quanty input-number" >
                  </div>
                </td>
                <td>
                  <h5 id="total" value="{{$c->product->price * $c->quantity}}">{{$c->product->price * $c->quantity}}</h5>
                </td>
                <td>
                    <form action="{{route('delete-cart',$c->id)}}" class="d-inline"
                        onsubmit="return confirm('are you sure?')" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="genric-btn primary small" value="Delete" name="" id="">
                    </form>
                </td>
              </tr>
            @endforeach






              <tr>
                <td>
                    @if ((count($cart)) == 0)
                    <div><h3>There is no items in cart </h3></div>
                    @endif
                </td>
                <td></td>
                <td>
                  <h5>Total</h5>
                </td>
                <td>
                  <h5>{{$total_qty}}</h5>
                </td>
              </tr>


            </tbody>
          </table>

          <form action="{{route('applycoupon')}}" method="post">
            @csrf
            <tr class="">
              <td>
                <input type="text" name="coupon" class="form-control" placeholder="Apply Coupon Here">
              </td>
              <td></td>
              <td></td>
              <td>

                  <button type="submit"> apply</button>

              </td>
            </tr>
        </form>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="{{route('welcome')}}">Continue Shopping</a>
            <form action="{{route('makeorder')}}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="percentage" value="{{ $percentage }}">
            <input type="submit" class="btn_1 checkout_btn_1" value="Proceed to Order">
            </form>

          </div>
        </div>
      </div>
  </section>
@endsection
@section('script')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function () {

      var quantity= null

            $(".quanty").change(function (e) {

            this.quantity = $(this).val();
            var id = $(this).attr("data-id")
            var pid = $(this).attr("data-pid")
            console.log(this.quantity);
            console.log(id);
            console.log(pid);
            axios.post('{{route('update-cart')}}', {
            quantity:this.quantity,id:id,pid:pid
            }).then(function (response) {
                if(response.data.message === "error")
                {
                location.reload();
                alert("Max stock Number for " + response.data.name + " is : " + response.data.quantity)
                }
                else{
                location.reload();
                }
                }).catch(function (error) {
                console.log(error);
                });

            // }
        })


    })


</script>
@endsection
