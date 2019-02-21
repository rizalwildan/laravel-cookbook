<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recipes;
use Alert;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Categories::all();
        $ingredients = Ingredients::all();
        return view('backend.recipe.form')->with(compact('category', 'ingredients'));
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
           'recipe_name' => 'required',
            'description' => 'max:100',
            'recipe_ingredient' => 'required'
        ]);

        if ($request->file('photo')) {
            $file = $request->file('photo');

            $img = imageUpload($file, $dir='food_image');
        }

        $data = new Recipes;
        $data->recipe_name = $request->input('recipe_name');
        $data->description = $request->input('description');
        $data->cook_time = $request->input('cook_time');
        $data->servings = $request->input('servings');
        $data->serving_size = $request->input('serving_size');
        $data->prep_time = $request->input('prep_time');
        $data->categories_id = $request->input('recipe_category');
        $data->image = $img;

        if ($data->save()) {
            $data->ingredients()->attach($request->input('recipe_ingredient'));
            Alert::success('Recipe created', 'success');
        } else {
            Alert::error('Error create recipe', 'Error');
        }

        return redirect()->route('admin.recipe.index');

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
        $recipe = Recipes::with('ingredients')->where('recipes.slug', $id)->get();
        $recipe_ingredients = $recipe->pluck('ingredients')->toArray();
        $category = Categories::all();
        $ingredients = Ingredients::all();

        return view('backend.recipe.form')
            ->with(compact('recipe', 'category', 'ingredients', 'recipe_ingredients'));
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
            'recipe_name' => 'required',
            'description' => 'max:100',
            'recipe_ingredient' => 'required'
        ]);

        $data = Recipes::find($id);
        $data->recipe_name = $request->input('recipe_name');
        $data->description = $request->input('description');
        $data->cook_time = $request->input('cook_time');
        $data->servings = $request->input('servings');
        $data->serving_size = $request->input('serving_size');
        $data->prep_time = $request->input('prep_time');
        $data->categories_id = $request->input('recipe_category');
        if ($request->file('photo')) {
            $file = $request->file('photo');

            $data->image = imageUpload($file, $dir='food_image');
        }

        if ($data->save()) {
            $data->ingredients()->sync($request->input('recipe_ingredient'));
            Alert::success('Recipe updated', 'success');
        } else {
            Alert::error('Error update recipe', 'Error');
        }

        return redirect()->route('admin.recipe.index');
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
        $data = Recipes::find($id);
        $data->ingredients()->detach($data->ingredients()->pluck('ingredients.id'));
        $data->delete();
    }

    public function getRecipe()
    {
        $data = Recipes::with('categories')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <a class="btn btn-square btn-primary" 
                    href="'.route('admin.recipe.edit', ['recipe' => $data->slug]).'">Edit</a>   
                <button class="btn btn-square btn-danger" id="recipe-delete"
                    data-uri="'.route('admin.recipe.destroy', ['recipe' => $data->id]).'">Delete</button>
                ';
            })
            ->make(true);
    }
}
