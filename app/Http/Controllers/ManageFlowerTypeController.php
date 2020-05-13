<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlowerType;

class ManageFlowerTypeController extends Controller
{
    public function indexFlowerTypes()
    {
        $flowerstype = FlowerType::paginate(10);
        return view('manageflowertypes.index')->with('flowertypes', $flowerstype);
    }

    public function createFlowerTypes()
    {
        return view('manageflowertypes.create');
    }

    public function storeFlowerTypes(Request $request)
    {
        $this->validate($request, array(
            'flower_type' => 'required|min:4|unique:flower_types,typename',
        ));

        $flowerstype = new FlowerType();
        $flowerstype->typename = $request->flower_type;
        $flowerstype->save();

        return redirect('/manageflowertypes');
    }

    public function destroyFlowerTypes(FlowerType $flowertypes)
    {
        $flowertypes->delete();
        return redirect('/manageflowertypes');
    }

    public function editFlowerTypes($typeid)
    {
        $flowertypes = FlowerType::find($typeid);
        return view('manageflowertypes.edit', compact('flowertypes'));
    }

    public function updateFlowerTypes(Request $request, $typeid)
    {
        $this->validate($request, array(
            'flower_type' => 'required|min:4|unique:flower_types,typename',
        ));

        $flowertype = FlowerType::findOrFail($typeid);
        $flowertype->typename = $request->input('flower_type');
        $flowertype->save();

        return redirect('/manageflowertypes');
    }

    public function searchFlowerTypes(Request $request)
    {
        $search = $request->search;
        $flowertypes = FlowerType::where('typename', 'like', '%' . $search . '%')->paginate(10);
        return view('manageflowertypes.index')->with('flowertypes', $flowertypes);
    }
}
