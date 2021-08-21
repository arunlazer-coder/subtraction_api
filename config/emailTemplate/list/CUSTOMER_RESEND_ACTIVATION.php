<?php

return array(
    'category' => 'A2C',
    'title' => 'Resent Activation Mail',
    'email_from' => 'info@classimate.com',
    'subject' => 'Activate Your Account!!',
    'content_path' => 'frontoffice.customer.resendActivation',
    'variables' =>
    array(
        'NAME' => 'Customer Name',
        'ACTIVATION_URL' => 'Activation URL',
    ),
    'ordering' => '2',
);
