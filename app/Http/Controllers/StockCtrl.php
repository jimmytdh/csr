<?php

namespace App\Http\Controllers;

use App\Stocks;
use App\Supply;
use Illuminate\Http\Request;

class StockCtrl extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    function index($id)
    {
        $name = Supply::find($id)->name;
        $data = Stocks::where('supply_id',$id)
            ->orderBy('date_expiration','asc')
            ->paginate(30);

        return view('stock',[
            'menu' => 'manage',
            'sub' => 'supply',
            'data' => $data,
            'name' => $name
        ]);
    }

    function delete($id)
    {
        Stocks::find($id)->delete();
        return redirect()->back()->with('status','deleted');
    }
}
