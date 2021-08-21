<?php
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return redirect('/login');
// });

Route::get('/home', function () {
    return redirect('/admin');
});

Route::post('imageUpload', 'Admin\ImageUploadController@index')->name('imageUpload');
Route::post('fileUpload', 'Admin\FileUploadController@index')->name('fileUpload');

Route::post('ajax/toggle/status/', 'Admin\Ajax\ToggleStatus@index')->name('ajax.jsonToggleStatus');

Route::get('ajax/state', 'Admin\Ajax\GetStateData@index')->name('ajax.jsonState');
Route::get('ajax/district', 'Admin\Ajax\GetDistrictData@index')->name('ajax.jsonDistrict');
Route::get('ajax/city', 'Admin\Ajax\GetCityData@index')->name('ajax.jsonCity');
Route::get('ajax/area', 'Admin\Ajax\GetAreaData@index')->name('ajax.jsonArea');
Route::get('ajax/country-city', 'Admin\Ajax\GetCountryCityData@index')->name('ajax.jsonCountryCity');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::delete('permission/destroy', 'PermissionController@massDestroy')->name('permission.massDestroy');
    Route::resource('permission', 'PermissionController');

    Route::delete('role/destroy', 'RoleController@massDestroy')->name('role.massDestroy');
    Route::resource('role', 'RoleController');

    Route::delete('user/destroy', 'UserController@massDestroy')->name('user.massDestroy');
    Route::resource('user', 'UserController');

    Route::get    ('area',             'AreaController@index')->name('area.index');
    Route::any    ('area/create',      'AreaController@create')->name('area.create');
    Route::any    ('area/edit/{id}',   'AreaController@edit')->name('area.edit');
    Route::get    ('area/show/{id}',   'AreaController@show')->name('area.show');
    Route::delete ('area/delete/{id}', 'AreaController@delete')->name('area.delete');
    Route::delete ('area/destroy',     'AreaController@massDestroy')->name('area.massDestroy');

    Route::get    ('city',             'CityController@index')->name('city.index');
    Route::any    ('city/create',      'CityController@create')->name('city.create');
    Route::any    ('city/edit/{id}',   'CityController@edit')->name('city.edit');
    Route::get    ('city/show/{id}',   'CityController@show')->name('city.show');
    Route::delete ('city/delete/{id}', 'CityController@delete')->name('city.delete');
    Route::delete ('city/destroy',     'CityController@massDestroy')->name('city.massDestroy');

    Route::get    ('{type}/customer',                     'CustomerController@index')->name('customer.index')->where('type','t|l');
    Route::any    ('{type}/customer/create',     'CustomerController@create')->name('customer.create')->where('type','t|l');
    Route::any    ('{type}/customer/edit/{id}',  'CustomerController@edit')->name('customer.edit')->where('type','t|l');
    Route::get    ('customer/{type}/show/{id}',           'CustomerController@show')->name('customer.show')->where('type','t|l');
    Route::delete ('customer/delete/{id}',         'CustomerController@delete')->name('customer.delete');
    Route::delete ('customer/destroy',              'CustomerController@massDestroy')->name('customer.massDestroy');

    Route::get    ('country',             'CountryController@index')->name('country.index');
    Route::get    ('country/create',      'CountryController@create')->name('country.create');
    Route::post   ('country/create',      'CountryController@create')->name('country.create');
    Route::get    ('country/edit/{id}',   'CountryController@edit')->name('country.edit');
    Route::put    ('country/edit/{id}',   'CountryController@edit')->name('country.edit');
    Route::get    ('country/show/{id}',   'CountryController@show')->name('country.show');
    Route::delete ('country/delete/{id}', 'CountryController@delete')->name('country.delete');
    Route::delete ('country/destroy',     'CountryController@massDestroy')->name('country.massDestroy');

    Route::get    ('driver',             'DriverController@index')->name('driver.index');
    Route::any    ('driver/create',      'DriverController@create')->name('driver.create');
    Route::any    ('driver/edit/{id}',   'DriverController@edit')->name('driver.edit');
    Route::get    ('driver/show/{id}',   'DriverController@show')->name('driver.show');
    Route::delete ('driver/delete/{id}', 'DriverController@delete')->name('driver.delete');
    Route::delete ('driver/destroy',     'DriverController@massDestroy')->name('driver.massDestroy');

    Route::get    ('district',             'DistrictController@index')->name('district.index');
    Route::any    ('district/create',      'DistrictController@create')->name('district.create');
    Route::any    ('district/edit/{id}',   'DistrictController@edit')->name('district.edit');
    Route::get    ('district/show/{id}',   'DistrictController@show')->name('district.show');
    Route::delete ('district/delete/{id}', 'DistrictController@delete')->name('district.delete');
    Route::delete ('district/destroy',     'DistrictController@massDestroy')->name('district.massDestroy');

    Route::get    ('load',             'LoadController@index')->name('load.index');
    Route::any    ('load/create',      'LoadController@create')->name('load.create');
    Route::any    ('load/edit/{id}',   'LoadController@edit')->name('load.edit');
    Route::get    ('load/show/{id}',   'LoadController@show')->name('load.show');
    Route::delete ('load/delete/{id}', 'LoadController@delete')->name('load.delete');
    Route::delete ('load/destroy',     'LoadController@massDestroy')->name('load.massDestroy');

    Route::get    ('load-booking',             'LoadBookingController@index')->name('loadBooking.index');
    Route::get    ('load-booking/show/{id}',   'LoadBookingController@show')->name('loadBooking.show');
    Route::delete ('load-booking/delete/{id}', 'LoadBookingController@delete')->name('loadBooking.delete');
    Route::delete ('load-booking/destroy',     'LoadBookingController@massDestroy')->name('loadBooking.massDestroy');

    Route::get    ('products',             'ProductController@index')->name('product.index');
    Route::get    ('products/create',      'ProductController@create')->name('product.create');
    Route::post   ('products/create',      'ProductController@create')->name('product.create');
    Route::get    ('products/edit/{id}',   'ProductController@edit')->name('product.edit');
    Route::put    ('products/edit/{id}',   'ProductController@edit')->name('product.edit');
    Route::get    ('products/show/{id}',   'ProductController@show')->name('product.show');
    Route::delete ('products/delete/{id}', 'ProductController@delete')->name('product.delete');
    Route::delete ('products/destroy',     'ProductController@massDestroy')->name('product.massDestroy');

    Route::match  (['get', 'post', 'put'], 'preference/',  'PreferenceController@index')->name('preference.index');

    Route::get    ('page',             'PageController@index')->name('page.index');
    Route::any    ('page/create',      'PageController@create')->name('page.create');
    Route::any    ('page/edit/{id}',   'PageController@edit')->name('page.edit');
    Route::get    ('page/show/{id}',   'PageController@show')->name('page.show');
    Route::delete ('page/delete/{id}', 'PageController@delete')->name('page.delete');
    Route::delete ('page/destroy',     'PageController@massDestroy')->name('page.massDestroy');

    Route::get    ('state',             'StateController@index')->name('state.index');
    Route::any    ('state/create',      'StateController@create')->name('state.create');
    Route::any    ('state/edit/{id}',   'StateController@edit')->name('state.edit');
    Route::get    ('state/show/{id}',   'StateController@show')->name('state.show');
    Route::delete ('state/delete/{id}', 'StateController@delete')->name('state.delete');
    Route::delete ('state/destroy',     'StateController@massDestroy')->name('state.massDestroy');

    Route::get    ('trip',              'TripController@index')->name('trip.index');
    Route::any    ('trip/create',      'TripController@create')->name('trip.create');
    Route::any    ('trip/edit/{id}',   'TripController@edit')->name('trip.edit');
    Route::get    ('trip/show/{id}',   'TripController@show')->name('trip.show');
    Route::delete ('trip/delete/{id}', 'TripController@delete')->name('trip.delete');
    Route::delete ('trip/destroy',     'TripController@massDestroy')->name('trip.massDestroy');

    Route::get    ('trip-booking',             'TripBookingController@index')->name('tripBooking.index');
    Route::get    ('trip-booking/show/{id}',   'TripBookingController@show')->name('tripBooking.show');
    Route::delete ('trip-booking/delete/{id}', 'TripBookingController@delete')->name('tripBooking.delete');
    Route::delete ('trip-booking/destroy',     'TripBookingController@massDestroy')->name('tripBooking.massDestroy');

    Route::get    ('vehicle',             'VehicleController@index')->name('vehicle.index');
    Route::any    ('vehicle/create',     'VehicleController@create')->name('vehicle.create');
    Route::any    ('vehicle/edit/{id}',  'VehicleController@edit')->name('vehicle.edit');
    Route::get    ('vehicle/show/{id}',   'VehicleController@show')->name('vehicle.show');
    Route::delete ('vehicle/delete/{id}', 'VehicleController@delete')->name('vehicle.delete');
    Route::delete ('vehicle/destroy',     'VehicleController@massDestroy')->name('vehicle.massDestroy');

    Route::get    ('vehicle-type',             'VehicleTypeController@index')->name('vehicleType.index');
    Route::any    ('vehicle-type/create',     'VehicleTypeController@create')->name('vehicleType.create');
    Route::any    ('vehicle-type/edit/{id}',  'VehicleTypeController@edit')->name('vehicleType.edit');
    Route::get    ('vehicle-type/show/{id}',   'VehicleTypeController@show')->name('vehicleType.show');
    Route::delete ('vehicle-type/delete/{id}', 'VehicleTypeController@delete')->name('vehicleType.delete');
    Route::delete ('vehicle-type/destroy',     'VehicleTypeController@massDestroy')->name('vehicleType.massDestroy');

});
