<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create_receipt.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
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
                            <span><i class="fas fa-receipt"></i> Phiếu Thu</span>
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
                <h3 class="table-name2">Tạo Phiếu Mới</h3>
                <div class="form-receipt">
                    <form method="post" action="{{ route('receipts.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                @foreach ($students as $student)
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_id">Mã SV</label>
                                        <input style="color:grey" value="{{ $student->id }}" name="student_id" type="text"
                                            id="student_id" readonly />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_name">Tên SV</label>
                                        <input style="color:grey" value="{{ $student->student_name }}" name="student_name" type="text"
                                            id="student_name" readonly />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_dob">Ngày sinh</label>
                                        <input style="color:grey" value="{{ $student->student_dob }}" name="student_dob" type="date"
                                            id="student_dob" readonly style="width:184px; color:grey" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="student_total_fee">Tổng học phí</label>
                                        <input value="{{ $student->total_fee }}" name="student_total_fee" type="text"
                                            id="student_total_fee" readonly />
                                    </div>

                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="amount_each_time">HP/lần đóng</label>
                                        <input style="color:grey" value="{{ $student->amount_each_time }}" name="amount_each_time"
                                            type="text" id="amount_each_time" readonly />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="payment_type">Kiểu đóng</label>
                                        <select name="payment_type" type="text" id="payment_type" style="width:184px">
                                            @foreach ($paymentTypes as $paymentType)
                                                @if($student->payment_type_id == $paymentType->id)
                                                    <option value="{{ $paymentType->id }}">
                                                        {{ $paymentType->payment_type_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                @endforeach
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="payment_method_id">Phương thức đóng</label>
                                    <select name="payment_method_id" type="text" id="payment_method_id" style="width:184px">
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">
                                                {{ $paymentMethod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="accountant_id">Kế toán</label>
                                    <select name="accountant_id" type="text" id="accountant_id" style="width:184px">
                                        @if (session()->has('accountant'))
                                            <option value="{{ session('accountant')->id }}">
                                                {{ session('accountant')->accountant_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="submitter_name">Người nộp <span style="color: red">*</span></label>
                                    <input name="submitter_name" type="text" id="submitter_name" />
                                    @if ($errors->has('submitter_name'))
                                        <span class="text-danger">{{ $errors->first('submitter_name') }}</span>
                                    @endif
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="submitter_phone">SĐT người nộp <span style="color: red">*</span></label>
                                    <input name="submitter_phone" type="text" id="submitter_phone" />
                                    @if ($errors->has('submitter_phone'))
                                        <span class="text-danger">{{ $errors->first('submitter_phone') }}</span>
                                    @endif
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="payment_date_time">Vào lúc</label>
                                    <input style="width: 184px" name="payment_date_time" type="datetime-local" id="payment_date_time" value="YYYY-MM-DD THH:MM:SS"/>
                                    @if ($errors->has('payment_date_time'))
                                        <span class="text-danger">{{ $errors->first('payment_date_time') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                @foreach ($students as $student)
                                    <div class="mt-3 mb-3">
                                        <label class="item-label" for="current_debt">Công nợ hiện tại</label>
                                        <input name="current_debt" value="{{ $student->debt }}"
                                            data-current="{{ $student->debt }}" type="text" id="current_debt"
                                            readonly />
                                    </div>
                                @endforeach
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="amount_of_money">Số tiền đóng</label>
                                    <input value="{{ $student->amount_each_time }}"
                                        data-amount="{{ $student->amount_each_time }}" name="amount_of_money"
                                        type="text" id="amount_of_money" readonly/>
                                    @if ($errors->has('amount_of_money'))
                                        <span class="text-danger">{{ $errors->first('amount_of_money') }}</span>
                                    @endif
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="amount_owed">Tiền còn nợ</label>
                                    <input name="amount_owed" type="text" id="amount_owed" readonly />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="debt">Cập nhật công nợ</label>
                                    <input name="debt" type="text" id="debt" readonly />
                                </div>

                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="times_paid">Đợt đóng</label>
                                    <input name="times_paid" type="text" id="times_paid" readonly />
                                </div>
                                <div class="mt-3 mb-3">
                                    <label class="item-label" for="note">Nội dung</label>
                                    <input name="note" type="text" id="note"
                                        value="{{ old('ghi_chu', 'Đóng học phí đợt ') }}" />
                                    @if ($errors->has('note'))
                                        <span class="text-danger">{{ $errors->first('note') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="total_amount"
                                style="margin-right: 199px;
                            font-weight: 700;
                            font-size: 18px;
                            color: green;
                            margin-bottom: 40px;
                            margin-top: -10px;
                            padding-right: 55px;
                            text-align: right;">
                                <h5>Tổng số tiền đóng: </h5>
                            </div>
                        </div>

                        <div class="create-receipt-btn-save">
                            <button class="btn-save">Tạo</button>
                        </div>
                    </form>
                    <button class="open-modal">Scan Mã QR Code Chuyển khoản</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mã QR Code --}}
    <div class="modal2">
        <div class="modal2-container">
            <div class="modal-name">Scan Mã QR Code</div>
            <br>
            <br>
            <img src="{{ URL('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png') }}"
                class="qr_code_img" alt="qr" style="width: 250px; height: 250px">
        </div>
    </div>

    <script>
        const openModal = document.querySelector('.open-modal')
        const modal = document.querySelector('.modal2');
        const modalContainer = document.querySelector('.modal2-container');

        function showModalQR() {
            modal.classList.add('open');
        }

        function hideModalQR() {
            modal.classList.remove('open');
        }
        openModal.addEventListener('click', showModalQR);
        modal.addEventListener('click', hideModalQR);
        modalContainer.addEventListener('click', function(event) {
            event.stopPropagation();
        })
    </script>


    <script>
        function updateDateTime() {
            var now = new Date();
            var isoDateTime = now.toISOString().slice(0, 16); // Định dạng ISO 8601
            document.getElementById("payment_date_time").value = isoDateTime;
        }
        updateDateTime(); // Cập nhật giá trị ban đầu
        setInterval(updateDateTime, 1000); // Cập nhật lại mỗi giây
    </script>



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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentDebt = document.getElementById('current_debt');
            var amountOfMoney = document.getElementById('amount_of_money');
            var amountOwed = document.getElementById('amount_owed');
            var debt = document.getElementById('debt');
            var current = parseFloat(currentDebt.getAttribute('data-current')) || 0;
            var studentTotalFee = document.getElementById('student_total_fee');
            var amountEachTime = document.getElementById('amount_each_time');
            var timesPaid = document.getElementById('times_paid');
            var paymentType = document.getElementById('payment_type');

            function calculateOwed() {
                var amountMoney = parseFloat(amountOfMoney.value) || 0;
                //calculate
                var owed = current - amountMoney;
                var updateDebt = current - amountMoney;
                //in ra màn hình
                amountOwed.value = owed.toFixed(2);
                debt.value = updateDebt.toFixed(2);
            }

            // Calculate timesPaid
            var totalFee = parseFloat(studentTotalFee.value) || 0;
            var eachTime = parseFloat(amountEachTime.value) || 0;
            var timesPaidValue = ((totalFee - current) / eachTime) + 1;
            timesPaid.value = Math.round(timesPaidValue);

            document.getElementById('note').value = 'Đóng học phí '+ paymentType.options[paymentType.selectedIndex].text+" "+ Math.round(timesPaidValue);


            // Add event listeners
            amountOfMoney.addEventListener('input', calculateOwed);
            calculateOwed();


        });
    </script>

    {{-- ma QR code --}}
    <script>
        const amountInput = document.getElementById('amount_of_money');
        const totalAmount = document.getElementById('total_amount');
        const qr_code_img = document.querySelector(".qr_code_img");
        let qrCodeAmount = 0;

        // Function to update total amount and QR code
        function updateTotalAmount() {
            const enteredAmount = parseFloat(amountInput.value.trim());
            if (!isNaN(enteredAmount)) {
                qrCodeAmount = enteredAmount; // Gán giá trị của enteredAmount cho qrCodeAmount
                totalAmount.textContent = 'Tổng số tiền: ' + qrCodeAmount.toLocaleString() + ' VND';
            } else {
                qrCodeAmount = 0; // Nếu không phải số, gán 0 cho qrCodeAmount
                totalAmount.textContent = 'Tổng số tiền:';
            }

            // Cập nhật mã QR code
            let MY_BANK = {
                BANK_ID: "Vietcombank",
                ACCOUNT_NO: "0451000327899",
            };
            let desriptionTransaction = "{{ $student->student_name }}" +" "+ document.getElementById('note').value;
            let QR =
                `https://img.vietqr.io/image/${MY_BANK.BANK_ID}-${MY_BANK.ACCOUNT_NO}-qr_only.png?amount=${qrCodeAmount}&addInfo=${desriptionTransaction}`;
            qr_code_img.src = QR;
        }

        // Run updateTotalAmount() once when the page is loaded
        window.addEventListener('DOMContentLoaded', updateTotalAmount);

        // Listen for changes in the amount input
        amountInput.addEventListener('input', updateTotalAmount);
    </script>

</body>
