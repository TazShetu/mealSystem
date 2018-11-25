<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--link-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/fontawesome.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">


    <title>Meal System</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
</head>
<body>

<!--....NAV BAR....  -->
@include('includes.navbar')

<header id="home-section" class="HomE">
    <div class="dark-overlay">
        <div class="home-inner">
            <h1 class="text-center">Welcome back <strong>Taz</strong></h1>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-info btn-block btn-lg" data-toggle="modal" data-target="#newModal">
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
                <div class="row">
                    <!--<div class="col-lg-12 text-center">-->
                    <!--<h1 class="display-3">Meal-rate is <strong>500</strong> Tk/meal</h1>-->
                    <!--</div>-->
                    <div class="col-lg-12 text-center">
                        <div class="card bg-success text-center card-form">
                            <div class="card-body">
                                <h3 class="display-4">Meal-rate is <strong><b>100</b></strong> Tk/meal</h3>
                            </div>
                        </div>
                        <br>
                        <div class="card bg-info text-center card-form">
                            <div class="card-body">
                                <h3 class="display-6">Your balance <strong><b> + - 100</b></strong> Tk</h3>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-lg btn-success btn-block"><i class="fa fa-bars" style="font-size: 20px;"></i>&nbsp; View personal Table</a>
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
<footer id="main-footer" class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="py-4">
                    <h1 class="h3">Taz Inc.</h1>
                    <p>Copyright &copy; 2018</p>
                    <button class="btn btn-success" data-toggle="modal" data-target="#contactModal">Contact Us</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- .....Contact Modal....  -->
<div class="modal fade text-dark" id="contactModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">Contact US</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mesage</label>
                        <textarea class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block">Submit</button>
            </div>
        </div>
    </div>
</div>

<!--   editModal -->
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

<!--   newModal -->
<div class="modal fade" id="newModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content Ms">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Enter New Data</h5>
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
                <button type="submit" class="btn btn-success btn-block"><b>Submit</b></button>
            </div>
        </div>
    </div>
</div>



<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>