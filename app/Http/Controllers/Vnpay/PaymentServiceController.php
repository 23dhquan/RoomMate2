<?php

namespace App\Http\Controllers\Vnpay;

use App\Http\Controllers\Controller;
use App\Models\HouseService;
use App\Models\Payment;
use App\Models\Penalty;
use App\Models\Service;
use App\Models\WaterBill;
use App\VNPay\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentServiceController extends Controller
{
    public function payService(Request $request)
    {
        $vnpay = new VNPay(env('VNPAY_TMN_CODE'), env('VNPAY_HASH_SECRET'));

        $data = [
            'vnp_Version' => '2.1.0',
            'vnp_Command' => 'pay',
            'vnp_TmnCode' => env('VNPAY_TMN_CODE'),
            'vnp_Amount' => (int)($request->input('amount') * 100),
            'vnp_TxnRef' => time() . uniqid(),
            'vnp_OrderInfo' => $request->input('order_desc'),
            'vnp_OrderType' => 'billpayment',
            'vnp_CurrCode' => 'VND',
            'vnp_Locale' => 'vn',
            'vnp_IpAddr' => $_SERVER['REMOTE_ADDR'],
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_ReturnUrl' => route('vnpay.return.service'),
        ];

        $transactionId = uniqid('txn_');

        session(['transaction_id' => $transactionId]);

        session([$transactionId . '_service_bill_ids' => $request->input('service_bill_id')]);


        ksort($data);

        $hashData = http_build_query($data);
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $data['vnp_SecureHash'] = $secureHash;

        $queryString = http_build_query($data);

        return redirect('https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?' . $queryString);
    }




    public function returnService(Request $request)
    {
        $vnpay = new VNPay(env('VNPAY_TMN_CODE'), env('VNPAY_HASH_SECRET'));
        $receivedHash = $request->input('vnp_SecureHash');
        $data = $request->except('vnp_SecureHash');

        $hashData = $vnpay->createHashData($data);
        $isValid = $vnpay->verifySecureHash($receivedHash, $hashData);

        if ($isValid) {
            $transactionId = session('transaction_id');

            if ($transactionId) {

                $serviceIds = session($transactionId . '_service_bill_ids');
                if ($serviceIds) {
                    $service = HouseService::find($serviceIds);
                    if ($service && $service->status == 0) {
                        $service->status = 1;
                        $service->save();
                    }
                }
                $houseService = Service::where('service_id', $service->service_id)->first();
                $house_price =  $houseService->price;

                Payment::create([
                    'name' => Auth::user()->name,
                    'amount' => $house_price,
                    'note' => "Dịch vụ",
                    'payment_date' => now(),
                    'is_delete' => 0,
                ]);

                session()->forget('transaction_id');
                session()->forget($transactionId . '_service_bill_ids');


                return redirect()->route('services.index')->with('success', 'thành công.');
            } else {
                return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
            }
        } else {
            return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
        }
    }




    public function cancel()
    {
        return redirect()->route('services.index')->with('success', 'thành công.');
    }
}
