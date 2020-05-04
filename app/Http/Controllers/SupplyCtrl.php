<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Stocks;
use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplyCtrl extends Controller
{
    function __construct()
    {
        $this->middleware('login');
        $this->middleware('admin');
    }

    function index()
    {
        $data = Supply::orderBy('name','asc');
        $search = Session::get('searchSupply');
        if($search){
            $data = $data->where('name','like',"%$search%");
        }
        $data = $data->paginate(30);

        return view('supply',[
            'menu' => 'manage',
            'sub' => 'supply',
            'data' => $data
        ]);
    }

    function save(Request $req)
    {
        $supply_id = self::checkName($req->name,$req->unit);
        self::checkBrand($req->brand);

        $data = array(
            'supply_id' => $supply_id,
            'brand' => $req->brand,
            'unit' => $req->unit,
            'qty' => $req->qty,
            'type' => 'supplies',
            'date_expiration' => $req->date_expiration
        );
        Stocks::create($data);

        return redirect('/supply')->with('status','saved');
    }

    function checkName($name,$unit)
    {
        $s = Supply::updateOrCreate([
            'name' => $name,
            'unit' => $unit
        ]);
        return $s->id;
    }

    function checkBrand($name)
    {
        $b = Brand::updateOrCreate([
            'name' => $name
        ]);
    }

    function getSupplies()
    {
        $data = array();
        $supplies = Supply::orderBy('name','asc')->get();
        foreach($supplies as $row){
            $data[] = array(
                'data' => $row->name,
                'value' => $row->name
            );
        }
        return $data;
    }

    function getBrands()
    {
        $data = array();
        $supplies = Brand::orderBy('name','asc')->get();
        foreach($supplies as $row){
            $data[] = array(
                'data' => $row->name,
                'value' => $row->name
            );
        }
        return $data;
    }
}
