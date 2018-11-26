{{--find meal system of current month and auth user--}}
{{--find all the user of the ms--}}
<?php
//    $a = \Illuminate\Support\Facades\Auth::user();
//    $cm = \Carbon\Carbon::now()->month;
//    $ms = \App\Mealsystem::where('month', $cm)->get();
//    dd($ms);
//?>
<div class="modal fade" id="newModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content Ms">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Enter New Data</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="lead text-dark">Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i> &#160;Select Date</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="lead text-dark">Select User</label>
                        <select class="form-control">
                            <option value="" hidden disabled selected>Name</option>
                            <!--loop start-->
                            <option value="">Taz</option>
                            <!--loop end-->
                            <option value="">Taz1</option>
                            <option value="">Taz2</option>
                        </select>
                    </div>

                </div>
            </form>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="lead"><b>Date</b></label>
                            <div class="input-group">
                                <input type="date" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i> &#160;Select Date</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!--collapse btn-->
                        <div class="form-group">
                            <label >Select User</label>
                            <select class="form-control">
                                <option value="" hidden disabled selected>Name</option>
                                <!--loop start-->
                                <option value="">Taz</option>
                                <!--loop end-->
                                <option value="">Taz1</option>
                                <option value="">Taz2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="lead text-dark"><b>Meal</b></label>
                        <input type="number" value="2" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label class="lead text-dark"><b>Bazar</b></label>
                            <input type="number" value="0" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-block"><b>Submit</b></button>
            </div>



        </div>
    </div>
</div>