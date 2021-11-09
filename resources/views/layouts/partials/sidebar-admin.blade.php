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
            <a href="{{route('faq')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'faq') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                FAQ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link {{ (substr_count(Route::currentRouteName(), 'slider') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('testimony')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'testimony') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Testimony
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER</li>
          <li class="nav-item">
            <a href="{{route('channel')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'channel') > 0) ? 'active' : '' }}">
              <i class="nav-icon fab fa-whatsapp"></i>
              <p>
                Channel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('size')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'size') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-expand-alt"></i>
              <p>
                Size
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('category')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'category') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('color')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'color') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Color
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'product') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-header">ORDER</li>
          <li class="nav-item">
            <a href="{{route('order')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'order') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Order</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('refund')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'refund') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>Refund</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('promo')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'promo') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-percent"></i>
              <p>Promo</p>
            </a>
          </li>
          <li class="nav-header">PRODUCTION</li>
          <li class="nav-item">
            <a href="{{route('purchasing')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'purchasing') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-truck"></i>
              <p>Purchasing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.request')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'production_request') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Production Request</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.actual')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'production_actual') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-dolly-flatbed"></i>
              <p>Production Actual</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('production.defect')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'production_defect') > 0) ? 'active' : '' }}">
              <i class="nav-icon fas fa-store-alt-slash"></i>
              <p>Production Defect</p>
            </a>
          </li>
          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="{{route('report.stock')}}" class="nav-link {{ (substr_count(Route::currentRouteName(), 'report.stock') > 0) ? 'active' : '' }}">
              <i class="fas fa-warehouse"></i>
              <p>Stock</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>