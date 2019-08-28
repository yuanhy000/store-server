<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ProductException;
use App\Http\Model\ProductModel;
use App\Http\Model\ValidateModel;

class ProductController extends Controller
{
    /*
     * 获得传入的count参数
     * @url product/recent/{count?}
     * @http GET
     * */
    public function getRecent(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->end);
        $result = ProductModel::getMostRecent($request->start, $request->end);
        if (!$result) {
            throw new ProductException();
        }
        return $result;
    }

    public function getAllInCategory(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->id);
        $result = ProductModel::getProductsByCategoryID($request->id);
        if (!$result) {
            throw new ProductException();
        }
        return $result->makeHidden('summary');
    }

    public function getOne(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->id);
        $result = ProductModel::getProductDetail($request->id);
        if (!$result) {
            throw new ProductException();
        }
        return $result;
    }
}
