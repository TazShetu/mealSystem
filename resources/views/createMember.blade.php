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
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 text-uppercase mb-0">Create new Member</h3>
                                    <p class="text-muted mb-0">for January</p>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group text-center text-primary">
                                            <p>Default password is <b>123456</b> but member can change that later.</p>
                                            <p>Do not forget to give members their usernames personally.</p>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-control-label text-uppercase"><b>Name</b></label>
                                            <input type="text" class="form-control" name="date">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-control-label text-uppercase"><b>Username</b></label>
                                            <input type="text" class="form-control" name="date">
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Create Member</button>
                                        </div>
                                    </form>
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