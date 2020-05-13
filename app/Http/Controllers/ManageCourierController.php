<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courier;

class ManageCourierController extends Controller
{
    public function indexCouriers()
    {
        $couriers = Courier::paginate(10);
        return view('managecouriers.index')->with('couriers', $couriers);
    }

    public function createCouriers()
    {
        return view('managecouriers.create');
    }

    public function storeCouriers(Request $request)
    {
        $this->validate($request, array(
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'numeric|min:3000'
        ));
        
        $couriers = new Courier();
        $couriers->couriername = $request->courier_name;
        $couriers->price = $request->shipping_cost;
        $couriers->save();

        return redirect('/managecouriers');
    }

    public function editCouriers($courierid)
    {
        $couriers = Courier::find($courierid);
        return view('managecouriers.edit', compact('couriers'));
    }

    public function updateCouriers(Request $request, $courierid)
    {
        $this->validate($request, array(
            'courier_name' => 'required|min:3',
            'shipping_cost' => 'numeric|min:3000'
        ));

        $couriers = Courier::findOrFail($courierid);
        $couriers->couriername = $request->input('courier_name');
        $couriers->price = $request->input('shipping_cost');
        $couriers->save();

        return redirect('/managecouriers');
    }

    public function destroyCouriers(Courier $couriers)
    {
        $couriers->delete();
        return redirect('/managecouriers');
    }

    public function searchCouriers(Request $request)
    {
        $search = $request->search;
        $couriers = Courier::where('couriername', 'like', '%' . $search . '%')->paginate(10);
        return view('managecouriers.index')->with('couriers', $couriers);
    }
}
