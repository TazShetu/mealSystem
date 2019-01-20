<!DOCTYPE html>
<html>
@include('v2includes.head')
<body>

<!-- navbar-->
@include('v2includes.navHeaderPast')


<div class="d-flex align-items-stretch " id="gradient">

    @include('v2includes.sidebarPast')

    <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
            <section class="pt-5">
                <div class="row mt-3">
                    <div class="col-lg-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h6 text-uppercase mb-0">Meal</h3>
                            </div>
                            <div class="card-body">
                                @if(session('mealDataSuccess'))
                                    <div class="alert alert-success text-center">
                                        {{session('mealDataSuccess')}}
                                    </div>
                                @endif
                                <p class="text-muted">Enter / Edit Meal Data</p>
                                        {{--     MEAL    form           --}}
                                <form action="{{route('mM.store.mdata.past', ['pmsid' => $va['pms']->id])}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-control-label text-uppercase"><b>Month</b></label>
                                                <h5 class="bg-light p-1">{{$va['monthName']}}</h5>
                                            </div>
                                            <div class="col {{$errors->has('day') ? 'has-error' : ''}}">
                                                <label class="form-control-label text-uppercase"><b>Day</b></label>
                                                <input type="number" step="1" class="form-control" name="day" value="{{old('day')}}" required>
                                                @if($errors->has('day'))
                                                    <span class="help-block text-danger">{{$errors->first('day')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Name</b></label>
                                        <select name="name" id="name" class="form-control" required>
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($users as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('name'))
                                            <span class="help-block text-danger">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('meal') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Meal</b></label>
                                        <input type="number" min="0" class="form-control" name="meal" value="{{old('meal')}}">
                                        @if($errors->has('meal'))
                                            <span class="help-block text-danger">{{$errors->first('meal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('bazar') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Bazar</b></label>
                                        <input type="number" min="0" class="form-control" name="bazar" value="{{old('bazar')}}">
                                        @if($errors->has('bazar'))
                                            <span class="help-block text-danger">{{$errors->first('bazar')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('deposit') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Deposit</b></label>
                                        <input type="number" min="0" class="form-control" name="deposit" value="{{old('deposit')}}">
                                        @if($errors->has('deposit'))
                                            <span class="help-block text-danger">{{$errors->first('deposit')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h6 text-uppercase mb-0">Utility</h3>
                            </div>
                            <div class="card-body">
                                @if(session('utilityDataSuccess'))
                                    <div class="alert alert-success text-center">
                                        {{session('utilityDataSuccess')}}
                                    </div>
                                @endif
                                <p class="text-muted">Enter / Edit Expense</p>
                                            {{--  UTILITY       form--}}
                                <form action="{{route('exp.store.past', ['pmsid' => $va['pms']->id])}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-control-label text-uppercase"><b>Month</b></label>
                                                <h5 class="bg-light p-1">{{$va['monthName']}}</h5>
                                            </div>
                                            <div class="col {{$errors->has('day') ? 'has-error' : ''}}">
                                                <label class="form-control-label text-uppercase"><b>Day</b></label>
                                                <input type="number" step="1" class="form-control" name="Day" value="{{old('Day')}}" required>
                                                @if($errors->has('Day'))
                                                    <span class="help-block text-danger">{{$errors->first('Day')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Name</b></label>
                                        <select name="nameExp" id="nameExp" class="form-control" required>
                                            <option value="" hidden disabled selected>Choose One</option>
                                            @foreach($users as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('nameExp'))
                                            <span class="help-block text-danger">Name field is required.</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('exp') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Expense</b></label>
                                        <input type="number" min="0" class="form-control" name="exp" value="{{old('exp')}}" required>
                                        @if($errors->has('exp'))
                                            <span class="help-block text-danger">Expense field is required.</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{$errors->has('remark') ? 'has-error' : ''}}">
                                        <label class="form-control-label text-uppercase"><b>Remark</b></label>
                                        <textarea class="form-control" name="remark" cols="30" rows="4" maxlength="50">{{old('remark')}}</textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Add Expense</button>
                                    </div>
                                </form>
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