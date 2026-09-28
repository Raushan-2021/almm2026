<?php

use App\Models\State;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  UPDATE `almm`.`manufacturer_users` SET `name` = 'Dummy', `email` = 'dummy@gov.in', `password` = '$10$xGEY01gOyWUK1Os17Q6j7OFH67qioZQlhguUBmgyXhzsZF1RSt0Ey' WHERE (`id` = '4');


*/

Route::view('/', 'frontend.home')->name('home');
Route::view('how-it-works','frontend.howItWorks')->name('how-it-works');
Route::view('about-the-programmes','frontend.aboutTheProgrammes')->name('about-the-programmes');// blade file m url:: to kr k url access krege
Route::view('downloads','frontend.downloads')->name('downloads');
Route::view('faqs','frontend.faqs')->name('faqs');
Route::view('privacy-policy','frontend.privacyPolicy')->name('privacy-policy');
Route::view('terms-of-use','frontend.termsOfUse')->name('terms-of-use');
Route::view('contact-us','frontend.contactUs')->name('contact-us');
Route::view('feedback','frontend.feedback')->name('feedback');
Route::view('sandes','frontend.sandes')->name('sandes');
Route::post('/get_distictbystate', 'HomeController@get_distictbystate');
Route::get('/multiple-user-access', 'HomeController@checkuserlogin')->name('multiple-user-access');
Route::match(['post', 'get'], 'register-user', 'HomeController@registerUser');
Route::match(['post', 'get'], 'register-user-rlmm', 'HomeController@registerUserRlmm');
Route::match(['post', 'get'], 'submit-feedback', 'HomeController@submitFeedback');
Route::match(['post', 'get'], 'consumer-interest-form', 'HomeController@consumerInterestForm');

Route::match(['post', 'get'], 'rmllogin', 'HomeController@rmllogin')->name('rmllogin');

Route::get('/artisan_cmd',function(){
	Artisan::call('storage:link');
});

Route::get('/getCounters','HomeController@getCounters');
// Testing email
Route::match(['post', 'get'], 'test_email', 'HomeController@test_email');

Route::group(['prefix' => 'ajax'], function () {
    
    Route::get('fetchCities/{state}', 'AjaxController@getDistrictsByState');
    Route::get('api/fetchStates', 'AjaxController@getState');
    Route::get('fetchSubDistricts/{district}', 'AjaxController@getSubDistrictsByDistrict');
    Route::get('fetchSubDistrictsByVillage/{village}', 'AjaxController@fetchSubDistrictsByVillage');
    Route::get('fetchDistrictBySubDiscrict/{subDistrict}', 'AjaxController@fetchDistrictBySubDiscrict');
    Route::get('fetchStateByDiscrict/{district}', 'AjaxController@fetchStateByDiscrict');
    Route::get('setOrEditPriority/{systemId}/{priority}', 'AjaxController@setOrEditPriority');
    Route::post('addEditSystem', 'AjaxController@addEditSystem');
    Route::get('getLatLong/{address}','AjaxController@getLocation');
    Route::get('ajax-refresh-csrf','AjaxController@tokencsrf_token_regerate');
    Route::get('fetch-Application-By-Id/{appId}', 'AjaxController@fetchApplicationDetailsById');
    Route::post('generate-token/{token}', 'AjaxController@generateToken');
    //fetchApplicationDetailsById
});
Route::get('api/fetchStates', 'HomeController@getState');
Route::get('api/fetchDistrict/{district}', 'HomeController@getDistrictsByState');

Route::group(['prefix' => 'v2'], function () {
    Route::get('fetchCities/{state}', 'AjaxController@getDistrictsByState');
    Route::get('solarparkData', 'AjaxController@getState');
});
/************************Reset Password*******************/
Route::match(['post', 'get'], 'reset-user-password','ResetPassController@sendOtpToUser')->name('reset.password');
//Route::get("/reset-user-password",'ResetPassController@reset_password_user')->name('reset.password');
//Route::post("/send-otp-user",'ResetPassController@sendOtpToUser');

Route::match(['post' , 'get'],'verify-otp','ResetPassController@checkOtp');
// Route::get("/verify-otp",'ResetPassController@verifyOtp');
// Route::post("/check-otp",'ResetPassController@checkOtp');

Route::match(['post','get'],'change-password','ResetPassController@updatePassword')->name('changepassword');

Route::get("/check-email",'ResetPassController@basic_email');
// Route::post("/update-password",'ResetPassController@updatePassword');


/************************Reset Password for Rlmm by Raushan*******************/
Route::match(['post', 'get'], 'forget-user-password','ResetPassController@sendOtpToEmailrlmm')->name('forget.password');
Route::match(['post' , 'get'],'verify-otp-user','ResetPassController@checkOtprlmm');
Route::match(['post','get'],'change-password','ResetPassController@updatePasswordrlmm')->name('change.password');


Route::get('/linkstorage',function(){
    Artisan::call('storage:link');
});

Route::get("/test-curl",'HomeController@curl_consumer_validation');
Route::get("/test-response",'HomeController@curl_decrypt_mobile');

Auth::routes();



// Manufacturer(users) Routes for almm wind 
Route::group(['prefix' => 'mfft', 'as' => 'mfft.', 'namespace' => 'Backend\Mfft', 'middleware' => ['auth:MFFT', 'onlyOneUser']], function () {

    // Example Route - You can replace this with actual routes needed for MFFT
    // Route::get('/', 'MainController@fetchNotificationDetailsById');
    Route::get('/', 'MainController@index')->name('dashboard');


    //Application Part 1
    Route::get('awuser-applications', 'MainController@awuserApplication');
    // Route::get('new-application/{id}', 'MainController@newApplication');
    Route::get('awnew-application/{id}', 'MainController@awnewApplication');
    Route::match(['get', 'post'], '/awnew-application', 'MainController@awnewApplication');
    Route::match(['get', 'post'], '/annexure-four', 'AwAnnexureController@annexureFour');
    Route::get('annexure-four/{id}', 'AwAnnexureController@annexureFour');
    Route::get('annexure-four/{id}/{edit_id}', 'AwAnnexureController@annexureFour');
    Route::get('annexure-four/{id}/{edit_id}/{type}', 'AwAnnexureController@annexureFour');

    Route::match(['get', 'post'], '/annexure-four-two', 'AwAnnexureController@awannexureFourTwo');
    Route::get('annexure-four-two/{id}', 'AwAnnexureController@awannexureFourTwo');
    Route::get('annexure-four-two/{id}/{edit_id}', 'AwAnnexureController@awannexureFourTwo');
    Route::get('annexure-four-two/{id}/{edit_id}/{type}', 'AwAnnexureController@awannexureFourTwo');

    Route::match(['get', 'post'], '/annexure-four-three', 'AwAnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}', 'AwAnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}/{edit_id}', 'AwAnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}/{edit_id}/{type}', 'AwAnnexureController@annexureFourThree');
    Route::get('annexure-four-three/delete/{id}', 'AwAnnexureController@deleteAnnexurewind');

    // affidavit_indemnity
    Route::match(['get', 'post'],'/application-affdt-indt', 'MainController@useraffdt_indt');
    Route::get('application-affdt-indt/{id}', 'MainController@useraffdt_indt');
    //Additional Information 
    Route::match(['get', 'post'], '/application-submission', 'MainController@applicationSubmission');
    Route::get('application-submission/{id}', 'MainController@applicationSubmission');

    // Upload file & attachment 
    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');
    Route::get('preview-docs/{folder}/{file}', 'AwAnnexureController@previewDocs');

    // view Application Rlmm 
    Route::any('view-application/{id}', 'MainController@viewApplication');

    Route::any('rlmm-track-detail/{id}', 'MainController@trackDetail');
    Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');

    Route::get('applications-mom', 'MainController@ApplicationsListMoM');
    Route::match(['get', 'post'], '/approvemom', 'MainController@approvemom');

    Route::post('changeScheduleDate', 'MainController@requestToChangeScheduleDate');

    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    // Other MFFT-specific routes can go here...
});



// Niwe Routes for almm wind 
Route::group(['prefix' => 'niwe','as' => 'niwe', 'namespace' => 'Backend\Niwe', 'middleware' => ['auth:NIWE', 'onlyOneUser']], function () {



    Route::get('fetch-notification-By-Id', 'MainController@fetchNotificationDetailsById');
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::get('applications-list', 'MainController@UserApplications');

    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::get('manufacturer-user-list', 'MainController@manufacturerUsers');

    // Mom niwe
    Route::get('applications-mom', 'MainController@ApplicationsListMoM');
    Route::match(['get', 'post'], '/approvemom', 'MainController@approvemom');
    Route::match(['get', 'post'], '/request-additional-docs', 'MainController@requestDocsForm');

    
    Route::any('reset-password', 'MainController@resetPassword');
    
    Route::any('view-application/{id}', 'MainController@viewApplication');
    Route::any('track-detail/{id}', 'MainController@trackDetail');
    Route::post('forwardto', 'MainController@forwardto');
    Route::post('scheduleInspection', 'MainController@scheduleInspection');
    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');
    Route::get('/application-fee-master', 'MasterController@index');
    Route::match(['get', 'post'], '/add-application-fee', 'MasterController@addApplicationFee');
    Route::get('/add-application-fee/{id}', 'MasterController@addApplicationFee');
    Route::post('reject-inspection-request', 'MainController@rejectRequest');
    Route::post('complete-inspection', 'MainController@completeInspection');
    Route::get('scheduled-inspections', 'MainController@scheduledInspections');     
    Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');
    Route::post('submit-holding-reason', 'MainController@submitHoldingReason');
    Route::post('holding-reason', 'MainController@holdingReason');
    Route::post('accept-inspection-request', 'MainController@acceptRequest');
});


// Mnre Routes for almm wind 
Route::group(['prefix' => 'mnre_wind_users','as' => 'mnre_wind_users', 'namespace' => 'Backend\RlmmMnre', 'middleware' => ['auth:MNREWIND', 'onlyOneUser']], function () {

    Route::get('/', 'MainController@index')->name('dashboard');
   
    Route::post('forwardto', 'MainController@forwardto');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');

    /************* Audit Trail*******Added by Raushan**********/
    Route::match(['get', 'post'],'/audit-trail','MainController@userAuditTrail')->name('audit.trail');
    /************* Audit Trail*******************/

    //Raushan 
    Route::get('mnre-user-list', 'MainController@mnreUsers');
    Route::any('create-mnre-user', 'MainController@createMnreUser');
    Route::any('edit-mnre-user/{id}', 'MainController@editMnreUser');

    // Raushan by Mom Approved
    // Route::match(['get', 'post'], 'MainController@approvemom');
    Route::match(['get', 'post'], '/approvemom', 'MainController@approvemom');
    Route::get('applications-mom', 'MainController@ApplicationsListMoM');
    

    //Raushan 
     Route::get('manufacturer-user-list', 'MainController@manufacturerUsers');
     Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');
     Route::get('approveForm/{id}', 'MainController@approveFormUsers');

     Route::any('reset-password', 'MainController@resetPassword');
     Route::get('applications-list', 'MainController@UserApplications');
     Route::any('view-application/{id}', 'MainController@viewApplication');
     Route::any('track-detail/{id}', 'MainController@trackDetail');
     Route::any('reports', 'MainController@reports');
     Route::any('feedbacks', 'MainController@feedbacks');
     Route::post('holding-reason', 'MainController@holdingReason');
    
});







// User Routes for manufacturer almm solar 
Route::group(['prefix' => 'users', 'as' => 'users.', 'namespace' => 'Backend\Users', 'middleware' => ['auth:users','onlyOneUser']], function () {

    Route::get('fetch-notification-By-Id', 'MainController@fetchNotificationDetailsById');
    Route::post('AjaxfetchDashboardCounts/{year}', 'MainController@AjaxfetchDashboardCounts');

    
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    Route::match(['get', 'post'], '/forced-password-change', 'MainController@forcedPasswordChange');
    Route::match(['get', 'post'], '/upload-pan-gst-document', 'MainController@uploadPanGstDocument');

    


    

    
    //Application Part 1
    Route::get('user-applications', 'MainController@userApplication');
    Route::get('new-application/{id}', 'MainController@newApplication');
    Route::match(['get', 'post'], '/new-application', 'MainController@newApplication');

    //Application Part 2
    Route::get('new-application-step2/{id}', 'MainController@newApplicationStep2');
    Route::match(['get', 'post'], '/new-application-step2', 'MainController@newApplicationStep2');
    
    //Module Master
    Route::match(['get', 'post'], '/module-master','ModuleController@moduleMaster');
    Route::get('/module-master/{id}', 'ModuleController@moduleMaster');

    Route::match(['get', 'post'], '/addModule','ModuleController@addModule');
    Route::get('/addModule/{id}', 'ModuleController@addModule');
    Route::get('/editModule/{id}/{editid}', 'ModuleController@addModule');

    
    Route::get('/deleteModule/{editid}', 'ModuleController@deleteModule');

    //Annexure One Routes
    Route::match(['get', 'post'], '/annexure-one', 'AnnexureController@annexure1');
    Route::get('annexure-one/{id}', 'AnnexureController@annexure1');
    Route::get('annexure-one/{id}/{edit_id}', 'AnnexureController@annexure1');
    Route::match(['get', 'post'], '/annexure-one-b-attachment', 'AnnexureController@annexureOnebAttachment');
    //by raushan 
    Route::match(['get', 'post'], '/annexure-one-attachment', 'AnnexureController@annexureOneAttachment');

    //Annexure One Part B Routes
    Route::match(['get', 'post'], '/annexure-one-b', 'AnnexureController@annexure1_1');
    Route::get('annexure-one-b/{id}', 'AnnexureController@annexure1_1');
    Route::get('annexure-one-b/{id}/{edit_id}', 'AnnexureController@annexure1_1');
    Route::get('annexure-one-b/{id}/{edit_id}/{type}', 'AnnexureController@annexure1_1');

    //Annexure One Part C Routes
    Route::match(['get', 'post'], '/annexure-one-c', 'AnnexureController@annexure1_3');
    Route::get('annexure-one-c/{id}', 'AnnexureController@annexure1_3');
    Route::get('annexure-one-c/{id}/{edit_id}', 'AnnexureController@annexure1_3');
    Route::get('annexure-one-c/{id}/{edit_id}/{type}', 'AnnexureController@annexure1_3');
    Route::match(['get', 'post'], '/annexure-one-c-attachment', 'AnnexureController@annexureOnecAttachment');
    Route::match(['get', 'post'], '/annexure-one-d-attachment', 'AnnexureController@annexureThreeAttachment');
    // BoM Attachment by Raushan 
    Route::match(['get', 'post'], '/annexure-bom-datasheet', 'AnnexureController@bomdatasheet');

    //Annexure Two Routes
    Route::match(['get', 'post'], '/annexure-two', 'AnnexureController@annexureTwo');
    Route::get('annexure-two/{id}', 'AnnexureController@annexureTwo');
    Route::get('annexure-two/{id}/{edit_id}', 'AnnexureController@annexureTwo');

    //Annexure Three Routes
    Route::match(['get', 'post'], '/annexure-three', 'AnnexureController@annexureThree');
    Route::get('annexure-three/{id}', 'AnnexureController@annexureThree');
    Route::get('annexure-three/{id}/{edit_id}', 'AnnexureController@annexureThree');
    Route::get('annexure-three/{id}/{edit_id}/{type}', 'AnnexureController@annexureThree');


    Route::match(['get', 'post'], '/annexure-four', 'AnnexureController@annexureFour');
    Route::get('annexure-four/{id}', 'AnnexureController@annexureFour');
    Route::get('annexure-four/{id}/{edit_id}', 'AnnexureController@annexureFour');
    Route::get('annexure-four/{id}/{edit_id}/{type}', 'AnnexureController@annexureFour');

    Route::match(['get', 'post'], '/annexure-four-two', 'AnnexureController@annexureFourTwo');
    Route::get('annexure-four-two/{id}', 'AnnexureController@annexureFourTwo');
    Route::get('annexure-four-two/{id}/{edit_id}', 'AnnexureController@annexureFourTwo');
    Route::get('annexure-four-two/{id}/{edit_id}/{type}', 'AnnexureController@annexureFourTwo');

    Route::match(['get', 'post'], '/annexure-four-three', 'AnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}', 'AnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}/{edit_id}', 'AnnexureController@annexureFourThree');
    Route::get('annexure-four-three/{id}/{edit_id}/{type}', 'AnnexureController@annexureFourThree');
//    Route::get('annexure-four-three/{application_id}/{sfhsdhg}', 'AnnexureController@annexureFourThree');


    Route::match(['get', 'post'], '/add-annexure-four-three', 'AnnexureController@addannexureFourThree');

    Route::match(['get', 'post'], '/annexure-four-four', 'AnnexureController@annexureFourFour');
    Route::get('annexure-four-four/{id}', 'AnnexureController@annexureFourFour');
    Route::get('annexure-four-four/{id}/{edit_id}', 'AnnexureController@annexureFourFour');

    Route::match(['get', 'post'], '/annexure-four-five', 'AnnexureController@annexureFourFive');
    Route::get('annexure-four-five/{id}', 'AnnexureController@annexureFourFive');
    Route::get('annexure-four-five/{id}/{edit_id}', 'AnnexureController@annexureFourFive');

    Route::match(['get', 'post'], '/annexure-seven', 'AnnexureController@annexureSeven');
    Route::get('annexure-seven/{id}', 'AnnexureController@annexureSeven');

    Route::match(['get', 'post'], '/annexure-eight', 'AnnexureController@annexureEight');
    Route::get('annexure-eight/{id}', 'AnnexureController@annexureEight');

    Route::match(['get', 'post'], '/annexure-attachment', 'AnnexureController@annexureAttachment');
    Route::get('annexure-attachment/{id}', 'AnnexureController@annexureAttachment');
    Route::get('annexure-attachment/{annexure_id}/{id}', 'AnnexureController@deleteAttachment');

    Route::match(['get', 'post'], '/application-submission', 'MainController@applicationSubmission');
    Route::get('application-submission/{id}', 'MainController@applicationSubmission');

    Route::get('delete-annexure/{annexure_id}/{id}', 'AnnexureController@deleteAnnexure');
    Route::get('preview-docs/{folder}/{file}', 'AnnexureController@previewDocs');

    //Download Application Route
    Route::get('download-application/{id}', 'MainController@downloadApplication');
    
    Route::any('view-application/{id}', 'MainController@viewApplication');
    Route::any('track-detail/{id}', 'MainController@trackDetail');
    Route::post('changeScheduleDate', 'MainController@requestToChangeScheduleDate');

    Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');
    Route::get('preview-application/{id}', 'MainController@previewApplication');
    
    
    //

    //Existing-application Module
    Route::match(['get', 'post'], '/select-existing-application', 'ExistingController\ExistingModelController@selectExisingApplication');
    Route::get('/select-existing-application/{id}', 'ExistingController\ExistingModelController@selectExisingApplication');
    
    Route::match(['get', 'post'], '/existing-application', 'ExistingController\ExistingModelController@ExistingApplication');
    Route::get('existing-application/{id}', 'ExistingController\ExistingModelController@ExistingApplication');

    Route::match(['get', 'post'], '/existing-application-step2', 'ExistingController\ExistingModelController@ExistingApplicationStep2');
    Route::get('existing-application-step2/{id}', 'ExistingController\ExistingModelController@ExistingApplicationStep2');

    //Existing Module 
    Route::match(['get', 'post'], '/module-existing-master','ExistingController\ModuleExistingController@moduleExistingMaster');
    Route::get('/module-existing-master/{id}', 'ExistingController\ModuleExistingController@moduleExistingMaster');

    Route::match(['get', 'post'], '/addExistingModule','ExistingController\ModuleExistingController@addExistingModule');
    Route::get('/addExistingModule/{id}', 'ExistingController\ModuleExistingController@addExistingModule');
    Route::get('/editExistingModule/{id}/{editid}', 'ExistingController\ModuleExistingController@addExistingModule');
    Route::get('/deleteExistingModule/{editid}', 'ExistingController\ModuleExistingController@deleteExistingModule');

    //Existing Annexure
    Route::match(['get', 'post'], '/existing-annexure-one', 'ExistingController\ExistingAnnexureController@annexure1');
    Route::get('existing-annexure-one/{id}', 'ExistingController\ExistingAnnexureController@annexure1');
    Route::get('existing-annexure-one/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexure1');

    Route::match(['get', 'post'], '/existing-annexure-one-b', 'ExistingController\ExistingAnnexureController@annexure1_1');
    Route::get('existing-annexure-one-b/{id}', 'ExistingController\ExistingAnnexureController@annexure1_1');
    Route::get('existing-annexure-one-b/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexure1_1');
    Route::get('existing-annexure-one-b/{id}/{edit_id}/{type}', 'ExistingController\ExistingAnnexureController@annexure1_1');
     
     Route::match(['get', 'post'], '/existing-annexure-one-c', 'ExistingController\ExistingAnnexureController@annexure1_3');
     Route::get('existing-annexure-one-c/{id}', 'ExistingController\ExistingAnnexureController@annexure1_3');
     Route::get('existing-annexure-one-c/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexure1_3');
     Route::get('existing-annexure-one-c/{id}/{edit_id}/{type}', 'ExistingController\ExistingAnnexureController@annexure1_3');

    Route::match(['get', 'post'], '/existing-annexure-two', 'ExistingController\ExistingAnnexureController@annexureTwo');
    Route::get('existing-annexure-two/{id}', 'ExistingController\ExistingAnnexureController@annexureTwo');
    Route::get('existing-annexure-two/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureTwo');

    Route::match(['get', 'post'], '/existing-annexure-three', 'ExistingController\ExistingAnnexureController@annexureThree');
    Route::get('/existing-annexure-three/{id}', 'ExistingController\ExistingAnnexureController@annexureThree');
    Route::get('/existing-annexure-three/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureThree');
    Route::get('/existing-annexure-three/{id}/{edit_id}/{type}', 'ExistingController\ExistingAnnexureController@annexureThree');

    Route::match(['get', 'post'], '/existing-annexure-four', 'ExistingController\ExistingAnnexureController@annexureFour');
    Route::get('/existing-annexure-four/{id}', 'ExistingController\ExistingAnnexureController@annexureFour');
    Route::get('/existing-annexure-four/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFour');

    Route::match(['get', 'post'], '/existing-annexure-four-two', 'ExistingController\ExistingAnnexureController@annexureFourTwo');
    Route::get('/existing-annexure-four-two/{id}', 'ExistingController\ExistingAnnexureController@annexureFourTwo');
    Route::get('/existing-annexure-four-two/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFourTwo');
    
    Route::match(['get', 'post'], '/existing-annexure-four-three', 'ExistingController\ExistingAnnexureController@annexureFourThree');
    Route::get('existing-annexure-four-three/{id}', 'ExistingController\ExistingAnnexureController@annexureFourThree');
    Route::get('existing-annexure-four-three/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFourThree');

    Route::match(['get', 'post'], '/existing-annexure-four-four', 'ExistingController\ExistingAnnexureController@annexureFourFour');
    Route::get('existing-annexure-four-four/{id}', 'ExistingController\ExistingAnnexureController@annexureFourFour');
    Route::get('existing-annexure-four-four/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFourFour');

    Route::match(['get', 'post'], '/existing-annexure-four-five', 'ExistingController\ExistingAnnexureController@annexureFourFive');
    Route::get('existing-annexure-four-five/{id}', 'ExistingController\ExistingAnnexureController@annexureFourFive');
    Route::get('existing-annexure-four-five/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFourFive');

    Route::match(['get', 'post'], '/existing-annexure-five', 'ExistingController\ExistingAnnexureController@annexureFive');
    Route::get('existing-annexure-five/{id}', 'ExistingController\ExistingAnnexureController@annexureFive');
    Route::get('existing-annexure-five/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureFive');
    Route::get('existing-annexure-five-delete/{annexure_id}/{id}', 'ExistingController\ExistingAnnexureController@deleteAnnexure5');
    
    // annexure-five-attachment

    Route::match(['get', 'post'], '/existing-annexure-six', 'ExistingController\ExistingAnnexureController@annexureSix');
    Route::get('existing-annexure-six/{id}', 'ExistingController\ExistingAnnexureController@annexureSix');
    Route::get('existing-annexure-six/{id}/{edit_id}', 'ExistingController\ExistingAnnexureController@annexureSix');
    Route::get('existing-annexure-six-delete/{annexure_id}/{id}', 'ExistingController\ExistingAnnexureController@deleteAnnexure6');
    
    Route::match(['get', 'post'], '/existing-annexure-seven', 'ExistingController\ExistingAnnexureController@annexureSeven');
    Route::get('existing-annexure-seven/{id}', 'ExistingController\ExistingAnnexureController@annexureSeven');

    Route::match(['get', 'post'], '/existing-annexure-eight', 'ExistingController\ExistingAnnexureController@annexureEight');
    Route::get('existing-annexure-eight/{id}', 'ExistingController\ExistingAnnexureController@annexureEight');

    Route::match(['get', 'post'], '/existing-annexure-attachment', 'ExistingController\ExistingAnnexureController@annexureAttachment');
    Route::get('existing-annexure-attachment/{id}', 'ExistingController\ExistingAnnexureController@annexureAttachment');
    Route::get('existing-annexure-attachment/{annexure_id}/{id}', 'ExistingController\ExistingAnnexureController@deleteAttachment');

    Route::match(['get', 'post'], '/existing-application-submission', 'ExistingController\ExistingAnnexureController@applicationSubmission');
    Route::get('existing-application-submission/{id}', 'ExistingController\ExistingAnnexureController@applicationSubmission');

    Route::get('existing-delete-annexure/{annexure_id}/{id}', 'ExistingController\ExistingAnnexureController@deleteAnnexure');
    Route::get('existing-preview-docs/{folder}/{file}', 'ExistingController\ExistingAnnexureController@previewDocs');

    Route::match(['get', 'post'],'/existing-application-fees', 'ExistingController\ExistingAnnexureController@userApplicationFee');
    Route::get('existing-application-fees/{id}', 'ExistingController\ExistingAnnexureController@userApplicationFee');

    //Raushan
    Route::match(['get', 'post'], '/annexure-five', 'AnnexureController@annexureFive');
    Route::get('annexure-five/{id}', 'AnnexureController@annexureFive');
    Route::get('annexure-five/{id}/{financial_year}/{datatype}', 'AnnexureController@annexureFive');
    Route::post('annexure-five-attachment', 'AnnexureController@annexure5attachment');
    Route::get('annexure-five-delete/{annexure_id}/{id}', 'AnnexureController@deleteAnnexure5');
    Route::post('api/updateAnnexure5Data', 'AnnexureController@updateModuleData');

    Route::match(['get', 'post'], '/annexure-six', 'AnnexureController@annexureSix');
    Route::get('annexure-six/{id}', 'AnnexureController@annexureSix');
    Route::get('annexure-six/{id}/{edit_id}', 'AnnexureController@annexureSix');
    Route::get('annexure-six-delete/{annexure_id}/{id}', 'AnnexureController@deleteAnnexure6');
    //Raushan

    Route::match(['get', 'post'],'/application-fees', 'MainController@userApplicationFee');
    Route::get('application-fees/{id}', 'MainController@userApplicationFee');
    
    Route::match(['get', 'post'],'/inspection-fees', 'MainController@userApplicationInspFee');
    Route::get('inspection-fees/{id}', 'MainController@userApplicationInspFee');

});

// MNRE Routes
Route::group(['prefix' => 'mnre', 'as' => 'mnre.', 'namespace' => 'Backend\Mnre', 'middleware' => ['auth:mnre','onlyOneUser']], function () {
    Route::get('fetch-notification-By-Id', 'MainController@fetchNotificationDetailsById');
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::post('forwardto', 'MainController@forwardto');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');

    /************* Audit Trail*******Added by Raushan**********/
    Route::match(['get', 'post'],'/audit-trail','MainController@userAuditTrail')->name('audit.trail');
    /************* Audit Trail*******************/
    Route::get('mnre-user-list', 'MainController@mnreUsers');
    Route::any('create-mnre-user', 'MainController@createMnreUser');
    Route::any('edit-mnre-user/{id}', 'MainController@editMnreUser');
    //Raushan
     Route::get('manufacturer-user-list', 'MainController@manufacturerUsers');
     Route::any('reset-password', 'MainController@resetPassword');
     Route::get('applications-list', 'MainController@UserApplications');
     Route::any('view-application/{id}', 'MainController@viewApplication');
     Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');
     Route::any('track-detail/{id}', 'MainController@trackDetail');
     Route::any('reports', 'MainController@reports');
     Route::any('feedbacks', 'MainController@feedbacks');
     Route::post('holding-reason', 'MainController@holdingReason');
    //Raushan
});

// MNRE Routes End

// NISE Routes Start
Route::group(['prefix' => 'nise', 'as' => 'nise.', 'namespace' => 'Backend\Nise', 'middleware' => ['auth:nise','onlyOneUser']], function () {
    Route::get('fetch-notification-By-Id', 'MainController@fetchNotificationDetailsById');
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    Route::get('manufacturer-user-list', 'MainController@manufacturerUsers');
    Route::any('reset-password', 'MainController@resetPassword');
    Route::get('applications-list', 'MainController@UserApplications');
    Route::any('view-application/{id}', 'MainController@viewApplication');
    Route::any('track-detail/{id}', 'MainController@trackDetail');
    Route::post('forwardto', 'MainController@forwardto');
    Route::post('scheduleInspection', 'MainController@scheduleInspection');
    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');
    Route::get('/application-fee-master', 'MasterController@index');
    Route::match(['get', 'post'], '/add-application-fee', 'MasterController@addApplicationFee');
    Route::get('/add-application-fee/{id}', 'MasterController@addApplicationFee');
    Route::post('reject-inspection-request', 'MainController@rejectRequest');
    Route::post('complete-inspection', 'MainController@completeInspection');
    Route::get('scheduled-inspections', 'MainController@scheduledInspections');     
    Route::get('download-pdf-application/{id}', 'MainController@downloadPdfApplication');
    Route::post('submit-holding-reason', 'MainController@submitHoldingReason');
    Route::post('holding-reason', 'MainController@holdingReason');
});

Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('optimize:clear');
       Artisan::call('config:clear');
       Artisan::call('cache:clear');
       Artisan::call('config:cache');
       Artisan::call('route:clear');
       Artisan::call('route:clear');
        // return what you want
     });
// NISE Routes End