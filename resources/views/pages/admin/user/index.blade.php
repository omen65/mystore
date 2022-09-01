@extends('layouts.admin')
@section('title')
User
@endsection

@section('content')
 <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">User</h2>
        <p class="dashboard-subtitle">
            List of Users
        </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3 mt-3">Tambah User</a>
                            <div class="table-responsive">
                                <table class="table table-hover w-100 scroll-vertical-horizontal" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! url()->current() !!}'
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false,
                        searchable: false ,
                        width: '100px'
                    }
                ]
            });
        });
    </script>
@endpush