<footer>
    <div class="text-center pt-1">
        <h5>
            Taz Inc. <span style="font-size: 17px;">Copyright &copy; 2018</span>
            <small><button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#usesModal">Usage</button></small>
        </h5>
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="https://www.facebook.com/lessmessMessSystem/" class="btn btn-sm btn-secondary" target="_blank"><i class="fa fa-facebook"></i></a>
            </div>
            <div class="col-sm-6">
                <a href="http://ttazs.com/" class="btn btn-default text-secondary" target="_blank">About</a>
                <a href="{{route('contact')}}" class="btn btn-default text-secondary">Contact</a>
            </div>
        </div>
    </div>
</footer>
<!-- .....Contact Modal....  -->
<div class="modal fade text-dark" id="usesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light">Usage</h5>
                <button class="close text-light" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <ul>
                    <li><b>Calculation result may vary from user to user by (+/-)1 Tk</b></li>
                    <li>Member has to personally collect username from meal-manager.</li>
                    <li>Member created by meal-manager has a default password 123456</li>
                    <li>Change the default password from edit profile menu.</li>
                    <li><b>Provide a valid email address at edit profile menu to recover forgotten password.</b></li>
                    <li>Member can enter/edit/delete data but it will not be added into calculation until meal-manager accepts that.</li>
                    <li>Name and date in table can not be edited. If you want to change those, better delete and enter again.</li>
                    <li>If meal-manager enters or accepts new data for the same date and same member, it will auto overwrite the old data.</li>
                    <li>Every new month will auto create a new meal-system under the meal-manager. <b>Meal-manager can attach old member to the new meal-system.</b> Once added, member can not be removed but new month will auto erase all old member from last month.</li>
                    <li>Database only stores data worth of 2 months. So user can only see the data of the previous month and the following month.</li>
                    <li>Use <i class="fa fa-user"></i> <i class="fa fa-arrows-h"></i> <i class="fa fa-user-o"></i> this icon to make someone else meal-manager.</li>
                    <li>Use <i class="fa fa-user-plus"></i> this icon to add new meal member.</li>
                    <li>New member can not be added to old(last month's) meal-system.</li>
                    <li>Meal-system can have only one meal-manager.</li>
                    <li>Utility expense and deposit have nothing to do with meal-rate.</li>
                    <li>Utility expenses are divided equally among all the members.</li>
                    <li>Members cannot edit or delete accepted expense but they can enter new expense for the same date.</li>
                    <li>While changing meal-manager, it is highly advised not to choose someone who was not a member of Last month’s meal-system.</li>
                    <li>As newly added member cannot access old month’s meal-system.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <p>Fell free to send your feedback <br><a href="{{route('contact')}}" class="btn btn-light pull-right">Contact</a></p>
            </div>
        </div>
    </div>
</div>