<?php

namespace App\Http\Controllers;

use App\Exceptions\ThemeException;
use App\Http\Model\ThemeModel;
use App\Http\Model\ValidateModel;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /*
     * @url /theme?ids=id1,id2,id3...
     * @.return  一组theme模型
     * */
    public function getSimpleList(Request $request)
    {
        ValidateModel::checkIDs($request->ids);
        $ids = explode(',', $request->ids);
        $result = ThemeModel::getThemeByIDs($ids);
        if ($result->isEmpty()) {
            throw new ThemeException();
        }
        return $result;
    }

    /*
     * @url /theme/{id}
     * */
    public function getComplexOne(Request $request)
    {
        ValidateModel::IDMustBePositiveInt($request->id);
        $result = ThemeModel::getThemeWithProducts($request->id);
        if (!$result){
            throw new ThemeException();
        }
        return $result;
    }
}
