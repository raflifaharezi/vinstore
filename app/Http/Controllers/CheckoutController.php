<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

 //untuk midtrans
use Exception;
use Midtrans\Snap;
use midtrans\Config;
use Midtrans\Notification;
class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses checkout
        $code = 'STORE-' . mt_rand(0000,9999);
        $carts = Cart::with(['product','user'])
                    ->where('user_id', Auth::user()->id)
                    ->get();
    
        //proses transaction create
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000,9999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'product_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Delete cart data
        Cart::with(['product','user'])
                ->where('user_id', Auth::user()->id)
                ->delete();
                
        // kongigurasi midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // uat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => [
                'gopay', 'bank_transfer'
            ],
            'vtweb' =>[]
        ];

    try {
    // Get Snap Payment Page URL
    $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
    
    // Redirect to Snap Payment Page
    return redirect($paymentUrl);
    }
    catch (Exception $e) {
    echo $e->getMessage();
    }

    }

    public function callback(Request $request)
    {
        //set configuration midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // instance midtrans notification
        $notification = New Notification();

        // assign ke variable untuk memdahkan koding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        // cari transaski berdasarkan id
        $transaction = Transaction::findorFail($order_id);
        //Handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending') {
            $transaction->status = 'PENDING';
        }
        else if($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }
        // simpan transaksi
        $transaction->save();


    }
}