<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Setting\CategoryController;
use App\Http\Controllers\Transaction\SalesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Transaction\ItemRegController;
use App\Http\Controllers\Transaction\TransactionController;

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
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home-chart', [HomeController::class, 'homeChart'])->name('homeChart');
Route::get('/AccountPaging', [AccountController::class, 'ShowAccountPage'])->name('accsetting');
Route::get('/AccountSettings/{user}/editAcc', [AccountController::class, 'edit'])->name('accsetting.edit');
Route::Post('/AccountSettings/{user}', [AccountController::class, 'update'])->name('accsetting.update');
Route::get('/AccountSettings/Acc/{user}', [AccountController::class, 'show'])->name('accsetting.show');
Route::get('/AccountSettings/RolePaging', [RoleController::class, 'index'])->name('rolePaging');
Route::get('/AccountSettings/RoleDetail/{refRole}', [RoleController::class, 'edit'])->name('role.detail');
Route::put('/AccountSettings/RoleEdit/{refRole}', [RoleController::class, 'update'])->name('role.update');
Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses.index');
Route::get('/filtered', [ExpensesController::class, 'index'])->name('filtered.expense');
Route::get('/ItemReg/AddItem', [ItemRegController::class, 'AddItem'])->name('AddItem');
Route::get('/ItemReg/EditItem/{id}', [ItemRegController::class, 'editItem'])->name('EditItem');
Route::post('/ItemReg/Updateitem/{id}', [ItemRegController::class, 'updateItem'])->name('updateItem');
Route::post('/ItemReg', [ItemRegController::class, 'NewItem'])->name('NewItem');
Route::get('/ItemReg', [ItemRegController::class, 'viewItem'])->name('viewItem');
Route::get('/activate/{token}', [ResetPasswordController::class, 'showChangeForm'])->name('showChangeForm');
Route::post('/change/{token}', [ResetPasswordController::class, 'changePassword'])->name('change.password');
Route::post('/validate-field', [RegisterController::class, 'validateField'])->name('validateField');
Route::post('/validate-item', [ItemRegController::class, 'validateItem'])->name('validateItem');
Route::post('/saveItem', [ItemRegController::class, 'saveItem'])->name('saveItem');
Route::post('/update-stock', [ItemRegController::class, 'updateStock'])->name('UpdateStock');
Route::get('/Stock-Opname', [ItemRegController::class, 'StockOpname'])->name('StockOpname');
Route::get('/Category-Paging', [CategoryController::class, 'categoryPaging'])->name('CategoryP');
Route::get('/Category-edit/{refCategoryId}', [CategoryController::class, 'categoryEdit'])->name('CategoryE');
Route::post('/Category-update/{refCategoryId}', [CategoryController::class, 'categoryUpdate'])->name('CategoryU');
Route::post('/Category-delete/{refCategoryId}', [CategoryController::class, 'categoryDelete'])->name('CategoryD');
Route::post('/category/cancel', [CategoryController::class, 'categoryCancel'])->name('categoryC');
Route::get('/Transaction/AddTrans', [TransactionController::class, 'AddItem'])->name('AddTransItem');
Route::get('/get-items', [TransactionController::class, 'getItems']);
Route::get('/get-item-details/{itemCode}', [TransactionController::class, 'getItemDetails']);
Route::get('/TransactionPaging', [TransactionController::class, 'transactionPaging'])->name('TransactionPaging');
Route::post('/addTrx', [TransactionController::class, 'AddTrx'])->name('AddTrx');
Route::get('/TransactionDetail/{trxno}', [TransactionController::class, 'getTrxDetail'])->name('TransactionDetail');
Route::get('/SalesInfo', [SalesController::class, 'showSales'])->name('SalesInfo');
Route::get('/SalesInfoFiltered', [SalesController::class, 'showSalesFiltered'])->name('SalesInfoFiltered');
Route::get('/SalesPersonal', [SalesController::class, 'showPeronalSales'])->name('SalesPersonal');
Route::get('/SalesPersonalFiltered', [SalesController::class, 'showPeronalSalesByDate'])->name('SalesPersonalFilter');
