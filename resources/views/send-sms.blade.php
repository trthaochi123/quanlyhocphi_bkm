<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Gửi Thông Báo SMS</title>
</head>

<body>
    <div class="container">
        <div class="card">
            @if (Session::has('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        {{ Session::get('fail') }}

                    </div>
                </div>
            @endif
            <div class="card-header" style="background-color: #65cf65; font-weight: 700;">Gửi Thông Báo SMS </div>
            <div class="card-body">
                <form action="{{ route('sendSMS', $id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label style="font-weight:700" for="exampleFormControlInput1" class="form-label">Số Điện Thoại
                            Phụ Huynh</label>
                        <input value="{{ $student->student_parent_phone }}" type="text" class="form-control"
                            id="exampleFormControlInput1" name="number" placeholder="Enter Receiver Phone Number">
                        @if ($errors->has('number'))
                            <span class="text-danger">{{ $errors->first('number') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label style="font-weight:700" for="exampleFormControlTextarea1" class="form-label">Tin
                            Nhắn</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message">Nhà trường xin thông báo nhắc nhở sinh viên {{ $student->student_name }} về việc hoàn tất đóng học phí. Để đảm bảo quá trình học tập và lịch thi cử diễn ra suôn sẻ, sinh viên vui lòng hoàn tất việc đóng học phí trước ngày 20 hàng tháng. Công nợ hiện tại: {{ number_format($student->debt, 0, '', ',') }} VNĐ. Trân trọng!</textarea>
                        @if ($errors->has('message'))
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>

                    <a href="{{ route('receipts.studentFilter', $student->class_id) }}" class="btn btn-secondary"
                        style="margin-left: 10px;">Quay lại Danh sách sinh viên</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
