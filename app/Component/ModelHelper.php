<?php
namespace App\Component;
use Request;

class ModelHelper{
	
	public static function getValidatorErrors($validator, $errorAll=true){
		if(Request::segment(1) == 'api'){
			$errors = collect($validator->errors())->map(function ($messages) {
				return $messages[0];
			})->toArray();
			
			return implode(' & ', array_values($errors));
		}
		else{
			$errors = collect($validator->errors())->map(function ($messages, $messageKey) {
				return $messages[0];
			})->toArray();
			if ($errorAll) {
				$errors = ['errorAll' => SERVER_VALIDATION_ERROR_ALL] + $errors;
			}
			return $errors;
		}
	}
	
	public static function nullIfBlankOrZero($value){
		return trim($value)=='' || $value===0 || $value==="0" ? NULL : $value;
	}
	
}
