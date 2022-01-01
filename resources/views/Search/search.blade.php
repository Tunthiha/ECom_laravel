@extends('layout.master')

@section('content')
@section('style')
<style>
    .popular-items .nice-select{
        height: auto;
    }
    .card{
        flex-direction: row;
        min-width: 1000px;
    }
    .collapse{
        width: 100%;
    }

</style>
@endsection
<div class="container">
    <section class="popular-items latest-padding">
        <div class="container">

            <div class="row product-btn justify-content-between mb-40">
                <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Search</a>
                        </div>
                    </nav>
                    <!--End Nav Button  -->
                </div>
                <!-- Grid and List view -->
                <div class="grid-list-view">
                </div>
                <!-- Select items -->

            </div>
            <!-- Nav Card -->
            <form action="{{route('search')}}" method="GET" class="row">
                @csrf
                <input type="hidden" name="search" value="{{request()->search}}">
                <p>


                    <button class="genric-btn info circle" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="filter">
                      Filter
                    </button>
                  </p>
                  <div class="collapse" id="filter">
                    <h5 class="card-header">Filter Search</h5>
                    <div class="card card-body">


                                <select name="color" id="" class="form-control mx-3">
                                    <option value="">Select color</option>
                                    @foreach ($colorinproduct as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>


                                <select name="Size" id="" class="form-control mx-3">
                                    <option value="">Select Size</option>
                                    @foreach ($sizeinproduct as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>


                    <input type="submit" class="genric-btn primary-border medium mx-3">


                    </div>
                  </div>



            </form>
            <h3 class="mb-30"> Search Result : {{request()->search}} </h3>

            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        @foreach ($products as $p)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-popular-items mb-50 text-center">
                                <div class="popular-img">
                                    <img src="{{asset('images/'.$p->image[0]->img_url)}}" width="200" height="200" alt="">
                                    <a href="{{route('productdetail',$p->id)}}">
                                    <div class="img-cap">
                                        <span>Add to cart</span>
                                    </div>
                                    <div class="favorit-items">
                                        <span class="flaticon-heart"></span>
                                    </div>
                                </div>
                                <div class="popular-caption">
                                    <h3><a href="product_details.html">{{$p->name}}</a></h3>
                                    <h4>In stock : {{$p->total_quantity}}</h4>
                                    <span>{{$p->price}} Kyats</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            {{$products->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Nav Card -->
        </div>
    </section>
</div>
@endsection
