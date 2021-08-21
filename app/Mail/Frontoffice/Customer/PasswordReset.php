<?php

namespace App\Mail\Frontoffice\Customer;

use App\Component\Mail;

class PasswordReset extends Mail
{
	protected $configName = 'CUSTOMER_PASSWORD_RESET';

	public function __construct($customer, $token)
	{
		parent::__construct();
		
		$customerName = trim($customer->first_name.' '.$customer->last_name);
		
		$resetUrlParams = [];
		$resetUrlParams['e'] = $customer->email;
		$resetUrlParams['t'] = $token;
		$resetUrl = implode(',', $resetUrlParams);

		$this->setData('NAME', $customerName);
		$this->setData('RESET_URL', $resetUrl);
		
		$this->toEmail = $customer->email;
		$this->toName = $customerName;
		
		\Log::info($resetUrl);
	}
}
