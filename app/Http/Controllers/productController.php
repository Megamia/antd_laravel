<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class productController extends Controller
{
    public function inforProduct(Request $request)
    {
        $product = product::all();
        if ($product->count() > 0) {
            return response()->json(['status' => 1, 'inforProduct' => $product]);
        } else {
            return response()->json(['status' => 0, 'inforProduct' => 'No data product']);
        }
    }
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:jpg,png,jpeg,gif,svg',
    ]);

    if ($request->file()) {
        $fileName = $request->file->getClientOriginalName();
        $filePath = public_path('uploads');

        if (!file_exists($filePath)) {
            mkdir($filePath, 0755, true);
        }

        if (file_exists($filePath . '/' . $fileName)) {
            unlink($filePath . '/' . $fileName);
        }

        $request->file('file')->move($filePath, $fileName);

        return response()->json(['success' => 'File uploaded successfully.', 'file_path' => '/uploads/' . $fileName]);
    }

    return response()->json(['error' => 'File upload failed.']);
}


    public function showImg(Request $request)
    {
        $files = File::files(public_path('uploads'));

        $images = [];
        foreach ($files as $file) {
            $images[] = [
                'url' => asset('uploads/' . $file->getFilename()),
                'name' => $file->getFilename()
            ];
        }

        if (!empty($images)) {
            return response()->json(['status' => 1, 'images' => $images]);
        } else {
            return response()->json(['status' => 0, 'images' => 'No images']);
        }
    }
    public function addNewProduct(Request $request)
    {
        $data = $request->only(
            'name',
            'tag',
            'price',
            'quantity',
            'img'
        );
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'img' => 'nullable|string',
        ]);
        $existingProduct = product::where('name', $data['name'])->first();
        if ($existingProduct) {
            return response()->json(['status' => 0, 'inforProduct' => 'Product already exists']);
        }
        $product = product::create([
            'name' => $data['name'],
            'tag' => $data['tag'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'img' => $data['img'],
        ]);
        if ($product) {
            return response()->json(['status' => 1, 'inforProduct' => $product]);
        } else {
            return response()->json(['status' => 0, 'inforProduct' => 'No product']);
        }
    }
}
