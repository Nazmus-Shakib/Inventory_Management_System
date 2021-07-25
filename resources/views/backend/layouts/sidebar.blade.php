@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(Auth::user()->usertype=="Admin")
          <li class="nav-item {{( $prefix=='/users' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.view')}}" class="nav-link {{( $route=='users.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item {{( $prefix=='/profiles' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profiles.view')}}" class="nav-link {{( $route=='profiles.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Your Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('profiles.password.view')}}" class="nav-link {{( $route=='profiles.password.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/suppliers' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Suppliers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('suppliers.view')}}" class="nav-link {{( $route=='suppliers.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Suppliers</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/customers' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customers.view')}}" class="nav-link {{( $route=='customers.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customers.credit')}}" class="nav-link {{( $route=='customers.credit' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Due Customers</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/units' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Units
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('units.view')}}" class="nav-link {{( $route=='units.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Units</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/categories' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.view')}}" class="nav-link {{( $route=='categories.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/products' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products.view')}}" class="nav-link {{( $route=='products.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/purchases' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('purchases.view')}}" class="nav-link {{( $route=='purchases.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('purchases.pending.list')}}" class="nav-link {{( $route=='purchases.pending.list' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('purchases.report')}}" class="nav-link {{( $route=='purchases.report' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Purchase Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/inovices' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Invoice
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('inovices.view')}}" class="nav-link {{( $route=='inovices.view' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('inovices.pending.list')}}" class="nav-link {{( $route=='inovices.pending.list' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('print.invoice.list')}}" class="nav-link {{( $route=='print.invoice.list' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('invoice.daily.report')}}" class="nav-link {{( $route=='invoice.daily.report' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Invoice Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{( $prefix=='/stocks' ? 'menu-open' : '' )}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stocks.report')}}" class="nav-link {{( $route=='stocks.report' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('stocks.report.supplier.product.wise')}}" class="nav-link {{( $route=='stocks.report.supplier.product.wise' ? 'active' : '' )}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier/Product Wise</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>

      <!-- /.sidebar-menu -->
