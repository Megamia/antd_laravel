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
        $productSelected = [];                      //array
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
    public function createProduct(Request $request)
    {
        $idProducts = $request->input('idProducts');

        if (empty($idProducts)) {
            return response()->json(['status' => 0, 'error' => 'Invalid input idProducts']);
        }

        if (!is_array($idProducts)) {
            $idProducts = [$idProducts];
        }

        $detailProducts = DetailProduct::whereIn('id', $idProducts)->get();
        $createProducts = [];

        foreach ($detailProducts as $detailProduct) {
            $createProduct = Product::create([
                'idDetailProduct' => $detailProduct->id,
            ]);
            $createProducts[] = $createProduct;
        }

        return response()->json(['status' => 1, 'createProduct' => $createProducts]);
    }
}
