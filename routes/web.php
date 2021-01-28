<?php

use App\Exports\DocsExport;
use GuzzleHttp\Middleware;
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

/** Download Excel */
Route::get('/doc', function () {
    return Excel::download(new DocsExport, 'ListadoProductos.xlsx');
});
/** Download Excel */

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

/**Accounts Route */
Route::resource('cuentas', 'AccountsController')->middleware('auth');
/**Accounts Route */

/**userInfo Route */
Route::resource('UsuariosEmpresa', 'UsuarioEmpresaController')->middleware('auth');
/**userInfo Route */

/**Account_type Route */
Route::resource('TipodeCuenta', 'AccountTypesController')->middleware('auth');
/**Account_type Route */