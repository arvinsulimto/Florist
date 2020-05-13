<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Flower;
use App\Courier;
use App\Transaction;
use App\DetailTransactions;
use Auth;

class CartController extends Controller
{
    public function indexCarts()
    {
        $flowers = DB::table('flowers')
                    ->join('carts', 'flowers.flowerid', '=', 'carts.flowerid')
                    ->where('carts.id', Auth::id())
                    ->select('carts.flowerid', 'flowers.flowername', 'flowers.image', 'flowers.price', 'carts.quantity')
                    ->get();
        $couriers = Courier::all();
        
        $prices = [];
        for ($i=0; $i<count($flowers); $i++){
            $prices[$i] = $flowers[$i]->price * $flowers[$i]->quantity;
        }

        $totals = 0;
        foreach($prices as $price){
            $totals += $price;
        }

        return view('cart', compact('flowers', 'couriers', 'prices', 'totals'));
    }

    public function destroyCarts(Flower $flowers)
    {
        $curr = Flower::where('flowerid', $flowers->flowerid)->select('stock')->get()[0]->stock;
        $qty = Cart::where('id', Auth::id())->where('flowerid', $flowers->flowerid)->select('quantity')->get()[0]->quantity;
        $sum = (int)$curr + (int)$qty;

        Flower::where('flowerid', $flowers->flowerid)
            ->update([
                'stock' => $sum
            ]);

        Cart::where('id', Auth::id())->where('flowerid', $flowers->flowerid)->delete();
        
        return redirect('/cart');
    }

    public function checkoutCarts(Request $request)
    {
        $this->validate($request, array(
            'courier' => 'required',
        ));
        
        $courierprice = Courier::where('courierid', $request->courier)->select('price')->get()[0]->price;

        $flowers = DB::table('flowers')
            ->join('carts', 'flowers.flowerid', '=', 'carts.flowerid')
            ->where('carts.id', Auth::id())
            ->select('carts.flowerid', 'flowers.price', 'carts.quantity')
            ->get();
        
        $prices = [];
        for ($i=0; $i<count($flowers); $i++){
            $prices[$i] = $flowers[$i]->price * $flowers[$i]->quantity;
        }

        $totals = 0;
        foreach($prices as $price){
            $totals += $price;
        }

        $transactions = new Transaction();
        $transactions->id = Auth::id();
        $transactions->courierid = $request->courier;
        $transactions->courierprice = $courierprice;
        $transactions->totalprice = $totals;
        $transactions->save();
        
        $transactionid = Transaction::where('id', Auth::id())->orderBy('transactionid', 'desc')->select('transactionid')->get()[0]->transactionid;

        for ($i=0; $i<count($flowers); $i++){
            $detailtransactions = new DetailTransactions();
            $detailtransactions->transactionid = $transactionid;
            $detailtransactions->flowerid = $flowers[$i]->flowerid;
            $detailtransactions->quantity = $flowers[$i]->quantity;
            $detailtransactions->price = $flowers[$i]->price;
            $detailtransactions->save();
        }

        Cart::where('id', Auth::id())->delete();

        return redirect('/');
    }
}
