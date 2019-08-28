<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/2
 * Time: 19:33
 */

namespace App\Http\Service;

use App\Exceptions\OrderException;
use App\Exceptions\ParameterException;
use App\Exceptions\TokenException;
use App\Http\Enum\OrderStatusEnum;
use App\http\model\OrderModel;
use App\Http\Service\Order as OrderService;
use App\Http\Service\Token as TokenService;
use App\WeChat\JsApiPay;
use Exception;
use Log;
use WxPayApi;
use App\WeChat\WxPayConfig;

class Pay
{
    private $orderID;
    private $orderNO;

    function __construct($orderID)
    {
        if (!$orderID) {
            throw new Exception('订单号为空，好好检查一下');
        }
        $this->orderID = $orderID;
    }

    public function pay()
    {
        $this->checkOrderValid();
        //判断商品是否还有库存
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if (!$status['pass']) {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
    }

    //想微信服务器发送预订单
    private function makeWxPreOrder($totalPrice)
    {
        $openid = TokenService::getCurrentTokenVar('openid');
        if (!$openid) {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO); //设置订单号
        $wxOrderData->SetTrade_type('JSAPI'); //设置交易类型
        $wxOrderData->SetTotal_fee($totalPrice * 100); //交易总金额，默认以分为单位
        $wxOrderData->SetBody('零食商城'); //商品描述
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url('https://www.baidu.com/'); //接受回调结果的地址
        return $this->getPaySignature($wxOrderData);
    }

    private function getPaySignature($wxOrderData)
    {
        $config = new WxPayConfig();
        $wxOrder = WxPayApi::unifiedOrder($config, $wxOrderData);
        if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS') {
            Log::channel('WeChatLog')->log('error', $wxOrder);
            Log::channel('WeChatLog')->log('error', '获取预支付订单失败');
            throw new ParameterException([
                'msg' => '获取预支付订单失败'
            ]);
        }
        $this->recordPreOrder($wxOrder);
        $jsApi = new JsApiPay();
        $jsApiParameters = $jsApi->GetJsApiParameters($wxOrder);
        return $jsApiParameters;
    }

    //记录推送微信模板消息时需要的prepay_id参数
    private function recordPreOrder($wxOrder)
    {
        OrderModel::where('id', '=', $this->orderID)->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    //检验订单是否有效
    private function checkOrderValid()
    {
        //判断订单是否存在
        $order = OrderModel::find($this->orderID);
        if (!$order) {
            throw new OrderException();
        }
        //判断用户是否是操作自己的订单，将订单中user_id与token令牌中的uid进行比较
        if (!TokenService::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        //判断该订单是否被支付
        if ($order->status != OrderStatusEnum::UNPAID) {
            throw new OrderException([
                'msg' => '您的订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }
}