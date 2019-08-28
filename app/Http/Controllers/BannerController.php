<?php

namespace App\Http\Controllers;

use App\Exceptions\BannerMissException;
use App\Http\Model\BannerModel;
use App\Http\Model\ValidateModel;
use Illuminate\Http\Request;


class BannerController extends Controller
{
    /*获取指定id的banner信息
    @url /banner/id
    @http GET
    @id banner的id号*/
    protected function getBanner(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->id);
        $banner = BannerModel::getBannerByID($request->id);
        if (!$banner) {
            throw new BannerMissException();
        }
        return $banner;
    }

}
