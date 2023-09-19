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
                    <h2>Meal</h2>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mealmodal">
                        Create Meal
                    </button>
                    <div class="modal fade" id="mealmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::open(['route' => 'meal.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="meal_id" id="meal_id" value="">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Meal Name:</strong>
                                                <input type="text" id="meal_name" name="meal_name"
                                                    class="form-group form-control" placeholder="Meal Name" required />
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <strong>Meal Prep Time:</strong>
                                                <select id="prep_time" name="prep_time" class="form-group form-control"
                                                    required>
                                                    <option value="1">5min</option>
                                                    <option value="2">10min</option>
                                                    <option value="3">15min</option>
                                                    <option value="4">20min</option>
                                                    <option value="5">25min</option>
                                                    <option value="6">30min</option>
                                                    <option value="7">35min</option>
                                                    <option value="8">40min</option>
                                                    <option value="9">45min</option>
                                                    <option value="10">50min</option>
                                                    <option value="11">55min</option>
                                                    <option value="12">60min</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <strong>Meal Cook Time:</strong>
                                                <select id="cook_time" name="cook_time" class="form-group form-control"
                                                    required>
                                                    <option value="1">5min</option>
                                                    <option value="2">10min</option>
                                                    <option value="3">15min</option>
                                                    <option value="4">20min</option>
                                                    <option value="5">25min</option>
                                                    <option value="6">30min</option>
                                                    <option value="7">35min</option>
                                                    <option value="8">40min</option>
                                                    <option value="9">45min</option>
                                                    <option value="10">50min</option>
                                                    <option value="11">55min</option>
                                                    <option value="12">60min</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <strong>Suitable For:</strong>
                                            <div class="row">
                                                <?php $category = App\Models\MealCategories::get(); ?>
                                                @foreach ($category as $cat)
                                                    <div class="col-3">
                                                        <label><input type="checkbox" name="meal_categories_id[]"
                                                                value="{{ $cat->id }}"> {{ $cat->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <strong>Tags:</strong>
                                            <div class="row">
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="1"> Paleo</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="2"> High fiber</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="3"> One pot</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="4"> Instant pot</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="5"> Slow cooker</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="6"> Salad</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="7"> Soup</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="8"> Smoothie</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="9"> Simple meals</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="tag[]"
                                                            value="10"> No cooking</label></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <strong>Contains:</strong>
                                            <div class="row">
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="1"> Meat</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="2"> Fish</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="3"> Shellfish</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="4"> Soy</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="5"> Tree nuts</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="6"> Eggs</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="7"> Dairy</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="8"> Gluten</label></div>
                                                <div class="col-3"><label><input type="checkbox" name="contain[]"
                                                            value="9"> Peanuts</label></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="image">Image </label>
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <input type="file" name="image" id="customFileEg1"
                                                        class="custom-file-input form-group form-control">

                                                    <label class="custom-file-label"
                                                        for="customFileEg1">{{ 'choose' }}
                                                        {{ 'file' }}</label>

                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-bottom:0%;">
                                                <center>
                                                    <img style="width: 150px;border: 1px solid; border-radius: 10px;"
                                                        id="viewer"
                                                        @if (isset($product)) src="{{ asset('image') }}/{{ $product['image'] }}"
                                                         @else
                                                        src="{{ asset('images/picture.jpg') }}" @endif
                                                        alt="image" />
                                                </center>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
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
                        <h4 class="card-title">Meal</h4>
                        <div class="row">
                            @foreach ($meals as $key => $meal)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 px-3">
                                    <div class="card ">
                                        <div><img src="{{ asset('image') }}/{{ $meal->image }}" width="362"
                                                height="200"></div>
                                        <div class="card-body border" style="padding: 20px !important;">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('meal.edit', ['id' => $meal->id]) }}"><i
                                                        class="fa fa-pencil aria-hidden="
                                                        style="margin-right: 10px;"></i></a>
                                                <a href="{{ route('meal.destroy', ['id' => $meal->id]) }}"><i
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

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $('body').on('click', '.editmeal', function() {
            //     var food_id = $(this).data('id');

            //     $.get("{{ url('food') }}" + '/' + 'edit/' + food_id, function(
            //         data) {
            //         $('#foodmodal').modal('show');
            //         $('#food_id').val(data.id);
            //         $('#food_name').val(data.food_name);
            //         $('#serving_size').val(data.serving_size);
            //         $('#serving_type').val(data.serving_type);
            //         $('#calories').val(data.calories);
            //         $('#protein').val(data.protein);
            //         $('#carbs').val(data.carbs);
            //         $('#fat').val(data.fat);
            //         $('#saturated_fat').val(data.saturated_fat);
            //         $('#trans_fat').val(data.trans_fat);
            //         $('#polyunsaturated_fat').val(data.polyunsaturated_fat);
            //         $('#monounsaturated_fat').val(data.monounsaturated_fat);
            //         $('#cholesterol').val(data.cholesterol);
            //         $('#sodium').val(data.sodium);
            //         $('#dietary_fiber').val(data.dietary_fiber);
            //         $('#sugar').val(data.sugar);
            //         $('#vitamin_a').val(data.vitamin_a);
            //         $('#vitamin_c').val(data.vitamin_c);
            //         $('#vitamin_d').val(data.vitamin_d);
            //         $('#vitamin_e').val(data.vitamin_e);
            //         $('#thiamin').val(data.thiamin);
            //         $('#riboflavin').val(data.riboflavin);
            //         $('#niacin').val(data.niacin);
            //         $('#vitamin_b_6').val(data.vitamin_b_6);
            //         $('#vitamin_b_12').val(data.vitamin_b_12);
            //         $('#pantothenic_acid').val(data.pantothenic_acid);
            //         $('#calcium').val(data.calcium);
            //         $('#iron').val(data.iron);
            //         $('#potassium').val(data.potassium);
            //         $('#phosphorus').val(data.phosphorus);
            //         $('#magnesium').val(data.magnesium);
            //         $('#zinc').val(data.zinc);
            //         $('#selenium').val(data.selenium);
            //         $('#copper').val(data.copper);
            //         $('#manganese').val(data.manganese);
            //         $('#alcohol').val(data.alcohol);
            //         $('#caffeine').val(data.caffeine);
            //     })
            // });
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#add_size_row_btn').addEventListener('click', function() {
                add_size_row();
            });
        });
    </script>
    <style>
        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 863px !important;
            }
        }
    </style>
@endsection
