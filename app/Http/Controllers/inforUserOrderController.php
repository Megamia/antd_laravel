<?php

namespace App\Http\Controllers;

use App\Models\InforUserOrder;
use Illuminate\Http\Request;

class InforUserOrderController extends Controller
{
    public function data(Request $request)
    {
        $users = InforUserOrder::all();
        if ($users->isNotEmpty()) {
            return response()->json(['status' => 1, 'dataUser' => $users]);
        } else {
            return response()->json(['message' => 'No data'], 404);
        }
    }

    public function dataUserOrder(Request $request)
    {
        $data = $request->only('id');
        if($data['id']==='guest'){
            return response()->json(['status' => 1, 'dataUserOrder' => 'Khách lẻ']);
        }else{
            $dataUser = InforUserOrder::where('id', $data['id'])->first();
            if ($dataUser) {
                return response()->json(['status' => 1, 'dataUserOrder' => $dataUser]);
            } else {
                return response()->json(['status' => 0, 'messsage' => 'no data user']);
            }
        }
    }

    public function addUserOder(Request $request)
    {
        $data = $request->only([
            'username',
            'phoneNumber',
            'email'
            // 'text',
            // 'number',
            // 'date',
            // 'dropDown',
            // 'checkBox',
            // 'address',
            // 'email2'
        ]);
        $existingUser = InforUserOrder::where('email', $data['email'])->first();
        if ($existingUser) {
            return response()->json(['status' => 0, 'message' => 'User already exists']);
        }
        $users = InforUserOrder::create([
            'name' => $data['username'],
            'phoneNumber' => $data['phoneNumber'],
            'email' => $data['email'],
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'User has been add to inforUserOrder', 'data' => $users
        ]);
    }
}
