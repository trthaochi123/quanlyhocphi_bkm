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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/font/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/print_receipt.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/favicon.png') }}"/>
    <title>Receipts Export</title>
    <style>
        .text-container {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <script src="{{ URL::to('js/script.js') }}"></script>
    {{-- <script src="{{ URL::to('js/qrcode.js') }}"></script> --}}
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
                    {{-- <li>
                        <a>
                            <span><i class="fas fa-receipt"></i> Công Nợ</span>
                            <ul class="sub-nav">
                                <li><a href="{{ route('receipts.debtByQuarters') }}">Công Nợ Quý</a></li>
                                <li><a href="{{ route('receipts.debtBySemesters') }}">Công Nợ Kì</a></li>
                                <li><a href="{{ route('receipts.debtByYears') }}">Công Nợ Năm</a></li>
                            </ul>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <div class="content">
                <div class="invoice-wrapper" id="print-area">
                    <br />
                    <br />
                    <h3 class="table-name2">
                        Biên Lai Phiếu Thu
                    </h3>
                    <br />
                    <br />
                    <br />
                    <div class="main-content">
                        <div class="clear"></div>
                        <div class="row">
                            @foreach ($receipts as $receipt)
                                <div class="col-md-6">
                                    <h5>Thông tin Phiếu</h5>
                                    <hr>
                                    <h6>ID Phiếu Thu: {{ $receipt->id }}</h6>
                                    <h6>Ngày Nộp: {{ $receipt->payment_date_time }} </h6>
                                    <h6>Phương Thức Thanh Toán: {{ $receipt->methodName }}</h6>
                                    <h6>Người Nộp: {{ $receipt->submitter_name }}</h6>
                                    <h6>SĐT: {{ $receipt->submitter_phone }}</h6>
                                    <h6 class="border p-2 text-success">
                                        Nội dung: {{ $receipt->studentName }} {{ $receipt->note }}
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <h5>Thông Tin Sinh Viên</h5>
                                    <hr>
                                    <h6>Họ Tên: {{ $receipt->studentName }}</h6>
                                    <h6>SĐT: {{ $receipt->studentPhone }}</h6>
                                    <h6>Địa Chỉ: {{ $receipt->studentProvince }}, {{ $receipt->studentDistrict }},
                                        {{ $receipt->studentStreet }}.</h6>
                                </div>
                            @endforeach

                        </div>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <div class="text-container">
                            <div class="text">
                                <h5>Tổng Số Tiền</h5>
                            </div>
                            <div class="text">
                                <h5> {{ number_format($receipt->amount_of_money, 0, '', ',') }} VNĐ</h5>
                            </div>
                        </div>
                        <br>
                        <div class="sign-text">
                            <p>Kế toán viên Ký</p>
                        </div>
                        <h6>
                            @if (session()->has('accountant'))
                                {{ session('accountant')->accountant_name }}
                            @endif
                        </h6>
                        <hr>


                    </div>
                </div>


                {{-- Print Button --}}
                <div class="invoice-btns">
                    <button type="button" class="invoice-btn" onclick="printInvoice()">
                        <span><i class="fa-solid fa-print"></i></span>
                        <span>Print</span>
                    </button>
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
        const qr_code_img = document.querySelector(".qr_code_img");
        let MY_BANK = {
            BANK_ID: "Vietcombank",
            ACCOUNT_NO: "0451000327899",
        }

        let receiptAmount = {{ $receipt->amount_of_money }};
        let desriptionTransaction = "{{ $receipt->submitter_name }} Chuyen Khoan Hoc Phi";
        let QR = `https://img.vietqr.io/image/${MY_BANK.BANK_ID}-${MY_BANK.ACCOUNT_NO}-qr_only.png?amount=${receiptAmount}&addInfo=${desriptionTransaction}`
        qr_code_img.src = QRZ


        document.addEventListener("DOMContentLoaded", () => {});
    </script>
</body>

</html>
