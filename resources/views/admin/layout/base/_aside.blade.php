<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{in_array(request()->route()->getName(), ['admin.orders.index', 'admin.coupons.index']) ? 'active' : ''}}" href="javascript:void(0)" aria-expanded="false" data-type="{{request()->route()->getName()}}">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span class="hide-menu">Đơn hàng & Mã giảm giá</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level {{in_array(request()->route()->getName(), ['admin.orders.index', 'admin.coupons.index']) ? 'in' : ''}}">
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.orders.index')}}" aria-expanded="false">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="hide-menu">Đơn hàng</span>
                            </a>
                        </li>
                        <li class="sidebar-item"><a href="{{route('admin.coupons.index')}}" class="sidebar-link"><i
                                    class="fa fa-gift"></i><span
                                    class="hide-menu">Mã giảm giá </span></a></li>
                    </ul>
                </li>

                
                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{in_array(request()->route()->getName(), ['admin.products.index', 'admin.orders.index']) ? 'active' : ''}}" href="javascript:void(0)" aria-expanded="false" data-type="{{request()->route()->getName()}}">
                        <i class="fa fa-folder-open"></i>
                        <span class="hide-menu">Danh Mục & Sản Phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level {{in_array(request()->route()->getName(), ['admin.products.index', 'admin.orders.index']) ? 'in' : ''}}">
                        <li class="sidebar-item"><a href="{{route('admin.categories.index')}}" class="sidebar-link"><i
                                    class="fa fa-folder-open"></i><span
                                    class="hide-menu">Danh mục</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.products.index')}}" class="sidebar-link"><i
                                    class="fa fa-tree"></i><span
                                    class="hide-menu">Sản Phẩm </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="fa fa-users"></i>
                        <span class="hide-menu">Quản lý khách hàng</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.customers.index')}}" class="sidebar-link"><i
                                    class="fa fa-user"></i><span
                                    class="hide-menu">Khách hàng</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i
                                    class="fa fa-user-circle"></i><span
                                    class="hide-menu">Khách hàng subscribe</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fas fa-clone"></i>
                        <span class="hide-menu">Nội dung</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.banners.index')}}" class="sidebar-link"><i
                                    class="fa fa-image"></i><span
                                    class="hide-menu">Banner</span></a></li>
                        <!-- <li class="sidebar-item"><a href="#" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Quản lý trang</span></a></li> -->
                        <li class="sidebar-item"><a href="{{route('admin.news.index')}}" class="sidebar-link"><i
                                    class="fa fa-file"></i><span
                                    class="hide-menu">Bài viết</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.configs.index')}}" aria-expanded="false">
                        <i class="fas fa-h-square"></i>
                        <span class="hide-menu">Cấu hình cửa hàng</span>
                    </a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="fa fas fa-cogs"></i>
                    <span class="hide-menu">Thiết lập hệ thống</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.order-status.index')}}" class="sidebar-link"><i
                                    class="fas fa-asterisk"></i><span
                                    class="hide-menu">Trạng thái đơn hàng</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.shipping-status.index')}}" class="sidebar-link"><i
                                    class="fas fa-truck"></i><span
                                    class="hide-menu">Trạng thái vận chuyển</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.payment-status.index')}}" class="sidebar-link"><i
                                    class="fas fa-recycle"></i><span
                                    class="hide-menu">Trạng thái thanh toán</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.suppliers.index')}}" class="sidebar-link"><i
                                    class="fas fa-user-secret"></i><span
                                    class="hide-menu">Nhà cung cấp</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.brands.index')}}" class="sidebar-link"><i
                                    class="fas fa-university"></i><span
                                    class="hide-menu">Nhãn hiệu</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.weight-class.index')}}" class="sidebar-link"><i
                                    class="fas fa-balance-scale"></i><span
                                    class="hide-menu">Khối lượng</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.length-class.index')}}" class="sidebar-link"><i
                                    class="fas fa-minus"></i><span
                                    class="hide-menu">Kích thước</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.attribute-group.index')}}" class="sidebar-link"><i
                                    class="fas fa-bars"></i><span
                                    class="hide-menu">Nhóm thuộc tính</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.tax.index')}}" class="sidebar-link"><i
                                    class="far fa-calendar-minus"></i><span
                                    class="hide-menu">Thuế</span></a></li>

                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
