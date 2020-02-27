<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item @if($active == 'dashboard') selected @endif"> 
                    <a class="sidebar-link sidebar-link @if($active == 'dashboard') active @endif"" href="/" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item @if($active == 'transasction') selected @endif""> 
                    <a class="sidebar-link sidebar-link @if($active == 'transasction') active @endif"" href="/transaction" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Transaction</span>
                    </a>
                </li>
                <li class="sidebar-item @if($active == 'students') selected @endif"> 
                    <a class="sidebar-link has-arrow @if($active == 'students') selected @endif" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                        class="hide-menu">Data Students</span></a>
                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                    <li class="sidebar-item">
                        <a href="/students" class="sidebar-link">
                            <span class="hide-menu">Students</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/students/create" class="sidebar-link">
                            <span class="hide-menu">Add Students</span>
                        </a>
                    </li>
                </ul>
            </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>