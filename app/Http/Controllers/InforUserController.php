<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\InforUser;
use Illuminate\Http\Request;

class InforUserController extends Controller
{
    public function AddressUserWithId(Request $request)
    {
        $data = $request->only('id');

        $AddressUserWithId = InforUser::where('idUser', $data['id'])->get();

        if ($AddressUserWithId->isNotEmpty()) {
            $idAddresses = $AddressUserWithId->pluck('idAddress')->toArray();

            $DetailAddress = Address::whereIn('id', $idAddresses)->get();

            if ($DetailAddress->isNotEmpty()) {
                return response()->json(['status' => 1, 'DetailAddress' => $DetailAddress]);
            } else {
                return response()->json(['status' => 0, 'DetailAddress' => "DetailAddress doesn't exist"]);
            }
        } else {
            return response()->json(['status' => 0, 'AddressUserWithId' => "AddressUserWithId doesn't exist"]);
        }
    }
    public function AddNewInforUser(Request $request)
    {
        $data = $request->only('idUser', 'idAddress');
        $exsitId = InforUser::where('idUser', $data['idUser'])->first();
        $exsitAddress = InforUser::where('idAddress', $data['idAddress'])->first();
        if ($exsitId && $exsitAddress) {
            $InforUser = InforUser::where('idUser', $data['idUser'] && 'idAddress', $data['idAddress'])->first();
            return response()->json(['status' => 0, 'InforUser' => $InforUser]);
        } else {
            $AddNewInforUser = InforUser::create([
                'idUser' => $data['idUser'],
                'idAddress' => $data['idAddress'],
            ]);
            return response()->json(['status' => 1, 'AddNewInforUser' => $AddNewInforUser]);
        }
    }
}
