<!-- Header -->
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <input type="text" name="query" id="search-input" class="form-control"
                    placeholder="'Search', 'chart' etc." autofocus autocomplete="off" />
            </div>
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{route('home')}}" class="px-3" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-earth-americas" style="font-size: 1.5rem; color:rgba(138, 144, 157, 0.7);"></i>
                    </a>
                </li>
                <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">You have 5 notifications</li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-plus"></i> New user registered
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-remove"></i> User deleted
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 07 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 12 PM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-supervisor"></i> New client
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 10 AM</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="mdi mdi-server-network-off"></i> Server overloaded
                                <span class=" font-size-12 d-inline-block float-right"><i
                                        class="mdi mdi-clock-outline"></i> 05 AM</span>
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <a class="text-center" href="#"> View All </a>
                        </li>
                    </ul>
                </li>
                <!-- User Account -->
                
                <li class="dropdown">

                    <button class="flex items-center px-4 py-3 dropdown-toggle nav-link" data-toggle="dropdown">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="size-10 rounded-full object-cover"
                                    src="{{ asset(Auth::user()->profile_photo_url) }}"
                                    alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                    </button>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle"
                                alt="User Image" />
                            <div class="d-inline-block">
                                {{ Auth::user()->name }} <small
                                    class="pt-1">{{ Auth::user()->email }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('profile.show') }}"
                                :active="request() - > routeIs('profile.show')">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="email-inbox.html">
                                <i class="mdi mdi-email"></i> Message
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="mdi mdi-diamond-stone"></i> Projects </a>
                        </li>
                        <li>
                            <a href="#"> <i class="mdi mdi-settings"></i> Account Setting </a>
                        </li>

                        <li class="dropdown-footer">
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </li>

                {{-- </li> --}}
            </ul>
        </div>
    </nav>
</header>
<style>
#show-desktop button {
    font-size: 1.75rem !important;
    color: rgba(138, 144, 157, 0.7)!important;
}
</style>