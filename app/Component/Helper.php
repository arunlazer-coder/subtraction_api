<?php
namespace App\Component;

use File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SEOMeta;
use DB;

class Helper {

	public static function seoTitle($controllerName='', $functionName=''){
		if($functionName == 'index'){
			$functionName = 'list';
		}
		SEOMeta::setTitle(ucFirst($controllerName).' | '.ucFirst($functionName));
	}

	public static function nullIfBlankOrZero($value){
		return trim($value)=='' || $value===0 || $value==="0" ? NULL : $value;
	}

	public static function getTmpPath($semi = true)
    {
        $__ID = date('Y-m-d');
        $path = ROOT_TMP . $__ID;
        if (!is_dir($path)) {
            File::makeDirectory($path, DEF_FILE_PERM, true, true);
        }
        if ($semi) {
            return $__ID . DS;
        }
        return $path . DS;
	}

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

	public static function getIdPath($ID, $pathPrefix, $semi=true){
		$__ID = ceil($ID/32000);
		$path = $pathPrefix.$__ID;
		if( !is_dir($path) ){
			File::makeDirectory($path, 0777, true, true);
		}
		$__ID = $__ID .DS. $ID;
		$path = $pathPrefix . $__ID ;
		if( !is_dir($path) ){
			File::makeDirectory($path, 0777, true, true);
		}
		if($semi){
			return $__ID.DS;
		}
		return $path.DS;
	}

	public static function getToken()
    {
		$code = rand(1000,10000);
        return $code;
	}

	public static function getActivationToken()
    {
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
		}
        return hash_hmac('sha256', Str::random(40), $key);
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

	public static function nullIfBlankOrZeroMultiple($formData, $ids){
		foreach($ids as $id){
			if(!isset($formData[$id])){
				$formData[$id] = Null;
			}
			$formData[$id] = Self::nullIfBlankOrZero($formData[$id]);
		}
		return $formData;
	}

	public static function nullIfBlankOrZeroApiMultiple($formData, $request, $ids){

		foreach($ids as $id){
			$formData->$id = Self::nullIfBlankOrZero($request->input($id));
		}
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

	public static function getLocationList($viewData, $modelName, $term)
	{
		if(isset($viewData['formData'][$term]) && !empty($viewData['formData'][$term])){
			$list = DB::table($modelName)->where($term, $viewData['formData'][$term])->get(['id', 'name']);

			$list =  $list->mapWithKeys(function ($item, $key) {
				return [$item->id => $item->name];
			})->toArray();

			return $list ? $list : [];
		}
		return [];
	}

}
