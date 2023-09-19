@extends('layouts.header')
@section('sidebar')
    <li class="nav-item">
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

                <li class="nav-item active"> <a class="nav-link" href="{{ url('exercises') }}">Exercises</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Workouts</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Programs</a></li>
            </ul>
            <ul class="nav flex-column sub-menu"><b style="color: white">NUTRITION</b>
                <li class="nav-item"> <a class="nav-link" href="#">Meals</a></li>
            </ul>
        </div>
    </li>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Exercise</h2>
                </div>
                <div class="pull-right">
                    <!-- @can('role-create')
        -->
                        <a class="btn btn-success" href="{{ route('exercise.create') }}"> Create New</a>
                        <!--
    @endcan -->
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
                        <h4 class="card-title">Exercise</h4>
                        <div class="row">
                            @foreach ($exercise as $key => $exercise1)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 px-3">
                                    <div class="card ">
                                        <iframe height="200"
                                            src="https://www.youtube.com/embed/{{ $exercise1->video_url }}" frameborder="0"
                                            full></iframe>
                                        <div class="card-body border" style="padding: 20px !important;">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('exercise.edit', ['id' => $exercise1->id]) }}"><i
                                                        class="fa fa-pencil aria-hidden="
                                                        style="margin-right: 10px;"></i></a>
                                                <a href="{{ route('exercise.destroy', ['id' => $exercise1->id]) }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
