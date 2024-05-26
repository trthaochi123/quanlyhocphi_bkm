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
    <title>Add student</title>
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
                        <a href="{{ route('dashboards.index') }}">
                            <span><i class="fas fa-tachometer-alt"></i>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admins.index') }}">
                            <span><i class="fa fa-user"></i>Administrators</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('students.academics') }}">
                            <span><i class="fas fa-user-graduate"></i>Students Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('academics.index') }}">
                            <span><i class="fas fa-calendar"></i>Academic Years</span>
                        </a>
                    </li>
                    <li>
                        <a href=" {{ route('study_classes.index') }}">
                            <span><i class="fas fa-home"></i>Classes Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('majors.index') }}">
                            <span><i class="fas fa-network-wired"></i>Majors Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accountants.index') }}">
                            <span><i class="fas fa-file-plus"></i>Accountants Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment_methods.index') }}">
                            <span><i class="fas fa-cash-register"></i>Payment Methods</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('basic_fees.index') }}">
                            <span><i class="fas fa-money-bill"></i>Basic Fees</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('scholarships.index') }}">
                            <span><i class="fas fa-gift"></i>Scholarships Level</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment_types.index') }}">
                            <span><i class="fas fa-meteor"></i>Payment Types</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content2">
                <h3 class="table-name2">Create A New Student</h3>
                <div class="add-form">
                    <form method="post" action="{{ route('students.store') }}">
                        <div class="form-heading">Enter Information Fields</div>
                        @csrf
                        <div class="inputs-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 ">
                                    <div class="mt-3 mb-3">
                                        <label for="student_name">Full name</label>
                                        <input name="student_name" type="text" id="student_name"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="student_dob">Date of birth</label>
                                        <input name="student_dob" type="date" id="student_dob"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="student_phone">Phone number</label>
                                        <input name="student_phone" type="text" id="student_phone"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label>Address</label>
                                    </div>
                                    <div class="mt-3 mb-3 row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                            <label for="province">Province</label>
                                            <input name="province" type="text" id="province"
                                                class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                            <label for="district">District</label>
                                            <input name="district" type="text" id="district"
                                                class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                                            <label for="street">Street</label>
                                            <input name="street" type="text" id="street"
                                                class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="class_id">Class name</label>
                                        <select name="class_id" id="class_id" class="form-control form-control-sm">
                                            @foreach ($classes as $class_study)
                                                <option value="{{ $class_study->id }}">
                                                    {{ $class_study->class_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="basic_fee">Basic fees</label>
                                        <div name="basic_fee" type="text" id="basic_fee"
                                            class="form-control form-control-sm">
                                            @foreach ($basic_fees as $basic_fee)
                                                @foreach ($classes as $class_study)
                                                    @if ($basic_fee->academic_id == $class_study->academic_id && $basic_fee->major_id == $class_study->major_id)
                                                        {{ $basic_fee->basic_fee_amount }}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="student_parent_phone">Parent phone</label>
                                        <input name="student_parent_phone" type="text" id="student_parent_phone"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 ">
                                    <div class="mt-3 mb-3">
                                        <label for="scholarship_id">Scholarship</label>
                                        <select name="scholarship_id" id="scholarship_id"
                                            class="form-control form-control-sm">
                                            @foreach ($scholarships as $scholarship)
                                                <option value="{{ $scholarship->id }}">
                                                    {{ $scholarship->scholarship_amount }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="payment_type_id">Payment type</label>
                                        <select name="payment_type_id" id="payment_type_id"
                                            class="form-control form-control-sm">
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}">
                                                    {{ $payment_type->payment_type_name }}
                                                    - Discount {{ $payment_type->discount }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="discount">Discount</label>
                                        <select name="discount" type="text" id="discount"
                                            class="form-control form-control-sm">
                                            @foreach ($payment_types as $payment_type)
                                                <option value="{{ $payment_type->id }}">
                                                    {{ $payment_type->discount }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="total_fee">Total fee</label>
                                        <input name="total_fee" type="text" id="total_fee"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="amount_each_time">Amount each time</label>
                                        <input name="amount_each_time" type="text" id="amount_each_time"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="tuition_status">Tuition status</label>
                                        <input name="tuition_status" type="text" id="tuition_status"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="debt">Debt</label>
                                        <input name="debt" type="text" id="debt"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn-save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <script>
        var today = new Date();
        var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
        document.getElementById("date").innerHTML = date;
    </script>
    <script>
        $(document).ready(function() {
            $("#discount").click(function() {
                // let basic_fee = parseFloat($('#basic_fee').val());
                // let scholarship = parseFloat($('#scholarship_id').val());
                // let discount = parseFloat($('#discount').val());
                // let total = (basic_fee-scholarship) - discount*(basic_fee-scholarship);
                $('#total_fee').val("0");
            })
        });
    </script>

    <script>
        const basic_fee = document.getElementById('basic_fee');
        const scholarship = document.getElementById('scholarship_id');
        const discount = document.getElementById('discount');
        const total_fee = document.getElementById('total_fee');
        console.log(basic_fee.valueOf());
        console.log(scholarship);
        console.log(discount);

        basic_fee.addEventListener('input', calculateBasicFee);
        scholarship.addEventListener('input', calculateBasicFee);
        discount .addEventListener('input', calculateBasicFee);

        function calculateBasicFee() {
            const num1 = parseFloat(basic_fee.value);
            const num2 = parseFloat(scholarship.value);
            const num3 = parseFloat(discount.value);
            const sum = (num1 - num2) * num3;
            total_fee.textContent = sum;
        }
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
