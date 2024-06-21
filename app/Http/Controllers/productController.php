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
            'file' => 'required|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = public_path('uploads');

            if (!file_exists($filePath)) {
                mkdir($filePath, 0755, true);
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
}
