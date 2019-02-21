@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                Ingredients
                <div class="card-header-actions">
                    <a href="{{ route('admin.ingredient.create') }}" class="btn btn-square btn-primary">Add ingredient</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="dt-ingredient">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ingredient Name</th>
                        <th>Slug</th>
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
            $('#dt-ingredient').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.dt-ingredient') !!}',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'ingredient_name', name: 'ingredient_name'},
                    { data: 'slug', name: 'slug'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        $('#dt-ingredient').on('click', '#ingredient-delete', function (e) {
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
                        text: 'Ingredient deleted',
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