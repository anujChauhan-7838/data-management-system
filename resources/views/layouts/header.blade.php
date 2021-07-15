<header class="main-header">
            <!-- Logo -->

            <a href="#" class="logo"> 
            <span><img src="{{ asset('images/admin-panel-logo.png')}}" width="60px"></span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
               <a href="#" class="sidebar-toggle hidden-sm hidden-md hidden-lg" data-toggle="push-menu" role="button">
               <span class="sr-only">{{__('Toggle navigation')}}</span>
               </a>
               <!-- Navbar Right Menu -->
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- User Account Menu -->
                     <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <!-- The user image in the navbar-->
                           <img src="{{asset('images/admin.png')}}" class="user-image" alt="User Image">
                           <!-- hidden-xs hides the username on small devices so only the image appears. -->
                           <span class="hidden-xs">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- Menu Body -->
                           <li class="user-body">
                              <div class="row">
                                 <div class="col-xs-4 text-center">
                                 <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                                 </div>
                              </div>

                              
                              <!-- /.row -->
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>