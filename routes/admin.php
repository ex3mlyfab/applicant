<?php



Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::post('unlock', 'Admin\Auth\LoginController@unlock')->name('admin.unlock');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('locked','Admin\Auth\LoginController@locked')->name('admin.lock');
        Route::get('birthdays', function () {
            return view('admin.patient.birthday');
        })->name('birthdays'); //birthdays celebrant
        Route::post('pharmacy/filterstock', 'Admin\Pharmacy\PharmacyController@filterStock')->name('filter.stock');
        Route::get('pharmacy/stockreport', 'Admin\Pharmacy\PharmacyController@stockReport')->name('stockreport.view');
        Route::get('inpatient/dashboard', 'Admin\Inpatient\InpatientController@dashboard')->name('inpatient.dashboard')->middleware('permission:inpatient-view');
        Route::get('prescriptionreview/{pharmreq}', 'Admin\Consult\PharmreqController@prescriptionReview')->name('pharmreq.review');
        Route::post('wardround/changestatus', 'Admin\Inpatient\TreatmentSheetController@changeStatus');
        Route::post('surgicalpatient/confirmpayment', 'Admin\Procedure\SurgicalPatientController@confirmPayment')->name('surgical.confirm');
        Route::post('nurseround/recordtreatment', 'Admin\Inpatient\TreatmentSheetController@recordTreatment')->name('recordtreatment');
        Route::post('wardround/recordtask', 'Admin\Inpatient\ClinicalTrackerController@recordTask')->name('recordtasks');
        Route::post('patient/classajax/{patient}', 'Admin\Front\PatientController@patientAjax');
        Route::get('balance', 'Admin\Account\PaymentController@balance')->name('balance');
        Route::get('filterpayments', 'Admin\Account\PaymentController@filter')->name('filter.payment');
        Route::post('filterpayments', 'Admin\Account\PaymentController@filtersearch')->name('filterpayment.search');
        Route::resource('patient', 'Admin\Front\PatientController');
        Route::get('payment/settle/{invoice}', 'Admin\Account\PaymentController@settleInvoice')->name('payment.settle');
        Route::get('payment/printinvoice/{invoice}', 'Admin\Account\PaymentController@printInvoice')->name('payment.invoice');
        Route::get('payment/printreceipt/{payment}', 'Admin\Account\PaymentController@printReceipt')->name('payment.print');
        Route::post('payment/pay', 'Admin\Account\PaymentController@pay')->name('payment.pay');
        Route::post('payment/pharmacy', 'Admin\Account\PaymentController@pharmacy')->name('payment.pharmacy');
        Route::resource('paymentmode', 'Admin\Setting\PaymentModeController')->middleware('permission:paymentmode-create');
        Route::resource('paymentmethod', 'Admin\Setting\PaymentMethodController')->middleware('permission:paymentmethod-create');
        Route::resource('treatmentsheet', 'Admin\Inpatient\TreatmentSheetController')->middleware('permission:wardround-create');
        /**
         * Inpatient Routes
         */
        Route::resource('clinicaltask', 'Admin\Inpatient\ClinicalTrackerController');
        Route::resource('fluidreport', 'Admin\Inpatient\FluidReporController')->middleware('permission:fluidreport-view');
        Route::resource('nursingreport', 'Admin\Inpatient\NursingReportController')->middleware('permission:fluidreport-view');
        Route::resource('procedurerequest', 'Admin\Inpatient\ProcedureRequestController')->middleware('permission:procedure-view');
        Route::resource('discharge', 'Admin\Inpatient\DischargeSummaryController')->middleware('permission:discharge-view');
        Route::get('wardround/{inpatient}', 'Admin\Inpatient\InpatientController@wardRound')->name('wardround')->middleware('permission:wardround-create');
        Route::get('nurseround/{inpatient}', 'Admin\Inpatient\NursingCareController@nursingCare')->name('nurseround')->middleware('permission:nurseround-create');
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
        Route::resource('bank', 'Admin\Account\BankController')->middleware('permission:bank-view');
        Route::resource('banktransfer', 'Admin\Account\BankTransferController')->middleware('permission:bank-view');

        Route::resource('charge', 'Admin\Account\ChargeController')->middleware('permission:charge-view');
        Route::resource('clinicalappointment', 'Admin\Front\ClinicalAppointmentController')->middleware('permission:appointment-view');
        Route::resource('nursing', 'Admin\Front\VitalSignController')->middleware('permission:nursing-view');
        Route::get('chart/{id}', 'Admin\Front\VitalSignController@vitals');
        Route::get('vitals/{vital}', 'Admin\Front\VitalSignController@takeVitals')->name('vitals.create');
        Route::resource('physical', 'Admin\Consult\PhysicalExamController');
        Route::resource('pc', 'Admin\Consult\PresentingComplaintController');
        Route::get('consult/{consult}', 'Admin\Consult\ConsultController@consult')->middleware('permission:consult-view')->name('consult.create');
        Route::get('endconsult/{consult}', 'Admin\Consult\ConsultController@endConsult')->middleware('permission:consult-create')->name('consult.end');
        Route::resource('mdaccount', 'Admin\Setting\MdAccountController')->middleware('permission:mdaccount-create');
        Route::resource('otherprocedure', 'Admin\Front\OtherProcedureController');
        //pharmacy
        Route::get('processtock/{id}', 'Admin\Pharmacy\StockCartController@processStock')->name('process.stock');
        Route::post('recievestock', 'Admin\Pharmacy\StockCartController@recieveSupply')->name('receive.stock');
        Route::get('pharmacy/dispense-drugs', 'Admin\Pharmacy\PharmacyController@prepare')->middleware('permission:dispense-view')->name('dispense.drugs');
        Route::get('pharmacy/view-dispensed', 'Admin\Pharmacy\PharmacyController@billdrug')->middleware('permission:dispense-view')->name('pharmacy.dispensed');
        Route::get('pharmacy/dispensedrug/{pharmreq}', 'Admin\Pharmacy\PharmacyController@dispensedrug')->name('pharmacy.dispensedrug');
        Route::post('pharmacy/confirmdispense', 'Admin\Pharmacy\PharmacyController@confirmdispense')->name('pharmacy.confirmdispense');
        Route::resource('pharmbill', 'Admin\Pharmacy\PharmacyBillController');
        Route::post('filterdispensed', 'Admin\Pharmacy\PharmacyBillController@filtersearch')->name('filter.dispense');
        Route::resource('stockcart','Admin\Pharmacy\StockCartController');
        Route::resource('nursecart', 'Admin\Pharmacy\NursingCartController');
        Route::resource('emergencycart', 'Admin\Pharmacy\EmergencyCartController');
        Route::resource('theatercart', 'Admin\Pharmacy\TheaterCartController');
        Route::resource('followup', 'Admin\Consult\FollowUpController');
        Route::resource('consults', 'Admin\Consult\ConsultController');
        Route::post('consult/pharmreq/create', 'Admin\Consult\PharmreqController@ajaxdrug');
        Route::resource('pharmreq', 'Admin\Consult\PharmreqController');
        Route::resource('microreq', 'Admin\Consult\MicrobiologyreqController');
        Route::resource('bloodreq', 'Admin\Consult\BloodreqController');
        Route::resource('radiologyreq', 'Admin\Consult\RadiologyreqController');
        Route::resource('ultrasoundreq', 'Admin\Consult\UltrasoundreqController');
        Route::resource('allergy', 'Admin\Consult\AllergyController')->middleware('permission:consult-create');
        Route::post('addallergy', 'Admin\Front\PatientController@addAllergy')->middleware('permission:consult-create');
        Route::delete('removeAllergy/{allergy}', 'Admin\Front\PatientController@removeAllergy')->name('allergy.remove')->middleware('permission:consult-delete');
        Route::resource('patient-history', 'Admin\Inpatient\PatientHistoryController')->middleware('permission:nurseround');
        Route::resource('physical-assessment', 'Admin\Inpatient\PhysicalAssessmentController')->middleware('permission:nurseround');
        Route::resource('fun-health', 'Admin\Inpatient\FunHealthController')->middleware('permission:nurseround');
        Route::resource('daily-record', 'Admin\Inpatient\DailyRecordController')->middleware('permission:nurseround');
        Route::resource('patient-statistics', 'Admin\Front\PatientStatisticController');
        Route::resource('haematologyreq', 'Admin\Consult\HaematologyReqController');
        Route::resource('pathologyreq', 'Admin\Consult\PathologyController');
        Route::resource('histopathologyreq', 'Admin\Consult\HistopathologyReController');
        Route::get('selectdrug/{drug}', 'Admin\Pharmacy\DrugController@selectDrug');

        Route::get('family/familyenroll/{family}', 'Admin\Front\FamilyController@familyEnroll')->name('family.enroll');
        Route::resource('family', 'Admin\Front\FamilyController')->middleware('permission:family-view');
        Route::get('company/enroll/{company}', 'Admin\Front\CompanyController@enroll')->name('company.enroll');
        Route::post('company/enrollstore', 'Admin\Front\CompanyController@enrollStore')->name('company.enrollstore');
        Route::resource('company', 'Admin\Front\CompanyController')->middleware('permission:company-view');
        Route::post('role/assignpermission/{role}', 'Admin\Setting\RoleController@assign')->name('role.assignpermission');
        Route::resource('role', 'Admin\Setting\RoleController')->middleware('permission:role-view');
        Route::resource('permission', 'Admin\Setting\PermissionController')->middleware('permission:permission-view');
        Route::get('drug/drugajax/{drug}', 'Admin\Pharmacy\DrugController@drugAjax');
        Route::get('drug/getall','Admin\Pharmacy\DrugController@getAll');
        Route::get('drugcategory/drugcategoryajax/{drug}', 'Admin\Pharmacy\DrugClassController@classAjax');
        Route::resource('drugclass', 'Admin\Pharmacy\DrugClassController')->middleware('permission:drugcategory-view');
        Route::resource('drug', 'Admin\Pharmacy\DrugController')->middleware('permission:drug-view');
        Route::resource('drugbatch', 'Admin\Pharmacy\DrugBatchController')->middleware('permission:drugbatch-view');
        Route::resource('wards', 'Admin\Setting\WardModelController');
        Route::post('costdrug', 'Admin\Pharmacy\PharmacyController@prepare')->name('pharmacy.prepare');
        Route::resource('pharmbill', 'Admin\Pharmacy\PharmacyBillController');
        Route::resource('invoice', 'Admin\Account\InvoiceController')->middleware('permission:payment-view');
        Route::resource('pharmacy', 'Admin\Pharmacy\PharmacyController')->middleware('permission:pharmacy-view');
        Route::resource('purpose', 'Admin\Setting\VisitorPurposeSettingController');
        Route::resource('supplier', 'Admin\Account\Supplier')->middleware('permission:supplier-view');
        Route::get('suppliers/load', 'Admin\Account\Supplier@loadSuppliers')->middleware('permission:purchase-create');
        Route::get('suppliers/payables/{supplier}', 'Admin\Account\Supplier@payables')->middleware('permission:supplier-view')->name('supplier.payable');
        Route::post('suppliers/filter-payables', 'Admin\Account\Supplier@filterPayables')->middleware('permission:supplier-view')->name('payables.filter');
        Route::get('suppliers/purchases/{supplier}', 'Admin\Account\Supplier@purchases')->middleware('permission:supplier-view')->name('supplier.purchase');
        Route::post('suppliers/filter-purchases', 'Admin\Account\Supplier@filterPurchases')->middleware('permission:supplier-view')->name('purchases.filter');
        Route::resource('nhis', 'Admin\Front\NhisPatientController')->middleware('permission:patient-create');
        Route::resource('surgicalpatient', 'Admin\Procedure\SurgicalPatientController')->middleware('permission:surgical-view');

        Route::resource('insuranceCategory', 'Admin\Setting\InsuranceCategory')->middleware('permission:setting-view');
        Route::resource('insurance', 'Admin\Setting\Insurance')->middleware('permission:setting-view');
        Route::resource('insurancepackage', 'Admin\Setting\InsurancePackageController')->middleware('permission:insurance-view');
        Route::get('getinsured/{id}', 'Admin\Insurance\EnrollUserController@getInsuredPatient')->name('getinsured');
        Route::get('getbyinsurance/{id}', 'Admin\Insurance\EnrollUserController@getByInsurance')->name('getby.insurance');
        Route::resource('enrolluser', 'Admin\Insurance\EnrollUserController')->middleware('permission:insurance-create');
        Route::get('bookconsultation/{patient}', 'Admin\Front\ClinicalAppointmentController@bookConsultation')->name('consultation.book')->middleware('permission:consultation-view');
        Route::post('haematology/prepareinvoice', 'Admin\Laboratory\HaematologyController@prepareInvoice')->name('haematology.prepareinvoice');
        Route::get('haematology/invoice/{id}', 'Admin\Laboratory\HaematologyController@invoice')->name('haematology.invoice');
        Route::get('haematology/completed', 'Admin\Laboratory\HaematologyController@completed')->name('haematology.completed');
        Route::resource('haematology', 'Admin\Laboratory\HaematologyController')->middleware('permission:haematology-view');
        Route::resource('microbiology', 'Admin\Laboratory\MicrobiologyController')->middleware('permission:microbiology-view');
        Route::resource('drugClass', 'Admin\Pharmacy\DrugClassController')->middleware('permission:drugclass-create');
        Route::post('user/changepassword/{user}', 'Admin\Setting\AdminController@changePassword')->name('user.changepassword');
        Route::post('user/uploadpassport/{user}', 'Admin\Setting\AdminController@avatar')->name('user.avatar');
        Route::resource('user', 'Admin\Setting\AdminController')->middleware('permission:user-view');
        Route::resource('asset', 'Admin\Setting\AssetController')->middleware('permission:asset-view');
        Route::resource('assetcategory', 'Admin\Setting\AssetCategoryController')->middleware('permission:assetcategory-view');
        Route::resource('assetpurchase', 'Admin\Setting\AssetPurchaseController')->middleware('permission:assetpurchase-view');
        Route::resource('assetassign', 'Admin\Setting\AssetAssignController')->middleware('permission:assetassign-view');
        Route::resource('purchaseOrder', 'Admin\Pharmacy\PurchaseOrder')->middleware('permission:order-create');
        Route::resource('recieveorder', 'Admin\Pharmacy\RecieveOrderController')->middleware('permission:recieve-create');
        Route::post('recieveorder/createone', 'Admin\Pharmacy\RecieveOrderController@createOne')->name('recieveorder.createOne')->middleware('permission:recieveorder-create');


        Route::group(['prefix' => 'regtype'], function () {
            Route::get('/', 'Admin\Setting\RegistrationController@index')->middleware('permission:regtype-view')->name('regtype.index');
            Route::get('/{regtype}', 'Admin\Setting\RegistrationController@edit')->middleware('permission:regtype-update');
            Route::post('/create', 'Admin\Setting\RegistrationController@store');
            Route::patch('/update/{regtype}', 'Admin\Setting\RegistrationController@update');
            Route::delete('/destroy/{regtype}', 'Admin\Setting\RegistrationController@destroy');
        });

        Route::get('/', 'Admin\Setting\DashboardController@index')->name('admin.dashboard');
    });
});
