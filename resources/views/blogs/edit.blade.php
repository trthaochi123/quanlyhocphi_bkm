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
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/favicon.png') }}"/>
    <title>Sửa Bài Đăng</title>
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
                <ul class="category">
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
                <h3 class="table-name2">Sửa Bài Đăng</h3>
                <div class="add-form">
                    <form method="post" action="{{ route('blogs.update', $blog) }}" enctype="multipart/form-data">
                        <div class="form-heading">Điền Các Trường Thông Tin</div>
                        @csrf
                        @method('PUT')
                        <div class="inputs-list">
                            <div class="mt-3 mb-3">
                                <label for="title_blog">Tiêu Đề</label>
                                <input name="title_blog" value="{{ $blog->title_blog}}" type="text" id="title_blog"
                                    class="form-control form-control-sm" />
                                    @if ($errors->has('title_blog'))
                                <span class="text-danger">{{ $errors->first('title_blog') }}</span>
                                @endif
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="description_blog">Mô Tả</label>
                                <input name="description_blog" value="{{ $blog->description_blog}}" type="text" id="description_blog"
                                    class="form-control form-control-sm" />
                                    @if ($errors->has('description_blog'))
                                <span class="text-danger">{{ $errors->first('description_blog') }}</span>
                                @endif
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="content_blog">Nội Dung</label>
                                <input name="content_blog" value="{{ $blog->content_blog}}" type="text" id="content_blog" class="form-control" rows="5" />
                                @if ($errors->has('content_blog'))
                                <span class="text-danger">{{ $errors->first('content_blog') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình Ảnh</label>
                                <input name="image" class="form-control" type="file" id="image">
                                <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Admin/') . $blog->image) }}" width="100px" height="100px" alt="">
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="mt-3 mb-3">
                                <label class="item-label" for="posting_date_time">Ngày đăng</label>
                                <input name="posting_date_time" value="{{ $blog->posting_date_time}}" type="datetime-local" id="posting_date_time" />
                                @if ($errors->has('posting_date_time'))
                                <span class="text-danger">{{ $errors->first('posting_date_time') }}</span>
                                @endif
                            </div>

                            <div>
                                <button class="btn-save">Lưu</button>
                            </div>
                        </div>
                    </form>
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
    <script>
        $(document).ready(function() {
            $('#myDataTable').DataTable({
                "columns": [{
                        "data": "majorName"
                    },
                    {
                        "data": "academicName"
                    },
                    {
                        "data": "basic_fee_amount"
                    },
                    {
                        "defaultContent": "<button>Edit</button>" // Cột giả với nội dung mặc định
                    },
                    {
                        "defaultContent": "<button>Delete</button>" // Cột giả với nội dung mặc định
                    }
                ]
            });
        });
    </script>

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
</body>

</html>
