<?php

namespace App\Http\Controllers;

use App\Exceptions\ParameterException;
use App\Http\Model\ValidateModel;
use App\Http\Service\AppToken;
use App\Http\Service\Token as TokenService;
use App\Http\Service\UserToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /*
     * 获得传入的code信息
     * @url /token/user   传入json形式code
     * @http POST
     * */
    public function getToken(Request $request)
    {
        ValidateModel::checkToken($request);
        $code = getRequestCode($request);
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token
        ];
    }

    public function getAppToken(Request $request)
    {
        ValidateModel::checkAppToken($request->user_name, $request->user_pass);
        $appToken = new AppToken();
        $token = $appToken->get($request->user_name, $request->user_pass);
        return [
            'token' => $token
        ];
    }

    public function checkToken(Request $request)
    {
        if (!$request->token) {
            throw new ParameterException([
                'token不允许为空哦'
            ]);
        }
        $result = TokenService::checkToken($request->token);
        return [
            'result' => $result
        ];
    }


}
