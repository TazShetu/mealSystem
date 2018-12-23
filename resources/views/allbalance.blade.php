@include('includes.header')

@include('includes.navbar')


@role(['admin', 'mealManager'])

<section id="home-section" class="ProfilE">
    <div class="t-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h1>All balances from <span style="color: #fef4d1">{{$mn}}</span></h1>
                    </div>
                </div>
            </div>
            <div class="container">
                {{--<div class="row">--}}
                    @if(!$amounts->isEmpty())
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($amounts as $a)
                            <tr class="text-center">
                                <td>{{$a->user->name}}</td>
                                <td><span
                                    @php
                                        if ($a->amount < 0){
                                            echo 'style="color: red"';
                                        }
                                    @endphp >
                                        {{$a->amount}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <h3 class="text-center">Still no amount to show.</h3>
                    @endif

                {{--</div>--}}
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        {{--<a href="{{route('home')}}" class="btn btn-outline-success">Back to Home</a>--}}
                        @if($pms)
                            <a href="{{route('allbalance', ['msid' => $pms->id])}}" class="btn btn-outline-light pull-left">&#171; {{$pmn}}</a>
                        @endif

                    </div>
                    <div class="col-sm-6">
                        @if($cms)
                            <a href="{{route('allbalance', ['msid' => $cms->id])}}" class="btn btn-outline-light pull-right">{{$cmn}} &#187;</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--.......main Footer....  -->
{{--@include('includes.footer')--}}


@include('includes.euModal')
@endrole

<!--script-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--<script src="js/fontawesome.min.js"></script>-->





</body>
</html>