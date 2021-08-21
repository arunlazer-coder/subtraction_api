<?php

return array(
  'category' => 'A2C',
  'title' => 'Customer Forgot Password',
  'email_from' => 'info@classimate.com',
  'subject' => 'Reset Your Password',
  'content_path' => 'frontoffice.customer.passwordReset',
  'variables' =>
  array(
    'NAME' => 'Customer Name',
    'RESET_URL' => 'Password Reset URL',
  ),
  'ordering' => '4',
);
