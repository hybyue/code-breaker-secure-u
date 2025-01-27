<?php

use App\Exports\LostExport;
use App\Exports\UsersExport;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LostFoundController;
use App\Http\Controllers\PassSlipController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\LoopingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

//Login And Register
Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/export', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    Route::post('/forgot-password', [AuthController::class,'passwordEmail'])->name('password.request');

    Route::get('/reset-password/{token}',[AuthController::class, 'passwordReset'] )->name('password.reset');

    Route::post('/reset-password',[AuthController::class, 'passwordUpdate'] )->name('password.update');

    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
});

Route::get('/back', [HomeController::class, 'backButton'])->name('back');
Route::get('/view_lang', [HomeController::class, 'view_lang']);
Route::get('/view_langs', [HomeController::class, 'view_langs']);


//for sub-admin
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('sub-admin.dashboard');

    Route::get('/sub-admin/profile', function () {
        return view('profile');
    })->name('profile');



Route::get('/home', [EventController::class, 'showEvent'])->name('sub-admin.dashboard');

Route::controller(VisitorController::class)->group(function () {
    Route::get('/sub-admin/visitor',  'new_visitor')->name('sub-admin.visitors.visitor');
    Route::post('/add-visitor', 'store')->name('sub-admin.store');
    Route::put('/sub-admin/visitor/update/{id}',  'update')->name('update.visitorSub');
    Route::get('/sub-admin/visitor',  'filterVisitor')->name('sub-admin.visitors.visitor');
    Route::post('sub-admin/visitor/{id}/checkout',  'checkout')->name('visitor.checkout');
    Route::get('sub-admin/search_visitor',  'searchVisitor')->name('visitor.search');
    Route::get('/visitor-stats/{timeframe}', 'getVisitorStats');
    Route::get('/visitor-data', 'getVisitorData');
    Route::get('/visitor-total-data',  'getVisitorTotalData');
    Route::get('/validateField',  'validateField')->name('sub-admin.validate');
    Route::get('/sub-admin/visitor/clear-filter', 'clearVisitorFilter');
    Route::post('/sub-admin/visitor/{id}/duplicate', 'duplicateEntrySubAdmin')->name('visitor.duplicate.sub-admin');
    Route::get('/sub-admin/visitors/next-id',  'getNextVisitorId')->name('auto_visitor_id');
});


Route::controller(PassSlipController::class)->group(function () {
    Route::get('/sub-admin/pass_slip',  'pass_slip')->name('sub-admin.pass_slip.pass_slip');
    Route::post('sub-admin/pass_slip',  'store_slip')->name('pass_slips.store');
    Route::put('/sub-admin/pass_slip/update/{id}',  'updatePassSlip')->name('update.pass_slips');
    Route::get('/sub-admin/pass_slip',  'filterPassSlip')->name('sub-admin.pass_slip.pass_slip');
    route::post('sub-admin/search-employee', action: 'searchEmployee')->name('subadmin.search_employee');
    route::post('sub-admin/search-test', 'searchTest')->name('search_test');
    Route::post('/sub-admin/pass_slip/{id}', 'checkoutPassSlip')->name('passSlip.checkout');
    Route::get('/sub-admin/generate_no/',  'generateNextPassSub')->name('pass_slip.next_number_sub');
    Route::get('/sub-admin/pass-slip/clear-filter', 'clearPassSlipFilter')->name('pass_slip.clear-filter');
});



Route::controller(LostFoundController::class)->group(function () {

    Route::get('/sub-admin/lost_found',  'lost_found')->name('sub-admin.lost.lost_found');
    Route::post('sub-admin/store_lost',  'store_lost')->name('sub-admin.store_losts');
    Route::put('/sub-admin/lost_found/update/{id}',  'updateLostFound')->name('update.lost_found');
    Route::post('/sub-admin/update_claimed/{id}', 'updateClaimed');
    Route::post('/sub-admin/update_transfer', 'updateTransfer');
    Route::get('/sub-admin/lost_found',  'filterLostFounds')->name('sub-admin.lost.lost_found');
    Route::post('/sub-admin/batch_transfered/', 'batchTransferUnclaimed');
    Route::get('/sub-admin/lost_found/clear-filter', 'clearFilter')->name('sub-admin.lost.clear-filter');
    Route::post('/sub-admin/update_claimed_with_proof',  'updateClaimedWithProof');


});

Route::controller(EmployeesController::class)->group(function () {
    Route::get('sub-admin/profile',  'showProfile')->name('profile');
    Route::put('sub-admin/profile/{id}',  'addInformation')->name('profile.store');
    Route::put('sub-admin/profile/update/{id}',  'editInformation')->name('profile.update');
    Route::get('/sub-admin/change-password',  'changePassword')->name('auth.change-password');
    Route::put('/profile/{id}/update-picture',  'updatePicture')->name('profile.updatePicture');
});

Route::controller(ViolationController::class)->group(function () {
    Route::get('/sub-admin/violation',  'violation')->name('sub-admin.violation.violation');
    Route::post('sub-admin/violation',  'store_violation')->name('sub-admin.store_violate');
    Route::put('/sub-admin/violation/update/{id}',  'update_violation')->name('violation.update');
    Route::get('/sub-admin/violation',  'filterViolation')->name('sub-admin.violation.violation');
    Route::post('sub-admin/search-student',  'searchStudentSub')->name('sub-admin.search_student');
    Route::get('/sub-admin/violation/clear-filter', 'clearViolationFilter')->name('sub-admin.violation.clear-filter');

});

Route::controller(PdfController::class)->group(function () {
    Route::get('/generate-pdf/violation', 'generate_violation')->name('pdf.generate-violation');
    Route::get('/generate-pdf/lost_found', 'generate_lost')->name('pdf.generate-losts');
    Route::get('/generate-passSlip', 'generate_passSlip')->name('pdf.generate-passes');
    Route::get('/sub-admin/generate-pdf/visitor', 'generate_visitor')->name('pdf.generate-visitors');
    Route::get('/sub-admin/generate-pdf/looping', 'generateLoopingEmployee');
    Route::post('/sub-admin/generate_transfer_report',  'generateTransferReport');


});

Route::controller(LoopingController::class)->group(function () {
    Route::get('/sub-admin/loafing', 'index')->name('sub-admin.looping.loopings');
    Route::get('/sub-admin/loafing/clear-filter', 'clearLoopingFilter')->name('sub-admin.looping.clear-filter');
    Route::put('/sub-admin/loafing/update/{id}', 'update')->name('update.looping');
    Route::post('/sub-admin/loafing/store', 'store')->name('store.looping');
    route::post('/sub-admin/search-looping', 'searchLooping')->name('subadmin.search_looping');

});

});




Route::get('/export-custom-employee', function () {
    return Excel::download(new LostExport, 'employee.xlsx');
});

//for admin po
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.dashboard');

    Route::get('admin/profile', function () {
        return view('profile_admin');
    })->name('profile_admin');


    Route::get('/lost_found_admin', function () {
        return view('admin.lost_found_admin');
    })->name('lost_found_admin');


    Route::get('/sched_admin', function () {
        return view('admin.sched_admin');
    })->name('sched_admin');

    Route::get('/employee', function () {
        return view('admin.employee');
    })->name('employee');

    Route::get('/activity', function () {
        return view('admin.activity');
    })->name('activity');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('/admin/dashboard');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('admin.register');

    Route::get('/violation', function () {
        return view('admin.violation');
    })->name('violation');



// Route::get('admin/vehicle_sticker', [TeacherController::class, 'parking_admin'])->name('admin.vehicle_sticker.vehicle_sticker');
// Route::post('admin/store_parking', [TeacherController::class, 'store_park'])->name('store_parking');
// Route::put('/vehicle_sticker/update/{id}', [TeacherController::class, 'updateVehicleAdmin'])->name('update.vehicle_sticker_admin');
// Route::delete('/vehicle_sticker/archive/{id}', [TeacherController::class, 'destroy_vehicle']);
// Route::get('/filter_vehicle_admin', [TeacherController::class, 'filterVehicleAdmin']);

Route::controller(PassSlipController::class)->group(function (){
    Route::get('/admin/pass_slip',  'pass_slip_admin')->name('admin.pass_slip.pass_slip_admin');
    Route::post('admin/pass_slip',  'store_slip')->name('pass_slip.store');
    Route::put('/pass_slip/update/{id}',  'updatePassSlip')->name('update.pass_slip_admin');
    Route::delete('/pass_slip/archive/{id}',  'destroy_passSlip')->name('archive.pass_slip');
    Route::get('/admin/pass_slip',  'filterPassSlipAdmin')->name('admin.pass_slip.pass_slip_admin');
    route::post('/search-employee', 'searchEmployee')->name('search_employee');
    Route::post('/admin/passS_slip/{id}', 'checkoutAdmin')->name('passSlip.checkout_admin');
    Route::get('/admin/visitor-data', 'getVisitorData');
    Route::get('/visitor-stats/{timeframe}', 'getVisitorStats');
    Route::get('/admin/visitor-total-data',  'getVisitorTotalData');
    Route::get('/admin/generate_number/',  'generateNextPassNumber')->name('pass_slip.next_number');
    Route::get('/admin/pass-slip/clear-filter', 'clearPassSlipFilterAd')->name('pass_slip.clear-filter-admin');
});

Route::controller(EventController::class)->group(function () {
    Route::get('/admin/announcement', 'eventAdmin')->name('admin.events.event_admin');
    Route::post('/admin/announcement', 'store_adminEvent')->name('event.store_admin');
    Route::get('/admin', 'showEvents')->name('admin.dashboard');
    Route::put('/admin/announcement/update/{id}', 'updateEventsAdmin')->name('update.events_admin');
    Route::delete('/admin/archive_events/{id}', 'destroy_events');
});

// Route::get('/admin/employee', [EmployeeController::class, 'index_employee'])->name('admin.employee');
// Route::post('/admin/employee/store', [GlobalController::class, 'store_employee'])->name('admin.store_employees');
// Route::get('admin/employees/{employee}', [GlobalController::class, 'show'])->name('admin.show_employee');
// Route::post('admin/employees/update/{employee}', [GlobalController::class, 'update'])->name('admin.update_employee');

// Route::get('admin/visitor', [TeacherController::class, 'visitor_admin'])->name('admin.visitor_admin');
// Route::get('admin/new_visitor', [TeacherController::class, 'add_visitor'])->name('admin.new_visitor');
// Route::post('admin/store', [TeacherController::class, 'store_visitor'])->name('admin.store_visit');




Route::controller(VisitorController::class)->group(function () {
    Route::get('/admin/visitor', 'index')->name('admin.visitors.visitor_admin');
    Route::get('/admin/visitor', 'filterVisitorAdmin')->name('admin.visitors.visitor_admin');
    Route::post('/admin/visitor',  'store')->name('visitor.store');
    Route::post('/admin/visitor/{id}', 'checkoutAdmin')->name('visitor.checkout_admin');
    Route::put('/admin/visitor/update/{id}', 'update')->name('visitor.update');
    Route::get('admin/search_visitor', 'searchVisitors')->name('visitor.search');
    Route::delete('/admin/delete_visitor/{id}', 'destroy');
    Route::get('/admin/visitor/clear-filter', 'clearVisitorFilterAdmin')->name('visitors.clear-filter-admin');
    Route::post('/admin/visitor/{id}/duplicate', 'duplicateEntry')->name('visitor.duplicate');
    Route::get('/admin/visitors/next-id',  'getNextVisitorId')->name('auto_visitor_id.admin');

});





Route::resource('/admin/security_staff', EmployeesController::class)->names([
    'index' => 'admin.employee',
    'store' => 'employee.store',
    'update' => 'employee.update',
    'destroy' => 'employee.destroy',
]);
Route::controller(LostFoundController::class)->group(function () {
    Route::get('/admin/lost_found', 'lost_found_admin')->name('admin.lost.lost_found_admin');
    Route::post('/admin/store_lost', 'store_lost')->name('admin.store_lost');
    Route::put('/lost_found/update/{id}', 'updateLostFound')->name('update.lost_found_admin');
    Route::delete('/lost_found/archive/{id}', 'destroy_lostFound')->name('archive.lost_found');
    Route::get('/admin/lost_found', 'filterLostFoundAdmin')->name('admin.lost.lost_found_admin');
    Route::get('/admin/lost_found/clear-filter', 'clearFilterAdmin')->name('admin.lost.clear-filter');
    Route::post('/admin/update_claimed/{id}', 'updateClaimed')->name('update_claimed');
    Route::post('/admin/update_transfer', 'updateTransfer');

});



Route::get('/admin/activity-log', [ActivityController::class, 'index'])->name('admin.activity');
Route::get('/activity/clear-filter', [ActivityController::class, 'clearFilter'])->name('activity.clear-filter');

Route::controller(EmployeesController::class)->group(function (){
    Route::get('admin/profile', 'showProfileAdmin')->name('admin.layouts.profile_admin');
    Route::put('admin/profile/{id}', 'addInformation')->name('profile.stores');
    Route::put('admin/profile/update/{id}', 'editInformation')->name('profile.updates');
    Route::get('admin/change-password', 'changePasswordAdmin')->name('auth.change-password');
    Route::put('admin/profile/{id}/update-picture',  'updatePictureAdmin')->name('profile.updatePicture.admin');

});


Route::controller(PdfController::class)->group(function (){
    Route::get('/admin/generate-pdf/visitor', 'generate_visitor')->name('pdf.generate-visitor');
    Route::get('/generate-passSlipAdmin', 'generate_passSlip')->name('pdf.generate-pass');
    Route::get('/admin/generate-pdf/violation', 'generate_violation')->name('pdf.generate-violation');
    Route::get('/admin/generate-pdf/lost_found', 'generate_lost')->name('pdf.generate-lost');
    Route::get('/admin/generate-pdf/looping', 'generateLoopingEmployee');
    Route::post('/admin/generate_transfer_report',  'generateTransferReport');

});


Route::controller(ViolationController::class)->group(function (){
    Route::get('/admin/violation', 'violationView')->name('admin.violation.violation');
    Route::post('admin/violation', 'store_violation')->name('admin.store_violation');
    Route::put('/violation/update/{id}', 'update_violation')->name('violation.update.admin');
    Route::delete('/violation/archive/{id}', 'destroy_violation');
    Route::post('/search-student',  'searchStudentSub')->name('admin.search_student');
    Route::get('/admin/violation/clear-filter', 'clearViolationFilterAdmin')->name('admin.violation.clear-filter');

});


Route::controller(ListController::class)->group(function (){
    Route::get('/admin/students', 'student_admin')->name('admin.students.student');
    Route::post('/admin/students', 'store_student_admin')->name('store_admin.student');
    Route::delete('/admin/student/delete/{id}', 'destroy_student_admin');
    Route::put('/admin/student/update/{id}', 'updateStudentAdmin')->name('update_admin.student');

    Route::get('/admin/employees', 'all_employee_admin')->name('admin.employees.all_employee');
    Route::post('/admin/employees', 'store_all_employee_admin')->name('store_admin.employee');
    Route::put('/employee/update/{id}', 'updateEmployeeAdmin')->name('update_admin.employee');
    Route::delete('/employee/delete/{id}', 'destroy_all_employee_admin');
});

Route::controller(LoopingController::class)->group(function () {
    Route::get('/admin/loafing', 'index_admin')->name('admin.looping.loopings');
    Route::get('/admin/loafing/clear-filter', 'clearLoopingFilterAdmin')->name('admin.looping.clear-filter');
    Route::put('/admin/loafing/update/{id}', 'update')->name('update.looping_admin');
    Route::post('/admin/loafing/store', 'store')->name('store.looping_admin');
    route::post('/admin/search-looping', 'searchLooping')->name('admin.search_looping');

});

Route::post('/excel_import_student', [ImportExcelController::class, 'import_excel'])->name('import.student');
Route::post('/excel_import_employee', [ImportExcelController::class, 'import_excel_employee'])->name('import.employee');
Route::get('/export/employees', [ImportExcelController::class, 'exportAllEmployees'])->name('exports.all_employee_export');

});





