<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\DetailProduct;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;

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

        if (isset($data['idOrder']) && is_array($data['idOrder'])) {
            $idOrder = $data['idOrder'][0];
        } else {
            return response()->json(['status' => 0, 'createDetailOrderWithouPrice' => 'Invalid idOrder']);
        }

        $createDetailOrderWithouPrice = DetailOrder::create([
            'idOrder' => $idOrder,
            'timeCreateOrder' => Carbon::now(),
        ]);

        return response()->json(['status' => 1, 'createDetailOrderWithouPrice' => $createDetailOrderWithouPrice]);
    }
    public function createDetailOrderWithPrice(Request $request)
    {
        $data = $request->only('idProduct');

        if (isset($data['idProduct']) && is_array($data['idProduct'])) {
            $idDetailProducts = Product::whereIn('id', $data['idProduct'])->pluck('idDetailProduct');
            $idDetailOrders = Product::whereIn('id', $data['idProduct'])->pluck('idDetailOrder')->unique();

            $prices = DetailProduct::whereIn('id', $idDetailProducts)->pluck('price');
            $quantities = Product::whereIn('idDetailProduct', $idDetailProducts)
                ->where('idDetailorder', $idDetailOrders)
                ->pluck('numberSelected');

            // if ($prices->count() !== $quantities->count()) {
            //     return response()->json(['status' => 0, 'message' => 'Mismatch between prices and quantities count']);
            // }

            $priceAllProduct = 0;

            foreach ($prices as $index => $price) {
                // $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $price = str_replace([',', '.'], '', $price);
                $price = (float) $price;


                $quantity = $quantities[$index];

                // $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);
                // $price = str_replace([',', '.'], '', $price);
                $quantity = (int) $quantity;

                if (is_numeric($price) && is_numeric($quantity)) {
                    $priceAllProduct += $price * $quantity;
                } else {
                    return response()->json(['status' => 0, 'message' => 'Invalid price or quantity value']);
                }
            }

            $formattedPrice = number_format($priceAllProduct, 2, '.', ',');

            $updatedRows = DetailOrder::whereIn('id', $idDetailOrders)
                ->update(['price' => $formattedPrice]);

            $createDetailOrderWithPrice = DetailOrder::whereIn('id', $idDetailOrders)->get();

            if ($updatedRows) {
                return response()->json([
                    'status' => 1,
                    'createDetailOrderWithPrice' => $createDetailOrderWithPrice,
                    'priceAllProduct' => $priceAllProduct,
                    'prices' => $prices,
                    'quantities' => $quantities
                ]);
            } else {
                return response()->json(['status' => 0, 'message' => 'Failed to update detail orders']);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Invalid idProduct']);
        }
    }
}
