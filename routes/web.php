<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// For Admin part
Route::get('/error', function(){
return view('errorpage');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Basic Settings
Route::resource('gender', 'com\adventure\school\basic\GenderController');
Route::resource('quota', 'com\adventure\school\basic\QuotaController');
Route::resource('bloodgroup', 'com\adventure\school\basic\BloodGroupController');
Route::resource('religion', 'com\adventure\school\basic\ReligionController');
Route::resource('nationality', 'com\adventure\school\basic\NationalityController');
Route::resource('division', 'com\adventure\school\basic\DivisionController');
Route::resource('district', 'com\adventure\school\basic\DistrictController');
Route::resource('thana', 'com\adventure\school\basic\ThanaController');
Route::resource('postoffice', 'com\adventure\school\basic\PostOfficeController');
Route::resource('localgov', 'com\adventure\school\basic\LocalGovController');
Route::get('institute/changeaddress', 'com\adventure\school\basic\InstituteController@changeAddress');
Route::resource('institute', 'com\adventure\school\basic\InstituteController');
Route::resource('admissionsubject', 'com\adventure\school\basic\AdmissionSubjectController');
Route::resource('departments', 'com\adventure\school\basic\DepartmentController');
Route::resource('employmentstatus', 'com\adventure\school\basic\EmploymentStatusController');
Route::resource('employeetypes', 'com\adventure\school\basic\EmployeeTypeController');
Route::resource('employeestatus', 'com\adventure\school\basic\EmployeeStatusController');
Route::resource('designations', 'com\adventure\school\basic\DesignationController');
Route::resource('maritalstatus', 'com\adventure\school\basic\MaritalStatusController');
Route::resource('imageupload', 'com\adventure\school\basic\ImageUploadController');
Route::resource('educationdegree', 'com\adventure\school\basic\EducationDegreeController');
// Employee Settings
Route::resource('employees', 'com\adventure\school\employee\EmployeeController');
// Program Settings
Route::resource('session', 'com\adventure\school\program\SessionControler');
Route::resource('plevel', 'com\adventure\school\program\PLevelControler');
Route::resource('program', 'com\adventure\school\program\ProgramControler');
Route::resource('levelprogram', 'com\adventure\school\program\LevelProgramController');
Route::resource('group', 'com\adventure\school\program\GroupControler');
Route::resource('programgroup', 'com\adventure\school\program\ProgramGroupController');
Route::resource('medium', 'com\adventure\school\program\MediumControler');
Route::resource('shift', 'com\adventure\school\program\ShiftControler');
Route::get('programoffer/getValue', 'com\adventure\school\program\ProgramOfferController@getValue');
Route::resource('programoffer', 'com\adventure\school\program\ProgramOfferController');
Route::resource('course', 'com\adventure\school\program\CourseController');
Route::resource('coursecode', 'com\adventure\school\program\CourseCodeController');
Route::resource('sections', 'com\adventure\school\program\SectionController');
Route::resource('markcategory', 'com\adventure\school\program\MarkCategoryController');
Route::resource('gradeletter', 'com\adventure\school\program\GradeLetterController');
Route::get('gradepoint', 'com\adventure\school\program\GradePointController@createGratePoint');
Route::post('gradepoint', 'com\adventure\school\program\GradePointController@createGratePoint');
Route::get('gradepoint/edit', 'com\adventure\school\program\GradePointController@editGratePoint');
Route::post('gradepoint/edit', 'com\adventure\school\program\GradePointController@editGratePoint');
Route::get('gradepoint/getValue', 'com\adventure\school\program\GradePointController@getValue');
Route::resource('coursetype', 'com\adventure\school\program\CourseTypeController');

// Admission program settings
Route::get('admissionprogram/getValue','com\adventure\school\admission\AdmissionProgramController@getValue');
Route::resource('admissionprogram', 'com\adventure\school\admission\AdmissionProgramController');
Route::resource('startend', 'com\adventure\school\admission\AppStartEndController');
Route::get('admissionprogramsubject/getValue','com\adventure\school\admission\AdmissionProgramSubjectController@getValue');
Route::resource('admissionprogramsubject', 'com\adventure\school\admission\AdmissionProgramSubjectController');
Route::get('admissionfee/pay','com\adventure\school\admission\AdmissionFeeController@index1');
Route::post('admissionfee/pay','com\adventure\school\admission\AdmissionFeeController@index1');
Route::get('admissionfee/{id}/payment','com\adventure\school\admission\AdmissionFeeController@payment');
Route::post('admissionfee/payment','com\adventure\school\admission\AdmissionFeeController@Paymentstore');
Route::resource('admissionfee','com\adventure\school\admission\AdmissionFeeController');
Route::get('admissionmarkentry/getValue','com\adventure\school\admission\AdmissionMarkEntryController@getValue');
Route::get('admissionmarkentry','com\adventure\school\admission\AdmissionMarkEntryController@markEntry');
Route::post('admissionmarkentry','com\adventure\school\admission\AdmissionMarkEntryController@markEntry');
Route::get('admissionmarkentry/edit','com\adventure\school\admission\AdmissionMarkEntryController@markEdit');
Route::post('admissionmarkentry/edit','com\adventure\school\admission\AdmissionMarkEntryController@markEdit');
Route::get('admissionresults', 'com\adventure\school\admission\AdmissionResultController@resultDisplay');
Route::post('admissionresults', 'com\adventure\school\admission\AdmissionResultController@resultDisplay');
// Course offer settings
Route::resource('mearges', 'com\adventure\school\courseoffer\MeargeController');
Route::get('courseoffercreate/getValue','com\adventure\school\courseoffer\CourseOfferController@getValue');
Route::get('courseoffercreate','com\adventure\school\courseoffer\CourseOfferController@courseofferCreate');
Route::post('courseoffercreate','com\adventure\school\courseoffer\CourseOfferController@courseofferCreate');
Route::get('meargeoffer/getValue','com\adventure\school\courseoffer\MeargeOfferControllder@getValue');
Route::DELETE('meargeoffer/delete', 'com\adventure\school\courseoffer\MeargeOfferControllder@deleteMerge');
Route::resource('meargeoffer', 'com\adventure\school\courseoffer\MeargeOfferControllder');
Route::get('sectionoffer/getValue','com\adventure\school\courseoffer\SectionOfferController@getValue');
Route::resource('sectionoffer', 'com\adventure\school\courseoffer\SectionOfferController');

Route::get('markdistribution/getValue','com\adventure\school\courseoffer\MarkDistributionController@getValue');
Route::get('markdistribution','com\adventure\school\courseoffer\MarkDistributionController@createMarkdistribution');
Route::post('markdistribution','com\adventure\school\courseoffer\MarkDistributionController@createMarkdistribution');
Route::get('markdistribution/edit','com\adventure\school\courseoffer\MarkDistributionController@editMarkdistribution');
Route::post('markdistribution/edit','com\adventure\school\courseoffer\MarkDistributionController@editMarkdistribution');
// Academic Settings
Route::get('student', 'com\adventure\school\academic\StudentController@applicantSearch');
Route::get('student/create', 'com\adventure\school\academic\StudentController@goback');
Route::post('student/create', 'com\adventure\school\academic\StudentController@studentReg');
Route::get('students/getValue','com\adventure\school\academic\StudentController@getValue');
Route::get('students', 'com\adventure\school\academic\StudentController@allStudentReg');
Route::post('students', 'com\adventure\school\academic\StudentController@allStudentReg');
Route::get('directenroll', 'com\adventure\school\academic\StdDirectEnrollController@stdDirectEroll');
Route::post('directenroll', 'com\adventure\school\academic\StdDirectEnrollController@stdDirectEroll');
Route::get('studentimport', 'com\adventure\school\academic\StudentImportController@studentImport');
Route::post('studentimport', 'com\adventure\school\academic\StudentImportController@studentImport');
Route::get('studentimport/export', 'com\adventure\school\academic\StudentImportController@export');
Route::get('studentimport/index', 'com\adventure\school\academic\StudentImportController@index');
// Class Exam Settings
Route::resource('examname', 'com\adventure\school\exam\ExamNameController');
Route::get('masterexam/getValue', 'com\adventure\school\exam\MasterExamController@getValue');
Route::get('masterexam', 'com\adventure\school\exam\MasterExamController@masterExamCrete');
Route::post('masterexam', 'com\adventure\school\exam\MasterExamController@masterExamCrete');
Route::get('masterexam/{id}/edit', 'com\adventure\school\exam\MasterExamController@masterExamCrete');
Route::post('masterexam/{id}/edit', 'com\adventure\school\exam\MasterExamController@masterExamCrete');
Route::get('childexam', 'com\adventure\school\exam\ChildExamController@childExamCrete');
Route::post('childexam', 'com\adventure\school\exam\ChildExamController@childExamCrete');
Route::get('childexam/{id}/edit', 'com\adventure\school\exam\ChildExamController@childExamCrete');
Route::post('childexam/{id}/edit', 'com\adventure\school\exam\ChildExamController@childExamCrete');
Route::get('childexam/getValue', 'com\adventure\school\exam\ChildExamController@getValue');
// Mark Entry
Route::get('mstexammarkentry', 'com\adventure\school\classexam\MstExamMarkEntryController@marksentry');
Route::post('mstexammarkentry', 'com\adventure\school\classexam\MstExamMarkEntryController@marksentry');
Route::get('mstexammarkedit', 'com\adventure\school\classexam\MstExamMarkEntryController@marksedit');
Route::post('mstexammarkedit', 'com\adventure\school\classexam\MstExamMarkEntryController@marksedit');
// Class Result
Route::get('mstexamresult', 'com\adventure\school\classexam\MstExamResultController@mstexamresult');
// Menu Settings
Route::resource('menu', 'com\adventure\school\menu\MenuController');

// Role Settings
Route::resource('permission', 'com\adventure\school\role\PermissionController');
Route::get('role/getValue', 'com\adventure\school\role\RoleController@getValue');
Route::resource('role', 'com\adventure\school\role\RoleController');
// User Manager
Route::resource('user', 'com\adventure\school\usermanager\UserManagerController');

// ===========================================
// route For School front part
Route::get('/','SchoolHomeController@index');
Route::get('/admission/applicantcopy','com\adventure\school\admission\AdmissionController@applicantCopyPage');
Route::post('/admission/applicantcopy','com\adventure\school\admission\AdmissionController@applicantCopy');
Route::get('/admission/admitcard','com\adventure\school\admission\AdmissionController@getAdmitCardForm');
Route::post('/admission/admitcard','com\adventure\school\admission\AdmissionController@getAdmitCard');
Route::get('/admission/admissionresult','com\adventure\school\admission\AdmissionController@admissionResultForm');
Route::post('/admission/admissionresult','com\adventure\school\admission\AdmissionController@getAplicantResult');
Route::get('/admission/getValue','com\adventure\school\admission\AdmissionController@getValue');
Route::get('/admission/changeAddress','com\adventure\school\admission\AdmissionController@changeAddress');
Route::resource('admission', 'com\adventure\school\admission\AdmissionController');
