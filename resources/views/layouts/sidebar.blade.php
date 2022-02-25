<div class="side-nav" id="info-sidebar">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{ url('dashboard') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ url('data') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-audit"></i>
                    </span>
                    <span class="title">Data KTP</span>
                </a>
            </li>
			@if(Auth::user()->is_admin == 1)
            <li class="nav-item dropdown">
                <a href="{{ url('user') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">Kelola User</span>
                </a>
            </li>
			<li class="nav-item dropdown">
                <a href="{{ url('log-activity') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-info-circle"></i>
                    </span>
                    <span class="title">Log Aktivitas</span>
                </a>
            </li>
			@endif
        </ul>
    </div>
</div>