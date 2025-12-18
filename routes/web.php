<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TenantDetailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\BillUserController;
use App\Http\Controllers\User\HistoryBillController;
use App\Http\Controllers\User\HouseHomeController;
use App\Http\Controllers\User\ServiceBillController;
use App\Http\Controllers\Vnpay\PaymentBillController;
use App\Http\Controllers\Vnpay\PaymentPenaltiesController;
use App\Http\Controllers\Vnpay\PaymentServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [HouseHomeController::class, 'index'])->name('home.index');
Route::get('/house', [HouseHomeController::class, 'house'])->name('home.house');
Route::get('/contact', [HouseHomeController::class, 'contact'])->name('home.contact');
Route::post('/contact', [HouseHomeController::class, 'storeContact'])->name('contact.store');
Route::get('/about',function () {return view('about');})->name('home.about');
Route::get('/house-detail/{house_id}', [HouseHomeController::class, 'show'])->name('home.show');




Route::group(['middleware' => 'tenant'], function () {
    Route::get('/hoa-don', [BillUserController::class, 'index'])->name('bill.filter');
    Route::get('/phieu-phat', [BillUserController::class, 'showPenalties'])->name('penalty.filter');
    Route::post('/vnpay/pay', [PaymentBillController::class, 'pay'])->name('vnpay.pay');
    Route::get('/vnpay/return', [PaymentBillController::class, 'return'])->name('vnpay.return');
    Route::post('/vnpay/pay/penalties', [PaymentPenaltiesController::class, 'payPenaltis'])->name('vnpay.pay.penalties');
    Route::get('/vnpay/return/penalties', [PaymentPenaltiesController::class, 'returnPenaltis'])->name('vnpay.return.penalties');

    Route::get('/dich-vu', [ServiceBillController::class, 'index'])->name('services.index');
    Route::post('/services/register', [ServiceBillController::class, 'register'])->name('register.service');
    Route::post('/vnpay/pay/service', [PaymentServiceController::class, 'payService'])->name('vnpay.pay.service');
    Route::get('/vnpay/return/service', [PaymentServiceController::class, 'returnService'])->name('vnpay.return.service');
    Route::get('/payment-us', [HistoryBillController::class, 'index'])->name('payment.list.user');

});
Route::group(['middleware' => 'admin'], function () {


    //Route::get('/dashboard',function () {return view('admin.dashboard');})->name('dashboard');

    Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard');

  //Area

    Route::get('/area-list', [AreaController::class, 'index'])->name('area.list');
    Route::get('/add-areas', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/add-areas', [AreaController::class, 'store'])->name('areas.store');
    Route::delete('areas/{id}', [AreaController::class, 'destroy'])->name('areas.destroy');
    Route::get('/edit-areas/{id}', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/edit-areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    //User
    Route::get('/user-list',[UserController::class, 'index'])->name('user.list');
    Route::get('/add-users',[UserController::class, 'create'])->name('users.create');
    Route::post('/add-users', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/edit-users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');

    //House
    Route::get('/house-list', [HouseController::class, 'index'])->name('house.list');
    Route::get('/add-house', [HouseController::class, 'create'])->name('house.create');
    Route::post('/add-house', [HouseController::class, 'store'])->name('house.store');
    Route::get('/edit-house/{id}', [HouseController::class, 'edit'])->name('house.edit');
    Route::put('/edit-house/{id}', [HouseController::class, 'update'])->name('house.update');
    Route::delete('/house/{id}', [HouseController::class, 'destroy'])->name('house.destroy');

    //Tenant
    Route::get('/tenant-list', [TenantController::class, 'index'])->name('tenant.list');
    Route::get('/house-tenant', [HouseController::class, 'tenant'])->name('house-tenant.list');
    Route::post('/tenants/store', [TenantController::class, 'store'])->name('tenants.store');
    Route::delete('/tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    //Tenant Detail
    Route::get('/tenant-detail-list', [TenantDetailController::class, 'index'])->name('tenant-detail.list');
    Route::get('/add-tenant-detail', [TenantDetailController::class, 'create'])->name('tenant-detail.create');
    Route::post('/tenant-detail/store', [TenantDetailController::class, 'store'])->name('tenant-detail.store');
    Route::get('/edit-tenant-detail/{id}', [TenantDetailController::class, 'edit'])->name('tenant-detail.edit');
    Route::put('/edit-tenant-detail/{id}', [TenantDetailController::class, 'update'])->name('tenant-detail.update');
    Route::delete('/tenant-detail/{id}', [TenantDetailController::class, 'destroy'])->name('tenant-detail.destroy');

    //Service
    Route::get('/service-list',[ServicesController::class, 'index'])->name('service.list');
    Route::get('/add-service', [ServicesController::class, 'create'])->name('service.create');
    Route::post('/add-service', [ServicesController::class, 'store'])->name('service.store');
    Route::get('/edit-service/{id}', [ServicesController::class, 'edit'])->name('service.edit');
    Route::put('/edit-service/{id}', [ServicesController::class, 'update'])->name('service.update');
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name('service.destroy');
    Route::delete('/status-service/{id}', [ServicesController::class, 'updateStatus'])->name('service.status');


    //Penal
   Route::get('/penalty-list',[PenaltyController::class, 'index'])->name('penalty.list');
   Route::get('/add-penalty', [PenaltyController::class, 'create'])->name('penalty.create');
   Route::post('/add-penalty', [PenaltyController::class, 'store'])->name('penalty.store');
   Route::get('/edit-penalty/{id}', [PenaltyController::class, 'edit'])->name('penalty.edit');
   Route::put('/edit-penalty/{id}', [PenaltyController::class, 'update'])->name('penalty.update');
   Route::delete('/delete-penalty/{id}', [PenaltyController::class, 'destroy'])->name('penalty.destroy');
    Route::post('/penalty/{id}/update-status', [PenaltyController::class, 'updateStatus'])->name('penalty.updateStatus');

   //Deposit
    Route::get('/deposit_list',[DepositController::class, 'index'])->name('deposit.list');
    Route::get('/add-deposit',[DepositController::class,'create']) ->name('deposit.create');
    Route::post('/add-deposit',[DepositController::class,'store']) ->name('deposit.store');
    Route::get('/get-house-name/{house_id}', [DepositController::class, 'getHouseName']);
    Route::delete('/delete-deposit/{id}', [DepositController::class, 'destroy'])->name('deposit.destroy');
    Route::post('/deposit/{deposit_id}/update-status', [DepositController::class, 'updateStatus'])->name('deposit.updateStatus');

    //Water And Electricty
    Route::get('/get-bills-list',[BillController::class, 'index'])->name('bills.list');

    Route::get('/bill/create', [BillController::class, 'createBill'])->name('bill.create');
    Route::post('/bill/store', [BillController::class, 'storeBill'])->name('bill.store');
    Route::get('/bills-list',[BillController::class, 'bill'])->name('bill.list');
    Route::post('/bill/update-status', [BillController::class, 'updateStatus'])->name('bill.updateStatus');

    //contact us
    Route::get('/contact-list',[ContactController::class, 'index'])->name('contact.list');
    //Payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.list');
});
