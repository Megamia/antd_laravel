<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function inforProduct(Request $request)
    {
        $product = product::all();
        if ($product->count() > 0) {
            return response()->json(['status' => 1, 'inforProduct' => $product]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data product']);
        }
    }
}
