<nav class="navbar navbar-expand-lg text-primary bg-light">
   <a class="navbar-brand webNameStyle" href="{{ route('home')}}">FRIENDS HUB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    
        @if(Auth::check())
            
            <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link" href="{{ route('home')}}"><i class="fa fa-newspaper"></i>&nbsp Timeline</a></li>
                  <li class="nav-item mr-5"><a class="nav-link" href="{{ route('friend.index')}}"><i class="fa fa-user-friends"></i>&nbspFriends</a></li>

                  <li class="nav-item">   
                    <form class="form-inline" role="search" action="{{route('search.results')}}"> 
                        <div class="form-group form-row ">
                            <input class="form-control  mr-2" type="text" name="query" class="form-control"
                                 placeholder="Find People" 
                                    >
                            <button class="form-control" type="submit" class="btn btn-default"><i class="fa fa-search"></i>&nbspSearch</button>
                        </div>   
                    </form>

                  </li>
            </ul>


            
         
            
        @endif 
            

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::check())
                     <li class="nav-link">
                            
                           <a class="nav-item" href="{{ route('profile.index', ['username' => Auth::user()->username])}}"><i class="fa fa-user-check"></i>&nbsp{{ Auth::user()->getNameOrUsername() }}
                           </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="fa fa-user-cog"></i>&nbspUpdate Account Info</a>
                            <a class="dropdown-item" href="{{ route('profile.edit_userinfo')}}"><i class="fa fa-user-cog"></i>&nbspUpdate User Login Credentials </a>
                            <a class="dropdown-item" href="{{route('auth.signout')}}"><i class="fa fa-sign-out-alt"></i>&nbspSign Out</a>
                        </div>
                    </li>
                
                @endif
            </ul>

  </div>
</nav>

   


