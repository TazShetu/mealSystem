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
            <section class="pt-5 mb-5">
                <div class="container mt-3">
                    <div class="row mb-3">
                        <div class="col mb-4">
                            @if(count($mealData) > 0)
                                @foreach($mealData->groupBy('day') as $ds)
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="text-uppercase mb-0">{{$ds[0]->day}} - {{$monthName}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive" style="background-color: #fffaef;">
                                                <table class="table table-striped table-sm card-text">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Meal</th>
                                                        <th>Bazar</th>
                                                        <th>Deposit</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    @foreach($ds as $d)
                                                        <tr>
                                                            <td>{{$d['name']}}</td>
                                                            <td>{{$d->meal}}</td>
                                                            <td>{{$d->bazar}}</td>
                                                            <td>{{$d->deposit}}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Accept</a>
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                <a href="{{route('memdata.delete', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Data?')">Reject</a>
                                                            </td>
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
                                        <h6 class="text-uppercase mb-0">Unaccepted Meal Data</h6>
                                    </div>
                                    <div class="card-body">No Meal Data To Show.</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-uppercase mb-0">Unaccepted Expense Data</h6>
                                </div>
                                <div class="card-body">
                                    @if(count($expData) > 0)
                                        <div class="table-responsive" style="background-color: #fffaef;">
                                            <table class="table table-striped table-hover card-text">
                                                <thead class="text-center">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Expense</th>
                                                    <th>Remark</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @foreach($expData as $e)
                                                    <tr>
                                                        <td>{{$e->day}} / {{$e->month}}</td>
                                                        <td>{{$e['name']}}</td>
                                                        <td>{{$e->exp}}</td>
                                                        <td>{{$e->remark}}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-primary btn-sm mb-1">Accept</a>
                                                            <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                            <a href="{{route('exp.delete.unaccepted', ['eid' => $e->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Expense?')">Reject</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        No Expense Data To Show.
                                    @endif
                                </div>
                            </div>
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

</body>

</html>