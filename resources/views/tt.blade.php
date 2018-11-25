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



<header id="home-section" class="TablE">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">

                    <!--loop start of DATE-->

                    <h1 class="text-center pull-right">2.2.2</h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Meal</th>
                            <th>Bazar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--loop start for member-->
                        <tr>
                            <td>TAz</td>
                            <td>2</td>
                            <td>500</td>
                        </tr>
                        <!--loop end for member-->
                        <!----------------------->
                        <tr>
                            <td>TAz</td>
                            <td>2</td>
                            <td>500</td>
                        </tr>
                        <!------------------------->
                        </tbody>
                    </table>

                    <!--loop end of DATE-->

                    <!--====================================================-->
                    <h1 class="text-center pull-right">3.2.2</h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Meal</th>
                            <th>Bazar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--loop start for member-->
                        <tr>
                            <td>FRG</td>
                            <td>1</td>
                            <td>00</td>
                        </tr>
                        <!--loop end for member-->
                        <!----------------------->
                        <tr>
                            <td>gdsgf</td>
                            <td>0</td>
                            <td>100</td>
                        </tr>
                        <!------------------------->
                        </tbody>
                    </table>
                    <!--=======================================================-->


                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="" class="btn btn-success"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> Previous Month</a>
                    </div>
                    <div class="col-sm-8">
                        <a href="" class="btn btn-success pull-right">Current Month <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
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

<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>