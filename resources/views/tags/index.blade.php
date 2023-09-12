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

<li class="nav-item">
    <a class="nav-link" href="{{ url('users') }}">
        <i class="icon-head  menu-icon"></i>
        <span class="menu-title">User Management</span>
    </a>
</li>

<li class="nav-item active">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Master Libraries</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item active"> <a class="nav-link" href="{{ url('tags') }}">Tags</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('exercise_categories') }}">Exercise Categories</a></li>
        </ul>
    </div>
</li>
@endsection
@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tags</h2>
        </div>
        <div class="pull-right">
            <!-- @can('role-create') -->
            <a class="btn btn-success" href="{{ route('tags.create') }}"> Create Tag</a>
            <!-- @endcan -->
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
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tags.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });
  });
</script>
@endsection
