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

    public function newDataUserOrderAfterSwap(Request $request)
    {
        $newAddress = $request->only([
            'id'
        ]);

        $user_id = $request->session()->get('user_id');
        $user_id_expires_at = $request->session()->get('user_id_expires_at');

        if ($user_id && $user_id_expires_at && $newAddress['id'] && now()->lessThanOrEqualTo($user_id_expires_at)) {
            if ($user_id === 'guest') {
                return response()->json(['status' => 1, 'dataUserOrder' => 'guest']);
            } else {
                $dataUser = inforUserOrder::where('id', $user_id)->first();
                $newDataAddress = address::where('id', $newAddress['id'])->first();
                return response()->json(['status' => 1, 'dataUserOrder' => ['data' => $dataUser, 'address' => $newDataAddress]]);
            }
        } else {
            $request->session()->forget('user_id');
            $request->session()->forget('user_id_expires_at');
            return response()->json(['status' => 0, 'message' => 'no data user or session expired']);
        }
    }
    public function deleteAddress(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $address->delete();
        return response()->json(['status' => 1, 'message' => "Delete address success"]);
    }
}
