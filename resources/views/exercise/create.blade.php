@extends('layouts.header')
@section('sidebar')
    <style>
        /* Style for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-70%, -70%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        /* Style for the overlay background */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .scrollable-div {
            height: 500px;
            /* Adjust the height as needed */
            margin-left: 115px;
            overflow: auto;
            /* This will add scrollbars when content overflows */
            border: 1px solid #ccc;
            /* Optional: Add a border for styling */
        }
    </style>
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

                <li class="nav-item"> <a class="nav-link" href="{{ url('exercises') }}">Exercises</a></li>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Exercise Form</h3>
                    </div>
                    {!! Form::open(['route' => 'exercise.store', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div id="Exercise-form">
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
                            <div class="row">
                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Title:</strong>
                                        <input type="text" name="title" class="form-group form-control" required />
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Type:</strong>
                                        <select name="type" class="form-group form-control" required>
                                            <option value="">Please Select Type</option>
                                            <option value="1">Strength (rep x weight e.g squats)</option>
                                            <option value="2">General (display only, stretches)</option>
                                            <option value="3">Endurance</option>
                                            <option value="4">Cardio</option>
                                            <option value="5">Timed (longer better e.g planks)</option>
                                            <option value="6">Timed (Faster better e.g. Sprints)</option>
                                            <option value="7">Timed (Seconds X Weight)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Exercie Tags:</strong>
                                        <input type="button" onclick="openPopup()" name="Open" value="Tags"
                                            class="form-group form-control">
                                    </div>
                                </div>
                                <div class="popup scrollable-div" id="popup">
                                    <h2><b>Manage Exercise Tags</b></h2><br>
                                    <div class="row">
                                        <div class="col-3">
                                            <h4><b>Main muscle</b></h4>
                                            <label><input type="checkbox" name="tags[]" value="1"> Abductors
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="2"> Abs </label><br>
                                            <label><input type="checkbox" name="tags[]" value="3"> Adductors
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="4"> Back (lower)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="5"> Back (middle)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="6"> Bicep
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="7"> Calves
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="8"> Chest (inner)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="9"> Chest (mid)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="10"> Chest (upper)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="11"> Forearms
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="12"> Glutes
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="13"> Hamstrings
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="14"> Lats
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="15"> Neck
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="16"> Obliques
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="17"> Quads
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="18"> Shoulder (front)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="19"> Shoulder (rear)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="20"> Shoulder (side)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="21"> Traps
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="22"> Triceps
                                            </label><br>

                                        </div>
                                        <div class="col-3">
                                            <h4><b>Equipment</b></h4>
                                            <label><input type="checkbox" name="tags[]" value="23"> Bands
                                                (handles)</label><br>
                                            <label><input type="checkbox" name="tags[]" value="24"> Bands (loops)
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="25"> Barbell
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="26"> Battle ropes
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="27"> Bench
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="28"> Body weight
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="30"> Balance
                                                board</label><br>
                                            <label><input type="checkbox" name="tags[]" value="31"> BOSU Box
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="32"> Cable
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="33"> D-ring
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="34"> Dumbbell
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="35"> EZ bar
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="36"> Foam roller
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="37"> Jump rope
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="38"> Kettlebell
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="39"> Lacrosse ball
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="40"> Landmine
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="41"> Machine
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="42"> Mat </label><br>
                                            <label><input type="checkbox" name="tags[]" value="43"> Medicine ball
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="44"> Mini band
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="45"> Plate
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="46"> Pull up bar
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="47"> Sandbag
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="48"> Slam ball
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="49"> Sled Sliders
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="50"> Smith machine
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="51"> Suspension Swiss
                                                ball </label><br>
                                        </div>
                                        <div class="col-3">
                                            <h4><b>Movement</b></h4>
                                            <label><input type="checkbox" name="tags[]" value="52">
                                                Alternating</label><br>
                                            <label><input type="checkbox" name="tags[]" value="53">
                                                Bilateral</label><br>
                                            <label><input type="checkbox" name="tags[]" value="54">
                                                Contralateral</label><br>
                                            <label><input type="checkbox" name="tags[]" value="55"> General
                                                conditioning</label><br>
                                            <label><input type="checkbox" name="tags[]" value="56"> Hip
                                                dominan</label><br>
                                            <label><input type="checkbox" name="tags[]" value="57"> Horizontal
                                                pull</label><br>
                                            <label><input type="checkbox" name="tags[]" value="58"> Horizontal
                                                push</label><br>
                                            <label><input type="checkbox" name="tags[]" value="59">
                                                IpsiLateral</label><br>
                                            <label><input type="checkbox" name="tags[]" value="60"> Knee
                                                dominant</label><br>
                                            <label><input type="checkbox" name="tags[]" value="61">
                                                Mobility</label><br>
                                            <label><input type="checkbox" name="tags[]" value="62"> Plyometrics
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="63"> Static stretches
                                            </label><br>
                                            <label><input type="checkbox" name="tags[]" value="64">
                                                Unilateral</label><br>
                                            <label><input type="checkbox" name="tags[]" value="65"> Vertical
                                                pull</label><br>
                                            <label><input type="checkbox" name="tags[]" value="66"> Vertical
                                                push</label><br>
                                        </div>
                                        <div class="col-3">
                                            <h4><b>Mechanics</b></h4>
                                            <label><input type="checkbox" name="tags[]" value="67">
                                                Compound</label><br>
                                            <label><input type="checkbox" name="tags[]" value="68">
                                                Isolation</label><br>

                                            <h4><b>Level</b></h4>
                                            <label><input type="checkbox" name="tags[]" value="69">
                                                Advanced</label><br>
                                            <label><input type="checkbox" name="tags[]" value="70">
                                                Beginner</label><br>
                                            <label><input type="checkbox" name="tags[]" value="71">
                                                Intermediate</label><br>
                                        </div>
                                    </div>

                                    <input type="button" onclick="closePopup()" name="Close" value="Close">
                                </div>
                                <div class="overlay" id="overlay"></div>

                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Instructions :</strong>
                                        <textarea class="form-group form-control" name="instructions" required></textarea>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Description :</strong>
                                        <textarea class="form-group form-control" name="description" required></textarea>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Video URL :</strong>
                                        <input type="text" class="form-group form-control" name="video_url"
                                            id="youtube-url" placeholder="Paste YouTube URL here" onclick="embedVideo()"
                                            onkeypress="embedVideo()" onkeyup="embedVideo()" onblur="embedVideo()"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <div id="video-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- <div class="col-md-12" style="padding-top: 20px"> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('exercise.index') }}"> Back</a>
                        {{-- </div> --}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to open the popup
        function openPopup() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

    <script>
        function embedVideo() {
            const youtubeUrl = document.getElementById("youtube-url").value;
            const videoContainer = document.getElementById("video-container");

            if (isValidYouTubeUrl(youtubeUrl)) {
                const videoId = extractVideoId(youtubeUrl);
                const embedCode =
                    `<iframe width="350" height="250" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                videoContainer.innerHTML = embedCode;
            }
        }

        function isValidYouTubeUrl(url) {
            // Regular expression to match YouTube video URLs
            const regex = /^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/;
            return regex.test(url);
        }

        function extractVideoId(url) {
            const match = url.match(/[?&]v=([^&]+)/);
            return match ? match[1] : null;
        }
    </script>
@endsection
