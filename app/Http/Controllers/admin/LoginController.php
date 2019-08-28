<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\ValidateModel;
use App\Http\Service\AppToken;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->user_name) {
            ValidateModel::checkAppToken($request->user_name, $request->user_pass);
            $appToken = new AppToken();
            $token = $appToken->get($request->user_name, $request->user_pass);
            if (!$token) {
                return back()->with('msg', '用户名或密码错误！');
            }
            dd($token);
            return view();
        }
        return view('admin.login.login');
    }
}
