@extends('layouts.header')
@section('sidebar')
<li class="nav-item">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

@can('role-list')
<li class="nav-item">
    <a class="nav-link" href="{{ url('roles') }}">
        <i class="fa-solid fa-users-gear menu-icon"></i>
        <span class="menu-title">Role Management</span>
    </a>
</li>
@endcan

<li class="nav-item active">
    <a class="nav-link" href="{{ url('users') }}">
        <i class="icon-head  menu-icon"></i>
        <span class="menu-title">User Management</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Master Libraries</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('tags') }}">Tags</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('exercise_categories') }}">Exercise Categories</a></li>
        </ul>
    </div>
</li>
@endsection
@section('content')
<div class="content-wrapper">
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Management</h2>
            </div>
            <div class="pull-right">
                @can('user-create')
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                @endcan
            </div>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                    <table class="table data-table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th width="100px">Action</th>
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
<style>
    /* Style for the switch container */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Style for the slider (the actual switch) */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: -13px;
        right: 7px;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    /* Style for the slider when it's in the "on" state */
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    /* Style for the slider when it's checked (on) */
    input:checked+.slider {
        background-color: #2196F3;
    }

    /* Style for the slider's knob when it's checked (on) */
    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
</style>
<script type="text/javascript">
    function status_change_alert(id, status) {

        var formData = {
            id: id,
            status: status,
        };
        var type = "POST";
        var ajaxurl = "{{route('users.status')}}";
        jQuery.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                location.reload(true);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.list') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    });
</script>
@endsection
