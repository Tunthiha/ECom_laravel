<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(6);
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            Category::create([

                'name' => $request->name
            ]);
            return redirect()->back()->with('success', 'Category Created Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('admin.category.edit', compact('category'));
        }
        return redirect()->back()->with('danger', 'Category Not Found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $request->validate([
        //     'name' => "required",
        // ]);
        // Category::where('id', $id)->update([

        //     'name' => $request->name
        // ]);

        $this->validateWith([
            'name' => "required",
        ]);

        $category->name = $request->name;

        $category->save();
        return redirect()->back()->with('success', 'Category Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        Category::where('id', $category->id)->delete();
        return redirect()->back()->with('success', 'Deleted Success.');
    }
    public function filter(Request $request){
        $productByCat= Product::where('category_id',$request->id)->with('image','category')->paginate(12);
        $category_name= Category::where('id',$request->id)->first();
        return view('Admin.category.filter',compact('productByCat','category_name'));
    }
}
