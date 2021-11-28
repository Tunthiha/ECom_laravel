@extends('layout.master')

@section('content')
<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-12 col-md-12">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Hello ! <br>
                            Please Sign up now</h3>
                        <form class="row contact_form" action="{{route('register')}}" method="POST" novalidate="novalidate" >
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Username">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" value=""
                                    placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" value=""
                                    placeholder="Password">
                            </div>
                            <div class="col-md-12 form-group">
                               <input type="submit" class="btn_3" value="register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
