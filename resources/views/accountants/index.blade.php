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
    <title>Danh sách Kế Toán Viên</title>
    {{-- style cho modal thong bao action--}}
    <style>
        #success-message {
            position: fixed;
            top: 20px;
            right: -300px;
            /* Vị trí ban đầu nằm ngoài màn hình */
            transition: right 0.5s ease-in-out;
            z-index: 9999;
            /* ở trên các phần tử khác */

        }

        #success-message.show {
            right: 20px;
            /* Vị trí sau khi trượt vào màn hình */

        }

        /* modal action delete */
        #error-message {
            position: fixed;
            top: 30px;
            right: 30px;
            /* Vị trí ban đầu nằm ngoài màn hình */
            transition: right 0.5s ease-in-out;
            z-index: 9999;
            /* ở trên các phần tử khác */

        }

        #error-message.show {
            right: 20px;
            /* Vị trí sau khi trượt vào màn hình */

        }
    </style>
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
                <h3 class="table-name2">Danh sách Kế Toán Viên</h3>
                <div class="main-content">
                    <div class="btn-add">
                        <a href="{{ route('accountants.create') }}">
                            <i class="fas fa-plus"></i>
                            Thêm
                        </a>
                    </div>
                    <div class="clear"></div>
                    <div class="table2">
                        <table cellspacing="0" cellpadding="0" width="100%" id="myDataTable">
                            <thead>
                                <tr>
                                    <th class="left">ID</th>
                                    <th>Họ tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Mật khẩu</th>
                                    <th class="right" colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="accountant">
                                @foreach ($accountants as $accountant)
                                    <tr>
                                        <td>{{ $accountant->id }}</td>
                                        <td>{{ $accountant->accountant_name }}</td>
                                        <td>{{ $accountant->accountant_phone }}</td>
                                        <td>Thành phố {{ $accountant->province }}, Quận {{ $accountant->district }},
                                            Đường {{ $accountant->street }}</td>
                                        <td>{{ $accountant->email }}</td>
                                        <td>{{ $accountant->password }}</td>
                                        <td class="btn-edit">
                                            <div class="edit-block">
                                                <a href="{{ route('accountants.edit', $accountant->id) }}">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="btn-delete">
                                            <form method="post"
                                                action="{{ route('accountants.destroy', $accountant->id) }}"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <div class="delete-block">
                                                    <button>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- modal --}}
                @if (session('success'))
                    <div id="success-message" class="alert alert-success slide-in">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="error-message" class="alert alert-danger slide-in">
                        {{ session('error') }}
                    </div>
                @endif
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
                        "data": "id"
                    },
                    {
                        "data": "accountant_name"
                    },
                    {
                        "data": "accountant_phone"
                    },
                    {
                        "data": "province"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "password"
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

    {{-- Modal thong bao action --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm xử lý thông báo
            function handleNotification(elementId) {
                const notificationElement = document.getElementById(elementId);
                if (notificationElement) {
                    // Thêm lớp 'show' để kích hoạt hiệu ứng trượt vào
                    setTimeout(() => {
                        notificationElement.classList.add('show');
                    }, 100); // Đợi 100ms để đảm bảo phần tử được render trước khi thêm lớp 'show'

                    // Làm thông báo biến mất sau 4 giây
                    setTimeout(() => {
                        notificationElement.style.display = 'none';
                    }, 4000);
                }
            }

            handleNotification('success-message');

            handleNotification('error-message');
        });
    </script>

    {{-- function confirm delete/submit event --}}
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Ngăn chặn hành động submit mặc định
            const confirmation = confirm('Bạn có chắc chắn muốn xoá?');
            if (confirmation) {
                event.target.submit();
            }
        }
    </script>

</body>

</html>
