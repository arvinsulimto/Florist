<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $flowers = Flower::paginate(10);
        return view('home')->with('flowers', $flowers);;
    }

    public function searchFlowers(Request $request)
    {
        $search = $request->search;
        $flowers = Flower::where('flowername', 'like', '%' . $search . '%')->paginate(10);
        return view('home')->with('flowers', $flowers);
    }

    public function destroyFlowers(Flower $flowers)
    {
        $flowers->delete();
        return redirect('/');
    }
}
