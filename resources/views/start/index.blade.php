<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/start.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/favicon.png') }}"/>
    <title>Welcom to Fee Management BKM!</title>
    <style>
        body {
            background-image: url('image/bg-image.jpg');
            background-size: cover;
            background-repeat: 0;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            {{-- Left --}}
            <div class="col-md-6 justify-content-center align-items-center flex-column left-box ">
                <div class="logo-image justify-content-center align-items-center mb-3">
                    <img src="{{ URL('image/bach_khoa_bkacad_logo.png') }}" alt="" class="img-fluid"
                        style="width: 400px">
                </div>

            </div>

            {{-- Right --}}
            <div class="col-md-6 rounded-2 d-flex justify-content-center align-items-center flex-column right-box"
                style="background: #0a418d5a;">
                <div class="row align-items-center">
                    <div class="header-text">
                        <p style="">Welcome to BKACAD Fee Management </p>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <button class="button-5 mb-3">
                    <div class="mg2" role="button">
                        <a>Đăng Nhập</a>
                        <ul class="sub-nav">
                            <li><a class="js-modal-login-adm">Quản Trị Viên</a></li>
                            <li><a class="js-modal-login-acc">Kế Toán</a></li>
                        </ul>
                    </div>
                </button>
                <br>
                <br>
                <button class="button-5 mb-3" role="button">
                    <div class="mg3">
                        <a href="#">Trợ Giúp</a>
                    </div>
                </button>
            </div>

        </div>
    </div>

    {{-- Modal đăng nhập --}}
    <div class="modal js-modal">
        <div class="modal-container js-modal-container">
            <div class="modal-header">
                <h3 class="modal-name">Quyền truy cập</h3>
                <div class="modal-des">Lối vào cho Quản Trị Viên</div>
                <div class="modal-close js-modal-close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <form method="post" action="{{ route('admins.login') }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body-items">
                        <label for="admin_email" class="modal-label">Email*</label>
                        <input id="admin_email" name="email" type="text" class="modal-input">
                    </div>
                    <div class="modal-body-items">
                        <label for="admin_password" class="modal-label">Mật khẩu*</label>
                        <input id="admin_password" name="password" type="password" class="modal-input">
                    </div>
                </div>
                <button class="btn-login">
                    Đăng nhập
                </button>
            </form>
        </div>
    </div>

    {{-- Modal trợ giúp --}}
    <div class="modal modal-help js-modal-help">
        <div class="modal-container js-modal-container-help">
            <div class="modal-header">
                <h3 class="modal-name">Trợ Giúp</h3>
                <div class="modal-close js-modal-close-help">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-body-items">
                    <h5>Mọi vấn đề về kỹ thuật xin liên hệ: 093.529.52225</h5>
                </div>

            </div>
        </div>
    </div>


    @if (session('error') || $errors->any())
        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            {{ session('error') }}
                        @elseif ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal js-modal2">
        <div class="modal-container js-modal-container2">
            <div class="modal-header">
                <h3 class="modal-name">Quyền truy cập</h3>
                <div class="modal-des">Lối vào cho Kế Toán</div>
                <div class="modal-close js-modal-close2">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <form method="post" action="{{ route('accountants.login') }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body-items">
                        <label for="accountant_email" class="modal-label">Email*</label>
                        <input id="accountant_email" name="email" type="text" class="modal-input">
                    </div>
                    <div class="modal-body-items">
                        <label for="accountant_password" class="modal-label">Mật khẩu*</label>
                        <input id="accountant_password" name="password" type="password" class="modal-input">
                    </div>
                </div>
                <button class="btn-login">
                    Đăng nhập
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    {{-- <script>
        @if (session('error'))
            var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                keyboard: false
            });
            myModal.show();
        @endif
    </script> --}}

    <script>
        @if (session('error') || $errors->any())
            var myErrorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                keyboard: false
            });
            myErrorModal.show();
        @endif
    </script>

    <script>
        const modalAdminLogin = document.querySelector('.js-modal-login-adm');
        const modal = document.querySelector('.js-modal');
        const modalContainer = document.querySelector('.js-modal-container');
        const modalClose = document.querySelector('.js-modal-close');

        function showLoginAdmin() {
            modal.classList.add('open');
        }

        function hideLoginAdmin() {
            modal.classList.remove('open');
        }
        modalAdminLogin.addEventListener('click', showLoginAdmin);
        modalClose.addEventListener('click', hideLoginAdmin);
        modal.addEventListener('click', hideLoginAdmin);
        modalContainer.addEventListener('click', function(event) {
            event.stopPropagation();
        })

        const modalAccountantLogin = document.querySelector('.js-modal-login-acc');
        const modal2 = document.querySelector('.js-modal2');
        const modalContainer2 = document.querySelector('.js-modal-container2');
        const modalClose2 = document.querySelector('.js-modal-close2');

        function showLoginAccountant() {
            modal2.classList.add('open');
        }

        function hideLoginAccountant() {
            modal2.classList.remove('open');
        }
        modalAccountantLogin.addEventListener('click', showLoginAccountant);
        modalClose2.addEventListener('click', hideLoginAccountant);
        modal2.addEventListener('click', hideLoginAccountant);
        modalContainer2.addEventListener('click', function(event) {
            event.stopPropagation();
        })
    </script>

    {{-- Modal Help --}}
    <script>
        const modalHelp = document.querySelector('.js-modal-help');
        const modalContainerHelp = document.querySelector('.js-modal-container-help');
        const modalCloseHelp = document.querySelector('.js-modal-close-help');
        const buttonHelp = document.querySelector('.mg3 a');

        function showHelpModal() {
            modalHelp.classList.add('open');
        }

        function hideHelpModal() {
            modalHelp.classList.remove('open');
        }

        buttonHelp.addEventListener('click', showHelpModal);
        modalCloseHelp.addEventListener('click', hideHelpModal);
        modalHelp.addEventListener('click', hideHelpModal);
        modalContainerHelp.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>

</body>

</html>
