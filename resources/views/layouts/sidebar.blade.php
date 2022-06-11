  <div class="sidebar" data-color="danger" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

      <div class="sidebar-wrapper">
          <ul class="nav">
              <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                  <a class="nav-link" href="/admin/dashboard">
                      <i class="material-icons">dashboard</i>
                      <p>Dashboard</p>
                  </a>
              </li>
              @if(Auth::user()->roles =='admin')
              <li class="nav-item  {{ (request()->is('admin/users')) ? 'active' : '' }}">
                  <a class="nav-link" href="/admin/users">
                      <i class="material-icons">person</i>
                      <p>User Management</p>
                  </a>
              </li>

              @endif
              @if(Auth::user()->roles !='student')
              <li class="nav-item  {{ (request()->is('courses')) ? 'active' : '' }}">
                  <a class="nav-link" href="/courses">
                      <i class="material-icons">book</i>
                      <p>Courses Management</p>
                  </a>
              </li>
              @endif
              <li class="nav-item  {{ (request()->is('announcements')) ? 'active' : '' }}">
                  <a class="nav-link" href="/announcements">
                      <i class="material-icons">speaker</i>
                      <p>Announcement</p>
                  </a>
              </li>
              <li class="nav-item ">
              <li class="nav-item  {{ (request()->is('assignments')) ? 'active' : '' }}">
                  <a class="nav-link" href="/assignments">
                      <i class="material-icons">assignment</i>
                      <p>Assignment</p>
                  </a>
              </li>
              @if(Auth::user()->roles !='student')
              <li class="nav-item  {{ (request()->is('grades')) ? 'active' : '' }}">
                  <a class="nav-link" href="/grades">
                      <i class="material-icons">cloud_upload</i>
                      <p>Grades</p>
                  </a>
              </li>
              @endif
              @if(Auth::user()->roles =='student')
              <li class="nav-item  {{ (request()->is('students/grades')) ? 'active' : '' }}">
                  <a class="nav-link" href="/students/grades">
                      <i class="material-icons">cloud_upload</i>
                      <p>My Progress</p>
                  </a>
              </li>
              @endif
              @if(Auth::user()->roles !='student')
              <li class="nav-item  {{ (request()->is('attendances')) ? 'active' : '' }}">
                  <a class="nav-link" href="/attendances">
                      <i class="material-icons">cloud_upload</i>
                      <p>Attendances</p>
                  </a>
              </li>
              @endif

          </ul>
      </div>
  </div>