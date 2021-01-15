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
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="settings">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('company')}}">Company Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('agegroup.index')}}">Age Groups</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('subscription.index')}}">Subscription Plans</a>
                </li>
               
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Preferences" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Preferences</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Preferences">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('preferences.index')}}">Preference category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentpreferences.index')}}">Student Preferences</a>
                </li> 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ld" aria-expanded="false" aria-controls="ld">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Learning & Development</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ld">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('learning.index')}}">L&D Category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('development.index')}}">L&D Details</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('bookslot.index')}}">
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Book A Slot</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blogs" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Blogs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blogs">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('adminblogs.index')}}">Admin</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentblogs.index')}}">Student</a>
                </li>
              </ul>
           
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#optionpolltype" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Option Poll</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="optionpolltype">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('optionpolltype.index')}}">Option poll type </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('optionpoll.index')}}">Option poll </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('optionpoll.requests')}}">Option poll requests </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#studygroup" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Study Groups</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="studygroup">
              <ul class="nav flex-column sub-menu">
                
               
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studygrouprequest.index')}}">Study Group Request</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('studygroup.index')}}">Study Group</a>
                </li> 
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#vendor" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Vendor</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="vendor">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendordetails.index')}}">Vendor category</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('vendors.index')}}">Vendors</a>
                </li> 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#contents" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Activities</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contents">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('contentcategory.index')}}">Content category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('subject.index')}}">Subjects</a>
                </li>
            
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('details.index')}}">Content Details</a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tasks" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Tasks</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tasks">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('task.index')}}">Task </a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#parentdetails" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Parent Details</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="parentdetails">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('parentdetail.index')}}">Parent Details</a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#student" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Student</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="student">
              <ul class="nav flex-column sub-menu">
                
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentdetails.index')}}">Student Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentqueries.index')}}">Student Queries</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentgoals.index')}}">Student Goals</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('studentscrapbook.index')}}">Student Scrap Book</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('achievements.index')}}">Student Achievements</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('postings.index')}}">Student Posts</a>
                </li>
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