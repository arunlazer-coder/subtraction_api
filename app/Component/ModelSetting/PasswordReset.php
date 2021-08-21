<?php

namespace App\Component\ModelSetting;

use App\Component\Helper as HelperComponent;
use App\Model\PasswordReset as PasswordResetModel;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;

class PasswordReset
{
	public static $expires = 36000;

	public static function create($params, $cb)
	{
		$token = HelperComponent::getToken();
		
		DB::table(PasswordResetModel::TN)->where('user', $params['user'])->where($params['user'] . '_id', $params['user_id'])->delete();

		$model = new PasswordResetModel();

		$model->token						= Hash::make($token);
		$model->user						= $params['user'];
		$model->{$params['user'] . '_id'}	= $params['user_id'];
		$model->created_at					= new Carbon;

		$model->save();

		$cb($token);
	}
	
	public static function check($params)
	{
		$model = DB::table(PasswordResetModel::TN)->where('user', $params['user'])->where($params['user'] . '_id', $params['user_id'])->first();

		return $model && !self::tokenExpired($model->created_at) && $model->token == Hash::check($params['token'], $model->token);
	}

	public static function delete($params)
	{
		$model = DB::table(PasswordResetModel::TN)->where('user', $params['user'])->where($params['user'] . '_id', $params['user_id'])->delete();
	}
	
	public static function tokenExpired($createdAt)
	{
		return Carbon::parse($createdAt)->addSeconds(self::$expires)->isPast();
	}
}
