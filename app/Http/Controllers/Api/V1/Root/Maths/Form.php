<?php

namespace App\Http\Controllers\Api\V1\Root\Maths;

use App\Component\ModelHelper;
use App\Http\Controllers\ApiController;
use DB;
use File;
use Illuminate\Http\Request;
use Validator;
use App\Model\Maths as CurrentModel;
use App\Component\Helper;

class Form extends ApiController
{
    public function create(Request $request)
    {
        return $this->_form($request, 0);
    }

    private function _form(Request $request, $id)
    {
        $errors = [];

        if ($request->isMethod('post')) {
            $inputs = $request->all();
            $extraRules = [];
            $rules = array(
                'name'        => 'required',
                'type'        => 'required',
                'subType'       => 'required',
                'correct'    => 'required',
                'wrong'    => 'required',
            );

            $validator = Validator::make($inputs, $rules,  []);

            if ($validator->fails()) {
                $errors = ModelHelper::getValidatorErrors($validator);
            } else {
                $model = new CurrentModel();
                $model = Helper::dataForm($model, $inputs, ['name', 'type', 'subType', 'correct', 'wrong']);

                if ($model->save()) {
                        $msg = "data successfully added";
                    return $this->responseJsonSuccess(['message' => $msg]);
                } else {
                    $errors = ['errorAll' => "server error"];
                }
            }
        }

        return $this->responseJsonErrorList($errors);
    }
}
