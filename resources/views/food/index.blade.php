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

                <li class="nav-item active"> <a class="nav-link" href="#">Exercises</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Workouts</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Programs</a></li>
            </ul>
            <ul class="nav flex-column sub-menu"><b style="color: white">NUTRITION</b>
                <li class="nav-item"> <a class="nav-link" href="#">Meals</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('food') }}">Foods</a></li>

            </ul>
        </div>
    </li>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Meal Management </h2>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#foodmodal">
                        Create Food
                    </button>
                    <div class="modal fade" id="foodmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {!! Form::open(['route' => 'food.store', 'method' => 'POST']) !!}
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="food_id" id="food_id" value="">
                                        <div class="col-xs-6 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Food Name:</strong>
                                                <input type="text" id="food_name" name="food_name"
                                                    class="form-group form-control" placeholder="Food Name" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Serving Size:</strong>
                                                <input type="text" id="serving_size" name="serving_size"
                                                    class="form-group form-control" placeholder="Size" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Serving Type:</strong>
                                                <select id="serving_type" name="serving_type"
                                                    class="form-group form-control" required>
                                                    <option value="1">g</option>
                                                    <option value="2">oz</option>
                                                    <option value="3">lbs</option>
                                                    <option value="4">ml</option>
                                                    <option value="5">cup</option>
                                                    <option value="6">fl oz</option>
                                                    <option value="7">tsp</option>
                                                    <option value="8">tbsp</option>
                                                    <option value="9">custom</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Calories:</strong>
                                                <input type="text" id="calories" name="calories"
                                                    class="form-group form-control" placeholder="Calories" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Protein (g):</strong>
                                                <input type="text" id="protein" name="protein"
                                                    class="form-group form-control" placeholder="Protein" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Carbs (g):</strong>
                                                <input type="text" id="carbs" name="carbs"
                                                    class="form-group form-control" placeholder="Carbs" required />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <strong>Fat (g):</strong>
                                                <input type="text" id="fat" name="fat"
                                                    class="form-group form-control" placeholder="Fat" required />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mt-3 d-flex justify-content-between border-bottom">
                                        <h4>NUTRITION FACTS</h4>
                                        <p>All nutritional facts count for entered serving size of custom food</p>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Saturated Fat (g):</strong>
                                                <input type="text" id="saturated_fat" name="saturated_fat"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Trans Fat (g):</strong>
                                                <input type="text" id="trans_fat" name="trans_fat"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Polyunsaturated Fat (g):</strong>
                                                <input type="text" id="polyunsaturated_fat" name="polyunsaturated_fat"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Monounsaturated Fat (g):</strong>
                                                <input type="text" id="monounsaturated_fat" name="monounsaturated_fat"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Cholesterol (mg):</strong>
                                                <input type="text" id="cholesterol" name="cholesterol"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Sodium (mg):</strong>
                                                <input type="text" id="sodium" name="sodium"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Dietary Fiber (g):</strong>
                                                <input type="text" id="dietary_fiber" name="dietary_fiber"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Total Sugars (g):</strong>
                                                <input type="text" id="sugar" name="sugar"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin A (iu):</strong>
                                                <input type="text" id="vitamin_a" name="vitamin_a"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin C (mg):</strong>
                                                <input type="text" id="vitamin_c" name="vitamin_c"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin D (mcg/iu):</strong>
                                                <input type="text" id="vitamin_d" name="vitamin_d"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin E (mg):</strong>
                                                <input type="text" id="vitamin_e" name="vitamin_e"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Thiamin (mg):</strong>
                                                <input type="text" id="thiamin" name="thiamin"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Riboflavin (mg):</strong>
                                                <input type="text" id="riboflavin" name="riboflavin"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Niacin (mg):</strong>
                                                <input type="text" id="niacin" name="niacin"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin B 6 (mg):</strong>
                                                <input type="text" id="vitamin_b_6" name="vitamin_b_6"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Vitamin B 12 (mcg):</strong>
                                                <input type="text" id="vitamin_b_12" name="vitamin_b_12"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Pantothenic Acid (mg):</strong>
                                                <input type="text" id="pantothenic_acid" name="pantothenic_acid"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Calcium (mg):</strong>
                                                <input type="text" id="calcium" name="calcium"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Iron (mg):</strong>
                                                <input type="text" id="iron" name="iron"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Potassium (mg):</strong>
                                                <input type="text" id="potassium" name="potassium"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Phosphorus (mg):</strong>
                                                <input type="text" id="phosphorus" name="phosphorus"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Magnesium (mg):</strong>
                                                <input type="text" id="magnesium" name="magnesium"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Zinc (mg):</strong>
                                                <input type="text" id="zinc" name="zinc"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Selenium (mcg):</strong>
                                                <input type="text" id="selenium" name="selenium"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Copper (mg):</strong>
                                                <input type="text" id="copper" name="copper"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Manganese (mg):</strong>
                                                <input type="text" id="manganese" name="manganese"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Alcohol (g):</strong>
                                                <input type="text" id="alcohol" name="alcohol"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                                            <div class="form-group">
                                                <strong>Caffeine (mg):</strong>
                                                <input type="text" id="caffeine" name="caffeine"
                                                    class="form-group form-control" placeholder="E.g. '12'" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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
                        <h4 class="card-title">Food</h4>
                        <table class="table data-table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Serving Size</th>
                                    <th>Cals</th>
                                    <th>Protein</th>
                                    <th>Carbs</th>
                                    <th>Fat</th>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('food.list') }}",
                dom: 'Blfrtip',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'food_name',
                        name: 'food_name'
                    },
                    {
                        data: 'serving_size',
                        name: 'serving_size'
                    },
                    {
                        data: 'calories',
                        name: 'calories'
                    },
                    {
                        data: 'protein',
                        name: 'protein'
                    },
                    {
                        data: 'carbs',
                        name: 'carbs'
                    },
                    {
                        data: 'fat',
                        name: 'fat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $('body').on('click', '.editfood', function() {
                var food_id = $(this).data('id');

                $.get("{{ url('food') }}" + '/' + 'edit/' + food_id, function(
                    data) {
                    $('#foodmodal').modal('show');
                    $('#food_id').val(data.id);
                    $('#food_name').val(data.food_name);
                    $('#serving_size').val(data.serving_size);
                    $('#serving_type').val(data.serving_type);
                    $('#calories').val(data.calories);
                    $('#protein').val(data.protein);
                    $('#carbs').val(data.carbs);
                    $('#fat').val(data.fat);
                    $('#saturated_fat').val(data.saturated_fat);
                    $('#trans_fat').val(data.trans_fat);
                    $('#polyunsaturated_fat').val(data.polyunsaturated_fat);
                    $('#monounsaturated_fat').val(data.monounsaturated_fat);
                    $('#cholesterol').val(data.cholesterol);
                    $('#sodium').val(data.sodium);
                    $('#dietary_fiber').val(data.dietary_fiber);
                    $('#sugar').val(data.sugar);
                    $('#vitamin_a').val(data.vitamin_a);
                    $('#vitamin_c').val(data.vitamin_c);
                    $('#vitamin_d').val(data.vitamin_d);
                    $('#vitamin_e').val(data.vitamin_e);
                    $('#thiamin').val(data.thiamin);
                    $('#riboflavin').val(data.riboflavin);
                    $('#niacin').val(data.niacin);
                    $('#vitamin_b_6').val(data.vitamin_b_6);
                    $('#vitamin_b_12').val(data.vitamin_b_12);
                    $('#pantothenic_acid').val(data.pantothenic_acid);
                    $('#calcium').val(data.calcium);
                    $('#iron').val(data.iron);
                    $('#potassium').val(data.potassium);
                    $('#phosphorus').val(data.phosphorus);
                    $('#magnesium').val(data.magnesium);
                    $('#zinc').val(data.zinc);
                    $('#selenium').val(data.selenium);
                    $('#copper').val(data.copper);
                    $('#manganese').val(data.manganese);
                    $('#alcohol').val(data.alcohol);
                    $('#caffeine').val(data.caffeine);
                })
            });
        });
    </script>
@endsection
<style>
    @media (min-width: 1200px) {
        .modal-xl {
            max-width: 1550px !important;
        }
    }
</style>
