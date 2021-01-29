<?php

use App\Exports\DocsExport;
use App\Exports\DocsAccount;
use App\Exports\DocsAccountType;
use App\Exports\DocsBill;
use App\Exports\DocsCompany;
use App\Exports\DocsCustomer;
use App\Exports\DocsUser;


use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


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
    return view('PDF.archivo');
});
Auth::routes();


/** Descargar  PDF */
Route::get('Product-list-pdf', 'ArchivosController@exportProductPDF')->name('Product.pdf')->middleware('auth');
Route::get('Company-list-pdf', 'ArchivosController@exportCompanyPDF')->name('Company.pdf')->middleware('auth');
Route::get('Customer-list-pdf', 'ArchivosController@exportCustomerPDF')->name('Customer.pdf')->middleware('auth');
Route::get('Account-list-pdf', 'ArchivosController@exportAccountPDF')->name('Account.pdf')->middleware('auth');
Route::get('Factura-list-pdf', 'ArchivosController@exportfacturatPDF')->name('Factura.pdf')->middleware('auth');
Route::get('User-list-pdf', 'ArchivosController@exportUserPDF')->name('User.pdf')->middleware('auth');
/**FIn de Descargar PDF */

Route::resource('home', 'HomeController')->middleware('auth');
/**Start Productos Route */
Route::resource('productos', 'ProductController')->middleware('auth');
/**Start Productos Route */
/**Companies Route */
Route::resource('empresas', 'CompaniesController')->middleware('auth');
/**Companies Route */

/**Clients Route */
Route::resource('clientes', 'CustomersController')->middleware('auth');
/**Clients Route */

/**Bill Route */
Route::resource('facturas', 'InvoiceBillsController')->middleware('auth');
/**Bill Route */

/** Descargar PDF */
Route::get('user-list-pdf', 'ArchivosController@exportPDF')->name('products.pdf');
/** Descargar PDF */


/** Descargar Excel */
Route::get('/doc', function () {
    return Excel::download(new DocsExport, 'ListadoProductos.xlsx');
});
/** Descargar Excel */


/**Bill Route */
Route::resource('select', 'usuarioscontroller');
/**Bill Route */

/**Companies Route */
Route::resource('UsuariosEmpresa', 'UsuarioEmpresaController')->middleware('auth');
/**Companies Route */
/**userInfo Route */
Route::resource('cuentas', 'AccountsController')->middleware('auth');
/**userInfo Route */

/**Account_type Route */
Route::resource('TipodeCuenta', 'AccountTypesController')->middleware('auth');
/**Account_type Route */

/** Descargar Excel */
Route::get('/doc-Account', function () {
    return Excel::download(new DocsAccount, 'ListadoCuentas.xlsx');
});
Route::get('/doc-AccountType', function () {
    return Excel::download(new DocsAccountType, 'ListadoTipoCuentas.xlsx');
});
Route::get('/doc-bills', function () {
    return Excel::download(new DocsBill, 'ListadoFacturas.xlsx');
});
Route::get('/doc-Companies', function () {
    return Excel::download(new DocsCompany, 'ListadoCompañias.xlsx');
});
Route::get('/doc-Customer', function () {
    return Excel::download(new DocsCustomer, 'ListadoClientes.xlsx');
});
Route::get('/doc-User', function () {
    return Excel::download(new DocsUser, 'ListadoUsuarios.xlsx');
});
/** Descargar Excel */