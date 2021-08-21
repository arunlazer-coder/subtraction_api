<?php
namespace App\Component\ModelSetting;

use App\Component\Helper as HelperComponent;
use App\Model\Activation as ActivationModel;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;

class Activation{
	public static function create($params, $cb){

		$token = HelperComponent::getActivationToken();
		
		DB::table(ActivationModel::TN)->where('user', $params['user'])->where($params['user'].'_id', $params['user_id'])->delete();
		
		$model = new ActivationModel();
		
		$model->token					= Hash::make($token);
		$model->user					= $params['user'];
		$model->{$params['user'].'_id'}	= $params['user_id'];
		$model->created_at				= new Carbon;
			
		$model->save();
			
		$cb($token);
	}

	public static function check($params){
		
		$model = DB::table(ActivationModel::TN)->where('user', $params['user'])->where($params['user'].'_id', $params['user_id'])->first();
		
		return $model && $model->token == Hash::check($params['token'], $model->token);
	}

	public static function delete($params){
		$model = DB::table(ActivationModel::TN)->where('user', $params['user'])->where($params['user'].'_id', $params['user_id'])->delete();
	}
}
