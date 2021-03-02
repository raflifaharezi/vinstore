<?php

namespace App\Http\Controllers;
use App\Transaction;
use App\TransactionDetail;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.gallery'])
                        ->whereHas('product', function($product){
                            $product->where('user_id', Auth::user()->id);
                        });

        $revenue = $transaction->get()->reduce(function($carry , $item){
            return $carry + $item ->price;
        });

        $customer = User::count();
        
        return view('pages-dashboard.dashboard-page', [
            'transaction_count' => $transaction->count(),
            'transaction_data' => $transaction->get(),
            'revenue'   => $revenue,
            'customer'  => $customer
        ]); 
    }
    
}
    

    
    
    

