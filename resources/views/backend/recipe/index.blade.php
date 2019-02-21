@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Recipes
                <div class="card-header-actions">
                    <a class="btn btn-square btn-primary" href="{{ route('admin.recipe.create') }}">Add Recipe</a>
                </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="dt-recipe">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Recipe Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dataTables')
    <script>
        $(function() {
            $('#dt-recipe').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.dt-recipe') !!}',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'recipe_name', name: 'recipe_name'},
                    //{ data: 'slug', name: 'slug'},
                    { data: 'description', name: 'description' },
                    {
                        data: 'categories',
                        name: 'categories',
                        render: function (categories) {
                            return categories.category_name
                        }
                    },
                    { data: 'created_at', name: 'created_at'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        $('#dt-recipe').on('click', '#recipe-delete', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            swal({
                title: 'Are you sure ?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: 'Cancel',
                        visible: true,
                        closeModal: true
                    },
                    confirm: {
                        text: 'Delete',
                        closeModal: true
                    }
                }
            }).then((isConfirm) => {
                if (isConfirm) {
                    swal({
                        title: 'Success',
                        text: 'Recipe deleted',
                        buttons: false,
                        timer: 3000
                    }).then(() => {
                        $.ajax({
                            url: $(this).data('uri'),
                            type: 'DELETE',
                            dataType: 'JSON',
                            data: {
                                method: '_DELETE',
                                submit: true
                            },
                        });
                        location.reload();
                    })
                }
            });
        });
    </script>
@endpush