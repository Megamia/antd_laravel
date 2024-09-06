<?php

namespace App\Http\Controllers;

use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productSelected(Request $request)
    {
        $data = $request->input('data');
        $productSelected = [];                          //array
        //$productSelected = new \stdClass();           object
        if (!is_array($data)) {
            return response()->json([
                'message' => 'Invalid data format ',
                '$data: ' => $data
            ], 400);
        }
        foreach ($data as $item) {
            $idDetailProduct = $item['idDetailProduct'];
            $numberSelected = $item['numberSelected'];

            $existProduct = Product::where('idDetailProduct', $idDetailProduct)->first();

            if ($existProduct) {
                $existProduct->update([
                    'numberSelected' => $numberSelected,
                ]);
                $productSelected[] = $existProduct;
            } else {
                $new = Product::create([
                    'idDetailProduct' => $idDetailProduct,
                    'numberSelected' => $numberSelected,
                    'idTagTitle' => 2  //fix cứng
                ]);
                $productSelected[] = $new;
            }
        }
        return response()->json(['status' => 1, 'productSelected' => $productSelected]);
    }
    //update
    public function createProduct(Request $request)
    {
        $data = $request->only('idDetailProduct', 'idDetailOrder');
        $idDetailProduct = $data['idDetailProduct'];
        $idDetailOrder = $data['idDetailOrder'];
        if (empty($data)) {
            return response()->json(['status' => 0, 'error' => 'Invalid input']);
        }

        if (!is_array($idDetailProduct)) {
            $idDetailProduct = [$idDetailProduct];
        }

        $detailProducts = DetailProduct::whereIn('id', $idDetailProduct)->get();
        $createProducts = [];

        foreach ($detailProducts as $detailProduct) {
            $createProduct = Product::create([
                'idDetailOrder' => $idDetailOrder,
                'idDetailProduct' => $detailProduct->id,
            ]);
            $createProducts[] = $createProduct;
        }

        return response()->json(['status' => 1, 'createProduct' => $createProducts]);
    }
    //update
}
