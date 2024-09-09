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
        $data = $request->only('dataProduct', 'idDetailProduct', 'idDetailOrder');
        $idDetailProduct = $data['idDetailProduct'];
        $idDetailOrder = $data['idDetailOrder'];
        $dataProduct = $data['dataProduct'];

        if (empty($data) || !is_array($dataProduct) || empty($idDetailOrder)) {
            return response()->json(['status' => 0, 'error' => 'Invalid input']);
        }

        if (!is_array($idDetailProduct)) {
            $idDetailProduct = [$idDetailProduct];
        }

        $createProducts = [];

        foreach ($dataProduct as $data) {
            if (!isset($data['id']) || !isset($data['selectedQuantity'])) {
                return response()->json(['status' => 0, 'error' => 'Invalid dataProduct format']);
            }

            $createProduct = Product::create([
                'idDetailOrder' => $idDetailOrder,
                'idDetailProduct' => $data['id'],
                'numberSelected' => $data['selectedQuantity'] ?? 1,
            ]);

            $createProducts[] = $createProduct;
        }

        return response()->json(['status' => 1, 'createProduct' => $createProducts]);
    }

    //update
}
