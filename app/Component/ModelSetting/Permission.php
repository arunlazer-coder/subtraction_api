<?php
namespace App\Component\ModelSetting;

class Permission{

	const ACCESS  = 'access';
	const SHOW 	  = 'show';
	const CREATE  = 'create';
	const EDIT 	  = 'edit';
	const DELETE  = 'delete';
	
	public static $permissionList = array(
		self::ACCESS	=> 0,
		self::SHOW	    => 1,
		self::CREATE	=> 2,
		self::EDIT	    => 3,
		self::DELETE	=> 4,
	);
}
