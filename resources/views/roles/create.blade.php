@extends('layouts.header')
@section('sidebar')
<li class="nav-item">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

@can('role-list')
<li class="nav-item active">
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

@endsection
@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>
<br>

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


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
<style>
    .container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: yellow;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
@endsection
