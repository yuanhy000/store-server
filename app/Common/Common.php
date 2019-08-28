<?php
/*
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/24
 * Time: 13:35
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


function curl_get($url, &$httpCode = '0')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $file_contents;
}

function getRequestCode(Request $request)
{
    $data = $request->getContent();
    $data = json_decode($data);
    $value = $data->code;
    return $value;
}
function getRequestAddress(Request $request)
{
//    $result = Input::all();
    $data = $request->getContent();
    $data = json_decode($data,true);
    return $data;
}

function getRandChar($length)
{
    $str = null;
    $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}