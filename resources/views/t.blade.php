@include('includes.header')

<!--....NAV BAR....  -->
@include('includes.navbar')



<section id="home-section" class="ProfilE">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <!--<div class="col-lg-12 text-center">-->
                    <!--<h1 class="display-3">Meal-rate is <strong>500</strong> Tk/meal</h1>-->
                    <!--</div>-->
                    <div class="col-lg-12 text-center">

                        <!--<a href="#" class="btn btn-lg btn-success btn-block" style="padding: 25px 0;"><i class="fa fa-bars"></i>&nbsp; View personal Table</a>-->
                        <!--<br>-->
                        <a href="#" class="btn btn-success btn-block" ><i class="fa fa-table" aria-hidden="true"></i>&nbsp; <span style="font-size: 25px;"> View full Table</span></a>
                        <br>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Bazar</th>
                            <th>Meal</th>
                        </tr>
                        </thead>
                        <tbody>

                        <!--Loop start-->

                        <tr>
                            <td>Default</td>
                            <td>Defaultson</td>
                            <td>def@somemail.com</td>
                        </tr>

                        <!--loop end-->

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="" class="btn btn-success pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> Previous Month</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="" class="btn btn-success pull-right">Current Month <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--.......main Footer....  -->
@include('includes.footer')

<!--script-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/fontawesome.min.js"></script>-->

</body>
</html>