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
    }
    
    
}
