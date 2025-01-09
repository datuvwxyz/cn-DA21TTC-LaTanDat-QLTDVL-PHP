@extends('admin.dashboard')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Total Visitors Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Visitors</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVisitors }}</div>
                        <div class="text-xs font-weight-bold text-gray-600">
                            F: {{ $freelancers }} | E: {{ $employers }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Posts Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPosts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Posts Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Rejected Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejectedPosts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Posts Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingPosts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Active Posts Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activePosts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expired Posts Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Expired Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $expiredPosts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Monthly Posts Histogram -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex gap-3 mb-4">
                <div>
                    <label for="chartSelect" class="form-label">Select Data to Display</label>
                    <select id="chartSelect" class="form-control">
                        <option value="all">All Data</option>
                        <option value="visitors">Total Visitors</option>
                        <option value="posts">Total Posts</option>
                        <option value="rejected">Rejected Posts</option>
                        <option value="pending">Pending Posts</option>
                        <option value="active">Active Posts</option>
                        <option value="expired">Expired Posts</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <canvas id="myChart" style="width: 100%; height: 500px; "></canvas>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // Lấy dữ liệu từ Laravel controller
    const currentData = {
        dates: <?php echo json_encode($dates); ?>, // Mảng các ngày
        posts: {
            total: <?php echo json_encode($postCounts); ?>, // Mảng số lượng bài viết theo ngày
            rejected: <?php echo json_encode($rejectedPosts); ?>, // Mảng rejected posts theo ngày
            pending: <?php echo json_encode($pendingPosts); ?>, // Mảng pending posts theo ngày
            active: <?php echo json_encode($activePosts); ?>, // Mảng active posts theo ngày
            expired: <?php echo json_encode($expiredPosts); ?> // Mảng expired posts theo ngày
        },
        visitors: {
            freelancers: <?php echo json_encode($freelancers); ?>, // Mảng freelancers theo ngày
            employers: <?php echo json_encode($employers); ?> // Mảng employers theo ngày
        }
    };

    console.log(currentData); // Kiểm tra dữ liệu trong console

    // Function to create gradient
    function createGradient(ctx) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
        gradient.addColorStop(1, 'rgba(75, 192, 192, 0.0)');
        return gradient;
    }

    // Function to get chart data based on selection
    function getChartData(selection) {
        const datasets = {
            all: {
                labels: currentData.dates, // Sử dụng ngày thay vì tháng
                data: currentData.posts.total // Dữ liệu bài viết theo ngày
            },
            visitors: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.visitors.freelancers // Dữ liệu freelancers theo ngày
            },
            posts: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.posts.total // Dữ liệu bài viết theo ngày
            },
            rejected: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.posts.rejected // Dữ liệu rejected posts theo ngày
            },
            pending: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.posts.pending // Dữ liệu pending posts theo ngày
            },
            active: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.posts.active // Dữ liệu active posts theo ngày
            },
            expired: {
                labels: currentData.dates, // Mảng ngày
                data: currentData.posts.expired // Dữ liệu expired posts theo ngày
            }
        };

        return datasets[selection];
    }

    // Function to initialize/update chart
    function updateChart(selection = 'all') {
        const ctx = document.getElementById('myChart').getContext('2d');
        const chartData = getChartData(selection);

        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: selection === 'all' ? 'Daily Activity' : selection.charAt(0).toUpperCase() + selection.slice(1),
                    data: chartData.data,
                    backgroundColor: createGradient(ctx),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y.toLocaleString();
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(200, 200, 200, 0.2)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }

    let myChart = null;

    // Initialize chart and add event listeners
    document.addEventListener('DOMContentLoaded', () => {
        updateChart();

        // Add event listener for data type selection
        document.getElementById('chartSelect').addEventListener('change', (e) => {
            updateChart(e.target.value);
        });
    });
</script>
@endsection