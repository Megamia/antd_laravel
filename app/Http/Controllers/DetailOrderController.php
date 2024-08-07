<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailOrder;

class DetailOrderController extends Controller
{
    //
    public function addDetailOrder(Request $request)
    {
        $data = $request->only('idProduct');
        // DetailOrder::create([

        // ])
        return response()->json(['status' => 1, 'data' => $data]);
    }
}
