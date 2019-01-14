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
                        <div class="col">
                            @if(count($datams) > 0)
                                @foreach($datams->groupBy('day') as $ds)
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="text-uppercase mb-0">{{$ds[0]->day}} - {{$monthName}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm card-text">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Meal</th>
                                                        <th>Bazar</th>
                                                        <th>Deposit</th>
                                                        @role(['admin', 'mealManager'])
                                                            <th></th>
                                                        @endrole
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center">

                                                    @foreach($ds as $d)
                                                    <tr>
                                                        <td>{{$d['name']}}</td>
                                                        <td>{{$d->meal}}</td>
                                                        <td>{{$d->bazar}}</td>
                                                        <td>{{$d->deposit}}</td>
                                                        @role(['admin', 'mealManager'])
                                                            <td>
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                <a href="{{route('datam.delete', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Entry ?')">&#10006;</a>
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
                                        <h6 class="text-uppercase mb-0">Nothing to show</h6>
                                    </div>
                                    <div class="card-body">This mealsystem is not hatched yet.</div>
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

</body>

</html>