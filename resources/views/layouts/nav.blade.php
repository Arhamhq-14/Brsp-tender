@php
 use App\Models\Tender;

$activeTenders = Tender::where('archived', 0)->count();

$inactiveTenders = Tender::where('archived', 1)->count();
@endphp


        <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">			
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="{{asset('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                    </div>

                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                 {{Auth::user()->name}}
                                <span class="user-level">{{Auth::user()->roles()->pluck('name')->implode(', ')}}</span>
                               
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <li class="nav-item {{ (request()->is('home*')) ? 'active' : '' }}">
                        <a  href="{{route('home')}}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Tenders</h4>
                    </li>
                    <li class="nav-item {{ (request()->is('tenders*')) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Tender</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ (Route::is('tenders.create') || Route::is('tenders.index') || Route::is('tender.archive')) ? 'show' : '' }}" id="base">
                            <ul class="nav nav-collapse">
                                <!-- Add New Tender Link -->
                                <li class="{{ (Route::is('tenders.create')) ? 'active' : '' }}">
                                    <a href="{{ route('tenders.create') }}">
                                        <span class="sub-item">Add New Tender</span>
                                    </a>
                                </li>
                    
                                <!-- Active Tenders Link -->
                                <li class="{{ (Route::is('tenders.index')) ? 'active' : '' }}">
                                    <a href="{{ route('tenders.index') }}">
                                        <span class="sub-item">Active Tenders</span>
                                        <span class="badge badge-success">{{ $activeTenders }}</span>
                                    </a>
                                </li>
                    
                                <!-- Archived Tenders Link -->
                                <li class="{{ (Route::is('tender.archive')) ? 'active' : '' }}">
                                    <a href="{{ route('tender.archive') }}">
                                        <span class="sub-item">Archived Tenders</span>
                                        <span class="badge badge-success">{{$inactiveTenders}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item {{ (Route::is('users.create') || Route::is('users.index')) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-user-friends"></i>
                            <p>Users</p>
                            <span class="caret"></span>
                        </a>
                        
                        <!-- Add 'show' class if either 'users.create' or 'users.index' route is active -->
                        <div class="collapse {{ (Route::is('users.create') || Route::is('users.index')) ? 'show' : '' }}" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                
                                <!-- Add New User Link -->
                                <li class="{{ Route::is('users.create') ? 'active' : '' }}">
                                    <a href="{{ route('users.create') }}">
                                        <span class="sub-item">Add New User</span>
                                    </a>
                                </li>
                    
                                <!-- Users List Link -->
                                <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                                    <a href="{{ route('users.index') }}">
                                        <span class="sub-item">Users</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                    
              
                    <li class="nav-item {{ (Route::is('roles.create') || Route::is('roles.index')) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-sitemap"></i>
                            <p>User Roles</p>
                            <span class="caret"></span>
                        </a>
                    
                        <!-- Add 'show' class if either 'roles.create' or 'roles.index' route is active -->
                        <div class="collapse {{ (Route::is('roles.create') || Route::is('roles.index')) ? 'show' : '' }}" id="tables">
                            <ul class="nav nav-collapse">
                    
                                <!-- Add New Role Link -->
                                <li class="{{ Route::is('roles.create') ? 'active' : '' }}">
                                    <a href="{{ route('roles.create') }}">
                                        <span class="sub-item">Add New Role</span>
                                    </a>
                                </li>
                    
                                <!-- Roles List Link -->
                                <li class="{{ Route::is('roles.index') ? 'active' : '' }}">
                                    <a href="{{ route('roles.index') }}">
                                        <span class="sub-item">Roles</span>
                                    </a>
                                </li>
                    
                            </ul>
                        </div>
                    </li>
                    


                 
               
                    <li class="nav-item {{ (Route::is('settings.create') || Route::is('settings.index')) ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#charts">
                            <i class="fa fa-cog"></i>
                            <p>Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ (Route::is('settings.create') || Route::is('settings.index')) ? 'show' : '' }}" id="charts">
                            <ul class="nav nav-collapse">
                                 <!-- Add New Role Link -->
                                 <li class="{{ Route::is('settings.create') ? 'active' : '' }}">
                                    <a href="{{ route('settings.create') }}">
                                        <span class="sub-item">Add New Setting</span>
                                    </a>
                                </li>
                    
                                <!-- Roles List Link -->
                                <li class="{{ Route::is('settings.index') ? 'active' : '' }}">
                                    <a href="{{ route('settings.index') }}">
                                        <span class="sub-item">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="widgets.html">
                            <i class="fas fa-desktop"></i>
                            <p>Widgets</p>
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#submenu">
                            <i class="fas fa-bars"></i>
                            <p>Menu Levels</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="submenu">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#subnav2">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sub-item">Level 1</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                 
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->