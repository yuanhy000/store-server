<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use App\http\model\OrderModel;
use App\Http\Model\ValidateModel;
use App\Http\Service\Order as OrderService;
use App\Http\Service\Token;
use Illuminate\Http\Request;
use App\Http\Service\Token as TokenService;

class OrderController extends Controller
{
    //进行下单操作
    public function placeOrder(Request $request)
    {
        //检查请求参数的商品信息
        ValidateModel::checkProducts($request->products);
        $products = $request->products;
        //凭借用户携带的Token令牌获得用户的id
        $uid = TokenService::getCurrentUid();
        $order = new OrderService();
        //进行下单
        $status = $order->place($uid, $products);
        return $status;
    }

    //获得用户的详细订单信息
    public function getOrderInfo(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->id);
        $orderInfo = OrderModel::find($request->id)->makeHidden('prepay_id');
        if (!$orderInfo) {
            throw new OrderException();
        } else {
            return $orderInfo;
        }
    }

    //获得该用户的全部订单信息，用于用户页面展示信息
    public function getOrderList(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->page);
        ValidateModel::IDMustBePositiveInt($request->size);
        $uid = Token::getCurrentUid();
        //分页返回信息
        $orderList = OrderModel::getOrderList($uid, $request->page, $request->size);
        if (empty($orderList)) {
            return [
                'current_page' => $request->page,
                'data' => []
            ];
        }
        return [
            'current_page' => $request->page,
            'data' => $orderList
        ];
    }

    //获得全部用户的所有订单信息，由于后台统计
    public function getAllOrder(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->page);
        ValidateModel::IDMustBePositiveInt($request->size);
        //分页返回信息
        $allOrder = OrderModel::getAllOrder($request->page, $request->size);
        if (empty($allOrder)) {
            return [
                'current_page' => $request->page,
                'data' => []
            ];
        }
        return [
            'current_page' => $request->page,
            'data' => $allOrder
        ];
    }
}

