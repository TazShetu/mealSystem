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
                    @if(count($naD) > 0)
                        <div class="row mb-3">
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="text-uppercase mb-0">Unaccepted Data</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive" style="background-color: #fffaef;">
                                            <table class="table table-striped table-hover card-text">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Meal</th>
                                                        <th>Bazar</th>
                                                        <th>Deposit</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @if(session()->has('memdataDeleteMemberSuccess'))
                                                    <div class="alert alert-danger text-center">
                                                        {{ session()->get('memdataDeleteMemberSuccess') }}
                                                    </div>
                                                @elseif(session()->has('restoreMemberDelete'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('restoreMemberDelete') }}
                                                    </div>
                                                @endif
                                                @foreach($naD as $d)
                                                    <tr>
                                                        <td>{{$d->day}} / {{$d->month}}</td>
                                                        @if($d->dbm === null)
                                                            <td>{{$d->meal}}</td>
                                                            <td>{{$d->bazar}}</td>
                                                            <td>{{$d->deposit}}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                <a href="{{route('memdata.delete.member', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Data ?')">&#10006;</a>
                                                            </td>
                                                        @else
                                                            <td>&#10006;</td>
                                                            <td>&#10006;</td>
                                                            <td>&#10006;</td>
                                                            <td>
                                                                <a href="{{route('datam.delete.member.undo', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-info btn-sm mb-1" onclick="return confirm('Are you sure?')">Undo Delete</a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-uppercase mb-0">Personal Table</h6>
                                </div>
                                <div class="card-body">
                                    @if(count($aD) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover card-text">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Meal</th>
                                                        <th>Bazar</th>
                                                        <th>Deposit</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @if(session()->has('successDatamDeleteMember'))
                                                    <div class="alert alert-danger text-center">
                                                        {{ session()->get('successDatamDeleteMember') }}
                                                    </div>
                                                @elseif(session()->has('restoreMemberDelete'))
                                                    <div class="alert alert-success text-center">
                                                        {{ session()->get('restoreMemberDelete') }}
                                                    </div>
                                                @endif
                                                @foreach($aD as $d)
                                                    <tr>
                                                        <td>{{$d->day}} / {{$d->month}}</td>
                                                        <td>{{$d->meal}}</td>
                                                        <td>{{$d->bazar}}</td>
                                                        <td>{{$d->deposit}}</td>
                                                        @role(['admin', 'mealManager'])
                                                            <td>
                                                                <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                <a href="{{route('datam.delete', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Entry ?')">&#10006;</a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                @if($d->dbm === null)
                                                                    <a href="#" class="btn btn-outline-primary btn-sm mb-1">Edit</a>
                                                                    <a href="{{route('datam.delete.member', ['did' => $d->id])}}" class="btn btn-outline-danger btn-sm mb-1" onclick="return confirm('Are you sure, you want to delete this Entry ?')">&#10006;</a>
                                                                @else
                                                                    <a href="{{route('datam.delete.member.undo', ['uid' => $d->user_id, 'msid' => $d->mealsystem_id, 'm' => $d->month, 'd' => $d->day])}}" class="btn btn-outline-info btn-sm mb-1" onclick="return confirm('Are you sure?')">Undo Delete</a>
                                                                @endif
                                                            </td>
                                                        @endrole
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        No Meal Data To Show.
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