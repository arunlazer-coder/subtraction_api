<?php

namespace App\Http\Controllers\maths;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Model\Maths as CurrentModel;
use Validator;
use App\Component\Helper;
use App\Component\ModelHelper;

class Create extends ApiController
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
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
                'max'       => 'required'
            );

            $validator = Validator::make($inputs, $rules,  []);

            if ($validator->fails()) {
                $errors = ModelHelper::getValidatorErrors($validator);
            } else {
                $model = new CurrentModel();
                $model = Helper::dataForm($model, $inputs, ['name', 'type', 'subType', 'max', 'correct', 'wrong']);

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
