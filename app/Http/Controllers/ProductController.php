<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category','color','size')->orderby('id','desc')->paginate(10);

         return view('admin.product.index', compact('product'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category =  Category::all();
        $size = Size::all();
        $color = Color::all();

        return view('admin.product.create', compact('category', 'size', 'color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //try {
            $request->validate([
                'name' => "required",

                'category_id'=>"required",
                'size_id'=>"required",
                'color_id'=>"required",
                'total_quantity'=>'required',
                'price' => 'required',
                'images'=>'required',
                'images. *' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


            ]);


            $product = Product::create([

                'name' => $request->name,
                'category_id'=>$request->category_id,
                'total_quantity'=>$request->total_quantity,
                'price' =>$request->price,
                'description'=>$request->description,
                'user_id'=>Auth::user()->id

            ]);
            $product->color()->sync($request->color_id);
            $product->size()->sync($request->size_id);

            // Multiple images save
            $files = $request->file('images');
            foreach($files as $file){
                $images = new Image();
                $file_name=uniqid() . $file->getClientOriginalName();
                $images->img_url= $file_name;
                $images->product_id=$product->id;
                $images->save();

                $file->move(public_path('/images'), $file_name);
            }


            return redirect()->back()->with('success', 'Product Created Success');
       // }
        // catch (\Exception $e) {
        //     //return $e->getMessage();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $product = Product::where('id',$id)->with('category','color','size')->first();
        $images = Image::where('product_id',$id)->get();
        $category =  Category::all();
        $size = Size::all();
        $color = Color::all();
        return view('admin.product.edit', compact('category', 'size', 'color','product','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => "required",
            'category_id'=>"required",
            'size_id'=>"required",
            'color_id'=>"required",
            'total_quantity'=>'required',
            'price' => 'required',
            'images. *' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product_id=$product->id;
        if($request->file('images')){
            dd("image");
            //old images delete
            $images_delete = Image::where('product_id',$product->id)->get();
            foreach ($images_delete as $_img_delete ) {
                File::delete(public_path('images/' .$_img_delete->img_url ));
                $_img_delete->delete();
            }
            //images save
            $files = $request->file('images');
            foreach($files as $file){
                $images = new Image();

                $file_name=uniqid() . $file->getClientOriginalName();
                $images->img_url= $file_name;
                $images->product_id=$product->id;
                $images->save();
                $file->move(public_path('/images'), $file_name);
            }
            $product = Product::where('id',$product->id);
            $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'total_quantity' => $request->total_quantity,
            'price' => $request->price,
            'description' => $request->description,
            ]);
            $product = Product::find($product->first()->id);
            $product->color()->sync($request->color_id);
            $product->size()->sync($request->size_id);
        }
        else{


            $product = Product::where('id',$product->id);

            $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'total_quantity' => $request->total_quantity,
            'price' => $request->price,
            'description' => $request->description,
            ]);

            $product = Product::find($product_id);

            $product->color()->sync($request->color_id);
            $product->size()->sync($request->size_id);
        }
        return redirect()->route('product.index')->with("success","The product has been updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images_delete = Image::where('product_id',$product->id)->get();
            foreach ($images_delete as $_img_delete ) {
                File::delete(public_path('images/' .$_img_delete->img_url ));
                $_img_delete->delete();
            }

        Product::where('id', $product->id)->delete();

        return redirect()->back()->with('success', 'Deleted Success.');
    }
}
