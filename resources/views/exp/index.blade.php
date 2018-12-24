@include('includes.header')

@include('includes.navU')

<header id="home-section" class="utility">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @role(['admin', 'mealManager'])
                            <a href="{{route('create.exp', ['msid' => $ms->id])}}" class="btn btn-info">New Expense ({{$mn}})</a>
                            <hr>
                        @else
                            <a href="" class="btn btn-info">New Expense member</a>
                            <hr>
                        @endrole
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <a href="{{route('details.exps', ['msid' => $ms->id])}}" class="btn btn-outline-info">Details ({{$mn}})</a>
                            </div>
                            <div class="card-body">
                               <table class="table table-striped">
                                   <thead class="text-dark">
                                       <tr class="text-center">
                                           <th>Name</th>
                                           <th>Amount</th>
                                       </tr>
                                   </thead>
                                   <tbody class="text-dark">
                                       @foreach($expA as $e)
                                           <tr class="text-center">
                                               <td>{{$e->user->name}}</td>
                                               <td><span @php if ($e->expA < 0){echo 'style="color: red";';}@endphp >{{$e->expA}}</span></td>
                                           </tr>
                                       @endforeach
                                   </tbody>
                               </table>
                            </div>
                        </div>
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