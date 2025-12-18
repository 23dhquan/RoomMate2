<?php

namespace App\Http\Controllers\Vnpay;

use App\Http\Controllers\Controller;
use App\Models\ElectricityBill;
use App\Models\HouseBill;
use App\Models\Payment;
use App\Models\WaterBill;
use App\VNPay\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentBillController extends Controller
{
    public function pay(Request $request)
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
            'vnp_ReturnUrl' => route('vnpay.return'),
        ];

        $transactionId = uniqid('txn_');

        session(['transaction_id' => $transactionId]);

        session([$transactionId . '_house_bill_id' => $request->input('house_bill_id')]);
        session([$transactionId . '_water_bill_id' => $request->input('water_bill_id')]);
        session([$transactionId . '_electricity_bill_id' => $request->input('electricity_bill_id')]);

        ksort($data);

        $hashData = http_build_query($data);
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $data['vnp_SecureHash'] = $secureHash;

        $queryString = http_build_query($data);

        return redirect('https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?' . $queryString);
    }




    public function return(Request $request)
    {
        $vnpay = new VNPay(env('VNPAY_TMN_CODE'), env('VNPAY_HASH_SECRET'));
        $receivedHash = $request->input('vnp_SecureHash');
        $data = $request->except('vnp_SecureHash');

        $hashData = $vnpay->createHashData($data);
        $isValid = $vnpay->verifySecureHash($receivedHash, $hashData);
        $totalAmount = 0;
        if ($isValid) {
            $transactionId = session('transaction_id');

            if ($transactionId) {
                $houseId = session($transactionId . '_house_bill_id');
                $waterId = session($transactionId . '_water_bill_id');
                $electricityId = session($transactionId . '_electricity_bill_id');
                if ($waterId) {
                    $waterBill = WaterBill::find($waterId);
                    if ($waterBill && $waterBill->status == 0) {
                        $waterBill->status = 1;
                        $waterBill->save();
                        $totalAmount += $waterBill->amount;
                    }
                }

                if ($electricityId) {
                    $electricityBill = ElectricityBill::find($electricityId);
                    if ($electricityBill && $electricityBill->status == 0) {
                        $electricityBill->status = 1;
                        $electricityBill->save();
                        $totalAmount += $electricityBill->amount;
                    }
                }

                if ($houseId) {
                    $house = HouseBill::find($houseId);
                    if ($house) {
                        $house->status = 1;
                        $house->save();
                        $totalAmount += $house->amount;
                    }
                }
                Payment::create([
                    'name' => Auth::user()->name,
                    'amount' => $totalAmount,
                    'note' => "Điện nước nhà",
                    'payment_date' => now(),
                    'is_delete' => 0,
                ]);
                session()->forget('transaction_id');
                session()->forget($transactionId . '_house_bill_id');
                session()->forget($transactionId . '_water_bill_id');
                session()->forget($transactionId . '_electricity_bill_id');
                return redirect()->route('bill.filter')->with('success', 'thành công.');
            } else {
                return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
            }
        } else {
            return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
        }
    }




    public function cancel()
    {
        Log::info('Giao dịch VNPay đã bị hủy.');
        return response()->json(['message' => 'Giao dịch đã bị hủy.']);
    }
}
