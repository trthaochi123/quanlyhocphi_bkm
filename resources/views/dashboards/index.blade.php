<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard_content.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg" type="image/x-icon') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thống Kê</title>
</head>

<body>
    <div class="root">
        <div class="header">
            <div class="name-block">
                <h1 class="company-name">BKM</h1>
            </div>
            <div class="sub-head">
                <div id="date"></div>
                <img src="{{ URL('image/avatar.png') }}" alt="" class="user-pic" onclick="toggleMenu()"
                    style="width: 30px" height="30px">

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="{{ URL('image/avatar.png') }}" alt="" class="user-info"
                                style="width: 30px" height="30px">
                            <h2>
                                @if (session()->has('admin'))
                                    Chào, {{ session('admin')->admin_name }}
                                @endif
                            </h2>
                        </div>
                        <hr>
                        <a href="{{ route('admins.logout') }}" class="sub-menu-link">
                            <img src="{{ URL('image/logout.png') }}" alt="" class="user-info">
                            <p>Đăng xuất</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <ul class="category" style="list-style-type:none">
                    <li>
                        <a href="{{ route('dashboards.index') }}">
                            <span><i class="fas fa-tachometer-alt"></i>Thống Kê</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admins.index') }}">
                            <span><i class="fa fa-user"></i>Quản Trị Viên</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('students.academics') }}">
                            <span><i class="fas fa-user-graduate"></i>Sinh Viên</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('academics.index') }}">
                            <span><i class="fas fa-calendar"></i>Niên Khoá</span>
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('study_classes.index') }}">
                            <span><i class="fas fa-home"></i>Lớp Học</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('majors.index') }}">
                            <span><i class="fas fa-network-wired"></i>Chuyên Ngành</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accountants.index') }}">
                            <span><i class="fas fa-file-plus"></i>Kế Toán Viên</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment_methods.index') }}">
                            <span><i class="fas fa-cash-register"></i>Phương Thức Thanh Toán</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('basic_fees.index') }}">
                            <span><i class="fas fa-money-bill"></i>Học Phí Cơ Bản</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('scholarships.index') }}">
                            <span><i class="fas fa-gift"></i>Mức Học Bổng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment_types.index') }}">
                            <span><i class="fas fa-meteor"></i>Kiểu Đóng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs.index') }}">
                            <span><i class="fas fa-bell"></i>Bài Đăng</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <h3 class="table-name2">Thống Kê</h3>
                <div class="dashboard_content">
                    <section class="row">
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-6 col-lg-5 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-1 py-4-5 mb-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon purple">
                                                        <i class="fas fa-user-graduate"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Sinh Viên</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $student }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-5 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-1 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon blue">
                                                        <i class="fas fa-user-shield"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Quản Trị Viên</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $admin }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-2 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-1 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon green">
                                                        <i class="fas fa-user-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">Kế Toán Viên</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $accountant }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="box" style="display: flex; width: 1000px;">
                                <div class="chart-overview" style="flex: 1;">
                                    <div class="chart-content bg-white">
                                        <div class="bar-chart">
                                            <h1>Biểu Đồ Tổng</h1>
                                            <div style="width:900px; height:300px">
                                                <canvas id="myChart"></canvas>
                                            </div>
                                            <script>
                                                const ctx = document.getElementById('myChart');

                                                new Chart(ctx, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ['Tổng Thu', 'Tổng Công Nợ', 'Công Nợ Quý', 'Công Nợ Kì', 'Công Nợ Năm'],
                                                        datasets: [{
                                                            label: 'Biểu đồ Dữ liệu Về Học Phí BKM (Triệu VND) ',
                                                            data: [{{ $total_revenue }}, {{ $total_debt }}, {{ $total_debt_quarter }},
                                                                {{ $total_debt_semester }}, {{ $total_debt_year }}
                                                            ],
                                                            backgroundColor: [
                                                                'rgba(60, 179, 113, 0.6)',
                                                                'rgba(255, 57, 73, 0.6)',
                                                                'rgba(130, 134, 138, 0.6)',
                                                                'rgba(63, 127, 171, 0.6)',
                                                                'rgba(16, 83, 151, 0.6)'
                                                            ],
                                                            borderWidth: 1
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
                                        </div>

                                    </div>
                                </div>

                                {{-- Tin tức --}}
                                <div class="news-column" style="flex: 1; margin-left: 42px;">
                                    <div class="line-news"
                                        style="height: 3px; width: 400px; background-color: #147dbc;"></div>
                                    <h1 style="font-size: 26px; margin-top: 15px;margin-bottom: 13px">Tin Tức</h1>

                                    @foreach ($blogs as $blog)
                                        <a href="{{ route('blogs.show', ['id' => $blog->id]) }}">
                                            <div class="card mb-3" style="width: 400px">
                                                <img src="{{ asset('storage/Admin/' . $blog->image) }}"
                                                    alt="Ảnh tin tức" class="card-img-top" style="height: 195px;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $blog->title_blog }}</h5>
                                                    <p class="card-text">{{ $blog->description_blog }}</p>
                                                    <p class="card-text"><small
                                                            class="text-body-secondary">{{ $blog->posting_date_time }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                    {{-- Hiển thị phân trang --}}
                                    <div class="pagination">
                                        {{ $blogs->links() }}
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                        </div>

                    </section>
                </div>



            </div>
        </div>
    </div>
    </div>



    <script>
        var today = new Date();
        var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
        document.getElementById("date").innerHTML = date;
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    {{-- User avatar --}}
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }

        window.onclick = (event) => {
            if (!event.target.matches('.user-pic')) {
                if (subMenu.classList.contains('open-menu')) {
                    subMenu.classList.remove('open-menu')
                }
            }
        }

        subMenu.addEventListener('click', (event) => event.stopPropagation());
    </script>


    {{-- Chatbot AI --}}
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger chat-title="BKM_ChatBot" agent-id="5fbd1ad1-fe4a-461c-a33f-1a77fc18fded"
        language-code="vi"></df-messenger>

</body>

</html>
