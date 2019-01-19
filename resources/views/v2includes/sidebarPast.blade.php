<!--   SIDEBAR    -->
<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{route('home.Past', ['pmsid' => $va['pms']->id])}}" class="sidebar-link text-muted"><i class="fa fa-home mr-3 text-gray"></i><span>Home</span></a></li>
        <li class="sidebar-list-item"><a href="{{route('utility.past', ['pmsid' => $va['pms']->id])}}" class="sidebar-link text-muted"><i class="far fa-money-bill-alt mr-3 text-gray"></i><span>Utility</span></a></li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#tables" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="fa fa-table mr-3 text-gray"></i><span>Tables</span></a>
            <div id="tables" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{route('personal.table.past', ['slug' => $va['user']->slug, 'pmsid' => $va['pms']->id])}}" class="sidebar-link text-muted pl-lg-5">Personal</a></li>
                    <li class="sidebar-list-item"><a href="{{route('full.table.past', ['pmsid' => $va['pms']->id])}}" class="sidebar-link text-muted pl-lg-5">Full</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">Data</div>
    <ul class="sidebar-menu list-unstyled">
        @role(['admin','mealManager'])
            <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="far fa-plus-square mr-3 text-gray"></i><span>New</span></a></li>
        @else
            <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="far fa-plus-square mr-3 text-gray"></i><span>New</span></a></li>
        @endrole
        @role(['admin','mealManager'])
            <li class="sidebar-list-item">
                <a href="{{route('given.table.past', ['pmsid' => $va['pms']->id])}}" class="sidebar-link text-muted">
                    <div class="button">
                        <i class="far fa-arrow-alt-circle-down mr-3 text-gray"></i>
                        @if(($va['givenDataCount'] * 1) > 0)
                            &nbsp;<span class="button__badge bg-primary">{{$va['givenDataCount']}}</span>
                        @endif
                    </div>
                    <!--                        this space is also conditional     -->
                    @if(($va['givenDataCount'] * 1) > 0)
                        <span>&nbsp; Given</span>
                    @else
                        <span> Given</span>
                    @endif
                </a>
            </li>
        @endrole
    </ul>
</div>
<!--   SIDEBAR end     -->


