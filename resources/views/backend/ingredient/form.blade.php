@extends('layouts.backend')

<?php
if (!empty($data)) {
    $route = route('admin.ingredient.update', ['ingredient' => $data['id']]);
    $method = 'PUT';
    $ingredient_name = $data['ingredient_name'];
    $ingredient_notes = $data['notes'];
} else {
    $route = route('admin.ingredient.store');
    $method = '';
    $ingredient_name = '';
    $ingredient_notes = '';
}
?>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">Ingredient Form</div>
            <div class="card-body">
                <form action="{{ $route }}" method="post">
                    @csrf
                    @if(!empty($method))
                        @method($method)
                    @endif
                    <div class="form-group">
                        <label>Ingredient Name</label>
                        @if($errors->has('ingredient_name'))
                        <p class="text-danger">{{ $errors->first('ingredient_name') }}</p>
                        @endif
                        <input type="text" class="form-control" value="{{ $ingredient_name }}" name="ingredient_name">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text" class="form-control" value="{{ $ingredient_notes }}" name="ingredient_notes">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-square btn-primary" type="submit">Save</button>
                        <a href="{{ route('admin.ingredient.index') }}" class="btn btn-danger btn btn-square">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection