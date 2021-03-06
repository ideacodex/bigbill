<?php

namespace App\Http\Controllers;

use App\Adds;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

use App\Company;
use App\Product;
use App\Post;
use App\Reaction;
use App\Question;
use App\Category;
use App\Award;
use App\BranchOffice;
use App\Customer;
use App\InvoiceBill;
use App\User;
use App\Score;
use App\Shopping;
use App\DetailBill;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole(['Administrador', 'Gerente', 'Contador', 'Vendedor'])) {
            auth()->user()->syncRoles('Vendedor');
        }
        $rol = Auth::user()->role_id;
        $anuncios = Adds::all();
        $mesactual = date("Y-m");
        $fecha1 =  $mesactual . "-01";
        $fecha2 = $mesactual . "-31";
        /*  dd($fecha1, $fecha2); */
        if ($rol == 1) {
            $company = Company::all();
            $products = Product::where('stock', '!=', 0)->get();
            $prodag = Product::where('stock', 0)->get();
            $invoice = InvoiceBill::all();

            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::distinct('customer_id')->pluck('customer_id');
            $customer = Customer::whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Accedo al total de productos que tiene cada detalle */
            $productId = DetailBill::distinct('product_id')->pluck('product_id');
            $productos = Product::whereIn('id', $productId)->with('detailbill')->get();
            /* Accedo al total de productos que tiene cada detalle */

            /* Estad??sticas anuales */
            $bills = InvoiceBill::get()->where('active', 1)->count();
            $shoppings = Shopping::get()->where('active', 1)->count();
            $user = User::get()->count();
            $ibill = InvoiceBill::get()->where('active', 1)->sum('total');
            $ishopping = Shopping::get()->where('active', 1)->sum('total');
            /* Estad??sticas anuales */

            /* Estad??sticas mensuales */
            $invoicem = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $bill = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $shopping = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $users = User::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->count();
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $customerf = Customer::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->whereIn('id', $idClientes)->with('bills')->get();
            /* Estad??sticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.PrimerIngreso', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.PrimerIngreso', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
            }
        } else {
            $companies = Auth::user()->company_id;
            $prodag = Product::where('stock', 0)->where('company_id', $companies)->get();
            $company = Company::all();
            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::where('company_id', $companies)->distinct('customer_id')->pluck('customer_id');
            $customer = Customer::where('company_id', $companies)->whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Accedo al total de productos que tiene cada detalle */
            $productId = DetailBill::distinct('product_id')->pluck('product_id');
            $productos = Product::where('company_id', $companies)->whereIn('id', $productId)->with('detailbill')->get();
            /* Accedo al total de productos que tiene cada detalle */

            /* Estad??sticas anuales */
            $bills = InvoiceBill::get()->where('active', 1)->where('company_id', $companies)->count();
            $shoppings = Shopping::get()->where('active', 1)->where('company_id', $companies)->count();
            $ishopping = Shopping::where('company_id', $companies)->get()->sum('total');
            $products = Product::where('company_id', $companies)->get();
            $invoice = InvoiceBill::where('company_id', $companies)->get();
            $bill = InvoiceBill::where('company_id', $companies)->get()->count();
            $user = User::where('company_id', $companies)->get()->count();
            $shopping = Shopping::where('company_id', $companies)->get()->count();
            $users = User::where('company_id', $companies)->get()->count();
            $ibill = InvoiceBill::where('company_id', $companies)->where('active', 1)->get()->sum('total');
            /* Estad??sticas anuales */

            /* Estad??sticas mensuales */
            $invoicem = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->get();
            $bill = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->count();
            $shopping = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->count();
            $users = User::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->where('company_id', $companies)->count();
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            $customerf = Customer::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->whereIn('id', $idClientes)->where('company_id', $companies)->with('bills')->get();
            /* Estad??sticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.PrimerIngreso', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.PrimerIngreso', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // dd($request);
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $role_id = Auth::user()->role_id;
        $user = User::findOrFail($id);
        $companiaUsuario = Auth::user()->company_id;
        $anuncios = Adds::all();

        if ($role_id == 2 && $companiaUsuario != null) {

            $companies = Company::where('id', $companiaUsuario)->first();

            $branch_office = BranchOffice::all();

            if ($anuncios->first()) {
                return view('userInfo.edit', ['branch_office' => $branch_office, 'companies' => $companies, 'user' => $user, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('userInfo.edit', ['branch_office' => $branch_office, 'companies' => $companies, 'user' => $user, 'anuncios' => null]); //generala vista
            }
        } else {
            if ($role_id == 1) {
                $company = Company::all();
                $branch_office = BranchOffice::all();
                if ($anuncios->first()) {
                    return view('userInfo.edit', ['branch_office' => $branch_office, 'company' => $company, 'user' => $user, 'anuncios' => $anuncios->random(1)]); //generala vista
                } else {
                    return view('userInfo.edit', ['branch_office' => $branch_office, 'company' => $company, 'user' => $user, 'anuncios' => null]); //generala vista
                }
            } else {

                $company = Company::all();
                $branch_office = BranchOffice::all();
                if ($anuncios->first()) {
                    return view('userInfo.edit', ['branch_office' => $branch_office, 'company' => $company, 'user' => $user, 'anuncios' => $anuncios->random(1)]); //generala vista
                } else {
                    return view('userInfo.edit', ['branch_office' => $branch_office, 'company' => $company, 'user' => $user, 'anuncios' => null]); //generala vista
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public  function update(Request $request, $id)
    {
        $messege = 'Registro Modificado';
        // dd($request);
        request()->validate([
            'role_id' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|numeric|digits_between:6,11',
            'nit' => 'required',
            'address' => 'required',
            'email' => 'required',
            'file' => 'image',


        ]);
        DB::beginTransaction();
        try {
            //mandamos a llamar al modelo
            $user = User::findOrFail($id);
            // dd($id);
            //Actualizamos los datos con todo lo que venga del request

            if ($request->role_id == "Gerente") {
                # code...
                $rol_usuario = 2;
            } else {
                # code...
                if ($request->role_id == "Contador") {
                    # code...
                    $rol_usuario = 3;
                } else {
                    # code...

                    if ($request->role_id == "Vendedor") {
                        # code...
                        $rol_usuario = 4;
                    } else {
                        //dd($user->role_id);
                        $rol_usuario = $user->role_id;
                    }
                }
            }
            //  dd($rol_usuario);
            $role = Role::find($rol_usuario); //edito el rol por medio el role_id
            $user->syncRoles($role); //actualizo el rol en la tabla de permisos
            $user->role_id = $rol_usuario; //actualizo el rol en la tabla de usuarios




            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->nit = $request->nit;
            $user->address = $request->address;
            $user->email = $request->email;
            $request->company_id;
            $user->branch_id = $request->branch_id;

            if ($request->company_id == null) {
                $user->company_id = null;
            } else {
                $cps = Company::where('nit', $request->company_id)->first();
                if ($cps) {
                    if ($cps->nit == $request->company_id) {
                        //Asignaci??n de empresa por input
                        $user->company_id = $cps->id;
                        $messege = "Se le agrego a la Empresa solicitada, " . $cps->name;
                    } else {
                        $user->company_id = null;
                        $messege = "No pudimos encontrar ninguna Empresa con el nit ingresado";
                    }
                } else {
                    $user->company_id = null;
                    $messege = "No pudimos encontrar ninguna Empresa con el nit ingresado";
                }
            }
            //permisos de accion
            // $permisos = Auth::user()->work_permits;

            
            if ($request->work_permits == 1) {
                $user->work_permits = 1;
            } else {
                $user->work_permits = 0;
            }

            //Guarda Informacion
            $user->save();
            //si viene alguna imagen nueva va a guardar la imagen actualizando el archivo
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $user->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/usuarios', $imageNameToStore);
                    //dd($path);
                    $user->file = $imageNameToStore;
                    $user->save();
                } else {
                    $imageNameToStore = 'no_image.jpg';
                }
            }
            //***carga de imagen***//
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('ArchivosController@Perfil')
            ->with('MENSAJEEXITOSO', $messege);
    }

    public function inicio(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole(['Administrador', 'Gerente', 'Contador', 'Vendedor'])) {
            auth()->user()->syncRoles('Vendedor');
        }
        $rol = Auth::user()->role_id;
        $anuncios = Adds::all();
        $mesactual = date("Y-m");
        $fecha1 =  $mesactual . "-01";
        $fecha2 = $mesactual . "-31";
        /*  dd($fecha1, $fecha2); */
        if ($rol == 1) {
            $company = Company::all();
            $products = Product::where('stock', '!=', 0)->get();
            $prodag = Product::where('stock', 0)->get();
            $invoice = InvoiceBill::all();

            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::distinct('customer_id')->pluck('customer_id');
            $customer = Customer::whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Accedo al total de productos que tiene cada detalle */
            $productId = DetailBill::distinct('product_id')->pluck('product_id');
            $productos = Product::whereIn('id', $productId)->with('detailbill')->get();
            /* Accedo al total de productos que tiene cada detalle */

            /* Estad??sticas anuales */
            $bills = InvoiceBill::get()->where('active', 1)->count();
            $shoppings = Shopping::get()->where('active', 1)->count();
            $user = User::get()->count();
            $ibill = InvoiceBill::get()->where('active', 1)->sum('total');
            $ishopping = Shopping::get()->where('active', 1)->sum('total');
            /* Estad??sticas anuales */

            /* Estad??sticas mensuales */
            $invoicem = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $bill = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $shopping = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $users = User::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->count();
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $customerf = Customer::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->whereIn('id', $idClientes)->with('bills')->get();
            /* Estad??sticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.estmonth', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.estmonth', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
            }
        } else {
            $companies = Auth::user()->company_id;
            $prodag = Product::where('stock', 0)->where('company_id', $companies)->get();
            $company = Company::all();
            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::where('company_id', $companies)->distinct('customer_id')->pluck('customer_id');
            $customer = Customer::where('company_id', $companies)->whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Accedo al total de productos que tiene cada detalle */
            $productId = DetailBill::distinct('product_id')->pluck('product_id');
            $productos = Product::where('company_id', $companies)->whereIn('id', $productId)->with('detailbill')->get();
            /* Accedo al total de productos que tiene cada detalle */

            /* Estad??sticas anuales */
            $bills = InvoiceBill::get()->where('active', 1)->where('company_id', $companies)->count();
            $shoppings = Shopping::get()->where('active', 1)->where('company_id', $companies)->count();
            $ishopping = Shopping::where('company_id', $companies)->get()->sum('total');
            $products = Product::where('company_id', $companies)->get();
            $invoice = InvoiceBill::where('company_id', $companies)->get();
            $bill = InvoiceBill::where('company_id', $companies)->get()->count();
            $user = User::where('company_id', $companies)->get()->count();
            $shopping = Shopping::where('company_id', $companies)->get()->count();
            $users = User::where('company_id', $companies)->get()->count();
            $ibill = InvoiceBill::where('company_id', $companies)->where('active', 1)->get()->sum('total');
            /* Estad??sticas anuales */

            /* Estad??sticas mensuales */
            $invoicem = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->get();
            $bill = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->count();
            $shopping = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->where('company_id', $companies)->count();
            $users = User::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->where('company_id', $companies)->count();
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            $customerf = Customer::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->whereIn('id', $idClientes)->where('company_id', $companies)->with('bills')->get();
            /* Estad??sticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.estmonth', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.estmonth', ['prodag' => $prodag, 'invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
            }
        }
    }
}
