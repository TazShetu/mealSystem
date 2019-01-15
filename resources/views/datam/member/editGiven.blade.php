<!DOCTYPE html>
<html>
@include('v2includes.head')
<body>

<!-- navbar-->
@include('v2includes.navHeader')


<div class="d-flex align-items-stretch " id="gradient">

    @include('v2includes.sidebar')

    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
            <section class="pt-5">
                <div class="row mt-3">
                    <div class="col-lg-2 col-md-1"></div>
                    <div class="col-lg-8 col-md-10 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h6 text-uppercase mb-0">Edit Meal</h3>
                            </div>
                            <div class="card-body">
                                {{--<p class="text-muted">Edit Meal Data</p>--}}
                                <form action="{{route('datam.member.update.given', ['did' => $data->id])}}" method="post">
                                    @csrf
                                    <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Date</b></label>
                                        <p class="bg-light text-dark p-1">{{$data->day}} - {{$monthName}}</p>
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Name</b></label>
                                        <p class="bg-light text-dark p-1">{{$userName}}</p>
                                    </div>
                                    <div class="form-group {{$errors->has('meal') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Meal</b></label>
                                        <input type="number" min="0" class="form-control" name="meal" value="{{$data->meal}}">
                                        @if($errors->has('meal'))
                                            <span class="help-block text-danger">{{$errors->first('meal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('bazar') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Bazar</b></label>
                                        <input type="number" min="0" class="form-control" name="bazar" value="{{$data->bazar}}">
                                        @if($errors->has('bazar'))
                                            <span class="help-block text-danger">{{$errors->first('bazar')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('deposit') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Deposit</b></label>
                                        <input type="number" min="0" class="form-control" name="deposit" value="{{$data->deposit}}">
                                        @if($errors->has('deposit'))
                                            <span class="help-block text-danger">{{$errors->first('deposit')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-1"></div>
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