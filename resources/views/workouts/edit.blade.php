@extends('layouts.header')
@section('sidebar')
<style>
    .scrollable-div {
            height: 500px; /* Adjust the height as needed */
            margin-left: 115px;
            overflow: auto; /* This will add scrollbars when content overflows */
            border: 1px solid #ccc; /* Optional: Add a border for styling */
        }

</style>
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
            <li class="nav-item active"> <a class="nav-link" href="#">Workouts</a></li>
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
            <h2>Edit Category</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('workouts.index') }}"> Back</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($workouts, ['method' => 'PATCH','route' => ['workouts.update', $workouts->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        {{-- <div class="form-group">
            <strong>Exercise:</strong>
            <select name="exercise" class="form-group form-control select" multiple>
            <option value="">Please Select Exercise</option>
            @foreach ($exercise as $data)
                    <option value="{{ $data->id  }}">{{ $data->title }}</option>
            @endforeach
            </select>
        </div> --}}
        <div class="popup scrollable-div form-group form-control">
            <h2><b>Manage Exercise Tags</b></h2><br>
            <div class="row">
                <div class="col-12">
                    @foreach ($exercise as $data)
                        <label><input type="checkbox" name="tags[]" value="1"> Abductors </label><br>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
@endsection

