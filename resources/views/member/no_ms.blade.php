@include('includes.header')

<!--....NAV BAR before login....  -->
@include('includes.navbar')


<div class="container" style="padding-top: 200px;">
    <div class="row">
        <div class="col">
            <div class="card bg-success">
                <div class="card-header text-center">
                    <h3>You are not added to new meal system yet.</h3>
                    <p>Tell your meal manager to add you personally.</p>
                </div>
                <div class="card-footer bg-success">
                    <a href="{{route('home')}}" class="btn btn-outline-light btn-block">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes.euModal')

<!--.......main Footer....  -->
<footer class="fixed-bottom">
    <div class="text-center pt-1">
        <h5>Taz Inc. <span style="font-size: 17px;">Copyright &copy; 2018 </span></h5>
    </div>
</footer>





<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->




</body>
</html>