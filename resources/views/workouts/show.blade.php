@extends('layouts.header')
@section('sidebar')
<li class="nav-item ">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Messages</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Groups</span>
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
        <ul class="nav flex-column sub-menu"><b style="color: white">FITNESS</b>

            <li class="nav-item"> <a class="nav-link" href="{{ url('exercises') }}">Exercises</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Workouts</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Programs</a></li>
        </ul>
        <ul class="nav flex-column sub-menu"><b style="color: white">NUTRITION</b>
            <li class="nav-item"> <a class="nav-link" href="{{ url('meal-category') }}">Meals Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('meal') }}">Meals</a></li>
        </ul>
    </div>
</li>
@endsection
@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div><br/>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
@endsection
