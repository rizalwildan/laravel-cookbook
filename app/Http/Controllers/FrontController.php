<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Recipes;

class FrontController extends Controller
{
    public function index()
    {
        $recipes = Recipes::all();
        return view('frontend.home')->with(compact('recipes'));
    }

    public function detailRecipe($id)
    {
        $recipe = Recipes::with('categories', 'ingredients')->where('slug', $id)->get();
        return view('frontend.detail')->with(compact('recipe'));
    }


    public function recipeByCategory($id)
    {
        $category = Categories::with('recipe')->get();
        return view('frontend.category-detail')->with(compact('category'));
    }
}
