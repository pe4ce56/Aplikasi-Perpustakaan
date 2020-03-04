<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item {{request()->routeIS('dashboard') ? 'selected' : ''}}"> 
                    <a class="sidebar-link sidebar-link {{request()->routeIS('dashboard') ? 'active' : ''}}" href="/" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
            @if (auth()->user()->role=='admin' || auth()->user()->role == 'operator')
                  
                <li class="sidebar-item {{request()->routeIS('transaction') ? 'selected' : ''}}"> 
                    <a class="sidebar-link has-arrow {{request()->routeIS('transaction') ? 'active' : ''}}" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hide-menu">Transaction</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{url('transaction')}}" class="sidebar-link"><span
                                    class="hide-menu"> Borrowing Books
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{url('transaction\book_return')}}" class="sidebar-link"><span
                                    class="hide-menu"> Books Return
                                </span></a>
                        </li>
                    </ul>
                 </li>
                 <li class="sidebar-item {{request()->routeIS('report') ? 'selected' : ''}}"> 
                    <a class="sidebar-link {{request()->routeIS('report') ? 'active' : ''}}" href="{{url('report')}}" aria-expanded="false">
                        <i class="fas fa-graduation-cap"></i>
                        <span class="hide-menu">Report</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role=='admin')
                    <li class="sidebar-item {{request()->routeIS('students*') ? 'selected' : ''}}"> 
                        <a class="sidebar-link has-arrow {{request()->routeIS('students*') ? 'selected' : ''}}" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="hide-menu">Master</span>
                        </a>    
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{url('students')}}" class="sidebar-link"><span
                                        class="hide-menu"> Students
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{url('books')}}" class="sidebar-link"><span
                                        class="hide-menu"> Books
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{url('class')}}" class="sidebar-link"><span
                                        class="hide-menu"> Class
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item {{request()->routeIS('operators*') ? 'selected' : ''}}"> 
                        <a class="sidebar-link  {{request()->routeIS('operator*') ? 'active' : ''}}" href="{{url('operators')}}" aria-expanded="false">
                            <i class="fas fa-book"></i>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{request()->routeIS('setting') ? 'selected' : ''}}"> 
                        <a class="sidebar-link  {{request()->routeIS('setting') ? 'active' : ''}}" href="{{url('setting')}}" aria-expanded="false">
                            <i class="fas fa-book"></i>
                            <span class="hide-menu">Setting</span>
                        </a>
                    </li>
                @endif
            </ul>


        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>