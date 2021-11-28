<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Size;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $productByPrice = Product::orderBy('price','desc')->with('image')->paginate(6);
        $productByRecent = Product::orderBy('created_at','desc')->with('image')->paginate(6);


        return view('welcome', compact('productByPrice','productByRecent'));

    }
    public function search(Request $request)
    {
        if(trim($request->search) == ""){
            return redirect()->back();
        }
        $product = Product::latest()->with('category');
        if ($request->search) {
            $search =   $request->search;
            $product->where('name', 'like', "%{$search}%")->get();
            $productfilters = $product->where('name', 'like', "%{$search}%")->with('color','size')->get();

            // filter color only by product name
            $Colorfilter = array();
            foreach($productfilters as $p){
                foreach ($p->color as $p_c) {
                    array_push($Colorfilter,$p_c->id);
                }
            }
            $colorinproduct = Color::whereIn('id',$Colorfilter)->get();

            // filter color only by product name
            $Sizefilter = array();
            foreach($productfilters as $p){
                foreach ($p->size as $p_s) {
                    array_push($Sizefilter,$p_s->id);
                }
            }
            $sizeinproduct = Size::whereIn('id',$Sizefilter)->get();
            }

            //filter search
        if ($request->color) {
            $id = $request->color;

            $product->whereHas('color', function ($query) use ($id) {
                return $query->where('color_product.color_id', $id);
            });
        }

        if ($request->Size) {
            $id = $request->Size;

            $product->whereHas('size', function ($query) use ($id) {
                return $query->where('size_product.size_id', $id);
            });
        }

        $products= $product->with('image')->paginate(6);
        $products->appends($request->all());
        return view('search.search', compact('products', 'colorinproduct', 'sizeinproduct'));
    }
    public function detaill($id)
    {
         $product = Product::where('id',$id)->with('image','category','size','color')->first();
        return view('product.productdetail',compact('product'));
    }
    // public function hello()
    // {
    //     return view('hello');
    // }
}
