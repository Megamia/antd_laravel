<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;

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
        $data = $request->only('id');
        if ($data['id']) {
            $newAddress = address::where('id', $data['id'])->first();
            return response()->json([
                'status' => 1,
                'data' => $newAddress,
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'data' => 'No data',
            ]);
        }
    }


    public function dataAfterSwap(Request $request)
    {
        $response = $this->swapAnotherAddress($request);

        $responseData = $response->getData();

        if ($responseData->status == 1) {
            $data = $responseData->data;
            return response()->json([
                'status' => 1,
                'message' => 'Data processed after swap',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to swap address',
            ]);
        }
    }
}
