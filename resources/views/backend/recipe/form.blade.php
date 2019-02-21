@extends('layouts.backend')

<?php
if (!empty($recipe)) {
    $route = route('admin.recipe.update', ['recipe' => $recipe[0]['id']]);
    $method = 'PUT';
    $recipe_name = $recipe[0]['recipe_name'];
    $description = $recipe[0]['description'];
    $cook_time = $recipe[0]['cook_time'];
    $servings = $recipe[0]['servings'];
    $serving_size = $recipe[0]['serving_size'];
    $prep_time = $recipe[0]['prep_time'];
    $recipe_ingredients = $recipe_ingredients[0];
    $image = getImage('food_image', $recipe[0]['image']);
} else {
    $route = route('admin.recipe.store');
    $method = '';
    $recipe_name = '';
    $description = '';
    $cook_time = '';
    $servings = '';
    $serving_size = '';
    $prep_time = '';
    $recipe_ingredients = '';
    $image = getImage('food_image', '');
}
?>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-sm-8">
        <div class="card card-accent-primary">
            <div class="card-header">Recipe Form</div>
            <div class="card-body">
                <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($method))
                        @method($method)
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Recipe Name</label>
                            <input type="text" value="{{ $recipe_name }}" name="recipe_name" class="form-control">
                            @if($errors->has('recipe_name'))
                                <p class="text-danger">{{ $errors->first('recipe_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cook Time</label>
                            <input type="number" value="{{ $cook_time }}" name="cook_time" class="form-control">
                            <small class="form-text text-muted">In minutes</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        @if($errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif
                        <textarea rows="3" class="form-control" name="description">{{ $description }}</textarea>
                        <small class="form-text text-muted">Max 100 words</small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>How Many Serving</label>
                            <input type="number" class="form-control" value="{{ $servings }}" name="servings">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Serving Size</label>
                            <select name="serving_size" class="custom-select mr-sm-2">
                                <option selected>Choose...</option>
                                <option value="people">People</option>
                                <option value="cup">Cup</option>
                            </select>
                            <small class="form-text text-muted">Eg people, cups, etc</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Preparation Time</label>
                            <input type="number" value="{{ $prep_time }}" class="form-control" name="prep_time">
                            <small class="form-text text-muted">In minutes</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Recipe Category</label>
                            <select name="recipe_category" class="form-control">
                                <option selected>Choose...</option>
                                @foreach($category as $data)
                                <option value="{{ $data->id }}"
                                        @if(!empty($recipe))
                                        {{ ($recipe[0]['categories_id'] == $data->id) ? 'selected' : ''}}
                                        @endif
                                                >
                                    {{ $data->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label>Ingredients</label>
                            <select name="recipe_ingredient[]" multiple class="form-control" id="ingredient">
                            @foreach($ingredients as $data)
                                    <option value="{{ $data->id }}"
                                    @if(!empty($recipe))
                                    @foreach($recipe_ingredients as $val)
                                        {{ ($val['id'] == $data->id) ? 'selected' : '' }}
                                        @endforeach
                                    @endif
                                    >{{ $data->ingredient_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('recipe_ingredient'))
                                <p class="text-danger">{{ $errors->first('recipe_ingredient') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <img src="{{ $image }}" class="img-thumbnail" id="preview" alt="" style="max-height: 200px">
                    </div>
                    <div class="form-group">
                        <label class="btn btn-link mx-auto">
                            Choose Image
                            <input type="file" class="d-none" id="image" name="photo">
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-square" type="submit">Save</button>
                        <a href="#" class="btn btn-danger btn-square">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('dataTables')
    <script>
        $(document).ready(function() {
            $('#ingredient').select2({
                placeholder: 'Choose ingredients...',
                allowClear: true,
            });
        });
        
        function readUrl(input) {
            if (input.files && input.files[0]) {
                var render = new FileReader();

                render.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                };

                render.readAsDataURL(input.files[0]);
            }
        }
        $('#image').change(function() {
            readUrl(this);
        })
    </script>
@endpush