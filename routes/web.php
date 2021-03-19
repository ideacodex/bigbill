    <?php

    use App\Adds;
    use App\Exports\DocsExport;
    use App\Exports\DocsAccount;
    use App\Exports\DocsAccountType;
    use App\Exports\DocsBill;
    use App\Exports\DocsCompany;
    use App\Exports\DocsCustomer;
    use App\Exports\DocsUser;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    Route::get('/', function () {
        // $records = Adds::all();
        // if ($records->first()) {

        //     return view('landingpage.inicio',  ['records' => $records->random(1)]);
        // } else {

        //     return view('landingpage.inicio',  ['records' => null]);
        // }
        return view('landingpage.inicio');
    });
    Auth::routes(['verify' => true]);

    Route::resource('home', 'HomeController')->middleware('auth');

    /**Product Route */
    Route::resource('productos', 'ProductController')->middleware('auth');
    /**Product Route */

    /**Companies Route */
    Route::resource('empresas', 'CompaniesController')->middleware('auth');
    Route::resource('sucursales', 'BranchOfficesController')->middleware('auth');
    /**Companies Route */

    /**Clients Route */
    Route::resource('clientes', 'CustomersController')->middleware('auth');
    Route::post('cliente', 'CustomersController@save')->middleware('auth')->name('cliente');
    /**Clients Route */

    /**Bill Route */
    Route::resource('facturas', 'InvoiceBillsController')->middleware('auth');
    Route::get('/editar/{id}', 'InvoiceBillsController@editar')->name('editar')->middleware('auth'); //Actualizar usuarios
    Route::patch('/update/{id}', 'InvoiceBillsController@update')->name('update'); //Edición de usuarios
    /**Bill Route */

    /** Shopping Route */
    Route::resource('compras', 'ShoppingsController')->middleware('auth');
    Route::get('Estmensual', 'HomeController@inicio')->middleware('auth');
    Route::post('textoXml', 'ShoppingsController@xml')->middleware('auth');
    /** Shopping Route */

    /**Companies Route */
    Route::resource('UsuariosEmpresa', 'UsuarioEmpresaController')->middleware('auth');
    /**Companies Route */

    /**userInfo Route */
    Route::resource('cuentas', 'AccountsController')->middleware('role:Administrador')->middleware('auth'); //autentificacion y permisos
    /**userInfo Route */

    /**Account_type Route */
    Route::resource('TipodeCuenta', 'AccountTypesController')->middleware('auth');
    /**Account_type Route */

    /** Download  PDF */
    Route::get('Product-list-pdf', 'ArchivosController@exportProductPDF')->name('Product.pdf')->middleware('auth');
    Route::get('Company-list-pdf', 'ArchivosController@exportCompanyPDF')->name('Company.pdf')->middleware('auth');
    Route::get('Branch-list-pdf', 'ArchivosController@exportBranchPDF')->name('Sucursales.pdf')->middleware('auth');
    Route::get('Customer-list-pdf', 'ArchivosController@exportCustomerPDF')->name('Customer.pdf')->middleware('auth');
    Route::get('Account-list-pdf', 'ArchivosController@exportAccountPDF')->name('Account.pdf')->middleware('auth');
    Route::get('Factura-list-pdf', 'ArchivosController@exportfacturatPDF')->name('Factura.pdf')->middleware('auth');
    Route::get('User-list-pdf', 'ArchivosController@exportUserPDF')->name('User.pdf')->middleware('auth'); //usuarios por empresa
    Route::get('User-all', 'ArchivosController@exportUserAllPDF')->name('Todos-los-Usuarios.pdf')->middleware('auth'); //Todos los usuarios
    Route::get('Compra-list-pdf', 'ArchivosController@exportCompraPDF')->name('Compra.pdf')->middleware('auth');
    /**Download PDF */
    /** Ventas de las empresas*/
    Route::get('facturaCompañia', 'ArchivosController@facturaCompañia')->middleware('auth');
    /** Ventas de las empresas*/
    /** Compras de las empresas*/
    Route::get('comprasCompañia', 'ArchivosController@comprasCompañia')->middleware('auth');
    /** Compras de las empresas*/

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

    /** perfil */
    Route::get('perfil', 'ArchivosController@Perfil')->middleware('role:Administrador|Gerente|Contador|Vendedor')->middleware('auth'); //autentificacion y permisos
    /** perfil */

    /** Usuarios de las empresas*/
    Route::get('Personal', 'ArchivosController@Personal')->middleware('auth'); //muestra listado de emleados y/o ususarios de una compañia
    Route::get('Personal/{id}', 'ArchivosController@eliminar')->middleware('auth'); //me manda al formulario de confirmacion de eliminar usuario de la compañia
    Route::get('PersonalEliminado/{id}', 'ArchivosController@deleteuser')->name('Personal.deleteuser')->middleware('auth'); //quita compañias, solo el gerente puede despedir a usuarios de su emrpesa
    /** Usuarios de las empresas*/

    /**Lista de precios Route */
    Route::resource('lista', 'PricelistController')->middleware('auth');
    /**Lista de precios Route */

    /**Prueba de sistema */
    Route::get('suscripcion', 'UsuarioEmpresaController@suscription_user');
    /**Prueba de sistema */

    /**Pago de suscripción */
    Route::resource('pago', 'PaymentSuscriptions')->middleware('auth');
    /**Pago de suscripción */


    /**Lista de Ajustes Route */
    Route::resource('Ajustes', 'SettingController')->middleware('auth');
    /**Lista de Ajustes Route */


    /**Lista de familias Route */
    Route::resource('familias', 'FamilyController')->middleware('role:Administrador|Gerente|Contador')->middleware('auth'); //autentificacion y permisos
    /**Lista de familias Route */

    /**Lista de marcas Route */
    Route::resource('marcas', 'MarkController')->middleware('role:Administrador|Gerente|Contador')->middleware('auth'); //autentificacion y permisos
    /**Lista de marcas Route */

    /** Asinate tu compania */
    Route::get('AsinateTuCompania', 'ArchivosController@Companyassignment')->middleware('role:Administrador|Gerente|Contador|Vendedor')->middleware('auth'); //autentificacion y permisos
    /** Asinate tu compania */

    /** https://www.youtube.com/watch?v=h0H4Y0U2DGk */
    /**
     * PENDIENTE
     *
     */
    //Importar productos de Excel a mysql
    // Route::post('import-list-excel', 'ArchivosController@importExcel')->name('products.import.excel')->middleware('auth');
    //Importar productos de Excel a mysql

    /* React */
    Route::get('factura/create', 'InvoiceBillsController@createReact')->middleware('auth');
    Route::get('factura/edit/{id}', 'InvoiceBillsController@editReact')->middleware('auth');
    /* React */

    // pagina de visualizacion de publicaciones usuario
    // Route::get('Publicaciones', 'publicaciones@Publications');
    // pagina de visualizacion de publicaciones usuario



    // pagina de visualizacion de publicaciones Administrador
    Route::resource('Publicaciones', 'PublicationsController');
// pagina de visualizacion de publicaciones Administrador
