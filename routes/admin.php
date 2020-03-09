<?php
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::post('patient/classajax/{patient}', 'Admin\Front\PatientController@patientAjax');
    Route::resource('patient', 'Admin\Front\PatientController');
    Route::resource('payment', 'Admin\Front\PaymentController');
    Route::resource('chargecategory', 'Admin\Account\ChargeCategoryController');
    Route::resource('charge', 'Admin\Account\ChargeController');
    Route::resource('clinicalappointment', 'Admin\Front\ClinicalAppointmentController');
    Route::resource('nursing', 'Admin\Front\VitalSignController');
    Route::get('vitals/{vital}', 'Admin\Front\VitalSignController@takeVitals')->name('vitals.create');
    Route::resource('physical', 'Admin\Consult\PhysicalExamController');
    Route::resource('pc', 'Admin\Consult\PresentingComplaintController');
    Route::get('consult/{consult}', 'Admin\Consult\ConsultController@consult')->name('consult.create');
    Route::resource('followup', 'Admin\Consult\FollowUpController');
    Route::resource('consults', 'Admin\Consult\ConsultController');
    Route::resource('pharmreq', 'Admin\Consult\PharmreqController');
    Route::resource('microreq', 'Admin\Consult\MicrobiologyreqController');
    Route::resource('bloodreq', 'Admin\Consult\BloodreqController');
    Route::get('family/familyenroll/{family}', 'Admin\Front\CompanyController@familyEnroll')->name('family.enroll');
    Route::resource('family', 'Admin\Front\FamilyController');
    Route::get('company/enroll/{company}', 'Admin\Front\CompanyController@enroll')->name('company.enroll');
    Route::post('company/enrollstore', 'Admin\Front\CompanyController@enrollStore')->name('company.enrollstore');
    Route::resource('company', 'Admin\Front\CompanyController');

    Route::group(['prefix' => 'regtype'], function () {
        Route::get('/', 'Admin\Setting\RegistrationController@index');
        Route::get('/{regtype}', 'Admin\Setting\RegistrationController@edit');
        Route::post('/create', 'Admin\Setting\RegistrationController@store');
        Route::put('/update/{regtype}', 'Admin\Setting\RegistrationController@update');
        Route::delete('/destroy/{regtype}', 'Admin\Setting\RegistrationController@destroy');
    });
});
