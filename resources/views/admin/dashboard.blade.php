<x-admin title="Dashboard">
    <div class="row">
        <p class="text-secondary fs-4 text-center">Welcome! {{ Auth::user()->fullname }} <i class="fas fa-smile"></i></p>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Đơn hàng hôm nay</span>
                    <span class="info-box-number">{{ $order }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-store"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sản phẩm</span>
                    <span class="info-box-number">{{ $product }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tài khoản khách hàng</span>
                    <span class="info-box-number">Tổng: {{ $customer }}</span>
                    <span class="info-box-number">Online: {{ $userOnline }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-pie"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng doanh thu hôm nay</span>
                    <span class="info-box-number">{{ number_format($total_order_today) }} VNĐ</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 py-3 border-top">
        <div class="col-lg-6">
            <h6 class="badge bg-dark">Sản phẩm bán chạy nhất</h6>
            <table class="table table-borderless">
                <thead class="bg-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng đã bán</th>
                        <th>Đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach ($top_product as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="/storage/images/{{ $item->image }}" width="50" class=border
                                    alt="">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->id_order }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-6">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Doanh thu các tháng',
                        data: @json($revenueData),
                        borderWidth: 1,
                        backgroundColor: 'green'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
</x-admin>
