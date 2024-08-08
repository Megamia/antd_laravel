<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\DetailProduct;
use App\Models\Product;

class DetailOrderController extends Controller
{
    //
    public function addDetailOrder(Request $request)
    {
        $idProducts = $request->input('idProducts');

        if (!is_array($idProducts)) {
            return response()->json(['error' => 'Invalid input. idProducts should be an array.'], 400);
        }

        $products = Product::whereIn('id', $idProducts)->get();

        $result = [];

        foreach ($products as $product) {
            $idDetailProduct = $product->idDetailProduct;

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
        foreach ($result as $data) {
            $addDetailOrder = DetailOrder::create([
                'idProduct' => $data['id'],
                'price' => $data['price']
            ]);
            $addDetailOrders[] = $addDetailOrder;
        }
        return response()->json(['status' => 1, 'addDetailOrders' => $addDetailOrders]);

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
}
