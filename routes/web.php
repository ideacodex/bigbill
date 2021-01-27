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

/** Download Excel */
Route::get('/doc', function () {
    return Excel::download(new DocsExport, 'ListadoProductos.xlsx');
});
/** Download Excel */

/** Descargar PDF */
Route::get('user-list-pdf', 'ArchivosController@exportPDF')->name('products.pdf');
/** Descargar PDF */

Auth::routes();

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

/**Companies Route */
Route::resource('UsuariosEmpresa', 'UsuarioEmpresaController')->middleware('auth');
/**Companies Route */