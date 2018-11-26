@include('includes.header')

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
@include('includes.footer')

<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>