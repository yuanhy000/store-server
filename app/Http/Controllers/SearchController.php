<?php

namespace App\Http\Controllers;

use App\Http\Model\ProductModel;
use App\Http\Model\ValidateModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getProduct(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->page);
        ValidateModel::IDMustBePositiveInt($request->size);
        $result = ProductModel::getProductBySearch($request->page, $request->size, $request->name);

        if (empty($result)) {
            return [
                'current_page' => $request->page,
                'data' => []
            ];
        }
        return [
            'current_page' => $request->page,
            'data' => $result
        ];
    }
}
