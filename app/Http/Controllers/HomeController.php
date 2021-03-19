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
            $products = Product::all();
            $invoice = InvoiceBill::all();

            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::distinct('customer_id')->pluck('customer_id');
            $customer = Customer::whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Accedo al total de productos que tiene cada detalle */
            $productId = DetailBill::distinct('product_id')->pluck('product_id');
            $productos = Product::whereIn('id', $productId)->with('detailbill')->get();
            /* Accedo al total de productos que tiene cada detalle */

            /* Estadísticas anuales */
            $bills = InvoiceBill::get()->where('active', 1)->count();
            $shoppings = Shopping::get()->where('active', 1)->count();
            $user = User::get()->count();
            $ibill = InvoiceBill::get()->where('active', 1)->sum('total');
            $ishopping = Shopping::get()->where('active', 1)->sum('total');
            /* Estadísticas anuales */

            /* Estadísticas mensuales */
            $invoicem = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $bill = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $shopping = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->count();
            $users = User::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->count();
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('active', '!=', 0)->get();
            $customerf = Customer::whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->whereIn('id', $idClientes)->with('bills')->get();
            /* Estadísticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.PrimerIngreso', ['invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.PrimerIngreso', ['invoicem' => $invoicem, 'productos' => $productos, 'customerf' => $customerf, 'user' => $user, 'shoppings' => $shoppings, 'bills' => $bills, 'ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'customer' => $customer, 'ibill' => $ibill, 'users' => $users, 'company' => $company, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
            }
        } else {
            $companies = Auth::user()->company_id;
            $company = Company::all();
            /* Accedo al total de facturas que tiene cada cliente */
            $idClientes = InvoiceBill::where('company_id', $companies)->distinct('customer_id')->pluck('customer_id');
            $customer = Customer::where('company_id', $companies)->whereIn('id', $idClientes)->with('bills')->get();
            /* Accedo al total de facturas que tiene cada cliente */

            /* Estadísticas anuales */
            $ishopping = Shopping::where('company_id', $companies)->get()->sum('total');
            $products = Product::where('company_id', $companies)->get();
            $invoice = InvoiceBill::where('company_id', $companies)->get();
            $bill = InvoiceBill::where('company_id', $companies)->get()->count();
            $shopping = Shopping::where('company_id', $companies)->get()->count();
            $users = User::where('company_id', $companies)->get()->count();
            $ibill = InvoiceBill::where('company_id', $companies)->where('active', 1)->get()->sum('total');
            /* Estadísticas anuales */

            /* Estadísticas mensuales */
            $ibillm = InvoiceBill::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            $ishoppingm = Shopping::whereDate('date_issue', '>=', $fecha1)->whereDate('date_issue', '<=', $fecha2)->where('company_id', $companies)->where('active', '!=', 0)->get();
            /* Estadísticas mensuales */

            if ($anuncios->first()) {
                return view('PrimerIngreso.PrimerIngreso', ['ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('PrimerIngreso.PrimerIngreso', ['ibillm' => $ibillm, 'ishoppingm' => $ishoppingm, 'ishopping' => $ishopping, 'company' => $company, 'companies' => $companies, 'ibill' => $ibill, 'customer' => $customer, 'users' => $users, 'products' => $products, 'invoice' => $invoice, 'bill' => $bill, 'shopping' => $shopping, 'anuncios' => null]); //generala vista
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
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $role_id = Auth::user()->role_id;
        $user = User::findOrFail($id);
        $anuncios = Adds::all();
        if ($role_id == 2) {
            $companies = Company::where('user', $id)->get();
            if ($anuncios->first()) {
                return view('userInfo.edit', ['companies' => $companies, 'user' => $user, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('userInfo.edit', ['companies' => $companies, 'user' => $user, 'anuncios' => null]); //generala vista
            }
        } else {
            $company = Company::all();
            if ($anuncios->first()) {
                return view('userInfo.edit', ['company' => $company, 'user' => $user, 'anuncios' => $anuncios->random(1)]); //generala vista
            } else {
                return view('userInfo.edit', ['company' => $company, 'user' => $user, 'anuncios' => null]); //generala vista
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
            //Actualizamos los datos con todo lo que venga del request
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->nit = $request->nit;
            $user->address = $request->address;
            $user->email = $request->email;
            $request->company_id;


            if ($request->company_id == null) {
                $user->company_id = null;
            } else {
                $cps = Company::where('nit', $request->company_id)->first();
                if ($cps) {
                    if ($cps->nit == $request->company_id) {
                        //Asignación de empresa por input
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
            $permisos = Auth::user()->work_permits;
            if ($permisos == 1) {
                $user->work_permits = $permisos;
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
}
