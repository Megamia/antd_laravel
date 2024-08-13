<?php

namespace App\Http\Controllers;

use App\Models\InforUser;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $idDetailOrders = $request->input('idDetailOrder');
        $idUser = $request->input('idUser');
        $idAddress = $request->input('idAddress');

        if (!is_array($idDetailOrders) || !is_int($idUser)) {
            return response()->json(['error' => 'Invalid input. idDetailOrder should be an array and idUser should be an integer.'], 400);
        }

        if (!$idAddress) {
            $inforUser = InforUser::where('idUser', $idUser)->first();

            if ($inforUser) {
                $idAddress = InforUser::where('idUser', $idUser)->pluck('idAddress')->first();
                if (!$idAddress) {
                    return response()->json(['status' => 0, 'message' => 'No addresses available for the given user.'], 404);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'User not found'], 404);
            }
        }

        $inforUser = InforUser::where('idUser', $idUser)
            ->where('idAddress', $idAddress)
            ->first();

        if (!$inforUser) {
            return response()->json(['status' => 0, 'message' => 'InforUser not found with the given address'], 404);
        }

        $createdOrders = [];
        $failedOrders = [];

        foreach ($idDetailOrders as $idDetailOrder) {
            try {
                $createOrder = Order::create([
                    'idDetailOrder' => $idDetailOrder,
                    'idInforUser' => $inforUser->id,
                ]);

                $createdOrders[] = $createOrder;
            } catch (\Exception $e) {
                $failedOrders[] = $idDetailOrder;
            }
        }

        if (count($failedOrders) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Some orders could not be created',
                'failedOrders' => $failedOrders
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'createdOrders' => $createdOrders
        ]);
    }
}
