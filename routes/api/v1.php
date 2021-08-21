<?php

//Public
Route::group(['namespace' => 'Root' ], function () {
    Route::get('/maths', 'Maths\Listing')   ->name('maths.list');
    Route::post   ('/maths',       'Maths\Form@create')    ->name('maths.form.create');
});
