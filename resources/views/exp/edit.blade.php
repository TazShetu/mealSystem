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
                                <h3 class="h6 text-uppercase mb-0">Edit Expense</h3>
                            </div>
                            <div class="card-body">
                                {{--<p class="text-muted">Edit Meal Data</p>--}}
                                <form action="{{route('exp.update', ['eid' => $exp->id])}}" method="post">
                                    @csrf
                                    <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Date</b></label>
                                        <p class="bg-light text-dark p-1">{{$day}} - {{$monthName}}</p>
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Name</b></label>
                                        <p class="bg-light text-dark p-1">{{$userName}}</p>
                                    </div>
                                    <div class="form-group {{$errors->has('exp') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Expense</b></label>
                                        <input type="number" min="0" class="form-control" name="exp" value="{{$exp->exp}}" required>
                                        @if($errors->has('exp'))
                                            <span class="help-block text-danger">{{$errors->first('exp')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('remark') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Remark</b></label>
                                        <textarea class="form-control" name="remark" cols="30" rows="4" maxlength="50">{{$exp->remark}}</textarea>
                                        @if($errors->has('remark'))
                                            <span class="help-block text-danger">{{$errors->first('remark')}}</span>
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