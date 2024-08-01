<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productSelected(Request $request)
    {
        $data = $request->input('data');
        $productSelected = [];
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
}
