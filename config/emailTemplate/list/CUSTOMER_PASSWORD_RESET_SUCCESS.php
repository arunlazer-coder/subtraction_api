<?php

return array(
  'category' => 'A2C',
  'title' => 'After Customer Reset Password',
  'email_from' => 'info@classimate.com',
  'subject' => 'You have reset your password',
  'content_path' => 'frontoffice.customer.passwordResetSuccess',
  'variables' =>
  array(
    'NAME' => 'Customer Name',
  ),
  'ordering' => '5',
);
