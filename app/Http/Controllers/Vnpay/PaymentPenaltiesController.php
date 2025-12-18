<?php

namespace App\Http\Controllers\Vnpay;

use App\Http\Controllers\Controller;
use App\Models\ElectricityBill;
use App\Models\HouseBill;
use App\Models\Payment;
use App\Models\Penalty;
use App\Models\WaterBill;
use App\VNPay\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentPenaltiesController extends Controller
{
    public function payPenaltis(Request $request)
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
            'vnp_ReturnUrl' => route('vnpay.return.penalties'),
        ];

        $transactionId = uniqid('txn_');

        session(['transaction_id' => $transactionId]);

        session([$transactionId . '_penalties_bill_ids' => $request->input('penalties_bill_id')]);

        ksort($data);

        $hashData = http_build_query($data);
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $data['vnp_SecureHash'] = $secureHash;

        $queryString = http_build_query($data);

        return redirect('https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?' . $queryString);
    }




    public function returnPenaltis(Request $request)
    {
        $vnpay = new VNPay(env('VNPAY_TMN_CODE'), env('VNPAY_HASH_SECRET'));
        $receivedHash = $request->input('vnp_SecureHash');
        $data = $request->except('vnp_SecureHash');

        $hashData = $vnpay->createHashData($data);
        $isValid = $vnpay->verifySecureHash($receivedHash, $hashData);

        if ($isValid) {
            $transactionId = session('transaction_id');

            if ($transactionId) {

                $penaltiesIds = session($transactionId . '_penalties_bill_ids');

                if ($penaltiesIds && is_array($penaltiesIds)) {
                    foreach ($penaltiesIds as $penaltyId) {
                        $penalty = Penalty::find($penaltyId);
                        if ($penalty) {
                            $penalty->status = 1;
                            $penalty->save();
                        }
                    }
                }


                session()->forget('transaction_id');
                session()->forget($transactionId . '_penalties_bill_ids');

                Payment::create([
                    'name' => Auth::user()->name,
                    'amount' => $penalty->amount,
                    'note' => "Phạt",
                    'payment_date' => now(),
                    'is_delete' => 0,
                ]);
                return redirect()->route('penalty.filter')->with('success', 'thành công.');
            } else {
                return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
            }
        } else {
            return response()->json(['message' => 'Giao dịch không hợp lệ!'], 400);
        }
    }




    public function cancel()
    {
        return redirect()->route('penalty.filter')->with('success', 'thành công.');
    }
}
