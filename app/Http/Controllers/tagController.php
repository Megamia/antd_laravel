<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tag;
use App\Models\tag_title;

class tagController extends Controller
{
    public function itemFilterWithTag(Request $request)
    {
        $itemFilterWithTag = tag::all();
        if ($itemFilterWithTag->count() > 0) {
            return response()->json(['status' => 1, 'itemFilterWithTag' => $itemFilterWithTag]);
        } else {
            return response()->json(['status' => 0, 'itemFilterWithTag' => 'No itemFilterWithTag']);
        }
    }
    public function titleFilterWithTag(Request $request)
    {
        $data = $request->only('title_id');
        $titleFilterWithTag = tag_title::where('id', $data['title_id'])->first();
        if ($titleFilterWithTag) {
            return response()->json(['status' => 1, 'titleFilterWithTag' => $titleFilterWithTag]);
        } else {
            return response()->json(['status' => 0, 'titleFilterWithTag' => 'No titleFilterWithTag']);
        }
    }

    public function choosedTag(Request $request)
    {
        $data = $request->only('parent_id');
        $choosedTag = tag::whereIn('parent_id', explode(',', $data['parent_id']))->get();

        if ($choosedTag) {
            return response()->json(['status' => 1, 'choosedTag' => $choosedTag]);
        } else {
            return response()->json(['status' => 0, 'choosedTag' => 'No choosedTag']);
        }
    }
    public function dataTagItem(Request $request)
    {
        $data = $request->only('parent_id', 'id_item');

        $query = tag::query();

        if (isset($data['parent_id']) && !empty($data['parent_id'])) {
            $parentIds = array_filter(array_map('trim', explode(',', $data['parent_id'])));
            if (!empty($parentIds)) {
                $query->whereIn('parent_id', $parentIds);
            }
        }

        if (isset($data['id_item']) && !empty($data['id_item'])) {
            $idItems = array_filter(array_map('trim', explode(',', $data['id_item'])));
            if (!empty($idItems)) {
                $query->whereIn('id_item', $idItems);
            }
        }

        $dataTagItem = $query->get();

        if ($dataTagItem->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataTagItem' => $dataTagItem]);
        } else {
            return response()->json(['status' => 0, 'dataTagItem' => 'No dataTagItem']);
        }
    }
}
