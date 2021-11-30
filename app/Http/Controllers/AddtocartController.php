<?php

namespace App\Http\Controllers;

use App\Models\Addtocart;
use App\Models\Cupon;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddtocartController extends Controller
{
    public function addtocart(Request $request)
    {
        $product_stock= Product::where('id',$request->id)->first();
        $stock_quantity=$product_stock->total_quantity;
        $user_id=Auth::user()->id;
        $quantity= $request->quantity;
        $product_id = $request->id;
        $itemincart = Addtocart::where('product_id',$product_id)->where('user_id',$user_id)->first();
        if($itemincart)
        {
            $quantityincart = $itemincart->quantity;
            if($quantity + $quantityincart <= $stock_quantity ){
                $itemincart->quantity = $quantity + $quantityincart;
                $itemincart->save();
            }
            else{
                return redirect()->back()->with('danger','not enough quantity');
            }
        }
        else{
            if($quantity > $stock_quantity){
                return redirect()->back()->with('danger','not enough quantity in stock');
            }
            Addtocart::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'quantity'=>$quantity
            ]);
        }
        return redirect()->back()->with('success', 'Added To Cart!');
    }
    public function cart()
    {
        $percentage=0;
        $user_id=Auth::user()->id;
        $cart = Addtocart::where('user_id',$user_id)->with('product')->get();
        $images = Image::all();
        foreach($cart as $c){
            $imagesincart = Image::Where('product_id',$c->product->id)->first();

            $c['img'] = $imagesincart['img_url'];
        }

        $total_qty=0;
        foreach ($cart as $c) {
            $total_qty += $c->quantity * $c->product->price;
        }
        return view('cart.cart', compact('cart','images','total_qty','percentage'));
    }
    public function update_cart(){
        $stock_id = request()->pid;

        $product = Product::where('id',$stock_id)->first();

        $stock_qty= $product->total_quantity;
        if(request()->quantity > $stock_qty)
        {
            return response()->json([ 'quantity'=> $stock_qty,'name' => $product->name,'message' => 'error']);
        }
        else{
            Addtocart::where('id', request()->id)->update([
                'quantity' => request()->quantity
            ]);
            return response()->json([ 'quantity'=> request()->quantity,'name' => $product->name,'message' => 'success']);

        }
    }
    public function delete_cart($id)
    {
        Addtocart::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted Success.');
    }
    public function apply_coupon(Request $request)
    {

        $coupon = Cupon::where('name',$request->coupon)->first();

        // dd($coupon->Expire_date);
        if(!$coupon)
        {
            return redirect()->back()->with('danger','invalid coupon code');
        }
        if(date("Y-m-d") >= $coupon->Expire_date)
        {
            return redirect()->back()->with('danger','Coupon Code has been expired');
        }
        $user_id=Auth::user()->id;
        $cart = Addtocart::where('user_id',$user_id)->with('product')->get();
        //images fetch
        foreach($cart as $c){
            $imagesincart = Image::Where('product_id',$c->product->id)->first();

            $c['img'] = $imagesincart['img_url'];
        }

        $total_qty=0;
        foreach ($cart as $c) {
            $total_qty += $c->quantity * $c->product->price;
        }
        $percentage= 100 / $coupon->discount ;
        $discount = $total_qty / $percentage;

        $total_qty = $total_qty - $discount;

        return view('cart.cart', compact('cart','total_qty','percentage'));
    }
}
