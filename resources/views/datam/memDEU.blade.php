@include('includes.header')

<!--....NAV BAR before login....  -->
@include('includes.navbar')

@php
    $u = \Illuminate\Support\Facades\Auth::user();
    $o = DateTime::createFromFormat('!m', $month);
    $mn = $o->format('F');
@endphp
<div class="container" style="padding-top: 200px;">
    <div class="row">
        <div class="col">
            @if($x === 0)
                <div class="card bg-success">
                    <div class="card-header text-center">
                        <h3>You have already given data for "<span style="color: #fef4d1">{{$day}}</span > - <span style="color: #fef4d1">{{$mn}}</span>"</h3>
                    </div>
                    <div class="card-body text-center">
                        <p>You can edit / delete that in Personal Table.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('p.table', ['slug' => $u->slug, 'id' => $msid])}}" class="btn btn-outline-warning">Personal Table</a>
                    </div>
                </div>
            @else
                <div class="card bg-success">
                    <div class="card-header text-center">
                        <h3>You have already deleted data for "<span style="color: #fef4d1">{{$day}}</span > - <span style="color: #fef4d1">{{$mn}}</span>"</h3>
                    </div>
                    <div class="card-body text-center">
                        <p>Please undo that delete in Personal Table first.</p>
                        <p>Only then you can enter data for "<span style="color: #fef4d1">{{$day}}</span > - <span style="color: #fef4d1">{{$mn}}</span>"</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('p.table', ['slug' => $u->slug, 'id' => $msid])}}" class="btn btn-outline-warning">Personal Table</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>



<!--.......main Footer....  -->
<footer>
    <div class="text-center fixed-bottom bg-dark">
        <h5 class="h3">Taz Inc. <span style="font-size: 17px;">Copyright &copy; 2018</span></h5>
    </div>
</footer>


@include('includes.euModal')



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