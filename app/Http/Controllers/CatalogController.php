<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;
use App\Cart;
use Auth;

class CatalogController extends Controller
{
    public function detailFlowers($flowerid)
    {
        $flowers = Flower::find($flowerid);
        return view('detail', compact('flowers'));
    }

    public function insertCarts(Request $request, $flowerid)
    {
        $this->validate($request, array(
            'quantity' => 'required|numeric|min:1',
        ));

        $queryCart = Cart::where('id', Auth::id())->where('flowerid', $flowerid)->get();
        $queryStock = Flower::where('flowerid', $flowerid)->select('stock')->get()[0]->stock;
        
        if($queryStock!=0) {
            if(!$queryCart->isEmpty()) {
                $curr = Cart::where('id', Auth::id())->where('flowerid', $flowerid)->select('quantity')->get()[0]->quantity;
                $qty = $request->input('quantity');
                $sum = (int)$curr + (int)$qty;
                
                Cart::where('id', Auth::id())
                    ->where('flowerid', $flowerid)
                    ->update([
                        'quantity' => $sum
                    ]);
            } else {
                $carts = new Cart();
                $carts->id = Auth::id();
                $carts->flowerid = $flowerid;
                $carts->quantity = $request->quantity;
                $carts->save();
            }
        }

        $qtydb = Flower::where('flowerid', $flowerid)->select('stock')->get()[0]->stock;
        $qtycart = $request->input('quantity');
        $qtysum = (int)$qtydb - (int)$qtycart;
        Flower::where('flowerid', $flowerid)
            ->update([
                'stock' => $qtysum
            ]);

        return redirect('/');
    }

    public function addCarts($flowerid)
    {
        $queryCart = Cart::where('id', Auth::id())->where('flowerid', $flowerid)->get();
        $queryStock = Flower::where('flowerid', $flowerid)->select('stock')->get()[0]->stock;
        
        if($queryStock!=0) {
            if(!$queryCart->isEmpty()) {
                $curr = Cart::where('id', Auth::id())->where('flowerid', $flowerid)->select('quantity')->get()[0]->quantity;
                $sum = (int)$curr + 1;
                
                Cart::where('id', Auth::id())
                    ->where('flowerid', $flowerid)
                    ->update([
                        'quantity' => $sum
                    ]);
            } else {
                $carts = new Cart();
                $carts->id = Auth::id();
                $carts->flowerid = $flowerid;
                $carts->quantity = 1;
                $carts->save();
            }
        }

        $qtydb = Flower::where('flowerid', $flowerid)->select('stock')->get()[0]->stock;
        $qtysum = (int)$qtydb - 1;
        Flower::where('flowerid', $flowerid)
            ->update([
                'stock' => $qtysum
            ]);

        return redirect('/');
    }
}
