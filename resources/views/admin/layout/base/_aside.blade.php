<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.orders.index')}}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Đơn hàng</span></a></li>
                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark {{in_array(request()->route()->getName(), ['admin.products.index', 'admin.orders.index']) ? 'active' : ''}}" href="javascript:void(0)" aria-expanded="false" data-type="{{request()->route()->getName()}}">
                        <i class="mdi mdi-receipt"></i>
                        <span class="hide-menu">Danh Mục & Sản Phẩm</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level {{in_array(request()->route()->getName(), ['admin.products.index', 'admin.orders.index']) ? 'in' : ''}}">
                        <li class="sidebar-item"><a href="{{route('admin.categories.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-outline"></i><span
                                    class="hide-menu">Danh mục</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.products.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Sản Phẩm </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-receipt"></i>
                    <span class="hide-menu">Quản lý khách hàng</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.customers.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-outline"></i><span
                                    class="hide-menu">Khách hàng</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Khách hàng subscribe</span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Nội dung</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.banners.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-outline"></i><span
                                    class="hide-menu">Banner</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Quản lý trang</span></a></li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-receipt"></i>
                    <span class="hide-menu">Thiết lập hệ thống</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.order-status.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-outline"></i><span
                                    class="hide-menu">Trạng thái đơn hàng</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.shipping-status.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Trạng thái vận chuyển</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.payment-status.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Trạng thái thanh toán</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.suppliers.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Nhà cung cấp</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.brands.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Nhãn hiệu</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.weight-class.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Khối lượng</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.length-class.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Kích thước</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.attribute-group.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Nhóm thuộc tính</span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.tax.index')}}" class="sidebar-link"><i
                                    class="mdi mdi-note-plus"></i><span
                                    class="hide-menu">Thuế</span></a></li>

                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
