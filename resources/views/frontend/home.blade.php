@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Welcome to CookBook</h1>
        <p class="lead text-muted">
            Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.
        </p>
    </div>
</section>
    <div class="album py-5">
        <div class="container">
            <div class="row">
                @foreach($recipes as $recipe)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img src="{{ (empty($recipe->image)) ? 'https://via.placeholder.com/100x225' : asset('storage/img/food_image/'.$recipe->image) }}"
                             style="width: 100%; height: 225px" class="card-img-top" alt="">
                        <div class="card-body">
                            <p class="card-text h4">{{ $recipe->recipe_name }}</p>
                            <p class="card-text">
                                {{ $recipe->description }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('detail-recipe', ['slug' => $recipe->slug]) }}" class="btn btn-outline-primary">View</a>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <small class="text-muted">
                                        <i class="fa fa-stopwatch"></i>
                                        {{ $recipe->cook_time }} minute
                                        </small>
                                    </li>

                                    <li class="list-inline-item">
                                        <small class="text-muted">
                                            <i class="fa fa-user"></i>
                                            {{ $recipe->servings }} {{ $recipe->serving_size }}
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