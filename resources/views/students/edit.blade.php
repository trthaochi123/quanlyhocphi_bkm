<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/font/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/majors_fix.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/create.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/favicon.png') }}"/>
    <title>Sinh viên - Sửa</title>
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
            <div class="content2">
                <h3 class="table-name2">Sửa Sinh Viên</h3>
                <div class="add-form">
                    <form method="post" action="{{ route('students.update', $id) }}">
                        <div class="form-heading">Điền Các Trường Thông Tin</div>
                        @csrf
                        @method('PUT')
                        @foreach ($students as $student)
                            <div class="inputs-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 ">
                                        <div class="mt-3 mb-3">
                                            <label for="student_name">Họ tên</label>
                                            <input value="{{ $student->student_name }}" name="student_name"
                                                type="text" id="student_name" class="form-control form-control-sm" />
                                            @if ($errors->has('student_name'))
                                                <span class="text-danger">{{ $errors->first('student_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="student_dob">Ngày sinh</label>
                                            <input value="{{ $student->student_dob }}" name="student_dob"
                                                type="date" id="student_dob"
                                                class="form-control form-control-sm" />
                                            @if ($errors->has('student_dob'))
                                                <span class="text-danger">{{ $errors->first('student_dob') }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="student_phone">SDT</label>
                                            <input value="{{ $student->student_phone }}" name="student_phone"
                                                type="text" id="student_phone"
                                                class="form-control form-control-sm" />
                                            @if ($errors->has('student_phone'))
                                                <span class="text-danger">{{ $errors->first('student_phone') }}</span>
                                            @endif
                                        </div>

                                        <div class="mt-3 mb-3">
                                            <label>Địa chỉ</label>
                                        </div>
                                        <div class="mt-3 mb-3 row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                                <label for="province">Thành phố</label>
                                                <input value="{{ $student->province }}" name="province"
                                                    type="text" id="province"
                                                    class="form-control form-control-sm" />
                                                @if ($errors->has('province'))
                                                    <span class="text-danger">{{ $errors->first('province') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                                <label for="district">Quận</label>
                                                <input value="{{ $student->district }}" name="district"
                                                    type="text" id="district"
                                                    class="form-control form-control-sm" />
                                                @if ($errors->has('district'))
                                                    <span class="text-danger">{{ $errors->first('district') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                                <label for="street">Đường</label>
                                                <input value="{{ $student->street }}" name="street" type="text"
                                                    id="street" class="form-control form-control-sm" />
                                                @if ($errors->has('street'))
                                                    <span class="text-danger">{{ $errors->first('street') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="class_id">Tên lớp</label>
                                            <select name="class_id" id="class_id"
                                                class="form-control form-control-sm">
                                                @foreach ($classes as $class_study)
                                                    <option value="{{ $class_study->id }}"
                                                        @if ($student->class_id == $class_study->id) {{ 'selected' }} @endif>
                                                        {{ $class_study->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="basic_fee">Học phí cơ bản</label>
                                            @foreach ($students as $student)
                                                @foreach ($classes as $class_study)
                                                    @if ($class_study->id == $student->class_id)
                                                        @foreach ($basic_fees as $basic_fee)
                                                            @if ($basic_fee->academic_id == $class_study->academic_id && $basic_fee->major_id == $class_study->major_id)
                                                                <div id="basic_fee"
                                                                    data-basic-fee=" {{ $basic_fee->basic_fee_amount }}">
                                                                    {{ $basic_fee->basic_fee_amount }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="student_parent_phone">SDT phụ huynh</label>
                                            <input value={{ $student->student_parent_phone }}
                                                name="student_parent_phone" type="text" id="student_parent_phone"
                                                class="form-control form-control-sm" />
                                            @if ($errors->has('student_parent_phone'))
                                                <span class="text-danger">{{ $errors->first('student_parent_phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 ">

                                        <div class="mt-3 mb-3">
                                            <label for="scholarship_id">Học bổng</label>
                                            <select name="scholarship_id" id="scholarship_id"
                                                class="form-control form-control-sm">
                                                @foreach ($scholarships as $scholarship)
                                                    <option value="{{ $scholarship->id }}"
                                                        @if ($student->scholarship_id == $scholarship->id) {{ 'selected' }} @endif
                                                        data-amount="{{ $scholarship->scholarship_amount }}">
                                                        {{ $scholarship->scholarship_amount }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="payment_type_id">Kiểu đóng</label>
                                            <select name="payment_type_id" id="payment_type_id"
                                                class="form-control form-control-sm">
                                                @foreach ($payment_types as $payment_type)
                                                    <option value="{{ $payment_type->id }}"
                                                        data-discount="{{ $payment_type->discount }}"
                                                        data-payment-times="{{ $payment_type->payment_times }}"
                                                        @if ($student->payment_type_id == $payment_type->id) {{ 'selected' }} @endif>
                                                        {{ $payment_type->payment_type_name }} - Discount
                                                        {{ $payment_type->discount }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="total_fee">Tổng học phí</label>
                                            <input value={{ $student->total_fee }} name="total_fee" type="text"
                                                id="total_fee" class="form-control form-control-sm" />
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="amount_each_time">Số tiền đóng/đợt</label>
                                            <input value={{ $student->amount_each_time }} name="amount_each_time"
                                                type="text" id="amount_each_time"
                                                class="form-control form-control-sm" />
                                        </div>
                
                                        <div class="mt-3 mb-3">
                                            <label for="debt">Công nợ</label>
                                            <input name="debt" value="{{ $student->debt }}" type="text"
                                                id="debt" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn-save">Lưu</button>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

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
            var basicFeeElement = document.getElementById('basic_fee');
            var scholarshipDropdown = document.getElementById('scholarship_id');
            var totalFeeInput = document.getElementById('total_fee');
            var discountDropdown = document.getElementById('payment_type_id');
            var paymentTimesDropdown = document.getElementById('amount_each_time');
            var debt = document.getElementById('debt');

            // Get basic fee amount from data attribute
            var basicFeeAmount = parseFloat(basicFeeElement.getAttribute('data-basic-fee'));

            function calculateTotalFee() {
                var selectedScholarshipOption = scholarshipDropdown.options[scholarshipDropdown.selectedIndex];
                var scholarshipAmount = parseFloat(selectedScholarshipOption.getAttribute('data-amount')) || 0;

                var selectedDiscountOption = discountDropdown.options[discountDropdown.selectedIndex];
                var discountAmount = parseFloat(selectedDiscountOption.getAttribute('data-discount')) || 0;

                var paymentTimes = parseFloat(selectedDiscountOption.getAttribute('data-payment-times')) || 0;


                // Calculate total fee
                var totalFee = (basicFeeAmount - scholarshipAmount) * (1 - discountAmount);
                var amountEachTime = (totalFee / paymentTimes);

                // Update giao dien input field
                totalFeeInput.value = totalFee.toFixed(2);
                paymentTimesDropdown.value = amountEachTime.toFixed(2);
                debt.value = totalFee.toFixed(2);
            }


            // Add event listeners to dropdowns
            scholarshipDropdown.addEventListener('change', calculateTotalFee);
            discountDropdown.addEventListener('change', calculateTotalFee);

            // Initial calculation
            calculateTotalFee();
        });
    </script>

</body>

</html>
