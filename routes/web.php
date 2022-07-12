<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailsettingsController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\UserRegister_Controller;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalExcellenceController;
// use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IfTermination;

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
Route::get('/test2','HomeController@test2');
Route::get('/index_2', 'HomeController@test')->name('index_2');
Route::get('/home', 'HomeController@HomepageUrl')->name('home')->middleware('isTerminated');
Route::post('/import_employees', 'EmployeeController@import_employees')->name('import_employees');
Route::get('/index', 'HomeController@adminHome')->name('index')->middleware('isTerminated')->middleware('is_admin');
Route::get('/', function () {
         return redirect('index');
        //return view('auth/login');
    });

/*2 FA*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('2fa');
Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

	
  
Route::middleware(['App\Http\Middleware\AuthCheck','isTerminated','App\Http\Middleware\Check2FA'])->group(function () {

// Route::get('/index', function () {
//     return view('index');
// })->name('page');

Route::get('/employee-dashboard', function () {
    return view('employee-dashboard');
});
Route::get('/chat', function () {
    return view('chat');
});
Route::get('/voice-call', function () {
    return view('voice-call');
});
Route::get('/video-call', function () {
    return view('video-call');
});
Route::get('/outgoing-call', function () {
    return view('outgoing-call');
});
Route::get('/incoming-call', function () {
    return view('incoming-call');
});
Route::get('/events', function () {
    return view('events');
});
Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/inbox', function () {
    return view('inbox');
});
Route::get('/file-manager', function () {
    return view('file-manager');
});
// Route::get('/employees', function () {
//     return view('employees');
// });
Route::get('/employees','EmployeeController@employees')->name('employees');
Route::get('/getDesignationAjax','EmployeeController@getDesignationAjax')->name('getDesignationAjax');
Route::get('/designationList','EmployeeController@designationList')->name('designationList');
Route::post('add_employee','EmployeeController@add_employee')->name('add_employee');
Route::post('delete_employee','EmployeeController@delete_employee')->name('delete_employee');
Route::post('edit_employee','EmployeeController@edit_employee')->name('edit_employee');
Route::post('update_employee','EmployeeController@update_employee')->name('update_employee');
Route::get('search_employee','EmployeeController@search_employee')->name('search_employee');

//leave routes start --BY URMI SHAH
Route::get('/leave-settings','LeaveTypeController@index')->name('leave-settings');
Route::post('/save_leave_settings','LeaveTypeController@save_leave_settings')->name('save_leave_settings');
Route::get('/leaves-employee','EmployeeLeaveController@index')->name('leaves-employee');
Route::post('/save_leave','EmployeeLeaveController@save_leave')->name('save_leave');
Route::post('/update_leave','EmployeeLeaveController@update_leave')->name('update_leave');
Route::get('/delete_emp_leave/{id}','EmployeeLeaveController@delete_leave')->name('delete_leave');
Route::get('/edit_emp_leave/{id}','EmployeeLeaveController@edit_leave')->name('edit_leave');
Route::get('/leaves','AdminLeaveController@index')->name('leaves');
Route::get('/leave-calender','AdminLeaveController@leave_calender')->name('leave-calender');
Route::get('/leave_render','AdminLeaveController@leave_render')->name('leave_render');
Route::get('/change_leave_status/{type}/{id}','AdminLeaveController@change_leave_status')->name('change_leave_status');
Route::post('search_leave_employees','AdminLeaveController@search_leave_employee')->name('search_leave_employees');
Route::post('/add_manager_comment','AdminLeaveController@add_manager_comment')->name('add_manager_comment');
//leave routes end


Route::get('/holidays', 'HolidayController@list')->name('holidays');
Route::post('save-holiday','HolidayController@save')->name('holiday.save');
Route::get('/delete-holiday/{id?}', 'HolidayController@delete')->name('holiday.delete');
Route::post('/update-holiday', 'HolidayController@update')->name('holiday.update');
Route::get('/get-holidays','HolidayController@getHolidays');

Route::get('/attendance', function () {
    return view('attendance');
});
Route::get('/attendance-employee', function () {
    return view('attendance-employee');
});
// Route::get('/departments', function () {
//     return view('departments');
// });


Route::get('/timesheet', function () {
    return view('timesheet');
});
Route::get('/overtime', function () {
    return view('overtime');
});
Route::get('/clients', function () {
    return view('clients');
});
Route::get('/projects', function () {
    return view('projects');
});
Route::get('/tasks', function () {
    return view('tasks');
});
Route::get('/task-board', function () {
    return view('task-board');
});
Route::get('/leads', function () {
    return view('leads');
});
Route::get('/tickets', function () {
    return view('tickets');
});
Route::get('/estimates', function () {
    return view('estimates');
});
Route::get('/invoices', function () {
    return view('invoices');
});
Route::get('/payments', function () {
    return view('payments');
});
Route::get('/expenses', function () {
    return view('expenses');
});
Route::get('/provident-fund', function () {
    return view('provident-fund');
});
Route::get('/taxes', function () {
    return view('taxes');
});
Route::get('/salary', function () {
    return view('salary');
});
Route::get('/salary-view', function () {
    return view('salary-view');
});
Route::get('/payroll-items', function () {
    return view('payroll-items');
});
Route::get('/policies', function () {
    return view('policies');
});
Route::get('/expense-reports', function () {
    return view('expense-reports');
});
Route::get('/invoice-reports', function () {
    return view('invoice-reports');
});
// Route::get('/performance-indicator', function () {
//     return view('performance-indicator');
// });
//Route::get('/performance-indicator','IndicatorController@indicators');
Route::get('/performance', function () {
    return view('performance');
});
Route::get('/performance-appraisal', function () {
    return view('performance-appraisal');
});
Route::get('/goal-tracking', function () {
    return view('goal-tracking');
});
Route::get('/goal-type', function () {
    return view('goal-type');
});
Route::get('/training', function () {
    return view('training');
});
Route::get('/trainers', function () {
    return view('trainers');
});
Route::get('/training-type', function () {
    return view('training-type');
});
// Route::get('/promotion', function () {
//     return view('promotion');
// });
Route::get('/promotion','PromotionController@index')->name('promotions');
Route::post('/add-promotion','PromotionController@addPromotion')->name('add-promotion');
Route::get('/getdesignation','PromotionController@getDesignation')->name('getdesignation');
Route::get('/edit-promotion','PromotionController@editPromotion')->name('edit-promotion');
Route::post('/update-promotion','PromotionController@updatePromotion')->name('update-promotion');
Route::post('/delete-promotion','PromotionController@deletePromotion')->name('delete-promotion');
// Route::get('/resignation', function () {
//     return view('resignation');
// });

Route::get('/termination', 'TerminationController@list')->name('termination');
Route::post('/create-termination', 'TerminationController@save')->name('termination.save');
Route::post('/update-termination', 'TerminationController@update')->name('termination.update');
Route::get('/delete-termination/{id?}', 'TerminationController@delete')->name('termination.delete');
Route::get('/open-termination-create-form/{id?}', 'TerminationController@openCreateForm')->name('termination.openCreateForm');




// Route::get('/resignation', function () {
//     return view('resignation');
// });
Route::get('/resignation', 'ResignationController@index')->name('resignations');
Route::post('/add-resignation', 'ResignationController@addResignation')->name('add-resignation');
Route::get('/edit-resignation', 'ResignationController@editResignation')->name('edit-resignation');
Route::post('/update-resignation', 'ResignationController@updateResignation')->name('update-resignation');
Route::post('/delete-resignation', 'ResignationController@deleteResignation')->name('delete-resignation');

Route::get('/assets', function () {
    return view('assets');
});
Route::get('/jobs', function () {
    return view('jobs');
});
Route::get('/jobs-applicants', function () {
    return view('jobs-applicants');
});
Route::get('/knowledgebase', function () {
    return view('knowledgebase');
});
// Route::get('/activities', function () {
//     return view('activities');
// });
Route::get('activities','NotificationController@index')->name('activities');
Route::get('/users', function () {
    return view('users');
});
// Route::get('/settings', function () {
//     return view('settings');
// });
Route::get('settings','SettingController@settings')->name('settings');

Route::get('organizational-chart', 'EmployeeController@getOrganizationalChart')->name('organizational-chart');

Route::post('setting_update','SettingController@setting_update')->name('setting_update');
Route::get('/localization', function () {
    return view('localization');
});
Route::get('theme-settings','SettingController@theme_settings')->name('theme-settings');
Route::get('/performance-setting','SettingController@performance_settings')->name('performance-settings');
Route::post('theme_setting_update','SettingController@theme_setting_update')->name('theme_setting_update');
Route::post('save_okr','PerformanceSettingController@save_okr')->name('save_okr');
Route::post('save_competency','PerformanceSettingController@save_competency')->name('save_competency');
Route::post('save_smart_config','PerformanceSettingController@save_smart_config')->name('save_smart_config');
Route::post('save_scale2','PerformanceSettingController@save_scale2')->name('save_scale2');
Route::post('get_scale2','PerformanceSettingController@get_scale2')->name('get_scale2');
Route::post('get_c_scale2','PerformanceSettingController@get_c_scale2')->name('get_c_scale2');
Route::post('save_c_scale2','PerformanceSettingController@save_c_scale2')->name('save_c_scale2');
Route::post('get_s_scale2','PerformanceSettingController@get_s_scale2')->name('get_s_scale2');
Route::post('save_s_scale2','PerformanceSettingController@save_s_scale2')->name('save_s_scale2');
Route::post('save_compentency_info','PerformanceSettingController@save_compentency_info')->name('save_compentency_info');
Route::post('delete_compentency_info','PerformanceSettingController@delete_compentency_info')->name('save_compentency_info');
Route::post('edit_compentency_info','PerformanceSettingController@edit_compentency_info')->name('edit_compentency_info');
Route::get('changeStatus/{id}','PerformanceSettingController@changeStatus')->name('changeStatus');

// Route::get('/theme-settings', function () {
//     return view('theme-settings');
// });
// Route::get('/roles-permissions', function () {
//     return view('roles-permissions');
// });
Route::get('/roles-permissions','RoleController@roles_permissions');
Route::post('add_role','RoleController@add_role')->name('add_role');
Route::post('edit_role','RoleController@edit_role')->name('edit_role');
Route::post('delete_role','RoleController@delete_role')->name('delete_role');
Route::post('changeModuleAccess','RoleController@changeModuleAccess')->name('changeModuleAccess');
Route::post('updateModulePermission','RoleController@updateModulePermission')->name('updateModulePermission');
Route::get('getCheckedValues','RoleController@getCheckedValues')->name('getCheckedValues');
Route::get('GetModuleAccess','RoleController@GetModuleAccess')->name('GetModuleAccess');
Route::get('GetRoleModuleAccess','RoleController@GetRoleModuleAccess')->name('GetRoleModuleAccess');



Route::get('/email-settings', function () {
    return view('email-settings');
});
Route::get('/invoice-settings', function () {
    return view('invoice-settings');
});
Route::get('/salary-settings', function () {
    return view('salary-settings');
});
Route::get('/notifications-settings', function () {
    return view('notifications-settings');
});
Route::get('/change-password', function () {
    return view('change-password');
});
Route::get('/termination-type', 'TerminationController@listTypes')->name('termination-type');
Route::post('/create-termination-type', 'TerminationController@saveType')->name('termination-type.save');
Route::post('/update-termination-type', 'TerminationController@updateType')->name('termination-type.update');
Route::get('/termination-type/{id?}/status/{status?}', 'TerminationController@changeTypeStatus')->name('termination-type.changestatus');
Route::get('/delete-termination-type/{id?}', 'TerminationController@deleteType')->name('termination-type.delete');


Route::get('/leave-type', function () {
    return view('leave-type');
});
// Route::get('/profile', function () {
//     return view('profile');
// });
Route::get('/client-profile', function () {
    return view('client-profile');
});
// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/otp', function () {
    return view('otp');
});
Route::get('/lock-screen', function () {
    return view('lock-screen');
});
Route::get('/error-404', function () {
    return view('error-404');
});
Route::get('/error-500', function () {
    return view('error-500');
});
Route::get('/subscriptions', function () {
    return view('subscriptions');
});
Route::get('/subscriptions-company', function () {
    return view('subscriptions-company');
});
Route::get('/subscribed-companies', function () {
    return view('subscribed-companies');
});
Route::get('/search', function () {
    return view('search');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
Route::get('/blank-page', function () {
    return view('blank-page');
});
Route::get('/components', function () {
    return view('components');
});
Route::get('/form-basic-inputs', function () {
    return view('form-basic-inputs');
});
Route::get('/form-input-groups', function () {
    return view('form-input-groups');
});
Route::get('/form-horizontal', function () {
    return view('form-horizontal');
});
Route::get('/form-vertical', function () {
    return view('form-vertical');
});
Route::get('/form-mask', function () {
    return view('form-mask');
});
Route::get('/form-validation', function () {
    return view('form-validation');
});
Route::get('/tables-basic', function () {
    return view('tables-basic');
});
Route::get('/data-tables', function () {
    return view('data-tables');
});
Route::get('/create-estimate', function () {
    return view('create-estimate');
});
Route::get('/create-invoice', function () {
    return view('create-invoice');
});
Route::get('/clients-list', function () {
    return view('clients-list');
});
Route::get('/compose', function () {
    return view('compose');
});
Route::get('/edit-estimate', function () {
    return view('edit-estimate');
});
Route::get('/edit-invoice', function () {
    return view('edit-invoice');
});
Route::get('/estimate-view', function () {
    return view('estimate-view');
});
Route::get('/job-view', function () {
    return view('job-view');
});
Route::get('/job-list', function () {
    return view('job-list');
});
Route::get('/job-details', function () {
    return view('job-details');
});
Route::get('/knowledgebase-view', function () {
    return view('knowledgebase-view');
});
Route::get('/mail-view', function () {
    return view('mail-view');
});
Route::get('/project-list', function () {
    return view('project-list');
});
Route::get('/project-view', function () {
    return view('project-view');
});
Route::get('/ticket-view', function () {
    return view('ticket-view');
});
Route::get('/invoice-view', function () {
    return view('invoice-view');
});
Route::get('/employees-list', function () {
    return view('employees-list');
});
Route::get('/shift-scheduling', function () {
    return view('shift-scheduling');
});
Route::get('/shift-list', function () {
    return view('shift-list');
});
Route::get('/categories', function () {
    return view('categories');
});
Route::get('/budgets', function () {
    return view('budgets');
});
Route::get('/budget-expenses', function () {
    return view('budget-expenses');
});
Route::get('/budget-revenues', function () {
    return view('budget-revenues');
});
Route::get('/payments-reports', function () {
    return view('payments-reports');
});
Route::get('/project-reports', function () {
    return view('project-reports');
});
Route::get('/task-reports', function () {
    return view('task-reports');
});
Route::get('/user-reports', function () {
    return view('user-reports');
});
Route::get('/employee-reports', function () {
    return view('employee-reports');
});
Route::get('/payslip-reports', function () {
    return view('payslip-reports');
});
Route::get('/attendance-reports', function () {
    return view('attendance-reports');
});
Route::get('/leave-reports', function () {
    return view('leave-reports');
});
Route::get('/daily-reports', function () {
    return view('daily-reports');
});
Route::get('/user-dashboard', function () {
    return view('user-dashboard');
})->name('user-dashboard');
Route::get('/jobs-dashboard', function () {
    return view('jobs-dashboard');
})->name('jobs-dashboard');
Route::get('/manage-resumes', function () {
    return view('manage-resumes');
});
Route::get('/shortlist-candidates', function () {
    return view('shortlist-candidates');
});
Route::get('/interview-questions', function () {
    return view('interview-questions');
});
Route::get('/offer-approvals', function () {
    return view('offer-approvals');
});
Route::get('/experience-level', function () {
    return view('experience-level');
});
Route::get('/candidates', function () {
    return view('candidates');
});
Route::get('/schedule-timing', function () {
    return view('schedule-timing');
});
Route::get('/apptitude-result', function () {
    return view('apptitude-result');
});
Route::get('/toxbox-setting', function () {
    return view('toxbox-setting');
});
Route::get('/cron-setting', function () {
    return view('cron-setting');
});

Route::get('/approval-setting', function () {
    return view('approval-setting');
});
Route::get('/user-all-jobs', function () {
    return view('user-all-jobs');
});
Route::get('/saved-jobs', function () {
    return view('saved-jobs');
});
Route::get('/applied-jobs', function () {
    return view('applied-jobs');
});
Route::get('/interviewing', function () {
    return view('interviewing');
});
Route::get('/offered-jobs', function () {
    return view('offered-jobs');
});
Route::get('/visited-jobs', function () {
    return view('visited-jobs');
});
Route::get('/archived-jobs', function () {
    return view('archived-jobs');
});
Route::get('/sub-category', function () {
    return view('sub-category');
});


Route::get('email-settings','EmailsettingsController@Emailsettings')->name('emailsettings');
Route::post('email_setting_update','EmailsettingsController@Emailsetting_update')->name('emailsetting_update');
Route::get('/performance-indicator','IndicatorController@indicators')->name('indicators');
Route::get('/my-performance/{id}','MyPerfomanceCycleController@my_performance_data')->name('my-performance');
Route::post('add_indicator','IndicatorController@add_indicator')->name('add_indicators');
Route::post('edit_indicator','IndicatorController@edit_indicator')->name('edit_indicators');
Route::post('delete_indicator','IndicatorController@delete_indicator')->name('delete_indicator');
Route::get('changestatusDropdown/{type}/{id}','IndicatorController@changestatusDropdown')->name('changestatusDropdown');
Route::get('/performance-appraisal','AppraisalController@appraisal')->name('appraisal');
Route::post('add_appraisal','AppraisalController@add_appraisal')->name('add_appraisal');
Route::post('edit_appraisal','AppraisalController@edit_appraisal')->name('edit_appraisal');
Route::post('delete_appraisal','AppraisalController@delete_appraisal')->name('delete_appraisal');
Route::get('change_appraisal_status/{type}/{id}','AppraisalController@change_appraisal_status')->name('change_appraisal_status');
Route::get('/notifications-settings','NotificationsettController@notificationsetting');
Route::post('changeNotificationAccess','NotificationsettController@changeNotificationAccess')->name('chg_Notifi');
Route::get('/performance','PerfomanceController@Perfomance_emp')->name('perfomanceemp');
Route::get('/employee-dashboard','HomeController@index')->name('emp.home')->middleware('isTerminated');
Route::get('/performance','ProfessionalExcellenceController@ProfessionalExcellence')->name('professionals');
Route::post('add_professionalexcel','ProfessionalExcellenceController@add_ProfessionalExcellence')->name('add_professionalexcel');
Route::post('add_personalexcel','PersonalExcellencesController@add_PersonalExcellence')->name('add_personalexcel');
Route::post('add_specialInitiatives','SpecialInitiativesController@store_SpecialInitiatives')->name('add_specialInitiatives');
Route::post('add_commentsRole','CommentsRolesController@store_CommentsRole')->name('add_commentsRole');
Route::post('add_additioncommentRole','AdditionCommentRoleController@store_AdditionCommentRole')->name('add_additioncommentRole');
Route::post('add_appraiseestrength','AppraiseeStrengthsController@store_AppraiseeStrength')->name('add_appraiseestrength');
Route::post('add_personalGoal','PersonalGoalController@store_PersonalGoal')->name('add_personalGoal');
Route::post('add_professional_achived','ProfessionalGoalsAchievedController@store_ProfessionalGoalsAchieved')->name('add_professional_achived');
Route::post('add_professional_forthcoming','ProfessionalGoalsForthcomingController@store_ProfessionalGoalsForthcoming')->name('add_professional_forthcoming');
Route::post('add_training_requirements','TrainingRequirementsController@store_TrainingRequirements')->name('add_training_requirements');
Route::post('add_general_comment','OtherGeneralCommentController@store_OtherGeneralComment')->name('add_general_comment');
Route::post('add_perfomancemanageruse','PerfomanceManagerUseController@store_PerfomanceManagerUse')->name('add_perfomancemanageruse');
Route::post('add_perfomanceIdentitie','PerformanceIdentitiesController@store_PerformanceIdentity')->name('add_perfomanceIdentitie');
Route::get('/employees-performance','EmployeePerformanceController@get_employees')->name('employees_perfomance')->middleware('isemployeepermission');
Route::get('/edit-performance/{id}/{perfomance_date}','EmployeePerformanceController@edit_employees')->name('employees_per')->middleware('isemployeepermission');
Route::get('/edit-performance/{id}/{perfomance_date}','EmployeePerformanceController@edit_employees')->name('employees_per')->middleware('isemployeepermission');
Route::get('/add-myperformance/{id}/','MyPerfomanceCycleController@add_myperformance_datewise')->name('add-myperformance');
Route::get('edit-performance/{id}/{perfomance_date}','EmployeePerformanceController@edit_employees')->name('employees_per');
Route::post('/edit_man_professionalExcellence','EmployeePerformanceController@add_manager_ProfessionalExcellence')->name('edit_man_professionalExcellence');
Route::post('/edit_professionalExcellence','MyPerfomanceCycleController@myperformance_manager_ProfessionalExcellence')->name('edit_professionalExcellence');
Route::post('/myperformance_PersonalExcellence','MyPerfomanceCycleController@myperformance_PersonalExcellence')->name('myperformance_PersonalExcellence');
Route::post('/myperformance_SpecialInitiatives','MyPerfomanceCycleController@myperformance_SpecialInitiatives')->name('myperformance_SpecialInitiatives');
Route::post('/myperformance_OtherGeneralComment','MyPerfomanceCycleController@myperformance_OtherGeneralComment')->name('myperformance_OtherGeneralComment');
 


Route::post('/edit_man_PersonalExcellence','EmployeePerformanceController@add_manager_PersonalExcellence')->name('edit_man_PersonalExcellence');
Route::post('/edit_man_SpecialInitiatives','EmployeePerformanceController@add_manager_SpecialInitiatives')->name('edit_man_SpecialInitiatives');
Route::post('/edit_man_CommentsRole','EmployeePerformanceController@add_manager_CommentsRole')->name('edit_man_CommentsRole');
Route::post('/edit_man_AdditionComment','EmployeePerformanceController@add_manager_AdditionCommentRole')->name('edit_man_AdditionComment');
Route::post('/edit_man_AppraiseeStrength','EmployeePerformanceController@add_manager_AppraiseeStrength')->name('edit_man_AppraiseeStrength');
Route::post('/edit_man_PersonalGoal','EmployeePerformanceController@add_manager_PersonalGoal')->name('edit_man_PersonalGoal');
Route::post('/edit_man_ProfessionalGoalsAchieved','EmployeePerformanceController@add_manager_ProfessionalGoalsAchieved')->name('edit_man_ProfessionalGoalsAchieved');
Route::post('/edit_man_ProfessionalGoalsForthcoming','EmployeePerformanceController@add_manager_ProfessionalGoalsForthcoming')->name('edit_man_ProfessionalGoalsForthcoming');
Route::post('/edit_man_TrainingRequirements','EmployeePerformanceController@add_manager_TrainingRequirements')->name('edit_man_TrainingRequirements');
Route::post('/edit_man_OtherGeneralComment','EmployeePerformanceController@add_manager_OtherGeneralComment')->name('edit_man_OtherGeneralComment');
Route::post('/edit_man_PerfomanceManagerUse','EmployeePerformanceController@add_manager_PerfomanceManagerUse')->name('edit_man_PerfomanceManagerUse');
Route::post('/edit_manPerformanceIdentity','EmployeePerformanceController@add_manager_PerformanceIdentity')->name('edit_manPerformanceIdentity');
Route::post('search_employee_perfomance','EmployeePerformanceController@search_employee_Perfomance')->name('search_employee_perfomance');
Route::post('add_managerid_Employee','EmployeePerformanceController@add_managerid_EmployeeBasicInfo')->name('add_managerid_Employees');
Route::get('profile/{id}','ProfileController@Profile_employees')->name('profile_details');
Route::post('add_personal_info','ProfileController@add_profile_personal_informations')->name('add_personal_info');
Route::post('add_emergency_contact','ProfileController@add_profile_emergency_contact')->name('add_emergency_contact');
Route::get('/profile-employee-warning/{id}','EmployeeVerbalWarningController@Profile_EmployeeVerbalWarning_list')->name('Edit_Profile_Warning');
Route::get('success_status','EmployeePerformanceController@success_Perfomance_status')->name('success_status');
Route::post('employee_document','ProfileController@employee_document')->name('employee_document');
Route::get('employee_documents_delete/{id}','ProfileController@employee_document_delete')->name('employee_document_delete');
Route::post('add_Perfomance_status','EmployeePerformanceController@add_Perfomance_status_user')->name('add_Perfomance_status');
Route::post('add_read_notification_status','NotificationController@add_read_notification_status')->name('add_read_notification_status');
Route::post('add_Perfomance_status_user_for_employee','EmployeePerformanceController@add_Perfomance_status_user_for_employee')->name('add_Perfomance_status_user_for_employee');
Route::post('add_Perfomance_date_for_employee','EmployeePerformanceController@add_Perfomance_date_for_employee')->name('add_Perfomance_date_for_employee');
Route::post('add_KeyprofessionalExcellences',[ProfessionalExcellenceController::class,'store_KeyprofessionalExcellences'])->name('add_KeyprofessionalExcellences');
Route::get('employee-warning','EmployeeVerbalWarningController@EmployeeFirstVerbalWarning_list')->name('employee-warning');
Route::post('add_EmployeeFirstVerbalWarning','EmployeeVerbalWarningController@store_EmployeeFirstVerbalWarning')->name('add_EmployeeFirstVerbalWarning');
Route::post('update_EmployeeFirstVerbal','EmployeeVerbalWarningController@update_EmployeeFirstVerbalWarning')->name('update_EmployeeFirstVerbalWarning');
Route::post('delete_EmpVerbalWarning','EmployeeVerbalWarningController@delete_EmployeeVerbalWarning')->name('delete_EmpVerbalWarning');
Route::get('changeFirstWarningstatus/{type}/{id}','EmployeeVerbalWarningController@changeFirstWarningstatus')->name('changeFirstWarningstatus');
Route::post('add_EmployeeSecondVerbalWarning','EmployeeVerbalWarningController@store_EmployeeSecondVerbalWarning')->name('add_EmployeeSecondVerbalWarning');
Route::post('update_EmpSecondVerbalWarning','EmployeeVerbalWarningController@update_EmployeeSecondVerbalWarning')->name('update_EmployeeSecondVerbalWarning');
Route::post('delete_secondEmpVerbalWarning','EmployeeVerbalWarningController@delete_EmployeeSecondVerbalWarning')->name('delete_secondEmpVerbalWarning');
Route::get('changeSecondWarningstatus/{type}/{id}','EmployeeVerbalWarningController@changeSecondWarningstatus')->name('changeSecondWarningstatus');
Route::post('add_EmployeeThirdVerbalWarning','EmployeeVerbalWarningController@store_EmployeeThirdVerbalWarning')->name('add_EmployeeThirdVerbalWarning');
Route::post('update_EmpThirdVerbalWarning','EmployeeVerbalWarningController@update_EmployeeThirdVerbalWarning')->name('update_EmployeeThirdVerbalWarning');
Route::post('delete_EmpThirdVerbalWarning','EmployeeVerbalWarningController@delete_EmployeeThirdVerbalWarning')->name('delete_EmployeeThirdVerbalWarning');
Route::get('changeThirdWarningstatus/{type}/{id}','EmployeeVerbalWarningController@changeThirdWarningstatus')->name('changeThirdWarningstatus'); 
});

/// Remaning Leave
Route::get('/maternity_remaining_leave_type','EmployeeLeaveController@maternity_remaining_leave_type')->name('maternity_remaining_leave_type');
Route::get('/Sick_remaining_leave_type','EmployeeLeaveController@Sick_remaining_leave_type')->name('Sick_remaining_leave_type');
Route::get('/Hospitalisation_remaining_leave_type','EmployeeLeaveController@Hospitalisation_remaining_leave_type')->name('Hospitalisation_remaining_leave_type');
Route::get('/Paternity_remaining_leave_type','EmployeeLeaveController@Paternity_remaining_leave_type')->name('Paternity_remaining_leave_type');

Route::get('/Edit_Sick_remaining_leave_type','EmployeeLeaveController@Edit_Sick_remaining_leave_type')->name('Edit_Sick_remaining_leave_type');


//// Admin Approve Mail
Route::post('/send-mail-adminapp','ProfileController@send_mail_adminapprove')->name('send-mail-adminapp');
Route::post('/add_approve_status_for_employee','ProfileController@add_approve_status_for_employee')->name('add_approve_status_for_employee');


Route::get('/resetpassword', 'PasswordResetController@forgotpassword')->name('resetpassword');
Route::post('/resetpassword', 'PasswordResetController@sendmail');
Route::get('/resetnewpassword/{id}/{token}', 'PasswordResetController@resetpassword');
Route::post('/resetnewpassword/{id}/{token}', 'PasswordResetController@setnewpassword');

 Route::post('clear_notification','NotificationController@clear_notification')->name('clear_notification');

// Route::get('/register', function () {
//     return view('authregister');
// });

// Route::get('/testpusher', function () {
//     event(new App\Events\PromotionAdded('Added'));
//     return "Event has been sent!";
// });
Route::middleware([IfAdmin::class])->group(function () {
    Route::get('/departments','DepartmentController@departments')->name('departments');
    Route::post('add_deaprtment','DepartmentController@add_department')->name('add_department');
    Route::post('edit_department','DepartmentController@edit_department')->name('edit_department');
    Route::post('delete_department','DepartmentController@delete_department')->name('delete_department');
    
    Route::get('/locations','LocationController@locations')->name('locations');
    Route::post('add_location','LocationController@add_location')->name('add_location');
    Route::post('edit_location','LocationController@edit_location')->name('edit_location');
    Route::post('delete_location','LocationController@delete_location')->name('delete_location');
    
    
    Route::get('/designations','DesignationController@designations')->name('designations');
    Route::post('add_designation','DesignationController@add_designation')->name('add_designation');
    Route::post('edit_designation','DesignationController@edit_designation')->name('edit_designation');
    Route::post('delete_designation','DesignationController@delete_designation')->name('delete_designation');
     
    
    
    });

Auth::routes();
    
Route::namespace('Auth')->group(function(){

    //Login Routes
    Route::get('/login','LoginController@showLoginForm')->name('login');
	 
    Route::post('/login','LoginController@login');
	 
    Route::post('/logout','LoginController@logout')->name('logout');

    //Forgot Password Routes
    // Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    // Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

});