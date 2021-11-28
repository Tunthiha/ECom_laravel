<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $color = Color::latest()->paginate(6);
        return view('admin.color.index', compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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
            ]);
            Color::create([

                'name' => $request->name
            ]);
            return redirect()->back()->with('success', 'Color Created Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $Color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);
        if ($color) {
            return view('admin.color.edit', compact('color'));
        }
        return redirect()->back()->with('danger', 'Color Not Found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => "required",
        ]);
        Color::where('id', $id)->update([

            'name' => $request->name
        ]);
        return redirect()->back()->with('success', 'Color Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $Color
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted Success.');
    }
}
