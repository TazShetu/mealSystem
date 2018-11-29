@include('includes.header')
<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Choose, who to add in current month</h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card text-center bg-success">
                            <div class="card-body">
                                <form action="" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="category"><h4>Select member from last month</h4></label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($members as $m)
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="submit">Add</button>
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




@include('includes.footer')


{{--Edit user modal--}}
@include('includes.euModal')


<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->


</body>
</html>