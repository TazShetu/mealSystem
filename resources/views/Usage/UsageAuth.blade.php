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
                                    <h3 class="h6 text-uppercase mb-0">Guideline</h3>
                                    <p class="text-muted mb-0">Usage</p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Calculation result may vary from user to user by (+/-)1 Tk</b></li>
                                        <li class="list-group-item">Member has to personally collect username from meal-manager.</li>
                                        <li class="list-group-item">Member created by meal-manager has a default password 123456</li>
                                        <li class="list-group-item">Change the default password from edit profile menu.</li>
                                        <li class="list-group-item"><b>Provide a valid email address at edit profile menu to recover forgotten password.</b></li>
                                        <li class="list-group-item">The web page only shows data of a single month, <b>you can select month at top right corner.</b></li>
                                        <li class="list-group-item">Member can enter/edit/delete data but it will not be added into calculation until meal-manager accepts that.</li>
                                        <li class="list-group-item">Name and date in table can not be edited. If you want to change those, better delete and enter again.</li>
                                        <li class="list-group-item">If meal-manager enters or accepts new data for the same date and same member, it will auto overwrite the old data.</li>
                                        <li class="list-group-item">Every new month will auto create a new meal-system under the meal-manager. <b>Meal-manager can attach old member to the new meal-system.</b> Once added, member can not be removed but new month will auto erase all old member from last month.</li>
                                        <li class="list-group-item">Database only stores data worth of 2 months. So user can only see the data of the previous month and the following month.</li>
                                        <li class="list-group-item">Use <i class="fas fa-user"></i> <i class="fas fa-arrows-alt-h"></i> <i class="far fa-user"></i> this icon to make someone else meal-manager.</li>
                                        <li class="list-group-item">New member can not be added to old(last month's) meal-system.</li>
                                        <li class="list-group-item">Meal-system can have only one meal-manager.</li>
                                        <li class="list-group-item">Utility expense and deposit have nothing to do with meal-rate.</li>
                                        <li class="list-group-item">Utility expenses are divided equally among all the members.</li>
                                        <li class="list-group-item">Members cannot edit or delete accepted expense but they can enter new expense for the same date.</li>
                                        <li class="list-group-item">While changing mealmanager, it is highly recommended not to choose someone who was not a member of Last month’s meal-system as newly added member cannot access old month’s mealsystem.</li>
                                    </ul>
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