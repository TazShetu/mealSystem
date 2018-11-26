@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')
@role(['admin', 'mealManager'])
<header id="home-section" class="createData">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Enter/Edit Data</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <form action="" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$ms->id}}" name="mealsystem_id">
                                    <div class="form-group">
                                        <label class="lead"><b>Date</b></label>
                                        <input type="date" class="form-control" name="date">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Name</label>
                                        <select name="user_id" id="name" class="form-control">
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($ms->users as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="lead"><b>Meal</b></label>
                                        <input type="number" class="form-control" name="meal">
                                    </div>
                                    <div class="form-group">
                                        <label class="lead"><b>Bazar</b></label>
                                        <input type="number" class="form-control" name="bazar">
                                    </div>

                                    <div class="form-group">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endrole


{{--///////////////////////////////////////////////////////////////////////////////////////--}}
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
{{--///////////////////////////////////////////////////////////////////////////////////////////////////--}}

@include('includes.footer')

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>