@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
@php
    $month = \Carbon\Carbon::now()->month;
    $a = Auth::user();
    $ms = $a->mealsystems()->where('month', $month)->first();
    if ($ms){
        $am = $a->amountus()->where('mealsystem_id', $ms->id)->first();
    } else {
        $am = 0;
    }
    if ($month == 1){
            $pmonth = 12;
    }else {
            $pmonth = $month - 1 ;
    }
    $pms = $a->mealsystems()->where('month', $pmonth)->first();

@endphp
<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Welcome back <strong>{{Auth::user()->name}}</strong></h1>
            <br>
            <div class="container">
                @role(['admin', 'mealManager'])
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('datam.create')}}" class="btn btn-info btn-block btn-lg">
                                <b>Enter <span style="font-size: 25px;'">New</span> Data</b>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#" class="btn btn-outline-info btn-block btn-lg" data-toggle="modal" data-target="#editModal">
                                <b>Edit <span style="font-size: 25px;'">Old</span> Data</b>
                            </a>
                        </div>
                    </div>
                    <br>
                @endrole
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="card bg-success text-center card-form">
                            <div class="card-body">
                                @if($ms)
                                    <h3 class="display-4">Meal-rate is <strong><b>{{$ms->meal_rate}}</b></strong> Tk/meal</h3>
                                @else
                                    <h3>New month New meal-system</h3>
                                    <h3>Do not forget to</h3>
                                    <h3 class="display-3">Add member to new meal-system</h3>
                                @endif
                            </div>
                        </div>
                        <br>
                        @if($am)
                            <div class="card bg-info text-center card-form">
                                <div class="card-body">
                                    <h3 class="display-6">Your balance <span id="amountt"><strong><b>{{$am->amount}}</b></strong></span> Tk</h3>
                                </div>
                            </div>
                            <br>
                        @endif
                        @role(['admin', 'mealManager'])
                            @if($pms)
                                <a href="{{route('oldm.attach', ['id' => $a->id])}}" class="btn btn-info btn-block"><i class="fa fa-user-plus"></i>&nbsp; <h3>Add old Meal Member to new meal-system</h3></a>
                            @endif
                        @endrole
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        @if($ms)
                            <a href="{{route('p.table', ['slug' => $a->slug, 'id' => $ms->id])}}" class="btn btn-lg btn-success btn-block"><i class="fa fa-bars" style="font-size: 20px;"></i>&nbsp; View personal Table</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-lg btn-outline-success btn-block"><i class="fa fa-table" style="font-size: 20px;"></i>&nbsp; View full Table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>




<!--.......main Footer....  -->
@include('includes.footer')

<!--   editDataModal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content Ms">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Edit Old Entry</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="lead"><b>Date</b></label>
                            <div class="input-group">
                                <input type="date" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i> &#160;Select Date</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!--collapse btn-->
                        <div class="form-group">
                            <label >Select User</label>
                            <select class="form-control">
                                <option value="" hidden disabled selected>Name</option>
                                <!--loop start-->
                                <option value="">Taz</option>
                                <!--loop end-->
                                <option value="">Taz1</option>
                                <option value="">Taz2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="lead text-dark"><b>Meal</b></label>
                        <input type="number" value="2" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label class="lead text-dark"><b>Bazar</b></label>
                            <input type="number" value="0" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-edit"></i> <b>Edit</b></button>
            </div>
        </div>
    </div>
</div>



{{--Edit user modal--}}
@include('includes.euModal')


<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

<script>
    @if (count($errors) > 0)
        $('#euModal').modal('show');
    @endif
</script>


<script>
    $(function () {
        var score = parseInt($('#amountt').text().trim());
        var color = 'red';
        if (!isNaN(score)) {
            if (score >= 0) {
                color = 'white';
            }
            $('#amountt').css('color', color);
        }
    });
</script>

</body>
</html>