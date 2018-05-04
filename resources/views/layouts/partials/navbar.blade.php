    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ URL::asset('images/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">Email@email.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{!! url('/') !!}">
                            <i class="material-icons">dashboard</i>
                            <span>Home</span>
                        </a>
                    </li>

                    @can('Client Ticket Management')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">question_answer</i>
                            <span>Ticket For Client</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('/tickets/create')}}">Add Ticket</a>
                            </li>
                            <li>
                                <a href="{{url('/tickets/index')}}">My Tickets</a>
                            </li>
                        </ul>
                    </li>
                    @endcan



                    @can('Specialist Ticket Management')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">question_answer</i>
                            <span>Ticket For Support</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('specialist/tickets/index')}}">Ticket List</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Admin Ticket Management')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">question_answer</i>
                            <span>Ticket For Admin</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{url('admin/tickets/index')}}">Ticket List</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Manage Permission')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">accessibility</i>
                            <span>Permission</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{!! route('permission.create') !!}">Add Permission</a>
                            </li>
                            <li>
                                <a href="{{ route('permission.index') }}">Permission List</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Manage Role')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Role</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{!! route('role.create') !!}">Add Role</a>
                            </li>
                            <li>
                                <a href="{{ route('role.index') }}">Role List</a>
                            </li>
                            <li>
                                <a href="{{ route('role.assign') }}">Assign Role</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Manage Task')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">work</i>
                            <span>Tasks</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{!! route('task.create') !!}">Add Task</a>
                            </li>
                            <li>
                                <a href="{{ route('task.index') }}">Task List</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Manage User')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>User</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="">Add User</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('Activity Log')
                    <li>
                        <a href="{{ url('/activity/index') }}">
                            <i class="material-icons">local_activity</i>
                            <span>Activity Log</span>
                        </a>
                    </li>
                    @endcan


                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
{{--             <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div> --}}
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>