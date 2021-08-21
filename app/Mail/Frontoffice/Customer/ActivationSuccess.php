<?php

namespace App\Mail\Frontoffice\Customer;

use App\Component\Mail;

class ActivationSuccess extends Mail
{
    protected $configName = 'CUSTOMER_ACTIVATE';

    public function __construct($customer)
    {
        parent::__construct();

        $customerName = trim($customer->first_name . ' ' . $customer->last_name);

        $this->setData('NAME', $customerName);

        $this->toEmail = $customer->email;
        $this->toName = $customerName;
    }
}
