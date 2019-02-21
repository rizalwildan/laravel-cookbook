@extends('layouts.backend')

<?php
if (!empty($data)) {
    $route = route('admin.category.update', ['category' => $data['id']]);
    $method = 'PUT';
    $category_name = $data['category_name'];
} else {
    $route = route('admin.category.store');
    $method = '';
    $category_name = '';
}
?>

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-sm-8">
        <div class="card card-accent-primary">
            <div class="card-header">Category Form</div>
            <div class="card-body">
                <form action="{{ $route }}" method="post">
                    @csrf
                    @if(!empty($method))
                    @method($method)
                    @endif
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        @if($errors->has('category_name'))
                        <p class="text-danger">{{ $errors->first('category_name') }}</p>
                        @endif
                        <input type="text" name="category_name" value="{{ $category_name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-square btn-primary" type="submit">Save</button>
                        <a class="btn btn-square btn-danger" href="{{ route('admin.category.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection