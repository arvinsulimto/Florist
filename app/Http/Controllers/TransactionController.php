<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function indexHistory()
    {
        $transactionhistory = DB::table('transactions')
                            ->join('detail_transactions','transactions.transactionid','=','detail_transactions.transactionid')
                            ->join('users','users.id','=','transactions.id')
                            ->join('couriers','couriers.courierid','=','transactions.courierid')
                            ->join('flowers','flowers.flowerid','=','detail_transactions.flowerid')
                            ->select('transactions.transactionid','users.name','couriers.couriername','transactions.created_at as transactiondate',
                                    'transactions.totalprice','transactions.courierprice','flowers.*','detail_transactions.quantity as jumlah',
                                    'detail_transactions.price as harga')
                            ->get();
                            
        return view('transactionhistory')->with('transactionhistory',$transactionhistory);
    }
}
