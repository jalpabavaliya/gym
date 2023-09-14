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
            height: 500px; /* Adjust the height as needed */
            margin-left: 115px;
            overflow: auto; /* This will add scrollbars when content overflows */
            border: 1px solid #ccc; /* Optional: Add a border for styling */
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
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Exercise Category</h2>
        </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('exercise.index') }}"> Back</a>
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
    {!! Form::model($exercise, ['method' => 'PATCH','route' => ['exercise.update', $exercise->id]]) !!}
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Title:</strong>
                <input  type="text" name="title" class="form-group form-control" value="{{ $exercise->title }}"/>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Type:</strong>
                <select  name="type"  class="form-group form-control">
                    <option value="" >Please Select Type</option>
                    <option value="1" {{ $exercise->type == 1 ? 'selected' : '' }}>Strength (rep x weight e.g squats)</option>
                    <option value="2" {{ $exercise->type == 2 ? 'selected' : '' }}>General (display only, stretches)</option>
                    <option value="3" {{ $exercise->type == 3 ? 'selected' : '' }}>Endurance</option>
                    <option value="4" {{ $exercise->type == 4 ? 'selected' : '' }}>Cardio</option>
                    <option value="5" {{ $exercise->type == 5 ? 'selected' : '' }}>Timed (longer better e.g planks)</option>
                    <option value="6" {{ $exercise->type == 6 ? 'selected' : '' }}>Timed (Faster better e.g. Sprints)</option>
                    <option value="7" {{ $exercise->type == 7 ? 'selected' : '' }}>Timed (Seconds X Weight)</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Exercie Tags:</strong>
                <input type="button" onclick="openPopup()" name="Open" value="Tags" class="form-group form-control">
            </div>
        </div>
        <div class="popup scrollable-div" id="popup">
            <h2><b>Manage Exercise Tags</b></h2><br>
            <div class="row">
                <div class="col-3">
                    <h4><b>Main muscle</b></h4>
                    <label><input type="checkbox" name="tags[]" value="1" {{ in_array('1', $exercise->tag) ? 'checked' : '' }}> Abductors </label><br>
                    <label><input type="checkbox" name="tags[]" value="2" {{ in_array('2', $exercise->tag) ? 'checked' : '' }}> Abs </label><br>
                    <label><input type="checkbox" name="tags[]" value="3" {{ in_array('3', $exercise->tag) ? 'checked' : '' }}> Adductors </label><br>
                    <label><input type="checkbox" name="tags[]" value="4" {{ in_array('4', $exercise->tag) ? 'checked' : '' }}>  Back (lower) </label><br>
                    <label><input type="checkbox" name="tags[]" value="5" {{ in_array('5', $exercise->tag) ? 'checked' : '' }}>  Back (middle)  </label><br>
                    <label><input type="checkbox" name="tags[]" value="6" {{ in_array('6', $exercise->tag) ? 'checked' : '' }}> Bicep </label><br>
                    <label><input type="checkbox" name="tags[]" value="7" {{ in_array('7', $exercise->tag) ? 'checked' : '' }}> Calves </label><br>
                    <label><input type="checkbox" name="tags[]" value="8" {{ in_array('8', $exercise->tag) ? 'checked' : '' }}>  Chest (inner) </label><br>
                    <label><input type="checkbox" name="tags[]" value="9" {{ in_array('9', $exercise->tag) ? 'checked' : '' }}>  Chest (mid) </label><br>
                    <label><input type="checkbox" name="tags[]" value="10" {{ in_array('10', $exercise->tag) ? 'checked' : '' }}>  Chest (upper) </label><br>
                    <label><input type="checkbox" name="tags[]" value="11" {{ in_array('11', $exercise->tag) ? 'checked' : '' }}> Forearms </label><br>
                    <label><input type="checkbox" name="tags[]" value="12" {{ in_array('12', $exercise->tag) ? 'checked' : '' }}> Glutes </label><br>
                    <label><input type="checkbox" name="tags[]" value="13" {{ in_array('13', $exercise->tag) ? 'checked' : '' }}> Hamstrings </label><br>
                    <label><input type="checkbox" name="tags[]" value="14" {{ in_array('14', $exercise->tag) ? 'checked' : '' }}> Lats </label><br>
                    <label><input type="checkbox" name="tags[]" value="15" {{ in_array('15', $exercise->tag) ? 'checked' : '' }}> Neck </label><br>
                    <label><input type="checkbox" name="tags[]" value="16" {{ in_array('16', $exercise->tag) ? 'checked' : '' }}> Obliques </label><br>
                    <label><input type="checkbox" name="tags[]" value="17" {{ in_array('17', $exercise->tag) ? 'checked' : '' }}> Quads </label><br>
                    <label><input type="checkbox" name="tags[]" value="18" {{ in_array('18', $exercise->tag) ? 'checked' : '' }}>  Shoulder (front)  </label><br>
                    <label><input type="checkbox" name="tags[]" value="19" {{ in_array('19', $exercise->tag) ? 'checked' : '' }}> Shoulder (rear) </label><br>
                    <label><input type="checkbox" name="tags[]" value="20" {{ in_array('20', $exercise->tag) ? 'checked' : '' }}> Shoulder (side) </label><br>
                    <label><input type="checkbox" name="tags[]" value="21" {{ in_array('21', $exercise->tag) ? 'checked' : '' }}> Traps </label><br>
                    <label><input type="checkbox" name="tags[]" value="22" {{ in_array('22', $exercise->tag) ? 'checked' : '' }}> Triceps </label><br>
                </div>
                <div class="col-3">
                    <h4><b>Equipment</b></h4>
                    <label><input type="checkbox" name="tags[]" value="23" {{ in_array('23', $exercise->tag) ? 'checked' : '' }}> Bands (handles)</label><br>
                    <label><input type="checkbox" name="tags[]" value="24" {{ in_array('24', $exercise->tag) ? 'checked' : '' }}>  Bands (loops) </label><br>
                    <label><input type="checkbox" name="tags[]" value="25" {{ in_array('25', $exercise->tag) ? 'checked' : '' }}> Barbell </label><br>
                    <label><input type="checkbox" name="tags[]" value="26" {{ in_array('26', $exercise->tag) ? 'checked' : '' }}>  Battle ropes </label><br>
                    <label><input type="checkbox" name="tags[]" value="27" {{ in_array('27', $exercise->tag) ? 'checked' : '' }}> Bench </label><br>
                    <label><input type="checkbox" name="tags[]" value="28" {{ in_array('28', $exercise->tag) ? 'checked' : '' }}> Body weight </label><br>
                    <label><input type="checkbox" name="tags[]" value="29" {{ in_array('29', $exercise->tag) ? 'checked' : '' }}> Balance board</label><br>
                    <label><input type="checkbox" name="tags[]" value="30" {{ in_array('30', $exercise->tag) ? 'checked' : '' }}>  BOSU Box  </label><br>
                    <label><input type="checkbox" name="tags[]" value="31" {{ in_array('31', $exercise->tag) ? 'checked' : '' }}> Cable </label><br>
                    <label><input type="checkbox" name="tags[]" value="32" {{ in_array('32', $exercise->tag) ? 'checked' : '' }}>  D-ring </label><br>
                    <label><input type="checkbox" name="tags[]" value="33" {{ in_array('33', $exercise->tag) ? 'checked' : '' }}>  Dumbbell </label><br>
                    <label><input type="checkbox" name="tags[]" value="34" {{ in_array('34', $exercise->tag) ? 'checked' : '' }}>  EZ bar </label><br>
                    <label><input type="checkbox" name="tags[]" value="35" {{ in_array('35', $exercise->tag) ? 'checked' : '' }}>  Foam roller </label><br>
                    <label><input type="checkbox" name="tags[]" value="36" {{ in_array('36', $exercise->tag) ? 'checked' : '' }}>  Jump rope </label><br>
                    <label><input type="checkbox" name="tags[]" value="37" {{ in_array('37', $exercise->tag) ? 'checked' : '' }}>  Kettlebell </label><br>
                    <label><input type="checkbox" name="tags[]" value="38" {{ in_array('38', $exercise->tag) ? 'checked' : '' }}>  Lacrosse ball </label><br>
                    <label><input type="checkbox" name="tags[]" value="39" {{ in_array('39', $exercise->tag) ? 'checked' : '' }}>   Landmine </label><br>
                    <label><input type="checkbox" name="tags[]" value="40" {{ in_array('40', $exercise->tag) ? 'checked' : '' }}>   Machine  </label><br>
                    <label><input type="checkbox" name="tags[]" value="41" {{ in_array('41', $exercise->tag) ? 'checked' : '' }}>  Mat </label><br>
                    <label><input type="checkbox" name="tags[]" value="42" {{ in_array('42', $exercise->tag) ? 'checked' : '' }}>   Medicine ball </label><br>
                    <label><input type="checkbox" name="tags[]" value="43" {{ in_array('43', $exercise->tag) ? 'checked' : '' }}>   Mini band  </label><br>
                    <label><input type="checkbox" name="tags[]" value="44" {{ in_array('44', $exercise->tag) ? 'checked' : '' }}>  Plate </label><br>
                    <label><input type="checkbox" name="tags[]" value="45" {{ in_array('45', $exercise->tag) ? 'checked' : '' }}>   Pull up bar </label><br>
                    <label><input type="checkbox" name="tags[]" value="46" {{ in_array('46', $exercise->tag) ? 'checked' : '' }}>  Sandbag </label><br>
                    <label><input type="checkbox" name="tags[]" value="47" {{ in_array('47', $exercise->tag) ? 'checked' : '' }}>  Slam ball  </label><br>
                    <label><input type="checkbox" name="tags[]" value="48" {{ in_array('48', $exercise->tag) ? 'checked' : '' }}>  Sled Sliders </label><br>
                    <label><input type="checkbox" name="tags[]" value="49" {{ in_array('49', $exercise->tag) ? 'checked' : '' }}>   Smith machine </label><br>
                    <label><input type="checkbox" name="tags[]" value="50" {{ in_array('50', $exercise->tag) ? 'checked' : '' }}>   Suspension  Swiss ball </label><br>
                </div>
                <div class="col-3">
                    <h4><b>Movement</b></h4>
                    <label><input type="checkbox" name="tags[]" value="51" {{ in_array('51', $exercise->tag) ? 'checked' : '' }}> Alternating</label><br>
                    <label><input type="checkbox" name="tags[]" value="52" {{ in_array('52', $exercise->tag) ? 'checked' : '' }}> Bilateral</label><br>
                    <label><input type="checkbox" name="tags[]" value="53" {{ in_array('53', $exercise->tag) ? 'checked' : '' }}> Contralateral</label><br>
                    <label><input type="checkbox" name="tags[]" value="54" {{ in_array('54', $exercise->tag) ? 'checked' : '' }}> General conditioning</label><br>
                    <label><input type="checkbox" name="tags[]" value="55" {{ in_array('55', $exercise->tag) ? 'checked' : '' }}> Hip dominan</label><br>
                    <label><input type="checkbox" name="tags[]" value="56" {{ in_array('56', $exercise->tag) ? 'checked' : '' }}> Horizontal pull</label><br>
                    <label><input type="checkbox" name="tags[]" value="57" {{ in_array('57', $exercise->tag) ? 'checked' : '' }}> Horizontal push</label><br>
                    <label><input type="checkbox" name="tags[]" value="58" {{ in_array('58', $exercise->tag) ? 'checked' : '' }}> IpsiLateral</label><br>
                    <label><input type="checkbox" name="tags[]" value="59" {{ in_array('59', $exercise->tag) ? 'checked' : '' }}> Knee dominant</label><br>
                    <label><input type="checkbox" name="tags[]" value="60" {{ in_array('60', $exercise->tag) ? 'checked' : '' }}> Mobility</label><br>
                    <label><input type="checkbox" name="tags[]" value="61" {{ in_array('61', $exercise->tag) ? 'checked' : '' }}> Plyometrics </label><br>
                    <label><input type="checkbox" name="tags[]" value="62" {{ in_array('62', $exercise->tag) ? 'checked' : '' }}> Static stretches </label><br>
                    <label><input type="checkbox" name="tags[]" value="63" {{ in_array('63', $exercise->tag) ? 'checked' : '' }}> Unilateral</label><br>
                    <label><input type="checkbox" name="tags[]" value="64" {{ in_array('64', $exercise->tag) ? 'checked' : '' }}> Vertical pull</label><br>
                    <label><input type="checkbox" name="tags[]" value="65" {{ in_array('65', $exercise->tag) ? 'checked' : '' }}> Vertical push</label><br>      
                </div>
                <div class="col-3">
                    <h4><b>Mechanics</b></h4>
                    <label><input type="checkbox" name="tags[]" value="66" {{ in_array('66', $exercise->tag) ? 'checked' : '' }}> Compound</label><br>
                    <label><input type="checkbox" name="tags[]" value="67" {{ in_array('67', $exercise->tag) ? 'checked' : '' }}> Isolation</label><br>

                    <h4><b>Level</b></h4>
                    <label><input type="checkbox" name="tags[]" value="68" {{ in_array('68', $exercise->tag) ? 'checked' : '' }}> Advanced</label><br>
                    <label><input type="checkbox" name="tags[]" value="69" {{ in_array('69', $exercise->tag) ? 'checked' : '' }}> Beginner</label><br>
                    <label><input type="checkbox" name="tags[]" value="70" {{ in_array('70', $exercise->tag) ? 'checked' : '' }}> Intermediate</label><br>
                </div>
            </div>
            <input type="button" onclick="closePopup()" name="Close" value="Close">
        </div>
        <div class="overlay" id="overlay"></div>

        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Instructions :</strong>
                <textarea class="form-group form-control" name="instructions" required>
                    {{ $exercise->instructions }}
                </textarea>
            </div>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Description :</strong>
                <textarea class="form-group form-control" name="description" required>
                    {{ $exercise->description }}
                </textarea>
            </div>
        </div>

        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Video URL :</strong>
                    <input type="text" class="form-group form-control" name="video_url" id="youtube-url" placeholder="Paste YouTube URL here" onclick="embedVideo()" onkeypress="embedVideo()" onkeyup="embedVideo()" onblur="embedVideo()" value="https://www.youtube.com/watch?v={{ $exercise->video_url }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4">
            <div class="form-group">
                <div id="video-container"></div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
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
    embedVideo();
    function embedVideo() {
        const youtubeUrl = document.getElementById("youtube-url").value;
        const videoContainer = document.getElementById("video-container");

        if (isValidYouTubeUrl(youtubeUrl)) {
            const videoId = extractVideoId(youtubeUrl);
            const embedCode = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
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
