<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/assets/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/assets/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('faq')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                FAQ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('testimony')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Testimony
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER</li>
          <li class="nav-item">
            <a href="{{route('channel')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Channel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('size')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Size
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('category')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('color')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Color
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-header">PRODUCTION</li>
          <li class="nav-item">
            <a href="{{route('purchasing')}}" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Purchasing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.request')}}" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Production Request</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.actual')}}" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Production Actual</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.defect')}}" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Production Defect</p>
            </a>
          </li>
          <li class="nav-header">AUTHENTICATION</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Role</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>