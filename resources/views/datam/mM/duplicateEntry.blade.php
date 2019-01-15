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
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h6 text-uppercase mb-0">Duplicate Entry</h3>
                            </div>
                            <div class="card-body text-center">
                                @if(($x * 1) === 0)
                                    {{$user->name}} has already given data for {{$day}} - {{$monthName}}.<hr>
                                    Please edit that on <a href="{{route('show.member.data', ['msid' => $va['ms']->id])}}">Given Table</a>.
                                @elseif(($x * 1) === 1)
                                    {{$user->name}} has already deleted data for {{$day}} - {{$va['monthName']}}.<hr>
                                    Please undo that first on <a href="{{route('show.member.data', ['msid' => $va['ms']->id])}}">Given Table</a>.
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
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