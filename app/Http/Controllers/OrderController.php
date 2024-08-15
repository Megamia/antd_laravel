<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        //     $validator = Validator::make($request->all(), [
        //         'idDetailOrder' => 'required|array',
        //         'idUser' => 'required|integer',
        //         'idAddress' => 'nullable|integer',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json(['error' => $validator->errors()->first()], 400);
        //     }

        //     $idDetailOrders = $request->input('idDetailOrder');
        //     $idUser = $request->input('idUser');
        //     $idAddress = $request->input('idAddress');

        //     if (!$idAddress) {
        //         $idAddress = InforUser::where('idUser', $idUser)->pluck('idAddress')->first();
        //         if (!$idAddress) {
        //             return response()->json(['status' => 0, 'message' => 'No addresses available for the given user.'], 404);
        //         }
        //     }

        //     $inforUser = InforUser::where('idUser', $idUser)
        //         ->where('idAddress', $idAddress)
        //         ->first();

        //     if (!$inforUser) {
        //         return response()->json(['status' => 0, 'message' => 'InforUser not found with the given address'], 404);
        //     }

        //     $createdOrders = [];
        //     $failedOrders = [];

        //     foreach ($idDetailOrders as $idDetailOrder) {
        //         try {
        //             $createOrder = Order::create([
        //                 'idDetailOrder' => $idDetailOrder,
        //                 'idInforUser' => $inforUser->id,
        //             ]);
        //             $createdOrders[] = $createOrder;
        //         } catch (\Exception $e) {
        //             $failedOrders[] = ['idDetailOrder' => $idDetailOrder, 'error' => $e->getMessage()];
        //         }
        //     }

        //     if (count($failedOrders) > 0) {
        //         return response()->json([
        //             'status' => 0,
        //             'message' => 'Some orders could not be created',
        //             'failedOrders' => $failedOrders
        //         ], 500);
        //     }

        //     return response()->json([
        //         'status' => 1,
        //         'createdOrders' => $createdOrders
        //     ]);
        // }

        $data = $request->only('idDetailOrder', 'idInforUser', 'idVoucher');
        $createOrders = [];
        $failedOrders = [];
        foreach ($data['idVoucher'] as $idVoucher) {
            foreach ($data['idDetailOrder'] as $idDetailOrder) {
                try {
                    $createOrder = Order::create([
                        'idDetailOrder' => $idDetailOrder,
                        'idVoucher' => $idVoucher,
                        'idInforUser' => $data['idInforUser'],
                    ]);
                    $createOrders[] = $createOrder;
                } catch (\Exception $e) {
                    $failedOrders[] = [
                        'idDetailOrder' => $idDetailOrder,
                        'idVoucher' => $idVoucher,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }
        if (count($failedOrders) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Some orders could not be created',
                'failedOrders' => $failedOrders
            ], 500);
        }
        return response()->json(['status' => 1, 'createOrders' => $createOrders]);
    }
}
