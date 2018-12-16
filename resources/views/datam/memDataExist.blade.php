@include('includes.header')

<!--....NAV BAR before login....  -->
@include('includes.navbar')

@php
    $o = DateTime::createFromFormat('!m', $month);
    $mn = $o->format('F');
@endphp
<div class="container" style="padding-top: 200px;">
    <div class="row">
        <div class="col">
            <div class="card bg-success">
                <div class="card-header text-center">
                    <h3><span style="color: #fef4d1">{{$user->name}}</span> has already given data for "<span style="color: #fef4d1">{{$day}}</span > - <span style="color: #fef4d1">{{$mn}}</span>"</h3>
                </div>
                <div class="card-body text-center">
                    <p>You can accept / edit / delete that in given data table.</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('show.memd', ['month' => $month])}}" class="btn btn-outline-warning">Given Data Table</a>
                </div>
            </div>
        </div>
    </div>
</div>



<!--.......main Footer....  -->
<footer>
    <div class="text-center fixed-bottom bg-dark">
        <h5 class="h3">Taz Inc. <span style="font-size: 17px;">Copyright &copy; 2018</span></h5>
    </div>
</footer>





<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->




</body>
</html>

<style>
    body{
        background: url("{{asset('img/cM.jpg')}}") no-repeat;
        background-size: cover;
        background-attachment: fixed;
        min-height: 900px;
    }
</style>