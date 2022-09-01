<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transactions;

class DahsboardController extends Controller
{
    public function index()
    {
        $customers = User::count();
        $revenue= Transactions::WHERE('transaction_status','SUCCESS')->sum('total_price');
        $transactions = Transactions::count();
        return view('pages.admin.dashboard',[
            'customers' => $customers,
            'revenue' => $revenue,
            'transactions' => $transactions
        ]);
    }
}
