@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <table class="table table-bordered" id="user">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
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
        $('#user').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.users-dt') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'}
            ]
        });
    </script>
@endpush