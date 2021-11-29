<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupon = Cupon::latest()->paginate(10);
        return view('admin.cupon.index', compact('cupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => "required",
                'discount'=>"required",
                'exp_date'=>"required"
            ]);
            Cupon::create([

                'name' => $request->name,
                'discount'=>$request->discount,
                'Expire_date'=>$request->exp_date
            ]);

            return redirect()->back()->with('success', 'Category Created Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $coupon = Cupon::find($id);
        if ($coupon) {
            return view('admin.cupon.edit', compact('coupon'));
        }
        return redirect()->back()->with('danger', 'cupon Not Found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cupon $coupon)
    {
        $request->validate([
            'name' => "required",
            'discount'=>"required",
            'exp_date'=>"required"
        ]);
        $coupon->name=$request->name;
        $coupon->discount=$request->discount;
        $coupon->Expire_date=$request->exp_date;
        $coupon->save();
        return redirect()->back()->with('success', 'Coupon Updated Success!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupon $coupon)
    {

        Cupon::where('id', $coupon->id)->delete();
        return redirect()->back()->with('success', 'Deleted Success.');
    }
}
