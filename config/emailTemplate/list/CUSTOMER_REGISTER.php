<?php

return array(
    'category' => 'A2C',
    'title' => 'After Customer Registration',
    'email_from' => 'info@classimate.com',
    'subject' => 'Activate Your Account!!',
    'content_path' => 'frontoffice.customer.registerSuccess',
    'variables' =>
    array(
        'NAME' => 'Customer Name',
        'ACTIVATION_URL' => 'Activation URL',
    ),
    'ordering' => '1',
);
