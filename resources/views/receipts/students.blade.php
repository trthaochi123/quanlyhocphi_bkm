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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/font/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/class.css') }}">

    <title>Danh sách sinh viên</title>

    <script src="{{ URL::to('js/table2excel.js') }}"></script>
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
                                @if (session()->has('accountant'))
                                    Chào, {{ session('accountant')->accountant_name }}
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
                        <a href="{{ route('receipts.dashboard') }}">
                            <span><i class="fas fa-tachometer-alt"></i>Thống Kê</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipts.index') }}">
                            <span><i class="fas fa-receipt"></i>Phiếu Thu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipts.academics') }}">
                            <span><i class="fas fa-user-graduate"></i>Sinh Viên</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="content">
                <h3 class="table-name2">Danh Sách Sinh Viên </h3>
                <div class="main-content">
                    <button id="downloadexcel-button" class="btn btn-success">Xuất file Excel</button>
                    {{-- css in majors_fix.css --}}
                    <br><br>
                    @foreach ($classes as $class)
                        <h4>Lớp {{ $class->class_name }}</h4>
                    @endforeach
                    <div class="clear"></div>
                    <div class="table2">
                        <table id="myDataTable" border="1px" cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="left">ID</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>SDT</th>
                                    <th>Học bổng</th>
                                    <th>Tổng học phí</th>
                                    <th>HP/lần đóng</th>
                                    <th>Kiểu đóng</th>
                                    <th>SDT phụ huynh </th>
                                    <th>Số đợt đã đóng</th>
                                    <th>Công nợ</th>
                                    <th class="right">Tạo phiếu thu</th>
                                    <th>Gửi thông báo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        <td>{{ $student->student_dob }}</td>
                                        <td>{{ $student->student_phone }}</td>
                                        <td>{{ number_format($student->scholarship, 0, '', ',') }}</td>
                                        <td>{{ number_format($student->total_fee, 0, '', ',') }}</td>
                                        <td>{{ number_format($student->amount_each_time, 0, '', ',') }}</td>
                                        <td>{{ $student->paymentTypeName }}</td>
                                        <td>{{ $student->student_parent_phone }}</td>
                                        <td style="color: red; font-weight: bold">{{ $student->times_paid }}</td>
                                        <td>{{ number_format($student->debt, 0, '', ',') }}</td>
                                        <td class="btn-edit">
                                            <div class="edit-block">
                                                <a href="{{ route('receipts.create', $student->id) }}">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="btn-edit">
                                            <div class="edit-block">
                                                <a href="{{ route('sendSMS', $student->id) }}">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    <script>
        $(document).ready(function() {
            $('#myDataTable').DataTable({

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "student_name"
                    },
                    {
                        "data": "student_dob"
                    },

                    {
                        "data": "student_phone"
                    },
                    {
                        "data": "scholarship"
                    },
                    {
                        "data": "total_fee"
                    },
                    {
                        "data": "amount_each_time"
                    },
                    {
                        "data": "paymentTypeName"
                    },
                    {
                        "data": "student_parent_phone"
                    },
                    {
                        "data": "times_paid"
                    },
                    {
                        "data": "debt"
                    },
                    {
                        "defaultContent": "<button>Delete</button>"
                    },
                    {
                        "defaultContent": "<button>SMS</button>" // Cột giả với nội dung mặc định
                    }
                ],
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

    <script>
        document.getElementById('downloadexcel-button').addEventListener('click', function() {
            var table2excel = new Table2Excel();
            table2excel.export(document.querySelectorAll("#myDataTable"));
        });
    </script>




</body>

</html>
