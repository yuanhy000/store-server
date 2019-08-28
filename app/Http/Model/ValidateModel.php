<?php

namespace App\Http\Model;

use App\Exceptions\ParameterException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ValidateModel extends Model
{
    public static function IDMustBePositiveInt($id)
    {
        $result = (new self())->isPositiveInteger($id);
        if ($result) {
            return true;
        } else {
            $error = 'id必须是正整数哦';
            (new self())->throwParamsException($error);
//            throw new BannerMissException($error);
        }
    }

    public static function checkIDs($value)
    {
        if (empty($value)) {
            $error = '你没有传入ids参数哦';
            (new self())->throwParamsException($error);
        }

        $value = explode(',', $value);

        foreach ($value as $id) {
            if (!(new self())->isPositiveInteger($id)) {
                $error = '错了哦，ids参数必须是以逗号分隔的多个正整数';
                (new self())->throwParamsException($error);
            }
        }
        return true;
    }

    public static function checkCount($value)
    {
        $result = (new self())->PositiveIntegerLessThan15($value);
        if ($result) {
            return true;
        } else {
            $error = 'Count参数必须是1-15之间的正整数啦';
            (new self())->throwParamsException($error);
//            throw new BannerMissException($error);
        }
    }

    public static function checkToken(Request $request)
    {
        $value = getRequestCode($request);
        $result = (new self())->isNotNull($value);
        if ($result) {
            return true;
        } else {
            $error = '没有code还想获取Token，睡醒了吗';
            (new self())->throwParamsException($error);
        }

    }

    public static function checkAddress($value)
    {

        if (array_key_exists('uid', $value) || array_key_exists('user_id', $value)) {
            throw new ParameterException([
                'msg' => '参数中包含非法的参数名user_id或uid,操作无效'
            ]);
        }
        $data = [
            'name' => $value['name'],
            'mobile' => $value['mobile'],
            'province' => $value['province'],
            'city' => $value['city'],
            'county' => $value['county'],
            'detail' => $value['detail'],
        ];
        $checkMobile = (new self())->isMobile($data['mobile']);
        if (!$checkMobile) {
            $error = '手机号不符合规则哦';
            (new self())->throwParamsException($error);
        }
//        dd($data);
        foreach ($data as $value) {
            $result = (new self())->isNotNull($value);
            if (!$result) {
                break;
            }
        }
        if ($result) {
            return true;
        } else {
            $error = '参数必去全部填写哦';
            (new self())->throwParamsException($error);
        }

    }

    public static function checkProducts($values)
    {
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '商品参数不正确'
            ]);
        }
        if (empty($values)) {
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }

        foreach ($values as $value) {
            foreach ($value as $member) {
            }
            $result = (new self())->isPositiveInteger($member);
            if (!$result) {
                throw new ParameterException([
                    'msg' => '商品列表参数不正确'
                ]);
            }
        }
        return true;
    }

    public static function checkAppToken($user_name, $user_pass)
    {
        if (!(new self())->isNotNull($user_name)) {
            throw new ParameterException([
                'msg' => '用户名不能为空'
            ]);
        }
        if (!(new self())->isNotNull($user_pass)) {
            throw new ParameterException([
                'msg' => '密码不能为空'
            ]);
        }
        return true;
    }

    private function isPositiveInteger($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function PositiveIntegerLessThan15($value)
    {
        $result = (new self())->isPositiveInteger($value);
        if ($result) {
            if ($value <= 15) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function isNotNull($value)
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }

    public function isMobile($value)
    {
        $rule = '^1(3|4|5|6|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    private function throwParamsException($error)
    {
        $exception = new ParameterException([
            'msg' => $error
        ]);
        throw $exception;
    }
}
