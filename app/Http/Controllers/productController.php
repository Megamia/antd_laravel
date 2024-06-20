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
            return response()->json(['status' => 0, 'inforProduct' => 'No data product']);
        }
    }
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'files.*' => 'required|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048'
            ]);

            $filePaths = [];
            $fileInfos = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('uploads');
                    $filePaths[] = $path;

                    $fileInfo = [
                        'name' => $file->getClientOriginalName(),
                        'extension' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                        'path' => $path
                    ];

                    $fileInfos[] = $fileInfo;
                }
            }

            return response()->json([
                'status' => 1,
                'filePaths' => $filePaths,
                'fileInfos' => $fileInfos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function uploadPublic(Request $request)
    {
        $image = $request->file('files');
        if ($image) {

            $input['imgname'] = time() . '.' . $image->getClientOriginalExtension();
            $desPath = public_path('/upload');
            $image->move($desPath, $input['imgname']);
            return response()->json(['status' => 1, 'data' => $image]);
        } else {
            return response()->json(['status' => 0, 'data' => 'no data']);
        }
    }
}
