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
            return response()->json(['status' => 0, 'message' => 'No data']);
        }
    }

    public function chooseUserOrder(Request $request)
    {
        $data = $request->only('id');
        if ($data['id'] === 'guest') {
            $request->session()->put('user_id', 'guest');
            $request->session()->put('user_id_expires_at', now()->addHours(1)); //addSeconds, addMinutes
            return response()->json(['status' => 1, 'dataUserOrder' => 'Khách lẻ']);
        } else {
            $dataUser = inforUserOrder::where('id', $data['id'])->first();
            if ($dataUser) {
                $request->session()->put('user_id', $data['id']);
                $request->session()->put('user_id_expires_at', now()->addHours(1));
                return response()->json(['status' => 1, 'dataUserOrder' => $dataUser]);
            } else {
                return response()->json(['status' => 0, 'message' => 'no data user']);
            }
        }
    }
    public function dataUserOrder(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $user_id_expires_at = $request->session()->get('user_id_expires_at');

        if ($user_id && $user_id_expires_at && now()->lessThanOrEqualTo($user_id_expires_at)) {
            if ($user_id === 'guest') {
                return response()->json(['status' => 1, 'dataUserOrder' => 'guest']);
            } else {
                $dataUser = inforUserOrder::where('id', $user_id)->first();
                return response()->json(['status' => 1, 'dataUserOrder' => $dataUser]);
            }
        } else {
            $request->session()->forget('user_id');
            $request->session()->forget('user_id_expires_at');
            return response()->json(['status' => 0, 'message' => 'no data user or session expired']);
        }
    }

    public function deleteSession(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('user_id_expires_at');
        return response()->json(['status' => 1, 'message' => 'Success']);
    }


    public function addUserOrder(Request $request)
    {
        $data = $request->only([
            'username',
            'phoneNumber',
            'email'
        ]);
        if (is_null($data['email'])) {
            $data['email'] = 'example@gmail.com';
        }
        $existingUser = inforUserOrder::where('phoneNumber', $data['phoneNumber'])->first();
        if ($existingUser) {
            return response()->json(['status' => 0, 'message' => 'User already exists']);
        }
        $users = inforUserOrder::create([
            'name' => $data['username'],
            'phoneNumber' => $data['phoneNumber'],
            'email' => $data['email'],
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'User has been add to inforUserOrder', 'data' => $users
        ]);
    }
    public function inforUserCRM(Request $request)
    {
        $data = InforUserOrder::all();
        $inforUserCRM = [];

        foreach ($data as $record) {
            if (isset($record->isUserCRM) && $record->isUserCRM === 1) {
                $inforUserCRM[] = $record; 
            }
        }

        if (!empty($inforUserCRM)) {
            return response()->json(['status' => 1, 'inforUserCRM' => $inforUserCRM]);
        } else {
            return response()->json(['status' => 0, 'inforUserCRM' => "No inforUserCRM"]);
        }
    }
}
