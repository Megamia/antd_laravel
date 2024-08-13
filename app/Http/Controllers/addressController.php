<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\DetailInforUserOrder;
use App\Models\InforUser;
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
    //Cần update
    public function newDataUserOrderAfterSwap(Request $request)
    {
        $newAddress = $request->only(['idAddress']);
        $user_id = $request->session()->get('user_id');
        $user_id_expires_at = $request->session()->get('user_id_expires_at');

        if ($user_id && $user_id_expires_at && now()->lessThanOrEqualTo($user_id_expires_at)) {
            if ($user_id === 'guest') {
                return response()->json(['status' => 1, 'dataUserOrder' => 'guest']);
            } else {
                if (is_null($newAddress['idAddress'])) {
                    $inforUser = InforUser::where('idUser', $user_id)
                        ->orderBy('idAddress')
                        ->first();

                    if ($inforUser && $inforUser->idAddress) {
                        $newAddress['idAddress'] = $inforUser->idAddress;
                    }
                }

                $dataUser = DetailInforUserOrder::where('id', $user_id)->first();

                if ($dataUser) {
                    if (!is_null($newAddress['idAddress'])) {
                        $address = Address::where('id', $newAddress['idAddress'])->first();
                        if ($address) {
                            return response()->json(['status' => 1, 'dataUserOrder' => ['dataUser' => $dataUser, 'address' => $address]]);
                        } else {
                            return response()->json(['status' => 0, 'message' => 'Address not found']);
                        }
                    } else {
                        return response()->json(['status' => 1, 'dataUserOrder' => ['dataUser' => $dataUser]]);
                    }
                } else {
                    return response()->json(['status' => 0, 'message' => 'User not found']);
                }
            }
        } else {
            $request->session()->forget('user_id');
            $request->session()->forget('user_id_expires_at');
            return response()->json(['status' => 0, 'message' => 'No data user or session expired']);
        }
    }
    //Cần update
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
        $idUserWithPhone = DetailInforUserOrder::where('phoneNumber', $data['phoneNumber'])->first();

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
            'message' => 'Address has been add to database',
            'newAddress' => $newAddress
        ]);
    }
    public function DetailAddressWithIdUser(Request $request)
    {
        $data = $request->only('id');
        $DetailAddressWithIdUser = Address::where('idUser', $data['id'])->get();

        if ($DetailAddressWithIdUser->isNotEmpty()) {
            return response()->json(['status' => 1, 'DetailAddressWithIdUser' => $DetailAddressWithIdUser]);
        } else {
            return response()->json(['status' => 0, 'DetailAddressWithIdUser' => "No DetailAddressWithIdUser"]);
        }
    }
}
