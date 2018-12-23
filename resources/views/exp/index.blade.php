@include('includes.header')

@include('includes.navU')

<header id="home-section" class="utility">
    <div class="dark-overlay">
        <div class="home-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="" class="btn btn-info">New Expense</a>
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <a href="" class="btn btn-outline-info">Details</a>
                            </div>
                            <div class="card-body">
                               <table class="table table-striped">
                                   <thead class="text-dark">
                                       <tr class="text-center">
                                           <th>Name</th>
                                           <th>Amount</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       @foreach($expA as $e)
                                           <tr class="text-center">
                                               <td>{{$e->user->name}}</td>
                                               <td>{{$e->expA}}</td>
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