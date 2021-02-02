<?php

use App\Exports\BillsExport;
use App\Exports\DocsExport;
use GuzzleHttp\Middleware;
use App\Exports\DocsAccount;
use App\Exports\DocsAccountType;
use App\Exports\DocsBill;
use App\Exports\DocsCompany;
use App\Exports\DocsCustomer;
use App\Exports\DocsUser;

use Illuminate\Support\Facades\Route;
use App\Mail\ComprobanteMailable;
use App\User;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('inicio');
});
Auth::routes();

Route::resource('home', 'HomeController')->middleware('auth');

/**Product Route */
Route::resource('productos', 'ProductController')->middleware('auth');
/**Product Route */

/**Companies Route */
Route::resource('empresas', 'CompaniesController')->middleware('auth');
/**Companies Route */

/**Clients Route */
Route::resource('clientes', 'CustomersController')->middleware('auth');
/**Clients Route */

/**Bill Route */
Route::resource('facturas', 'InvoiceBillsController')->middleware('auth');
Route::get('correo', 'InvoiceBillsController@getMail');
/**Bill Route */

/** Descargar PDF */
Route::get('user-list-pdf', 'ArchivosController@exportPDF')->name('products.pdf');
/** Descargar PDF */

/**Companies Route */
Route::resource('UsuariosEmpresa', 'UsuarioEmpresaController')->middleware('auth');
/**Companies Route */

/**userInfo Route */
Route::resource('cuentas', 'AccountsController')->middleware('auth');
/**userInfo Route */

/**Account_type Route */
Route::resource('TipodeCuenta', 'AccountTypesController')->middleware('auth');
/**Account_type Route */

/** Download  PDF */
Route::get('Product-list-pdf', 'ArchivosController@exportProductPDF')->name('Product.pdf')->middleware('auth');
Route::get('Company-list-pdf', 'ArchivosController@exportCompanyPDF')->name('Company.pdf')->middleware('auth');
Route::get('Customer-list-pdf', 'ArchivosController@exportCustomerPDF')->name('Customer.pdf')->middleware('auth');
Route::get('Account-list-pdf', 'ArchivosController@exportAccountPDF')->name('Account.pdf')->middleware('auth');
Route::get('Factura-list-pdf', 'ArchivosController@exportfacturatPDF')->name('Factura.pdf')->middleware('auth');
Route::get('User-list-pdf', 'ArchivosController@exportUserPDF')->name('User.pdf')->middleware('auth');
/**Download PDF */

/** Descargar Excel */
Route::get('/doc', function () {
    return new DocsExport;
});
Route::get('/doc-Account', function () {
    
    return new DocsAccount;
});
Route::get('/doc-AccountType', function () {
    return new DocsAccountType;
});
Route::get('/doc-bills', function () {
    return new DocsBill;
});
Route::get('/doc-Companies', function () {
    return new DocsCompany;
});
Route::get('/doc-Customer', function () {
    return new DocsCustomer;
});
Route::get('/doc-User', function () {
    return new DocsUser;
});
/** Descargar Excel */

/** Resportes Individual x Compañias */
Route::get('ReportProducts', 'FilesController@ExportReportProducts')->name('Company-Products.pdf')->middleware('auth');
Route::get('ReportCostumer', 'FilesController@ExportReportCostumer')->name('Company-Costumer.pdf')->middleware('auth');
Route::get('ReportTypes', 'FilesController@ExportReportTypes')->name('Company-Types.pdf')->middleware('auth');
Route::get('ReportAcuonts', 'FilesController@ExportReportAcuonts')->name('Company-Acuonts.pdf')->middleware('auth');
Route::get('ReportUsers', 'FilesController@ExportReportUsers')->name('Company-Users.pdf')->middleware('auth');
Route::get('ReportBills', 'FilesController@ExportReportBills')->name('Company-Bills.pdf')->middleware('auth');
/** Resportes Individual x Compañias */