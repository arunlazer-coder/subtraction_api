<?php
 
define('ROOT_PUBLIC', base_path().DS);
define('URL_PUBLIC', rtrim(Request::getBaseUrl(), '/').'/');

define('SITE_NAME',     'Logitruck');
define('URL_SITE',          'logitruck.com');
define('URL_SITE_HTTP',     'http://www.'.URL_SITE.'/');

define('ROOT_TMP', ROOT_PUBLIC.'public/storage/temp/'.DS);
define('URL_TMP', URL_PUBLIC.'storage/temp/');

define('ROOT_VEHICLE_TYPE', ROOT_PUBLIC.'public/storage/vehicle-type/'.DS);
define('URL_VEHICLE_TYPE', URL_PUBLIC.'storage/vehicle-type/');

define('ROOT_CUSTOMER', ROOT_PUBLIC.'public/storage/customer/'.DS);
define('URL_CUSTOMER', URL_PUBLIC.'storage/customer/');


define('ROOT_RC_BOOK', ROOT_PUBLIC.'public/storage/rc-book/'.DS);
define('URL_RC_BOOK', URL_PUBLIC.'storage/rc-book/');

define('ROOT_INSURANCE', ROOT_PUBLIC.'public/storage/insurance/'.DS);
define('URL_INSURANCE', URL_PUBLIC.'storage/insurance/');

define('ROOT_POLLUTION', ROOT_PUBLIC.'public/storage/pollution/'.DS);
define('URL_POLLUTION', URL_PUBLIC.'storage/pollution/');

define('ROOT_VEHICLE', ROOT_PUBLIC.'public/storage/vehicle/'.DS);
define('URL_VEHICLE', URL_PUBLIC.'storage/vehicle/');

define('ROOT_DRIVER', ROOT_PUBLIC.'public/storage/driver/'.DS);
define('URL_DRIVER', URL_PUBLIC.'storage/driver/');

define('ROOT_LICENSE_COPY', ROOT_PUBLIC.'public/storage/license-copy/'.DS);
define('URL_LICENSE_COPY', URL_PUBLIC.'storage/license-copy/');

define('ROOT_NATIONAL_ID', ROOT_PUBLIC.'public/storage/national-id/'.DS);
define('URL_NATIONAL_ID', URL_PUBLIC.'storage/national-id/');

define('SERVER_VALIDATION_ERROR_ALL', 'Please check the following errors!');

define('SHIPMENT', 'SHIP');
define('TRIP', 'TRIP');
define('WEIGHT_UNIT', 'ton');

define('IMAGE', 'img');
define('FILE', 'file');

define('DEF_FILE_PERM', 0777);
