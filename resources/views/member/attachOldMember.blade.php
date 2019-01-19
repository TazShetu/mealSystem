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
                <div class="container">
                    <div class="row mt-3">
                        <div class="col mb-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 text-uppercase mb-0">Select old Member</h3>
                                    @if($va['pastMonthName'])
                                        <p class="text-muted mb-0">from {{$va['pastMonthName']}}</p>
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if(count($members) > 0)
                                        <form action="{{route('attach.old.member.update', ['msid' => $va['ms']->id])}}" method="post">
                                            @csrf
                                            @if($errors->has('names'))
                                                <span class="help-block text-danger">Please select at least one name.</span>
                                                <hr>
                                            @endif
                                            @foreach($members as $m)
                                                <div class="form-check ml-5">
                                                    <input class="form-check-input" type="checkbox" name="names[]" value="{{$m->id}}">
                                                    <label class="form-check-label">{{$m->name}}</label>
                                                </div><br>
                                            @endforeach
                                            <div class="form-group ml-5 mt-3">
                                                <button type="submit" class="btn btn-primary">Attach Member</button>
                                            </div>
                                        </form>
                                    @else
                                        No Old Member To Attach <span class="text-primary">!</span>
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