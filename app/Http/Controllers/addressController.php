<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\InforUserOrder;

class AddressController extends Controller
{
    public function inforAddress(Request $request)
    {
        $address = Address::all();
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
                $dataUser = InforUserOrder::where('id', $user_id)->first();
                $newDataAddress = Address::where('id', $newAddress['id'])->first();
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
    public function addNewAddress(Request $request)
    {
        $data = $request->only(
            'username',
            'phoneNumber',
            'city',
            'district',
            'ward',
            'address'
        );
        if (is_null($data['username'])) {
            $data['username'] = 'user';
        }
        $newAddress = Address::create([
            'name' => $data['username'],
            'phoneNumber' => $data['phoneNumber'],
            'city' => $data['city'],
            'district' => $data['district'],
            'ward' => $data['ward'],
            'address' => $data['address'],
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Address has been add to database', 'newAddress' => $newAddress
        ]);
    }
}
