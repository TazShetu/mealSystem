@include('includes.header')

@include('includes.navU')

<header id="home-section" class="utility">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if(($nd * 1) === 1)
                            {{--current month--}}
                            @role(['admin', 'mealManager'])
                                <a href="{{route('create.exp', ['msid' => $ms->id])}}" class="btn btn-info">New Expense ({{$mn}})</a>
                                <hr>
                            @else
                                <a href="{{route('mcreate.exp', ['slug' => $u->slug, 'msid' => $ms->id])}}" class="btn btn-info">New Expense ({{$mn}})</a>
                                <hr>
                            @endrole
                        @endif
                        @if(($nd * 1) === 2)
                            {{--past month--}}
                            @role(['admin', 'mealManager'])
                                <a href="{{route('pcreate.exp', ['msid' => $ms->id])}}" class="btn btn-info">New Expense ({{$mn}})</a>
                                <hr>
                            @else
                                <a href="{{route('mpcreate.exp', ['slug' => $u->slug, 'msid' => $ms->id])}}" class="btn btn-info">New Expense ({{$mn}})</a>
                                <hr>
                            @endrole
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <a href="{{route('details.exps', ['msid' => $ms->id])}}" class="btn btn-secondary">Details ({{$mn}})</a>
                            </div>
                            @if(count($amounts) > 0 )
                            <div class="card-body">
                               <table class="table table-striped">
                                   <thead class="text-dark">
                                       <tr class="text-center">
                                           <th>Name</th>
                                           <th>Amount</th>
                                       </tr>
                                   </thead>
                                   <tbody class="text-dark">
                                       @foreach($amounts as $e)
                                           <tr class="text-center">
                                               <td>{{$e->user->name}}</td>
                                               <td><span @php if ($e->expA < 0){echo 'style="color: red";';}@endphp >{{$e->expA}}</span></td>
                                           </tr>
                                       @endforeach
                                   </tbody>
                               </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        @if((($x * 1) === 1) && $pms)
                            <a href="{{route('p.utility', ['pmsid' => $pms->id])}}" class="btn btn-light pull-left"><i class="fa fa-angle-double-left" style="font-size: 20px;"></i> {{$pmn}}</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if($x === null && $pmn === null && $pms === null)
                            <a href="{{route('utility')}}" class="btn btn-light pull-right">{{$nmn}} <i class="fa fa-angle-double-right" style="font-size: 20px;"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{--Edit user modal--}}
@include('includes.euModal')

<!--.......main Footer....  -->
@include('includes.footer')


<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->



</body>
</html>