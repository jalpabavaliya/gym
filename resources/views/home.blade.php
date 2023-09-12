@extends('layouts.header')
@section('sidebar')
<li class="nav-item active">
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
<li class="nav-item">
    <a class="nav-link" href="{{ url('meal-category') }}">
        <i class="icon-head  menu-icon"></i>
        <span class="menu-title">Meal Categories </span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('meal') }}">
        <i class="icon-head  menu-icon"></i>
        <span class="menu-title">Meal Management </span>
    </a>
</li>

@endsection
@section('content')
<div class="content-wrapper">
</div>
@endsection
