<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RoomController,
    EmployeeController,
    CustomerController,
    DashboardController,
    ReservationController,
    MaintenanceController,
    ExpenseController,
    FinanceController,
    FuzzyController,
    FuzzySettingController,
    ReportController
};


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::get('/', [FuzzyController::class, 'index'])->name('fuzzy.index');
Route::post('/', [FuzzyController::class, 'process'])->name('fuzzy.process');

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/fuzzy', [FuzzyController::class, 'history'])
            ->name('fuzzy.index');

        Route::get('/fuzzy/{id}', [FuzzyController::class, 'show'])
            ->name('fuzzy.show');
            Route::get('/fuzzy-setting', [FuzzySettingController::class, 'edit'])->name('fuzzy-setting.edit');
            Route::put('/fuzzy-setting', [FuzzySettingController::class, 'update'])->name('fuzzy-setting.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');
    /*
    |--------------------------------------------------------------------------
    | Rooms
    |--------------------------------------------------------------------------
    */
    Route::get('/rooms/multi/{room}', [RoomController::class, 'showw'])->name('rooms.showw');
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/rooms/{room}/cekin', [ReservationController::class, 'create'])->name('rooms.cekin');
    Route::post('/rooms/import', [RoomController::class, 'import'])->name('rooms.import');
    Route::get('/rooms/cekin/multiple', [RoomController::class, 'cekInMultipleForm'])
    ->name('rooms.cekin.multiple');
    // Proses cek-in banyak
    Route::post('/rooms/cekin/multiple', [RoomController::class, 'cekInMultipleStore'])
        ->name('rooms.cekin.multiple.store');

    /*
    |--------------------------------------------------------------------------
    | Employees
    |--------------------------------------------------------------------------
    */
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::post('/employees/{employee}/attend', [EmployeeController::class, 'attend'])->name('employees.attend');

    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
    */
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    Route::delete('/customers/delete-inactive', [CustomerController::class, 'deleteInactive'])
    ->name('customers.deleteInactive');

    /*
    |--------------------------------------------------------------------------
    | Reservations
    |--------------------------------------------------------------------------
    */
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    // Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    // Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::delete('/reservations/cleanOld', [ReservationController::class, 'cleanOld'])->name('reservations.cleanold');

    /*
    |--------------------------------------------------------------------------
    | Maintenances
    |--------------------------------------------------------------------------
    */
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::get('/maintenances/create/{id}', [MaintenanceController::class, 'create'])->name('maintenances.create');
    Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store');
    // Route::get('/maintenances/{maintenance}', [MaintenanceController::class, 'show'])->name('maintenances.show');
    Route::get('/maintenances/{maintenance}/edit', [MaintenanceController::class, 'edit'])->name('maintenances.edit');
    Route::put('/maintenances/{maintenance}', [MaintenanceController::class, 'update'])->name('maintenances.update');
    Route::delete('/maintenances/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenances.destroy');

    /*
    |--------------------------------------------------------------------------
    | Expenses
    |--------------------------------------------------------------------------
    */

    Route::get('/maintenances/createe', [MaintenanceController::class, 'createe'])
    ->name('maintenances.createe');

Route::post('/maintenances/add', [MaintenanceController::class, 'storee'])
    ->name('maintenances.storee');

    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    /*
    |--------------------------------------------------------------------------
    | Finances
    |--------------------------------------------------------------------------
    */
    Route::get('/finances', [FinanceController::class, 'index'])->name('finances.index');
    Route::get('/finances/print', [FinanceController::class, 'printPdf'])->name('finances.print');
    Route::delete('/finances/delete-old', [FinanceController::class, 'deleteOld'])->name('finances.deleteOld');
});


require __DIR__.'/auth.php';
