<!DOCTYPE html>
<html>
@include('v2includes.head')
<body>

<!-- navbar-->
@include('v2includes.navHeader')


<div class="d-flex align-items-stretch" id="gradient">

    @include('v2includes.sidebar')


    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">

            <section class="pt-5">
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h2 class="h6 text-uppercase mb-0">All Expenses</h2>
                            </div>
                            <div class="chart-holder">
                                <div id="utilityPersonalTotal"  style="height: 560px; margin: auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h2 class="h6 text-uppercase mb-0">Utility Balance</h2>
                            </div>
                            <div class="chart-holder">
                                <div id="utilityBalances"  style="height: 560px; margin: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col">
                            @if(count($allsxpenses) > 0)
                                @foreach($allsxpenses->groupBy('day') as $ExpPD)
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="text-uppercase mb-0">{{$ExpPD[0]->day}} - {{$va['monthName']}}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover card-text">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Expense</th>
                                                    <th>Remark</th>
                                                    @role(['admin', 'mealManager'])
                                                        <th></th>
                                                    @endrole
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ExpPD as $e)
                                                    <tr>
                                                        <td>{{$e->name}}</td>
                                                        <td>{{$e->exp}}</td>
                                                        <td>{{$e->remark}}</td>
                                                        @role(['admin', 'mealManager'])
                                                            <td class="text-center">
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                <a href="#" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Expense?')">&#10006;</a>
                                                            </td>
                                                        @endrole
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                            @else
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="text-uppercase mb-0">No Expense</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        No one has added any utility coast yet.
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('v2includes.footer')
    </div>

</div>

@include('v2includes.buttonTheme')

<!-- JavaScript files-->
@include('v2includes.scriptTag')
{{--home.js for graph add--}}
<script src="{{asset('v2/js/EChrts.min.js')}}"></script>
@include('v2includes.utilityJs')

</body>

</html>