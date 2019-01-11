<!--   SIDEBAR    -->
<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{route('home')}}" class="sidebar-link text-muted"><i class="fa fa-home mr-3 text-gray"></i><span>Home</span></a></li>
        <li class="sidebar-list-item"><a href="utility.html" class="sidebar-link text-muted"><i class="far fa-money-bill-alt mr-3 text-gray"></i><span>Utility</span></a></li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#tables" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="fa fa-table mr-3 text-gray"></i><span>Tables</span></a>
            <div id="tables" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="personaltable.html" class="sidebar-link text-muted pl-lg-5">Personal</a></li>
                    <li class="sidebar-list-item"><a href="fulltable.html" class="sidebar-link text-muted pl-lg-5">Full</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item">
            <a href="info.html" class="sidebar-link text-muted">
                <div class="button">
                    <i class="fas fa-info mr-3 text-gray"></i>
                    &nbsp;<span class="button__badge text-primary" style="font-size: 13px">3</span>
                </div>
            </a>
        </li>
    </ul>
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">Data</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="newdata.html" class="sidebar-link text-muted"><i class="far fa-plus-square mr-3 text-gray"></i><span>New</span></a></li>
        <li class="sidebar-list-item">
            <a href="givendata.html" class="sidebar-link text-muted">
                <div class="button">
                    <i class="far fa-arrow-alt-circle-down mr-3 text-gray"></i>
                    &nbsp;<span class="button__badge bg-primary">10</span>
                </div>
                <!--                        this space is also conditional     -->
                <span>&nbsp; Given</span>
            </a>
        </li>
    </ul>
    <!--   IF mM         -->
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">Member</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{route('create.user')}}" class="sidebar-link text-muted"><i class="fas fa-user-plus mr-3 text-gray"></i><span>Add New</span></a></li>
        <li class="sidebar-list-item"><a href="attachold.html" class="sidebar-link text-muted"><i class="fas fa-user-tag mr-3 text-gray"></i><span>Attach Old</span></a></li>
    </ul>
    <!--   endIf         -->
</div>
<!--   SIDEBAR end     -->


