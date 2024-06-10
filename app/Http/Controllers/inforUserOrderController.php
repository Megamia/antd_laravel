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
            return $users;
        } else {
            return response()->json(['message' => 'No data'], 404);
        }
    }

    public function addUserOder(Request $request)
    {
        $data = $request->only([
            'name',
            'phoneNumber',
            'email',
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
            return response()->json(['message' => 'User already exists'], 201);
        }
        $users = InforUserOrder::create([
            'name' => $data['name'],
            'phoneNumber' => $data['phoneNumber'],
            'email' => $data['email'],
            'permission' => $data['permission']
        ]);

        return response()->json([
            'message' => 'User has been add to DashBoard', 'data' => $users
        ], 200);
    }
}
