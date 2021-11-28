@extends('admin.layout.master')
@section('css')
<style>
    img{
        height: 200px;
        width: 200px;
    }
    #selectedFiles img {
            max-width: 350px;
            max-height: 200px;
            float: ;
            margin-bottom: 10px;
        }

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')

<div>
    <a href="{{route('product.index')}}" class="btn btn-dark">Back</a>
</div>
<hr>

<form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Choose Category</label>
        <select name="category_id" id="" class="form-control">
            @foreach ($category as $c)
            <option value="{{$c->id}}" @if($c->id == $product->category->id) selected @endif
                >{{$c->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Choose Size</label>
        <select name="size_id[]" multiple id="size">
            @foreach ($size as $z)
            <option value="{{$z->id}}" @foreach ($product->size as $pz) @if($z->id==$pz->id) selected @endif
                @endforeach

                >{{$z->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Choose Color</label>
        <select name="color_id[]" multiple id="color">
            @foreach ($color as $z)
            <option value="{{$z->id}}" @foreach($product->color as $pc)
                @if($pc->id==$z->id) selected @endif
                @endforeach
                >{{$z->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Enter Title</label>
        <input type="text" name="name" value="{{$product->name}}" class="form-control" id="">
    </div>


    <div id="input-images">
        <div class="row">
            <div class="col-md-3 col-12">
                <input type="button" value="Clear" id="btn_clear" class="btn btn-danger">
            </div>
            <div class="col-md-3 col-12" style="padding-top:10px;">
                <input id="files" name="images[]"  type="file" multiple>
            </div>
        </div>

        <div class="col-12">

            <div id="selectedFiles">
                @foreach ($images as $image)

        <img src="{{asset('images/'.$image->img_url)}}" width="200" alt="">
        @endforeach
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="">Total Qty</label>
        <input type="number" value="{{$product->total_quantity}}" name="total_quantity" class="form-control" id="">
    </div>

    <div class="form-group">
        <label for="">Price</label>
        <input type="number" name="price" value="{{$product->price}}" class="form-control" id="">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ $product->description }}</textarea>
    </div>


    <input type="submit" class="btn btn-primary" value="Edit">
</form>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // $('.note-editor').css('font-size','18px');

        $("#files").on("change", handleFileSelect);
        selDiv = $("#selectedFiles");
    });
    let selDiv = "";
    function handleFileSelect(e) {
        var storedFiles = [];
        $('#selectedFiles').html("");
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        var device = $(e.target).data("device");
        filesArr.forEach(function(f) {
            if (!f.type.match("image.*")) {
            return;
            }
            storedFiles.push(f);
            var reader = new FileReader();
            reader.onload = function(e) {
            var html = "<div ><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile ' title=''>" + f.name + "<br clear=\"left\"/></div>";
            $("#selectedFiles").append(html);
            }
            reader.readAsDataURL(f);
        });
    }
    $('#btn_clear').click(function() {
        storedFiles = [];
        $('#files').val("");
        $('#selectedFiles').html("");
    });
    $(function(){
        $('#size').select2();
        $('#color').select2();
        $('#description').summernote({
            height:300
        });
    });

</script>

@endsection
