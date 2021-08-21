<?php

namespace App\Mail\Frontoffice\Customer;

use App\Component\Mail;

class RegisterSuccess extends Mail
{
    protected $configName = 'CUSTOMER_REGISTER';

    public function __construct($customer, $token)
    {
        parent::__construct();

        $customerName = trim($customer->first_name . ' ' . $customer->last_name);

        $activationUrlParams = [];
        $activationUrlParams['e'] = $customer->email;
        $activationUrlParams['t'] = $token;
        $activationUrl = route('api.v1.customer.auth.activate', $activationUrlParams);

        $this->setData('NAME', $customerName);
        $this->setData('ACTIVATION_URL', $activationUrl);

        $this->toEmail = $customer->email;
        $this->toName = $customerName;
        \Log::info($activationUrl);
    }
}
