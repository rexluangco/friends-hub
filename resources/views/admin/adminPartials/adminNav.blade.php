     <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-row">
        <a class="navbar-brand mr-auto" href="/admin/dashboard"><i class="fa fa-home"></i>&nbspHOME</a>
        <ul class="navbar-nav flex-row mr-lg-0">
            <li class="nav-item">
                <a class="nav-link pr-2">&nbspYou are logged in as:&nbsp<i class="fa fa-user"></i>&nbsp{{ Auth::user()->getAdminNameOrUsername() }}</a>
            </li>
            
            @if(Auth::check())

            <li class="nav-item">
                <a href="{{route('admin.signout')}}" class="nav-link pr-2"><i class="fa fa-sign-out-alt"></i>&nbspSign Out</a>
            </li>

            @endif
        </ul>
        <button class="navbar-toggler ml-lg-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <nav class="navbar navbar-expand-md navbar-info">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.masterlist')}}"><i class="fa fa-users"></i> &nbsp User Management &nbsp |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.bannable')}}"><i class="fa fa-clipboard-list"></i>&nbsp Reports &nbsp|</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.adminSettings')}}"><i class="fa fa-user-cog"></i>&nbsp Admin Settings &nbsp|</a>
                </li>

            </ul>

        </div>
    </nav>
