<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;
use App\FlowerType;

class ManageFlowerController extends Controller
{
    public function indexFlowers()
    {
        $flowers = Flower::paginate(10);
        return view('manageflowers.index')->with('flowers', $flowers);
    }

    public function createFlowers()
    {
        $flowerstype = FlowerType::all();
        return view('manageflowers.create')->with('flowertypes', $flowerstype);
    }

    public function storeFlowers(Request $request)
    {
        $this->validate($request, array(
            'flower_name' => 'required|min:3',
            'flower_type' => 'required',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|between:20,200',
            'stock' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ));

        $flowers = new Flower();
        $flowers->flowername = $request->flower_name;
        $flowers->typeid = $request->flower_type;
        $flowers->price = $request->price;
        $flowers->description = $request->description;
        $flowers->stock = $request->stock;
        
        if ($request->file('image') != null) {
            $flowers->image = $request->file('image')->store('flowers', 'public');
        }
        $flowers->save();

        return redirect('/manageflowers');
    }

    public function destroyFlowers(Flower $flowers)
    {
        $flowers->delete();
        return redirect('/manageflowers');
    }

    public function editFlowers($flowerid)
    {
        $flowers = Flower::find($flowerid);
        $flowertypes = FlowerType::all();
        return view('manageflowers.edit', compact('flowers', 'flowertypes'));
    }

    public function updateFlowers(Request $request, $flowerid)
    {
        $this->validate($request, array(
            'flower_name' => 'required|min:3',
            'flower_type' => 'required',
            'price' => 'required|numeric|min:10000',
            'description' => 'required|between:20,200',
            'stock' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ));

        $flowers = Flower::findOrFail($flowerid);
        $flowers->flowername = $request->input('flower_name');
        $flowers->typeid = $request->input('flower_type');
        $flowers->price = $request->input('price');
        $flowers->description = $request->input('description');
        $flowers->stock = $request->input('stock');

        if ($request->file('image') != null) {
            $flowers->image = $request->file('image')->store('flowers', 'public');
        }
        $flowers->save();

        return redirect('/manageflowers');
    }

    public function searchFlowers(Request $request)
    {
        $search = $request->search;
        $flowers = Flower::where('flowername', 'like', '%' . $search . '%')->paginate(10);
        return view('manageflowers.index')->with('flowers', $flowers);
    }
}
