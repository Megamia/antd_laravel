<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\DetailProduct;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class DetailOrderController extends Controller
{
    public function createDetailOrder(Request $request)
    {
        $idProducts = $request->input('idProduct');
        $idOrder = $request->input('idOrder');
        if (!$idProducts) {
            return response()->json(['status' => 0, 'error' => 'Invalid input idProducts']);
        }

        if (!is_array($idProducts)) {
            $idProducts = [$idProducts];
        }

        $products = Product::whereIn('id', $idProducts)->get();
        $orders = Order::whereIn('id', $idOrder)->get();
        $result = [];

        foreach ($products as $product) {
            $idDetailProduct = $product->idDetailProduct;
            foreach ($orders as $order) {

                if ($idDetailProduct) {
                    $detailProduct = DetailProduct::find($idDetailProduct);

                    if ($detailProduct) {
                        $result[] = [
                            'id' => $product->id,
                            'price' => $detailProduct->price
                        ];
                    } else {
                        $result[] = [
                            'id' => $product->id,
                            'error' => 'Detail product not found'
                        ];
                    }
                } else {
                    $result[] = [
                        'id' => $product->id,
                        'error' => 'Detail product ID is missing'
                    ];
                }
            }
        }

        $createdDetailOrders = [];
        foreach ($result as $data) {
            if (isset($data['price'])) {
                $createDetailOrder = DetailOrder::create([
                    'idProduct' => $data['id'],
                    'price' => $data['price']
                ]);
                $createdDetailOrders[] = $createDetailOrder;
            }
        }

        return response()->json(['status' => 1, 'createDetailOrder' => $createdDetailOrders]);



        // $exsitingDetailOrder = DetailOrder::where('id', $result['id']);
        // if (!$exsitingDetailOrder) {

        //     $addDetailOrders = [];
        //     foreach ($result as $data) {
        //         $addDetailOrder = DetailOrder::create([
        //             'idProduct' => $data['id'],
        //             'price' => $data['price']
        //         ]);
        //         $addDetailOrders[] = $addDetailOrder;
        //     }
        //     return response()->json(['status' => 1, 'addDetailOrders' => $addDetailOrders]);
        // } else {
        //     return response()->json(['status' => 0, 'addDetailOrders' => 'DetailOrder has been already']);
        // }



        // if (is_array($data)) {
        //     $addDetailOrders = [];
        //     foreach ($data as $id) {
        //         $addDetailOrder = DetailOrder::create([
        //             'idProduct' => $id,
        //         ]);
        //         $addDetailOrders[] = $addDetailOrder;
        //     }
        //     return response()->json(['status' => 1, 'addDetailOrder' => $addDetailOrders]);
        // } else {
        //     return response()->json(['status' => 0, 'message' => 'Invalid data format']);
        // }

    }
    public function createDetailOrderWithouPrice(Request $request)
    {
        $data = $request->only('idOrder');
        if ($data['idOrder']) {
            $createDetailOrderWithouPrice = DetailOrder::create([
                'idOrder' => $data['idOrder'],
                // 'timeCreateOrder' => Carbon::now()->toDateTimeString(),
            ]);
            return response()->json(['status' => 1, 'createDetailOrderWithouPrice' => $createDetailOrderWithouPrice]);
        } else {
            return response()->json(['status' => 0, 'createDetailOrderWithouPrice' => 'Faile to createDetailOrderWithouPrice']);
        }
    }
}
