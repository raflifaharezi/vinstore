<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function transaction()
    {
        $SellTransaction = TransactionDetail::with(['transaction.user', 'product.gallery'])
            ->whereHas('product', function($product){
                $product->where('user_id', Auth::user()->id);
            })->get();

            $BuyTransaction = TransactionDetail::with(['transaction.user', 'product.gallery'])
            ->whereHas('product', function($transaction){
                $transaction->where('user_id', Auth::user()->id);
            })->get();
        return view('pages-dashboard.dashboard-transaction',[
            'SellTransaction' => $SellTransaction,
            'BuyTransaction' => $BuyTransaction
        ]); 
    }

    public function transaction_detail(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.gallery'])
                        ->findOrFail($id);
        return view('pages-dashboard.dashboard-transaction-detail',[
            'transaction' => $transaction
        ]); 
    }
    public function update(Request $request, $id) 
    {
        $data = $request->all();
        $item = TransactionDetail::findorfail($id);
        
        $item->update($data);

        return redirect()->route('dashboard-transaction-detail', $id);
    }
}
