<?php

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Login And Register
Route::get('/', function () {
    return view('auth.login');
})->name('home');


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    route::post('login', 'loginAction')->name('login.action')->middleware('throttle:5,10');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    Route::post('/forgot-password', [AuthController::class,'passwordEmail'])->name('password.request');

    Route::get('/reset-password/{token}',[AuthController::class, 'passwordReset'] )->name('password.reset');

    Route::post('/reset-password',[AuthController::class, 'passwordUpdate'] )->name('password.update');

    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
});

Route::get('/back', [HomeController::class, 'backButton'])->name('back');


//for sub-admin
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('sub-admin.dashboard');

    Route::get('sub-admin/profile', function () {
        return view('profile');
    })->name('profile');



Route::get('/home', [EventController::class, 'showEvent'])->name('sub-admin.dashboard');

Route::controller(VisitorController::class)->group(function () {
    Route::get('sub-admin/visitor',  'new_visitor')->name('sub-admin.visitors.visitor');
    Route::post('/add-visitor', 'store_visit')->name('sub-admin.store');
    Route::put('/sub-admin/visitor/update/{id}',  'updateVisitorSub')->name('update.visitorSub');
    Route::get('/filter_visitor',  'filterVisitor');
    Route::post('sub-admin/visitor/{id}/checkout',  'checkout')->name('visitor.checkout');
    Route::get('sub-admin/search_visitor',  'searchVisitor')->name('visitor.search');
    Route::get('/visitor-stats/{timeframe}', 'getVisitorStats');
    Route::get('/visitor-data', 'getVisitorData');

});

Route::get('sub-admin/generate-pdf/visitor',[PdfController::class, 'generate_visitor'])->name('pdf.generate-visitors');

Route::controller(PassSlipController::class)->group(function () {
    Route::get('sub-admin/pass_slip',  'pass_slip')->name('sub-admin.pass_slip.pass_slip');
    Route::post('sub-admin/pass_slip',  'store_slip')->name('pass_slips.store');
    Route::put('sub-admin/pass_slip/update/{id}',  'updatePassSlip')->name('update.pass_slips');
    Route::get('/sub-admin/pass_slip/filter_pass_slip',  'filterPassSlip');
});
Route::get('generate-pdf/pass_slip',[PdfController::class, 'generate_passSlip'])->name('pdf.generate-passes');



Route::controller(LostFoundController::class)->group(function () {

    Route::get('sub-admin/lost_found',  'lost_found')->name('sub-admin.lost.lost_found');
    Route::post('sub-admin/store_lost',  'store_lost')->name('sub-admin.store_losts');
    Route::put('sub-admin/lost_found/update/{id}',  'updateLostFound')->name('update.lost_found');
    Route::get('/filter_lost_founds',  'filterLostFounds');

});
Route::get('generate-pdf/lost_found',[PdfController::class, 'generate_lost'])->name('pdf.generate-losts');

Route::controller(EmployeesController::class)->group(function () {
    Route::get('sub-admin/profile',  'showProfile')->name('profile');
    Route::post('sub-admin/profile',  'addInformation')->name('profile.store');
    Route::put('sub-admin/profile/update/{id}',  'editInformation')->name('profile.update');
    Route::get('/sub-admin/change-password',  'changePassword')->name('auth.change-password');
});

Route::controller(ViolationController::class)->group(function () {
    Route::get('sub-admin/violation',  'violation')->name('sub-admin.violation.violation');
    Route::post('sub-admin/violation',  'store_violate')->name('sub-admin.store_violate');
    Route::put('/violation/update/{id}',  'update_violation')->name('store_violation');
Route::get('/filter_violation',  'filterViolation');

});
Route::get('generate-pdf/violation',[PdfController::class, 'generate_violation'])->name('pdf.generate-violation');

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
    Route::get('admin/pass_slip',  'pass_slip_admin')->name('admin.pass_slip.pass_slip_admin');
    Route::post('admin/pass_slip',  'store_slip_admin')->name('pass_slip.store');
    Route::put('/pass_slip/update/{id}',  'updatePassSlipAdmin')->name('update.pass_slip_admin');
    Route::delete('/pass_slip/archive/{id}',  'destroy_passSlip')->name('archive.pass_slip');
    Route::get('/admin/filter_pass_slip_admin',  'filterPassSlipAdmin');
    route::post('/search-employee', 'searchEmployee')->name('search_employee');
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




Route::resource('/admin/visitor', VisitorController::class)->names([
    'index' => 'admin.visitors.visitor_admin',
    'store' => 'visitor.store',
]);

Route::controller(VisitorController::class)->group(function () {
    Route::get('/filter_visitor_admin', 'filterVisitorAdmin');
    Route::post('/admin/visitor/{id}', 'checkoutAdmin')->name('visitor.checkout_admin');
    Route::post('/admin/visitor/update', 'update')->name('visitor.update');
    Route::delete('/admin/delete_visitor/{id}', 'destroy');
    Route::get('admin/search_visitor', 'searchVisitors')->name('visitor.search');
});





Route::resource('/admin/security_staff', EmployeesController::class)->names([
    'index' => 'admin.employee',
    'store' => 'employee.store',
    'update' => 'employee.update',
    'destroy' => 'employee.destroy',
]);
Route::controller(LostFoundController::class)->group(function () {
    Route::get('admin/lost_found', 'lost_found_admin')->name('admin.lost.lost_found_admin');
    Route::post('admin/store_lost', 'store_lost_admin')->name('admin.store');
    Route::put('/lost_found/update/{id}', 'updateLostFoundAdmin')->name('update.lost_found_admin');
    Route::delete('/lost_found/archive/{id}', 'destroy_lostFound')->name('archive.lost_found');
    Route::get('/filter_lost_found', 'filterLostFoundAdmin');
});



Route::get('/admin/activity-log', [ActivityController::class, 'index'])->name('admin.activity');

Route::controller(EmployeesController::class)->group(function (){
    Route::get('admin/profile', 'showProfileAdmin')->name('admin.layouts.profile_admin');
    Route::post('admin/profile', 'addInformationAdmin')->name('profile.stores');
    Route::put('admin/profile/update/{id}', 'editInformationAdmin')->name('profile.updates');
    Route::get('admin/change-password', 'changePasswordAdmin')->name('auth.change-password');
});


Route::controller(PdfController::class)->group(function (){
    Route::get('admin/generate-pdf/visitor', 'generate_visitor')->name('pdf.generate-visitor');
    Route::get('admin/generate-pdf/pass_slip', 'generate_passSlip')->name('pdf.generate-pass');
    Route::get('admin/generate-pdf/lost_found', 'generate_lost')->name('pdf.generate-lost');
});


Route::controller(ViolationController::class)->group(function (){
    Route::get('admin/violation', 'violationView')->name('admin.violation.violation');
    Route::post('admin/violation', 'store_violation')->name('admin.store_violation');
    Route::put('/violation/update/{id}', 'update_violationAdmin')->name('store_violation');
    Route::delete('/violation/archive/{id}', 'destroy_violation');

});


Route::controller(ListController::class)->group(function (){
    Route::get('/admin/students', 'student_admin')->name('admin.students.student');
    Route::post('/admin/students', 'store_student_admin')->name('store_admin.student');
    Route::delete('/admin/student/delete/{id}', 'destroy_student_admin');

    Route::get('/admin/employees', 'all_employee_admin')->name('admin.employees.all_employee');
    Route::post('/admin/employees', 'store_all_employee_admin')->name('store_admin.employee');
    Route::delete('/employee/delete/{id}', 'destroy_all_employee_admin');
});




});





