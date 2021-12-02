<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
        return view('index');
    });
    
    Route::get('/home', function () {
        return view('index');
    });



Route::get('/index', function () {
    return view('index');
})->name('page');

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
Route::post('search_employee','EmployeeController@search_employee')->name('search_employee');
Route::get('/holidays', function () {
    return view('holidays');
});
Route::get('/leaves', function () {
    return view('leaves');
});
Route::get('/leaves-employee', function () {
    return view('leaves-employee');
});
Route::get('/leave-settings', function () {
    return view('leave-settings');
});
Route::get('/attendance', function () {
    return view('attendance');
});
Route::get('/attendance-employee', function () {
    return view('attendance-employee');
});
// Route::get('/departments', function () {
//     return view('departments');
// });
Route::get('/departments','DepartmentController@departments')->name('departments');
Route::post('add_deaprtment','DepartmentController@add_department')->name('add_department');
Route::post('edit_department','DepartmentController@edit_department')->name('edit_department');
Route::post('delete_department','DepartmentController@delete_department')->name('delete_department');

// Route::get('/designations', function () {
//     return view('designations');
// });
Route::get('/designations','DesignationController@designations')->name('designations');
Route::post('add_designation','DesignationController@add_designation')->name('add_designation');
Route::post('edit_designation','DesignationController@edit_designation')->name('edit_designation');
Route::post('delete_designation','DesignationController@delete_designation')->name('delete_designation');

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
Route::get('/performance-indicator', function () {
    return view('performance-indicator');
});
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
Route::get('/promotion', function () {
    return view('promotion');
});
Route::get('/resignation', function () {
    return view('resignation');
});
Route::get('/termination', function () {
    return view('termination');
});
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
Route::get('/activities', function () {
    return view('activities');
});
Route::get('/users', function () {
    return view('users');
});
// Route::get('/settings', function () {
//     return view('settings');
// });
Route::get('settings','SettingController@settings')->name('settings');
Route::post('setting_update','SettingController@setting_update')->name('setting_update');
Route::get('/localization', function () {
    return view('localization');
});
Route::get('theme-settings','SettingController@theme_settings')->name('theme-settings');
Route::post('theme_setting_update','SettingController@theme_setting_update')->name('theme_setting_update');

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
Route::get('/leave-type', function () {
    return view('leave-type');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/client-profile', function () {
    return view('client-profile');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
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
Route::get('/performance-setting', function () {
    return view('performance-setting');
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