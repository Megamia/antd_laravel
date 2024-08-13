<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\InforUser;
use Illuminate\Http\Request;

class InforUserController extends Controller
{

    public function InforUser(Request $request)
    {
        $data = $request->only('idUser', 'idAddress');

        $InforUser = InforUser::where('idUser', $data['idUser'])
            ->where('idAddress', $data['idAddress'])
            ->first();

        if ($InforUser) {
            return response()->json(['status' => 1, 'InforUser' => $InforUser]);
        }

        return response()->json(['status' => 0, 'message' => 'No matching records found']);
    }

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
        $exsitInforUser = InforUser::where('idUser', $data['idUser'])
            ->where('idAddress', $data['idAddress'])
            ->first();
        if ($exsitInforUser) {
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
