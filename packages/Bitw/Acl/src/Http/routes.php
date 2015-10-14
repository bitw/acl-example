<?php

Route::group(['namespace' => 'Bitw\Acl\Http\Controllers'], function () {
	Route::resource('acl', 'AclController', array(
		'except' => array('show'))
	);
});