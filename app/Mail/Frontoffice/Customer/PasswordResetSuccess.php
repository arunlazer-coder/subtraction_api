<?php

namespace App\Mail\Frontoffice\Customer;

use App\Component\Mail;

class PasswordResetSuccess extends Mail
{
	protected $configName = 'CUSTOMER_PASSWORD_RESET_SUCCESS';

	public function __construct($customer)
	{
		parent::__construct();

		$customerName = trim($customer->first_name.' '.$customer->last_name);

		$this->setData('NAME', $customerName);
		
		$this->toEmail = $customer->email;
		$this->toName = $customerName;
	}
}
