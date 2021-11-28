<?php

namespace App\Http\Controllers;

use App\Models\Addtocart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeorder(Request $request)
    {
        //stock check
        $cart= Addtocart::where('user_id',Auth::user()->id)->with('product')->get();
        foreach($cart as $s){

            $product =Product::where('id',$s->product_id)->first();
            if($product->total_quantity ==  0)
            {
                return redirect()->back()->with('danger', 'Max quantity for ' . $s->product->name . ' is ' . $s->product->total_quantity . " Please Remove From Cart ");
            }
            if($product->total_quantity < $s->quantity){
                return redirect()->back()->with('danger', 'Max quantity for ' . $s->product->name . 'is' . $s->product->total_quantity);
            }
        }
        $Itemsincart= Addtocart::where('user_id',Auth::user()->id)->with('product')->get();
        foreach($Itemsincart as $c){


            Order::create([
                'user_id' => auth()->id(),
                'product_id' => $c->product_id,
                'quantity' => $c->quantity,
                'total_price' => $c->quantity * $c->product->price
            ]);
            //stock delete
            $product =Product::where('id',$c->product_id)->first();

            $stock_qty=$product->total_quantity;

            $product->total_quantity= $stock_qty - $c->quantity;
            // dd($product->total_quantity);
            //var_dump($product->total_quantity);

            $product->save();
        }
        Addtocart::where('user_id', auth()->id())->delete();
        return redirect()->route('showorder');
    }
    public function showorder()
    {
        $status = request()->status;
        $order = Order::where('user_id', auth()->id())->with('product')->latest();


        if ($status == 'success') {
            $order->where('status', $status);
        }
        if ($status == 'pending') {
            $order->where('status', $status);
        }
        if ($status == 'cancel') {
            $order->where('status', $status);
        }
        $order = $order->get();
        foreach($order as $c){
            $imagesincart = Image::Where('product_id',$c->product->id)->first();

            $c['img'] = $imagesincart['img_url'];
        }


        return view('order.order', compact('order'));
    }


}
