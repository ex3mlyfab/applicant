<?php
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('patient/classajax/{patient}', 'Admin\Front\PatientController@patientAjax');
        Route::get('balance', 'Admin\Account\PaymentController@balance')->name('balance');
        Route::get('filterpayments', 'Admin\Account\PaymentController@filter')->name('filter.payment');
        Route::post('filterpayments', 'Admin\Account\PaymentController@filtersearch')->name('filterpayment.search');
        Route::resource('patient', 'Admin\Front\PatientController');
        Route::get('payment/settle/{invoice}', 'Admin\Account\PaymentController@settleInvoice')->name('payment.settle');
        Route::get('payment/printinvoice/{invoice}', 'Admin\Account\PaymentController@printInvoice')->name('payment.invoice');
        Route::get('payment/printreceipt/{payment}', 'Admin\Account\PaymentController@printReceipt')->name('payment.print');
        Route::post('payment/pay', 'Admin\Account\PaymentController@pay')->name('payment.pay');
        /**
         * Inpatient Routes
         */
        Route::get('wardround/{inpatient}', 'Admin\Inpatient\InpatientController@wardRound')->name('wardround');
        Route::resource('admitpatient', 'Admin\Inpatient\AdmitController');
        Route::resource('inpatient', 'Admin\Inpatient\InpatientController');
        Route::get('wardmodelajax/{ward}', 'Admin\Setting\WardModelController@wardmodelajax');
        Route::resource('tca', 'Admin\Consult\TCAController');
        Route::resource('floor', 'Admin\Setting\FloorController')->middleware('permission:floor-view');
        Route::resource('bedtype', 'Admin\Setting\BedTypeController')->middleware('permission:bedtype-view');
        Route::resource('bed', 'Admin\Setting\BedController')->middleware('permission:bed-view');
        Route::resource('ward', 'Admin\Setting\WardModelController')->middleware('permission:ward-view');
        Route::resource('payment', 'Admin\Account\PaymentController')->middleware('permission:payment-view');
        Route::resource('invoice', 'Admin\Account\InvoiceController');
        Route::resource('expense', 'Admin\Account\ExpenseController');
        Route::resource('expensehead', 'Admin\Account\ExpenseHeadController');
        Route::resource('chargecategory', 'Admin\Account\ChargeCategoryController');
        Route::resource('charge', 'Admin\Account\ChargeController')->middleware('permission:charge-view');
        Route::resource('clinicalappointment', 'Admin\Front\ClinicalAppointmentController')->middleware('permission:appointment-view');
        Route::resource('nursing', 'Admin\Front\VitalSignController')->middleware('permission:nursing-view');
        Route::get('chart/{id}', 'Admin\Front\VitalSignController@vitals');
        Route::get('vitals/{vital}', 'Admin\Front\VitalSignController@takeVitals')->name('vitals.create');
        Route::resource('physical', 'Admin\Consult\PhysicalExamController');
        Route::resource('pc', 'Admin\Consult\PresentingComplaintController');
        Route::get('consult/{consult}', 'Admin\Consult\ConsultController@consult')->middleware('permission:consult-view')->name('consult.create');

        Route::post('pharmacy/calculate-drugs', 'Admin\Pharmacy\PharmacyController@prepare')->name('pharmacy.cost');
        Route::post('pharmacy/billdrug', 'Admin\Pharmacy\PharmacyController@billdrug')->name('pharmacy.billdrug');
        Route::get('pharmacy/dispensedrug/{pharmreq}', 'Admin\Pharmacy\PharmacyController@dispensedrug')->name('pharmacy.dispensedrug');
        Route::post('pharmacy/confirmdispense', 'Admin\Pharmacy\PharmacyController@confirmdispense')->name('pharmacy.confirmdispense');
        Route::resource('pharmbill', 'Admin\Pharmacy\PharmacyBillController');
        Route::resource('followup', 'Admin\Consult\FollowUpController');
        Route::resource('consults', 'Admin\Consult\ConsultController');
        Route::post('consult/pharmreq/create', 'Admin\Consult\PharmreqController@ajaxdrug');
        Route::resource('pharmreq', 'Admin\Consult\PharmreqController');
        Route::resource('microreq', 'Admin\Consult\MicrobiologyreqController');
        Route::resource('bloodreq', 'Admin\Consult\BloodreqController');
        Route::resource('radiologyreq', 'Admin\Consult\RadiologyreqController');
        Route::resource('ultrasoundreq', 'Admin\Consult\UltrasoundreqController');

        Route::resource('haematologyreq', 'Admin\Consult\HaematologyReqController');
        Route::resource('pathologyreq', 'Admin\Consult\PathologyController');
        Route::resource('histopathologyreq', 'Admin\Consult\HistopathologyReController');

        Route::get('family/familyenroll/{family}', 'Admin\Front\FamilyController@familyEnroll')->name('family.enroll');
        Route::resource('family', 'Admin\Front\FamilyController')->middleware('permission:family-view');
        Route::get('company/enroll/{company}', 'Admin\Front\CompanyController@enroll')->name('company.enroll');
        Route::post('company/enrollstore', 'Admin\Front\CompanyController@enrollStore')->name('company.enrollstore');
        Route::resource('company', 'Admin\Front\CompanyController')->middleware('permission:company-view');
        Route::post('role/assignpermission/{role}', 'Admin\Setting\RoleController@assign')->name('role.assignpermission');
        Route::resource('role', 'Admin\Setting\RoleController')->middleware('permission:role-view');
        Route::resource('permission', 'Admin\Setting\PermissionController')->middleware('permission:permission-view');
        Route::get('drug/drugajax/{drug}', 'Admin\Pharmacy\DrugController@drugAjax');
        Route::get('drugcategory/drugcategoryajax/{drug}', 'Admin\Pharmacy\DrugCategoryController@drugAjax');
        Route::resource('drugcategory', 'Admin\Pharmacy\DrugCategoryController')->middleware('permission:drugcategory-view');
        Route::resource('drug', 'Admin\Pharmacy\DrugController')->middleware('permission:drug-view');
        Route::resource('drugbatch', 'Admin\Pharmacy\DrugBatchController')->middleware('permission:drugbatch-view');
        Route::resource('wards', 'Admin\Setting\WardModelController');
        Route::post('costdrug', 'Admin\Pharmacy\PharmacyController@prepare')->name('pharmacy.prepare');
        Route::resource('pharmbill', 'Admin\Pharmacy\PharmacyBillController');
        Route::resource('invoice', 'Admin\Account\InvoiceController')->middleware('permission:payment-view');
        Route::resource('pharmacy', 'Admin\Pharmacy\PharmacyController')->middleware('permission:pharmacy-view');
        Route::resource('purpose', 'Admin\Setting\VisitorPurposeSettingController');
        Route::resource('supplier', 'Admin\Account\Supplier')->middleware('permission:supplier-view');
        Route::resource('insuranceCategory', 'Admin\Setting\InsuranceCategory')->middleware('permission:setting-view');
        Route::resource('insurance', 'Admin\Setting\Insurance')->middleware('permission:setting-view');

        Route::post('haematology/prepareinvoice', 'Admin\Laboratory\HaematologyController@prepareInvoice')->name('haematology.prepareinvoice');
        Route::get('haematology/invoice/{id}', 'Admin\Laboratory\HaematologyController@invoice')->name('haematology.invoice');
        Route::get('haematology/completed', 'Admin\Laboratory\HaematologyController@completed')->name('haematology.completed');
        Route::resource('haematology', 'Admin\Laboratory\HaematologyController')->middleware('permission:haematology-view');
        Route::resource('microbiology', 'Admin\Laboratory\MicrobiologyController')->middleware('permission:microbiology-view');
        Route::group(['prefix' => 'subcategory'], function () {
            Route::post('store/{drugcategory}', 'Admin\Pharmacy\DrugCategoryController@subCategorystore')->name('drugsubcategory.store');
            Route::get('edit/{drugsubcategory}', 'Admin\Pharmacy\DrugCategoryController@subCategoryedit')->name('drugsubcategory.edit');
            Route::patch('update/{drugsubcategory}', 'Admin\Pharmacy\DrugCategoryController@subCategoryupdate')->name('drugsubcategory.update');
            Route::delete('delete/{drugsubcategory}', 'Admin\Pharmacy\DrugCategoryController@subCategorydelete')->name('drugsubcategory.destroy');
        });
        Route::post('user/changepassword/{user}', 'Admin\Setting\AdminController@changePassword')->name('user.changepassword');
        Route::post('user/uploadpassport/{user}', 'Admin\Setting\AdminController@avatar')->name('user.avatar');
        Route::resource('user', 'Admin\Setting\AdminController')->middleware('permission:user-view');
        Route::resource('asset', 'Admin\Setting\AssetController')->middleware('permission:asset-view');
        Route::resource('assetcategory', 'Admin\Setting\AssetCategoryController')->middleware('permission:assetcategory-view');
        Route::resource('assetpurchase', 'Admin\Setting\AssetPurchaseController')->middleware('permission:assetpurchase-view');
        Route::resource('assetassign', 'Admin\Setting\AssetAssignController')->middleware('permission:assetassign-view');

        Route::group(['prefix' => 'regtype'], function () {
            Route::get('/', 'Admin\Setting\RegistrationController@index')->middleware('permission:regtype-view')->name('regtype.index');
            Route::get('/{regtype}', 'Admin\Setting\RegistrationController@edit')->middleware('permission:regtype-update');
            Route::post('/create', 'Admin\Setting\RegistrationController@store');
            Route::put('/update/{regtype}', 'Admin\Setting\RegistrationController@update');
            Route::delete('/destroy/{regtype}', 'Admin\Setting\RegistrationController@destroy');
        });

        Route::get('/', 'Admin\Setting\DashboardController@index')->name('admin.dashboard');
    });
});
