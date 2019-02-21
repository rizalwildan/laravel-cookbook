<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Alert;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'category_name' => 'required'
        ]);

        $category = new Categories;
        $category->category_name = $request->input('category_name');

        if ($category->save()) {
            Alert::success('Category Created', 'Success');
        } else {
            Alert::error('Create category failed', 'Error');
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Categories::whereSlug($id)->get()->toArray()[0];

        return view('backend.category.form')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Categories::findOrFail($id);
        $category->category_name = $request->input('category_name');

        if ($category->save()) {
            Alert::success('Category updated', 'Success');
        } else {
            Alert::error('Failed update category', 'Error');
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Categories::findOrFail($id);
        $data->delete();
    }

    public function getDataCategory()
    {
        $data = Categories::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <a class="btn btn-square btn-primary" 
                    href="'.route('admin.category.edit', ['category' => $data->slug]).'">Edit</a>   
                <button class="btn btn-square btn-danger" id="category-delete"
                    data-uri="'.route('admin.category.destroy', ['category' => $data->id]).'">Delete</button>
                ';
            })
            ->make(true);
    }
}
