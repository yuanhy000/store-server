<?php

namespace App\Http\Controllers;

use App\Http\Model\ValidateModel;
use Illuminate\Http\Request;
use App\Http\Service\Pay as PayService;

class PayController extends Controller
{
    public function getPreOrder(Request $request)
    {
//        ValidateModel::IDMustBePositiveInt($request->id);
//        $pay = new PayService($request->id);
//        return $pay->pay();
        return 'ok';
    }
}
