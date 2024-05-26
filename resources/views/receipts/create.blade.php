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
                            <span><i class="fas fa-receipt"></i> Phiếu Thu</span>
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
                <h3 class="table-name2">Tạo Phiếu Mới</h3>
                <div class="form-receipt">
                    <form method="post" action="{{ route('receipts.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                @foreach ($students as $student)
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_id">Mã SV</label>
                                        <input value="{{ $student->id }}" name="student_id" type="text"
                                            id="student_id" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_name">Tên SV</label>
                                        <input value="{{ $student->student_name }}" name="student_name" type="text"
                                            id="student_name" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_dob">Ngày sinh</label>
                                        <input value="{{ $student->student_dob }}" name="student_dob" type="date"
                                            id="student_dob" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="amount_each_time">Số tiền/lần đóng</label>
                                        <input value="{{ $student->amount_each_time }}" name="amount_each_time"
                                            type="text" id="amount_each_time" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="payment_method_id">Phương thức đóng</label>
                                    <select name="payment_method_id" type="text" id="payment_method_id">
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">
                                                {{ $paymentMethod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="accountant_id">Kế toán</label>
                                    <select name="accountant_id" type="text" id="accountant_id">
                                        @if (session()->has('accountant'))
                                            <option value="{{ session('accountant')->id }}">
                                                {{ session('accountant')->accountant_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="submitter_name">Người nộp</label>
                                    <input name="submitter_name" type="text" id="submitter_name" />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="submitter_phone">SĐT người nộp</label>
                                    <input name="submitter_phone" type="text" id="submitter_phone" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="payment_date_time">Vào lúc</label>
                                    <input name="payment_date_time" type="datetime-local" id="payment_date_time" />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="amount_of_money">Số tiền đóng</label>
                                    <input value="{{ $student->amount_each_time }}" name="amount_of_money"
                                        type="text" id="amount_of_money" />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="amount_owed">Tiền còn nợ</label>
                                    <input name="amount_owed" type="text" id="amount_owed" />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="note">Ghi chú</label>
                                    <input name="note" type="text" id="note" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn-save">Save</button>
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
