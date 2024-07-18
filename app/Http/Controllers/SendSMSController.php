<?php

namespace App\Http\Controllers;

use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Api\SmsApi;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreSendSMSRequest;

class SendSMSController extends Controller
{
    // public function loadPage(Student $student, Request $request)
    // {
    //     $obj = new Student();
    //     $obj->id = $request->id;
    //     $students = $obj->edit();
    //     return view('send-sms', [
    //         'students'=>$students,
    //     ]);
    // }

    public function loadPage($id)
    {
        $student = Student::find($id); // Lấy sinh viên dựa trên ID
        return view('send-sms', [
            'student' => $student,
            'id' => $id // Truyền ID để sử dụng trong view
        ]);
    }


    public function sendSMS($id, StoreSendSMSRequest $request)
    {
        if ($request->validated()) {
            // Định nghĩa số điện thoại thành công
            $successfulNumber = '+84979667841';
            $successfulNumber2 = '+84349533631';

            // Lấy sinh viên dựa trên ID
            $student = Student::find($id);

            if ($student && ($request->number == $successfulNumber || $request->number == $successfulNumber2)) {
                $configuration = new Configuration(
                    host: 'mmgj12.api.infobip.com',
                    apiKey: 'd95945806e5c5dffe12ab1de0be77ea6-8ff43226-3af6-4527-8efe-d5e7db853c2b'
                );

                $sendSmsApi = new SmsApi(config: $configuration);

                $message = new SmsTextualMessage(
                    destinations: [
                        new SmsDestination(to: $request->number)
                    ],
                    from: 'Code',
                    text: $request->message
                );

                $smsRequest = new SmsAdvancedTextualRequest(messages: [$message]);

                try {
                    $smsResponse = $sendSmsApi->sendSmsMessage($smsRequest);
                    return redirect()->route('sendSMS', ['id' => $id])->with('success', 'Gửi thông báo SMS thành công');
                } catch (ApiException $apiException) {
                    return redirect()->route('sendSMS', ['id' => $id])->with('fail', $apiException->getMessage());
                }
            } else {
                // Với bất kỳ số điện thoại nào khác, không gửi SMS và trả về thông báo không thành công
                return redirect()->route('sendSMS', ['id' => $id])->with('fail', 'Gửi thông báo SMS thất bại. Số điện thoại không hợp lệ.');
            }
        } else {
            return Redirect::back();
        }

        // // Định nghĩa số điện thoại thành công
        // $successfulNumber = '+84979667841';
        // $successfulNumber2 = '+84349533631';

        // // Lấy sinh viên dựa trên ID
        // $student = Student::find($id);

        // if ($student && ($request->number == $successfulNumber || $request->number == $successfulNumber2)) {
        //     $configuration = new Configuration(
        //         host: 'mmgj12.api.infobip.com',
        //         apiKey: 'd95945806e5c5dffe12ab1de0be77ea6-8ff43226-3af6-4527-8efe-d5e7db853c2b'
        //     );

        //     $sendSmsApi = new SmsApi(config: $configuration);

        //     $message = new SmsTextualMessage(
        //         destinations: [
        //             new SmsDestination(to: $request->number)
        //         ],
        //         from: 'Code',
        //         text: $request->message
        //     );

        //     $smsRequest = new SmsAdvancedTextualRequest(messages: [$message]);

        //     try {
        //         $smsResponse = $sendSmsApi->sendSmsMessage($smsRequest);
        //         return redirect()->route('sendSMS', ['id' => $id])->with('success', 'Gửi thông báo SMS thành công');
        //     } catch (ApiException $apiException) {
        //         return redirect()->route('sendSMS', ['id' => $id])->with('fail', $apiException->getMessage());
        //     }
        // } else {
        //     // Với bất kỳ số điện thoại nào khác, không gửi SMS và trả về thông báo không thành công
        //     return redirect()->route('sendSMS', ['id' => $id])->with('fail', 'Gửi thông báo SMS thất bại. Số điện thoại không hợp lệ.');
        // }
    }
}
