<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 21:21
 */

namespace App;


use Illuminate\Http\Request;
use App\Rules\isPositiveInteger;

class IDMustBePositiveInt
{
    public function IDMustBePositiveInt(Request $request)
    {
        $this->validate($request, [
            $this->id => [new isPositiveInteger],
        ]);
    }
    protected $rule = [
    'id' => 'isPositiveInteger'
];
    protected $message = [
        'id.isPositiveInteger' => 'id不是正整数！',
    ];

    protected function isPositiveInteger($value, $rule = '', $data = '', $filed = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return $filed . '必须是正整数';
        }
    }


}