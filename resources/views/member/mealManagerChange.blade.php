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
                <div class="container">
                    <div class="row mt-3">
                        <div class="col mb-5">

                            @if(empty($members))
                                <div class="card">
                                <div class="card-header">
                                    <h3>No Member in Current Meal-System !</h3>
                                </div>
                                <div class="card-body">
                                    <p>Please add member in current mealsystem first.</p>
                                </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h6 text-uppercase mb-0">Select who will be Mealmanager</h3>
                                        <p class="text-muted mb-0">You will no longer be the Mealmanager.</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('mealmanager.change.store')}}" method="post">
                                            @csrf
                                            <div class="form-group {{$errors->has('member_id') ? 'has-error' : ''}}">
                                                <select name="member_id" id="member" class="form-control">
                                                    <option value="" hidden disabled selected>Choose One</option>
                                                    @foreach($members as $m)
                                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('member_id'))
                                                    <span class="help-block text-warning">{{$errors->first('member_id')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group text-center">
                                                <br>
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('You will no longer be Mealmanager. Are you sure ?');">Submit</button>
                                            </div>
                                        </form>
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



</body>

</html>