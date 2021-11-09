@extends('admin.layout.default')

@section('breadcrumb')
    {{renderBreadcrumb('Dashboard', [['name' => 'Home', 'link' => 'https://google.com.vn']])}}
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <a class="card card-hover" href="{{route('admin.orders.index')}}">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </h1>
                    <h6 class="text-white">{{$totalOrders}} Đơn hàng</h6>
                </div>
            </a>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <a class="card card-hover" href="{{route('admin.products.index')}}">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="fa fa-tree" aria-hidden="true"></i></h1>
                    <h6 class="text-white">{{$totalProducts}} Sản phẩm</h6>
                </div>
            </a>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <a class="card card-hover" href="{{route('admin.customers.index')}}">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="fa fa-users" aria-hidden="true"></i></h1>
                    <h6 class="text-white">{{$totalCustomers}} Khách hàng</h6>
                </div>
            </a>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <a class="card card-hover" href="{{route('admin.news.index')}}">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="fa fa-file" aria-hidden="true"></i></h1>
                    <h6 class="text-white">{{$totalNews}} Bài viết</h6>
                </div>
            </a>
        </div>
    </div>

    <!-- Chart-3 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng 30 ngày gần nhất</h5>
                    <canvas id="recent-orders-month" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- End chart-3 -->
    <!-- Charts -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thống kê 12 tháng gần nhất</h5>
                    <canvas id="percent-orders"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thống kê 12 tháng gần nhất</h5>
                    <canvas id="recent-orders-year"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm được quan tâm</h5>
                    <table class="table table-borderless">
                        <thead class="thead-light">
                        <tr class="thead--row">
                            <th scope="col" class="font-weight-bold">#</th>
                            <th scope="col" class="font-weight-bold">Hình ảnh</th>
                            <th scope="col" class="font-weight-bold">Tên</th>
                            <th scope="col" class="font-weight-bold">Lượt xem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($mostViewedProducts as $key=>$product)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>
                                <img src="{{asset('storage'.$product->image)}}" alt="{{$product->name}}"
                                        onerror="this.src='https://{{config('app.subdomain_admin')}}/assets/images/no-image.png'" style="max-width: 60px">
                                </td>
                                <td>
                                <a href="{{route('web.products.show', ['product' => $product->alias])}}" target="_blank">{{$product->name}}</a
                                </td>
                                <td>{{$product->view}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm bán chạy</h5>
                    <table class="table table-borderless">
                        <thead class="thead-light">
                        <tr class="thead--row">
                            <th scope="col" class="font-weight-bold">#</th>
                            <th scope="col" class="font-weight-bold">Hình ảnh</th>
                            <th scope="col" class="font-weight-bold">Tên</th>
                            <th scope="col" class="font-weight-bold">Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($bestSellProducts as $key=>$item)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>
                                <img src="{{asset('storage'.$item->product->image)}}" alt="{{$item->product->name}}"
                                        onerror="this.src='https://{{config('app.subdomain_admin')}}/assets/images/no-image.png'" style="max-width: 60px">
                                </td>
                                <td>
                                    <a href="{{route('web.products.show', ['product' => $item->product->alias])}}" target="_blank">{{$item->product->name}}</a
                                </td>
                                <td>{{$item->product_qty}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script src="{{asset('js/admin/dashboard.js')}}"></script>
@endsection

@section('css')
    <link type="text/css" href="{{asset('css/admin/news/index.css')}}" rel="stylesheet" />
@endsection
