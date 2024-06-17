<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;
use App\Models\inforUserOrder;

class addressController extends Controller
{
    public function inforAddress(Request $request)
    {
        $address = address::all();
        if ($address->count() > 0) {
            return response()->json(['status' => 1, 'inforAddress' => $address]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data address']);
        }
    }
    public function swapAnotherAddress(Request $request)
    {
        $data = $request->only('idUser', 'id');
        $address = address::where('id', $data['id'])->first();
        $user = inforUserOrder::where('id', $data['idUser'])->first();
        if ($address && $user) {
            return response()->json([
                'status' => 1,
                'data' => [
                    'address' => $address,
                    'user' => $user
                ]
            ]);
        } else {
            return response()->json(['status' => 0, 'data' => 'No data']);
        }
    }
    public function dataAfterSwap(Request $request)
{
    $swapData = $this->swapAnotherAddress($request);

    if ($swapData['status'] == 1) {
        return response()->json([
            'status' => 1,
            'message' => 'Swap address successful',
            'data' => [
                'address' => $swapData['data']['address'],
                'user' => $swapData['data']['user']
            ]
        ]);
    } else {
        return response()->json([
            'status' => 0,
            'message' => 'Failed to swap address'
        ]);
    }
}
}
