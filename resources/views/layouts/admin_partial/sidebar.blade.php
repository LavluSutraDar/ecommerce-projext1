 @php
     $setting = DB::table('settings')->first();
 @endphp
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('admin.home') }}" class="brand-link">

         {{-- <img src="{{ url($setting->logo ??'') }}" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
         <span class="brand-text font-weight-light">LH E-Commerce</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 {{-- <img src="{{ url($setting->fav_icon ??'') }}" class="img-circle elevation-2" alt="User Image"> --}}
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ Auth::user()->name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
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
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Admin Category
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('category.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('subcategory.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Sub Category</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('childcategory.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Chaild Category</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('brand.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Brand</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('warehouse.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Ware House</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             All Product
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('product.create')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>New Product</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('product.index')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon text-warning"></i>
                                 <p>Manage Product</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-solid fa-gear nav-icon"></i>
                         <p>
                             Settings
                             <i class="fas fa-angle-left right"></i>

                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('setting.seo.index') }}" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>SEO Setting</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('website.setting') }}" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>Website Setting</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('create.index.page') }}" class="nav-link">
                                 <i class="fa-brands fa-pagelines nav-icon text-danger"></i>
                                 <p>Create Page</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('setting.smtp') }}" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>SMTP Setting</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('brand.index') }}" class="nav-link">
                                 <i class="fa-solid fa-cart-shopping nav-icon text-info"></i>
                                 <p>Payment Getway</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-solid fa-gear nav-icon"></i>
                         <p>
                             Offer
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('coupon.index') }}" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>Coupon</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>E Campain</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fas fa-solid fa-gear nav-icon"></i>
                         <p>
                             Pickup Point
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('pickuppoint.index')}}" class="nav-link">
                                 <i class="fa-solid fa-bars nav-icon"></i>
                                 <p>Pickup Point</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-header">PROFILE</li>

                 <li class="nav-item">
                     <a href="{{ route('password.change') }}" class="nav-link">
                         <i class="nav-icon fa-solid fa-lock text-light"></i>
                         <p class="text">Password Change</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fa-solid fa-right-from-bracket nav-icon text-light"></i>
                         <p class="text">Logout</p>
                     </a>
                 </li>


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
