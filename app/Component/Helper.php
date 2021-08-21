<?php
namespace App\Component;

use File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class Helper {


	public static function getUnique()
    {
        return uniqid(mt_rand());
	}

	public static function dbLeftJoin($model, $modelName){

		foreach($modelName as $modelName){
			$alias = Str::replaceFirst('sub_', '', $modelName);
			$model = $model->leftJoin($modelName.' as '.$alias, $alias.'.id', 'tbl.'.$alias.'_id');
		}
		return $model;

	}

	public static function setCreateTimestamp($formData){
		$formData['created_at'] =	Carbon::now()->format('Y-m-d H:i:s');
		$formData['updated_at'] =	Carbon::now()->format('Y-m-d H:i:s');
		return $formData;
	}

	public static function setUpdateTimestamp($formData){
		$formData['updated_at'] =	Carbon::now()->format('Y-m-d H:i:s');
		return $formData;
	}


	public static function dataForm($formData, $inputs, $ids){

		foreach($ids as $name){
            if (isset($inputs[$name])) {
                $formData->$name = $inputs[$name];
            }
		}
		return $formData;
	}

	public static function customerCheck($a, $b)
    {
		if($a != strToUpper($b)){
			abort( response('Customer Type Error', 404) );
		}
	}


}
