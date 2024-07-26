<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCRM;

class UserCRMController extends Controller
{
    public function inforUserCRM(Request $request)
    {
        $inforUserCRM = UserCRM::all();
        if ($inforUserCRM->count() > 0) {
            return response()->json(['status' => 1, 'inforUserCRM' => $inforUserCRM]);
        } else {
            return response()->json(['status' => 0, 'inforUserCRM' => 'No inforUserCRM']);
        }
    }
}
