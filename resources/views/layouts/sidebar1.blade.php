<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <!-- <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a> -->
          <a class="sidebar-brand brand-logo" href="#"><h2>Edappt</h2></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
         
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('company')}}">Company Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('agegroup')}}">Age Groups</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="{{ route('typography')}}">Typography</a>
                </li> -->
              </ul>
            </div>
          </li>
         
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('forms')}}">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Forms</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('chartjs')}}">
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('tables')}}">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li> -->
         
        </ul>
      </nav>