<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/assets/images/favicons/favicon-32x32.png')}}" alt="MYJI" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MYJI Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/assets/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('faq')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'faq' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                FAQ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('slider')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'slider' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('testimony')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'testimony' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Testimony
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER</li>
          <li class="nav-item">
            <a href="{{route('channel')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'channel' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fab fa-whatsapp"></i>
              <p>
                Channel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('size')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'size' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-expand-alt"></i>
              <p>
                Size
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('category')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'category' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('color')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'color' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Color
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'product' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'customer' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-header">ORDER</li>
          <li class="nav-item">
            <a href="{{route('order')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'order' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Order</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('endorse')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'endorse' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-gifts"></i>
              <p>Endorse</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('refund')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'refund' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>Refund</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('promo')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) >= 1 ? ( ( explode('.', Route::currentRouteName())[0] == 'promo' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-percent"></i>
              <p>Promo</p>
            </a>
          </li>
          <li class="nav-header">PRODUCTION</li>
          <li class="nav-item">
            <a href="{{route('production.purchasing')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'production' && explode('.', Route::currentRouteName())[1] == 'purchasing' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-truck"></i>
              <p>Purchasing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.request')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'production' && explode('.', Route::currentRouteName())[1] == 'request' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Production Request</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.actual')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'production' && explode('.', Route::currentRouteName())[1] == 'actual' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-dolly-flatbed"></i>
              <p>Production Actual</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.defect')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'production' && explode('.', Route::currentRouteName())[1] == 'defect' ) ? 'active' : '') : '' }}">
              <i class="nav-icon fas fa-store-alt-slash"></i>
              <p>Production Defect</p>
            </a>
          </li>
          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="{{route('report.stock')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'report' && explode('.', Route::currentRouteName())[1] == 'stock' ) ? 'active' : '') : '' }}">
              <i class="fas fa-warehouse"></i>
              <p>Stock</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('report.production.request')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'report' && explode('.', Route::currentRouteName())[1] == 'production' && explode('.', Route::currentRouteName())[2] == 'request' ) ? 'active' : '') : '' }}">
              <i class="fas fa-list-alt"></i>
              <p>Production Request</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('report.production.estimation')}}" class="nav-link {{ count( explode('.', Route::currentRouteName() ) ) > 1 ? ( (explode('.', Route::currentRouteName())[0] == 'report' && explode('.', Route::currentRouteName())[1] == 'production' && explode('.', Route::currentRouteName())[2] == 'estimation' ) ? 'active' : '') : '' }}">
              <i class="fas fa-square-root-alt"></i>
              <p>Estimation Stock</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>