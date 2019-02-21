<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ingredients;
use Alert;
use Yajra\DataTables\DataTables;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.ingredient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.ingredient.form');
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
           'ingredient_name' => 'required'
        ]);

        $ingredient = new Ingredients;
        $ingredient->ingredient_name = $request->input('ingredient_name');
        $ingredient->notes = $request->input('ingredient_notes');

        if ($ingredient->save()) {
            Alert::success('Ingredient created', 'Success');
        } else {
            Alert::error('Failed create ingredient', 'Error');
        }

        return redirect()->route('admin.ingredient.index');
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
        $data = Ingredients::whereSlug($id)->get()->toArray()[0];

        return view('backend.ingredient.form')->with('data', $data);
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
        $validate = $request->validate([
            'ingredient_name' => 'required'
        ]);

        $ingredient = Ingredients::findOrFail($id);
        $ingredient->ingredient_name = $request->input('ingredient_name');
        $ingredient->notes = $request->input('ingredient_notes');

        if ($ingredient->save()) {
            Alert::success('Ingredient updated', 'Success');
        } else {
            Alert::error('Failed update ingredient', 'Error');
        }

        return redirect()->route('admin.ingredient.index');
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
        $data = Ingredients::findOrFail($id);
        $data->delete();
    }

    public function getIngredient()
    {
        $data = Ingredients::all();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <a class="btn btn-square btn-primary" 
                    href="'.route('admin.ingredient.edit', ['ingredient' => $data->slug]).'">Edit</a>   
                <button class="btn btn-square btn-danger" id="ingredient-delete"
                    data-uri="'.route('admin.ingredient.destroy', ['ingredient' => $data->id]).'">Delete</button>
                ';
            })
            ->make(true);
    }
}
