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
        $supply = Supply::find($id);
        $data = Stocks::where('supply_id',$id)
            ->orderBy('date_expiration','asc')
            ->paginate(30);

        return view('stock',[
            'menu' => 'manage',
            'sub' => 'supply',
            'data' => $data,
            'name' => $supply->name,
            'unit' => $supply->unit
        ]);
    }

    function delete($id)
    {
        Stocks::find($id)->delete();
        return redirect()->back()->with('status','deleted');
    }

    function updateQty(Request $req, $id)
    {
        Stocks::find($id)->update(['qty' => $req->qty]);
        return redirect()->back()->with('status','updated');
    }

    function updateExpiry(Request $req, $id)
    {
        Stocks::find($id)->update(['date_expiration' => $req->date_expiration]);
        return redirect()->back()->with('status','updated');
    }
}
