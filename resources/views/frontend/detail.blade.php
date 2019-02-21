@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
        <div class="col-md-7">
            <a href="{{ route('category-by', ['slug' => $recipe->pluck('categories')->toArray()[0]['slug']]) }}" class="btn btn-link">{{ $recipe->pluck('categories')->toArray()[0]['category_name'] }}</a>
            <div class="card mb-3">
                <img src="{{ (empty($recipe[0]['image'])) ? 'https://via.placeholder.com/781x180' : asset('storage/img/food_image/'.$recipe[0]['image']) }}"
                     style="width: 100%; height: 180px" class="card-img-top" alt="">
                <div class="card-body">
                    <h1 class="card-text"><strong>{{ $recipe[0]['recipe_name'] }}</strong></h1>
                    <p class="text-muted h6">
                        Cooking Time : {{ $recipe[0]['cook_time'] }} minutes |
                        Preparation Time : {{ $recipe[0]['prep_time'] }} minutes |
                        Serving Size : For {{ $recipe[0]['servings'] }} {{ $recipe[0]['serving_size'] }}
                    </p>
                    <hr>
                    <h3 class="card-text text-muted">Description</h3>
                    <p>{{ $recipe[0]['description'] }}</p>
                    <hr>
                    <h3 class="card-text text-muted">Ingredients</h3>
                    <?php $ingredients = $recipe->pluck('ingredients')->toArray()[0]?>
                    <ul class="list-unstyled py-2">
                        @foreach($ingredients as $ingredient)
                        <li>
                            <h5>
                                {{ $ingredient['ingredient_name'] }}
                                <p>
                                    @if(!empty($ingredient['notes']))<small class="text-muted"><em>Notes: {{ $ingredient['notes'] }}</em></small>@endif
                                </p>
                            </h5>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection