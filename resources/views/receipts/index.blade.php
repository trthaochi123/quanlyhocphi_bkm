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
    <link rel="stylesheet" href="{{ asset('assets/font/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/favicon.png') }}"/>
    <title>Receipts list</title>
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
                <h3 class="table-name2">Danh Sách Phiếu Thu</h3>
                <div class="main-content">
                    <div class="clear"></div>
                    <div class="table2">
                        <table id="myDataTable" cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="left">ID</th>
                                    <th>Họ tên SV</th>
                                    <th>Lớp</th>
                                    <th>Người nộp</th>
                                    <th>SĐT người nộp</th>
                                    <th>Đã nộp</th>
                                    <th>Công nợ</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Thời gian</th>
                                    <th>Kế Toán</th>
                                    <th>Nội dung</th>
                                    <th>Xuất phiếu</th>
                                </tr>
                            </thead>
                            <tbody id="receipts">
                                @foreach ($receipts as $receipt)
                                    <tr>
                                        <td>{{ $receipt->id }}</td>
                                        <td>{{ $receipt->studentName }}</td>
                                        @foreach($classes as $classes2)
                                            @if($classes2->id == $receipt->classId)
                                                <td>
                                                    {{$classes2->class_name }}
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>{{ $receipt->submitter_name }}</td>
                                        <td>{{ $receipt->submitter_phone }}</td>
                                        <td>{{ number_format($receipt->amount_of_money, 0, '', ',') }}</td>
                                        <td>{{ number_format($receipt->amount_owed, 0, '', ',') }}</td>
                                        <td>{{ $receipt->methodName }}</td>
                                        <td>{{ $receipt->payment_date_time }}</td>
                                        <td>{{ $receipt->accountantName }}</td>
                                        <td>{{ $receipt->note }}</td>
                                        <td class="btn-issue-receipts">
                                            <div class="issue-receipts">
                                                <a href="{{ route('receipts.export', $receipt->id) }}">
                                                    <i class="fas fa-receipt"></i>
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
                    }, // Cột 1
                    {
                        "data": "studentName"
                    },
                    {
                        "data": "className"
                    }, // Cột 2
                    {
                        "data": "submitter_name"
                    }, // Cột 3
                    {
                        "data": "submitter_phone"
                    },
                    {
                        "data": "amount_of_money"
                    },
                    {
                        "data": "amount_owned"
                    },
                    {
                        "data": "methodName"
                    },
                    {
                        "data": "payment_date_time"
                    },
                    {
                        "data": "accountantName"
                    },
                    {
                        "data": "note"
                    }, // Cột 4
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
