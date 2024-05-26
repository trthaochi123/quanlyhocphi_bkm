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
    <title>Công nợ - kì</title>
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

                        <a href="#" class="sub-menu-link">
                            <img src="{{ URL('image/help.png') }}" alt="" class="user-info">
                            <p>Help</p>
                            <span>></span>
                        </a>
                        <a href="{{ route('admins.logout') }}" class="sub-menu-link">
                            <img src="{{ URL('image/logout.png') }}" alt="" class="user-info">
                            <p>Log Out</p>
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
                        <a href="{{ route('receipts.index') }}">
                            <span><i class="fas fa-receipt"></i>Phiếu Thu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receipts.academics') }}">
                            <span><i class="fas fa-user-graduate"></i>Sinh Viên</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <span><i class="fas fa-receipt"></i> Công Nợ</span>
                            <ul class="sub-nav">
                                <li><a href="{{ route('receipts.debtByQuarters') }}">Công Nợ Quý</a></li>
                                <li><a href="{{ route('receipts.debtBySemesters') }}">Công Nợ Kì</a></li>
                                <li><a href="{{ route('receipts.debtByYears') }}">Công Nợ Năm</a></li>
                            </ul>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content">
                <h3 class="table-name2">CÔNG NỢ KÌ</h3>
                <div class="main-content">
                    <div class="clear"></div>
                    <div class="table2">
                        <table id="myDataTable" cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="left">ID</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>SDT</th>
                                    <th>Tên lớp</th>
                                    <th>Học bổng</th>
                                    <th>Tổng học phí</th>
                                    <th>Số tiền đóng/lần</th>
                                    <th>SDT phụ huynh </th>
                                    <th>Trạng thái học phí</th>
                                    <th>Công nợ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="receipts">
                                @foreach ($studentBySemesters as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->student_name }}</td>
                                        <td>{{ $student->student_dob }}</td>
                                        <td>{{ $student->student_phone }}</td>
                                        <td>{{ $student->className }}</td>
                                        <td>{{ number_format($student->scholarship, 0, '', ',') }}</td>
                                        <td>{{ number_format($student->total_fee, 0, '', ',') }}</td>
                                        <td>{{ number_format($student->amount_each_time, 0, '', ',') }}</td>
                                        <td>{{ $student->student_parent_phone }}</td>
                                        <td>
                                            @if ($student->tuition_status == 1)
                                                {{ 'Hoàn thành' }}
                                            @else
                                                {{ 'Chưa hoàn thành' }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($student->debt, 0, '', ',') }}</td>
                                        <td class="btn-edit">
                                            <div class="edit-block">
                                                <a href="{{ route('receipts.create', $student->id) }}">
                                                    <i class="fas fa-pen"></i>
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
                        "data": "className"
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
                        "data": "student_parent_phone"
                    },
                    {
                        "data": "tuition_status"
                    },
                    {
                        "data": "debt"
                    },
                    {
                        "defaultContent": "" // Cột giả với nội dung mặc định
                    },
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
