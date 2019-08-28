<?php

namespace App\Http\Controllers;

use App\Exceptions\SuccessMessage;
use App\Exceptions\UserException;
use App\http\model\UserModel;
use App\Http\Model\ValidateModel;
use Illuminate\Http\Request;
use App\Http\Service\Token as TokenService;

class AddressController extends Controller
{

    public function createOrUpdateAddress(Request $request)
    {
        $result = getRequestAddress($request);
        ValidateModel::checkAddress($result);
        $uid = TokenService::getCurrentUid();
        $user = UserModel::find($uid);
        if (!$user) {
            throw new UserException();
        }
        $dataArray = $result;
        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->create($dataArray);//创建
        } else {
            $user->address()->update($dataArray);  //更新
        }
        throw new SuccessMessage();
    }

    /*创建或更新用户地址信息
    @url /address/get
    @http POST
    @token 用户的token令牌*/
    public function getAddressInfo(Request $request)
    {
        $uid = TokenService::getCurrentUid();
        $user = UserModel::find($uid);
        if (!$user) {
            throw new UserException();
        }
        $addressInfo = $user->address;
        if (!$addressInfo) {
            throw new UserException([
                'msg' => '没有用户地址信息哦',
                'errorCode' => 60001
            ]);
        } else {
            return $addressInfo;
        }
    }
}
