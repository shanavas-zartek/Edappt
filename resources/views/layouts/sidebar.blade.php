<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">Edappt</span>
    </a>
   
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar Menu -->
    @if(Auth::user()->teacher_id == 0)
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-tachometer-alt"></i>&nbsp
              <p>
                Dashboard
              
              </p>
            </a>
   
          </li>
   

           <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-th"></i>&nbsp
              <p>
              Sales
               </p>
            </a>
          </li>

      <!-------    <li class="nav-item">
            <a href="{{ route('DSAdetails.index')}}" class="nav-link">
            <i class="fas fa-american-sign-language-interpreting"></i>&nbsp
              <p>
              Customers
             
              </p>
            </a>
          </li>  ---->
          <li class="nav-item">
            <a href="{{ route('DSAdetails.index')}}" class="nav-link">
            <i class="fab fa-servicestack"></i>&nbsp
              <p>
              Service Request
             
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('DSAdetails.index')}}" class="nav-link">
            <i class="fas fa-thumbs-up"></i>&nbsp
              <p>
              Approvel & Request
             
              </p>
            </a>
          </li>

  

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-sourcetree"></i>&nbsp
              <p>
           
            Users Management
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('studentdetails.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{ route('parentdetail.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parents</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('teacher.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teacher</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('vendors.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendors </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('DSAdetails.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DSA</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fab fa-angellist"></i>
              <p>
              Customer Service
                <i class="right fas fa-angle-left"></i>&nbsp
              </p>
            </a>
            <ul class="nav nav-treeview">
          
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Service Request
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Search & Find</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Teacher On Demand</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Query To Specialists</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Request For Callback</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Technical Support</p>
                    </a>
                  </li>
                </ul>
              </li>
           


              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Approval Request
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Request to Study Group</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Request to run a survey</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Request to host training </p>
                    </a>
                  </li>
                 </ul>
              </li>
              <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                      <p>Push Notification</p>
                    </a>
                  </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-angle-double-down"></i>
              <p>
             Content Management
                <i class="right fas fa-angle-left"></i>&nbsp
              </p>
            </a>
            <ul class="nav nav-treeview">
          
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Upload Contents
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Quiz / Activities</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Weekly Specials</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Magazines</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Modules & Courses</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Youtube Uploads</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Facebook Postings</p>
                    </a>
                  </li>
                </ul>
              </li>
           


              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Monitor & Approve
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>All Facebook Posts</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>All Youtube Posts</p>
                    </a>
                  </li>
               
                 </ul>
              </li>
            
            </ul>
          </li>
</ul></nav>



      @else  
        <ul class="nav">
         
         <!-- <li class="nav-item">
           <a class="nav-link" href="{{ route('teacher.home')}}">
             <i class="mdi mdi-home menu-icon"></i>
             <span class="menu-title">Dashboard</span>
           </a>
         </li> -->
         <li class="nav-item">
            <a class="nav-link" href="{{ route('home')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('teacher.ondemand')}}">
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            <span class="menu-title">Requests</span>
          </a>
        </li>
        </ui>
        @endif


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>













  