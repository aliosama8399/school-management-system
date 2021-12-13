<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Services\FatoorahServices;
use App\Models\Student;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{

    /**
     * FatoorahController constructor.
     */
    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }


    public function payOrder($request,$debit)
    {

        $student=Student::findorFail($request);
        $data = [
            "CustomerName" => $student->name,
            "NotificationOption" => "Lnk",
            "MobileCountryCode" => "+20",
            "CustomerMobile" => $student->myparent->Phone_Father,
            "CustomerEmail" => $student->email,
            "InvoiceValue" => $debit,
            "DisplayCurrencyIso" => "kwd",
            "CallBackUrl" => env('success_url'),
            "ErrorUrl" => route('Students.index'),
            "Language" => "en",
        ];


        return $this->fatoorahServices->sendPayment($data);

    }

    public function callBack(Request $request)
    {
        $data = [];
        $data['Key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';
          $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        // search where invoice id = $paymentData['Data]['InvoiceId];
        if ($paymentData['IsSuccess']){
            return redirect()->back();
        }


    }

}
