<?php
namespace App\Component\ModelSetting;

class Customer{

	const TRANSPORTER = 't';
	const LOADER 	  = 'l';
	
	public static $typeList = array(
		self::TRANSPORTER	=> 'Transporter',
		self::LOADER		=> 'Loader',
		't'					=> 'T',
		'l'					=> 'L'
	);
	
	const STATUS_ACTIVE			= '1';
	const STATUS_INACTIVE		= '0';
		
	public static $statusList = [
		self::STATUS_ACTIVE		=> 'Active',
		self::STATUS_INACTIVE	=> 'InActive',
	];

	const HEAVY = 'Heavy';
	const LIGHT = 'Light';
	
	public static $licenseTypeList = array(
		self::HEAVY	=> 'Heavy',
		self::LIGHT		=> 'Light',
	);
	
	const REJECTED		= 0;
	const ACCEPTED		= 1;
	const PROCESSING	= 2;
	const COMPLETED		= 3;
		
	public static $bookingStatusList = [
		self::REJECTED		=> 'Rejected',
		self::ACCEPTED		=> 'Accepted',
		self::PROCESSING	=> 'Processing',
		self::COMPLETED		=> 'Completed',
	];
}
