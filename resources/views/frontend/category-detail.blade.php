@extends('layouts.app')

@section('content')
    <div class="album py-5">
        <div class="container">
            <h3><strong>{{ $category[0]['category_name'] }}</strong></h3>
            <br>
            <div class="row">
                <?php $recipes = $category->pluck('recipe')->toArray()[0];?>
                @foreach($recipes as $recipe)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{ (empty($recipe['image'])) ? 'https://via.placeholder.com/100x225' : asset('storage/img/food_image/'.$recipe['image']) }}"
                                 style="width: 100%; height: 225px" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text h4">{{ $recipe['recipe_name'] }}</p>
                                <p class="card-text">
                                    {{ $recipe['description'] }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('detail-recipe', ['slug' => $recipe['slug']]) }}" class="btn btn-outline-primary">View</a>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <small class="text-muted">
                                                <i class="fa fa-stopwatch"></i>
                                                {{ $recipe['cook_time'] }} minute
                                            </small>
                                        </li>

                                        <li class="list-inline-item">
                                            <small class="text-muted">
                                                <i class="fa fa-user"></i>
                                                {{ $recipe['servings'] }} {{ $recipe['serving_size'] }}
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection