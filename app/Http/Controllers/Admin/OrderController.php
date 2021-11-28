<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function adminshoworder()
    {


        if(request()->status)
        {
            if(request()->status == "success")
            {
                $status = request()->status;
                $order=Order::where('status',$status)->with('product','user')->paginate(10);
                $order->appends(request()->all());
                return view('admin.order.index', compact('order'));
            }
            if(request()->status == "pending")
            {
                $status = request()->status;
                $order=Order::where('status',$status)->with('product','user')->paginate(10);
                $order->appends(request()->all());
                return view('admin.order.index', compact('order'));
            }
            if(request()->status == "cancel")
            {
                $status = request()->status;
                $order=Order::where('status',$status)->with('product','user')->paginate(10);
                $order->appends(request()->all());
                return view('admin.order.index', compact('order'));
            }
        }
        else{
            $order = Order::orderby('id','desc')->with('product', 'user')->paginate(10);
            $order->appends(request()->all());
            return view('admin.order.index', compact('order'));
        }


    }
    public function approve()
    {

        $status = request()->status;
        $product_id=request()->product_id;

        $order_id = request()->order_id;
        $orderr = Order::where('id',$order_id)->first();
        $restock = $orderr->quantity;

        Order::where('id', $order_id)->update([
            'status' => $status
        ]);

        if($status == "cancel"){
            $product = Product::where('id',$product_id)->first();
            $product->total_quantity = $product->total_quantity + $restock;
            $product->save();
        }
        return redirect()->back()->with('success', 'Change Order Status Success');
    }
    // public function orderlist()
    // {
    //     $status = request()->status;
    //     $order = Order::with('product')->latest();
    //     if ($status == 'success') {

    //         dd($order->where('status', $status));

    //     }
    //     if ($status == 'pending') {
    //         $order->where('status', $status);
    //     }
    //     if ($status == 'cancel') {
    //         $order->where('status', $status);
    //     }
    //     $order = $order->paginate(10);
    //     return view('Admin.order.index', compact('order'));
    // }
}
