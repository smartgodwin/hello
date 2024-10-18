<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoryController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\langController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// la route pour changer la langue
Route::get('/locale/{lang}', [langController::class, 'setlang']);



Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/info', function () {
    return view('pages.info');
});
Route::get('/detail', function () {
    return view('pages.detail');
});
Route::get('/notification', function () {
    return view('pages.notification');
});
Route::get('/search', [homeController::class, 'search'])->name('address.search');

Route::post('/search', [homeController::class, 'doSearch'])->name('address.doSearch');

Route::get('/address/{id}/detail', [AddressController::class, 'show'])->name('address.show');

Route::get('/address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');










// a ne pas toucher....
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/address', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');
    Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');    // Route pour supprimer une adresse
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
    Route::get('/user/{id}/addresses', [homeController::class, 'index'])->name('user.addresses');
    Route::get('/validation', function () {
        return view('pages.validation');
    })->name('validation');


    Route::post('/address/{id}/request-pin', [AddressController::class, 'requestPin'])->name('address.requestPin');
    Route::post('/address/validatePin/{id}', [AddressController::class, 'validatePin'])->name('address.validatePin');

    // Route::post('/notifications/{id}/markasread', [NotificationController::class, 'markasread'])->name('notifications.markAsRead');
    Route::resource('notifications', NotificationController::class)->except(['show', 'edit']);

    // Route::post('/send-code-pin/{id}', [NotificationController::class, 'sendCodePin'])->name('send.code.pin');
    Route::patch('/notifications/{id}/markasread', [NotificationController::class, 'markasread'])->name('notifications.markasread');
    Route::post('/notifications/sendCodePin/{id}', [NotificationController::class, 'sendCodePin'])->name('notifications.sendCodePin');
    Route::get('/notifications/{id}/sendCodePinEmail', [NotificationController::class, 'sendCodePin'])->name('notifications.sendCodePinEmail');

    Route::get('/unread-notifications-count', [homeController::class, 'getUnreadNotificationsCount'])->name('unreadNotificationsCount');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // favories
    Route::get('/favories', [FavoryController::class, 'index'])->name('favories.index');
    Route::post('/favories', [FavoryController::class, 'store'])->name('favories.store');
    Route::delete('/favories/{address}', [FavoryController::class, 'destroy'])->name('favories.destroy');


    // les route du superAdmin et l'admin
    Route::group(['middleware' => ['role:Admin|superAdmin']], function () {

        Route::get('/dashboard', function () {
            return view('backend.dashboard');
        })->name('dashboard');

        // Routes for RoleController
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');
        Route::get('role/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('role/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');

        // Routes for PermissionController
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('permission/{permission}', [PermissionController::class, 'show'])->name('permission.show');
        Route::get('permission/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('permission/{permission}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');

        // Routes for AddController
        Route::get('add', [AddController::class, 'index'])->name('add.index');
        Route::get('add/create', [AddController::class, 'create'])->name('add.create');
        Route::post('add', [AddController::class, 'store'])->name('add.store');
        Route::get('add/{add}', [AddController::class, 'show'])->name('add.show');
        Route::get('add/{add}/edit', [AddController::class, 'edit'])->name('add.edit');
        Route::put('add/{add}', [AddController::class, 'update'])->name('add.update');
        Route::delete('add/{add}', [AddController::class, 'destroy'])->name('add.destroy');

        // Routes for AdminController
        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('admin/{admin}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');





    });
});

Route::middleware('auth')->group(function () {
    Route::get('{id}/profile', [ProfileController::class, 'index'])->name('profile.index');
    // Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Si vous avez une page d'édition distincte
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


require __DIR__.'/auth.php';
