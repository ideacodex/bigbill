<?php

namespace App\Http\Controllers;

use App\Adds;
use App\Company;
use App\Family;
use App\mark;
use App\pivote_family;
use App\pivote_mark;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $mark = mark::with('company')->get();
            $product = Product::with('companies')->get();
            $company = Company::all();
            $family = Family::with('company')->get();
            return view("product.index", ['company' => $company, 'products' => $product, 'mark' => $mark, 'family' => $family]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $product = Product::where('company_id', $company)->with('companies')->get(); //Obtener los valores 
            $mark = mark::where('company_id', $company)->with('company')->get(); //Obtener los valores de tu request:
            $anuncios = Adds::all();
            $family = Family::where('company_id', $company)->with('company')->get(); //Obtener los valores de tu request:
            if ($anuncios->first()) {
                return view("product.index", ['family' => $family, 'mark' => $mark,'products' => $product, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view("product.index", ['family' => $family, 'mark' => $mark,'products' => $product, 'anuncios' => null]);
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $companies = Company::all(); //Selecciona todos los datos de la tabla compañia
            $family = Family::all();
            $mark = mark::all();
            return view("product.create", ['companies' => $companies, 'family' => $family, 'mark' => $mark]); //retorna vista con los datos correspondientes
        } else {
            $company = Auth::user()->company_id;
            $family = Family::where('company_id', $company)->get(); //Obtener los valores de tu request:
            $mark = mark::where('company_id', $company)->get(); //Obtener los valores de tu request:
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view("product.create", ['family' => $family, 'mark' => $mark, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view("product.create", ['family' => $family, 'mark' => $mark, 'anuncios' => null]);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'kind_product' => 'required',
            'company_id' => 'required',
            'quantity_values' => 'required',
            'file' => 'image',

        ]);
        DB::beginTransaction();
        try {

            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->company_id = $request->company_id;
            $product->tax = $request->tax;
            $product->quantity_values = $request->quantity_values;
            if ($request->kind_product == 1) {
                # code...
                $product->kind_product = 1;
                $product->price = $request->price;
                $product->special_price = $request->special_price;
                $product->credit_price = $request->credit_price;
                $product->cost = 0;
            } else {
                if ($request->kind_product == 2) {
                    # code...
                    $product->kind_product = 2;
                    $product->price = 0;
                    $product->special_price = 0;
                    $product->credit_price = 0;
                    $product->cost = $request->cost;
                } else {
                    $product->kind_product = 3;
                    $product->price = $request->price;
                    $product->special_price = $request->special_price;
                    $product->credit_price = $request->credit_price;
                    $product->cost = $request->cost;
                }
            }
            $product->stock = $request->quantity_values;
            if ($product->quantity_values >= 1) {
                $product->active = 1;
            } else {
                $product->active = 0;
            }
            $product->income_amount = $request->quantity_values;
            $product->new_income = 0;
            $product->total_revenue = $request->quantity_values;
            $product->amount_expenses = $request->amount_expenses;
            $product->weight = $request->weight;
            $product->tall = $request->tall;
            $product->broad = $request->broad;
            $product->depth = $request->depth;

            $product->save();
            // crear la insercion de  categorias en la tabla FAMILIES
            for ($i = 0; $i < sizeof($request->family_id); $i++) {
                $request->family_id[$i];
                DB::table('pivote_families')->insert(
                    ['family_id' => $request->family_id[$i], 'product_id' => $product->id]
                );
            }
            // crear el insertado de datos en marcas en la tabla MARKS
            for ($i = 0; $i < sizeof($request->mark_id); $i++) {
                $request->mark_id[$i];
                DB::table('pivote_marks')->insert(
                    ['mark_id' => $request->mark_id[$i], 'product_id' => $product->id]
                );
            }

            //***carga de imagen***//
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $imageNameToStore = $product->id . '.' . $extension;
                // Upload file //***nombre de carpeta para almacenar**
                $path = $request->file('file')->storeAs('public/productos', $imageNameToStore);
                //dd($path);
                $product->file = $imageNameToStore;
                $product->save();
            } else {
                $imageNameToStore = 'no_image.jpg';
            }
            //***carga de imagen***//
        } catch (\Illuminate\Database\QueryException $e) {

            DB::rollback();
            // dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@index')
            ->with('datosEliminados', 'Registro exitoso');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pivote_mark = pivote_mark::with('product')->with('marks')->get();
        $pivote_family = pivote_family::with('families')->with('products')->get();
        $products = Product::with('company')->find($id);
        $anuncios = Adds::all();
        if ($anuncios->first()) {
            return view('product.show', ['products' => $products,  'pivote_family' => $pivote_family, 'pivote_mark' => $pivote_mark, 'anuncios' => $anuncios->random(1)]);
        } else {
            return view('product.show', ['products' => $products,  'pivote_family' => $pivote_family, 'pivote_mark' => $pivote_mark, 'anuncios' => null]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Auth::user()->role_id;

        $products = Product::where('id', $id)->with('pivotMark')->with('pivotFamily')->first();
        $family = Family::whereNotIn('id', ($products->pivotFamily->pluck('family_id')))->get(); //Selecciona todos los datos de la tabla families
        $mark = mark::whereNotIn('id', $products->pivotMark->pluck('mark_id'))->get(); //Selecciona todos los datos de la tabla marks
        $companies = Company::all(); //Selecciona todos los datos de la tabla compañia
        if ($rol == 1) {
            $family = Family::whereNotIn('id', ($products->pivotFamily->pluck('family_id')))->get(); //Selecciona todos los datos de la tabla families
            $mark = mark::whereNotIn('id', $products->pivotMark->pluck('mark_id'))->get(); //Selecciona todos los datos de la tabla marks
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $family = Family::whereNotIn('id', ($products->pivotFamily->pluck('family_id')))->where('company_id', $company)->get(); //Selecciona todos los datos de la tabla families
            $mark = mark::whereNotIn('id', $products->pivotMark->pluck('mark_id'))->where('company_id', $company)->get(); //Selecciona todos los datos de la tabla marks
        }
        $anuncios = Adds::all();
        if ($anuncios->first()) {
            return view('product.edit', ['companies' => $companies, 'products' => $products, 'family' => $family, 'mark' => $mark, 'pivote_mark' => $products->pivotMark, 'pivote_family' => $products->pivotFamily,  'anuncios' => $anuncios->random(1)]);
        } else {
            return view('product.edit', ['companies' => $companies, 'products' => $products, 'family' => $family, 'mark' => $mark, 'pivote_mark' => $products->pivotMark, 'pivote_family' => $products->pivotFamily,  'anuncios' => null]);
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
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'kind_product' => 'required',
            'cost' => 'required',
            'company_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $products = Product::findOrFail($id);
            $products->name = $request->name;
            $products->description = $request->description;
            if ($request->kind_product == 1) {
                # code...
                $products->kind_product = 1;
                $products->price = $request->price;
                $products->special_price = $request->special_price;
                $products->credit_price = $request->credit_price;
                $products->cost = 0;
            } else {
                if ($request->kind_product == 2) {
                    # code...
                    $products->kind_product = 2;
                    $products->price = 0;
                    $products->special_price = 0;
                    $products->credit_price = 0;
                    $products->cost = $request->cost;
                } else {
                    $products->kind_product = 3;
                    $products->price = $request->price;
                    $products->special_price = $request->special_price;
                    $products->credit_price = $request->credit_price;
                    $products->cost = $request->cost;
                }
            }
            $products->company_id = $request->company_id;
            //**Ingresos anteriores */
            $products->income_amount = $request->income_amount;
            /**Nuevos ingresos */
            $products->new_income = $request->new_income;
            /**Total de ingresos */
            $products->total_revenue = $request->total_revenue;
            $products->amount_expenses = $request->amount_expenses;
            /**Stock anterior */
            $temporal = $products->new_income;
            /**Stock actualizado */
            $products->stock = $temporal + $request->quantity_values;
            $products->quantity_values = $products->stock;
            if ($products->stock >= 1) {
                $products->active = 1;
            } else {
                $products->active = 0;
            }
            $products->save();
            // actualizar etiquetas de familia al producto
            {
                //Buscamos los items de pivote_families relacionados con un solo post
                $productDB = DB::table('pivote_families')->where('product_id', $products->id)->get();
                //si todo sale bien, si lo que entra coincide con lo que sale entonces realizar lo siguiente
                if (sizeof($request->family_id) >= sizeof($productDB)) {
                    DB::table('pivote_families')->where('product_id', $products->id)->delete();
                    //repite el ciclo for para actualizar datos
                    for ($i = 0; $i < sizeof($request->family_id); $i++) {
                        $request->family_id[$i];
                        DB::table('pivote_families')->insert(
                            ['family_id' => $request->family_id[$i], 'product_id' => $products->id]
                        );
                    }
                } else {
                    //sino estan incluidos guardar nuevos registros
                    DB::table('pivote_families')->where('product_id', $products->id)->delete();
                    for ($i = 0; $i < sizeof($request->family_id); $i++) {
                        $request->family_id[$i];
                        DB::table('pivote_families')->insert(
                            ['family_id' => $request->family_id[$i], 'product_id' => $products->id]
                        );
                    }
                }
            }

            // actualizar etiquetas de marcas al producto
            {
                //Buscamos los items de pivote_marks relacionados con un solo post
                $productDB = DB::table('pivote_marks')->where('product_id', $products->id)->get();
                //si todo sale bien, si lo que entra coincide con lo que sale entonces realizar lo siguiente
                if (sizeof($request->mark_id) >= sizeof($productDB)) {
                    DB::table('pivote_marks')->where('product_id', $products->id)->delete();
                    //repite el ciclo for para actualizar datos
                    for ($i = 0; $i < sizeof($request->mark_id); $i++) {
                        $request->mark_id[$i];
                        DB::table('pivote_marks')->insert(
                            ['mark_id' => $request->mark_id[$i], 'product_id' => $products->id]
                        );
                    }
                } else {
                    //sino estan incluidos guardar nuevos registros
                    DB::table('pivote_marks')->where('product_id', $products->id)->delete();
                    for ($i = 0; $i < sizeof($request->mark_id); $i++) {
                        $request->mark_id[$i];
                        DB::table('pivote_marks')->insert(
                            ['mark_id' => $request->mark_id[$i], 'product_id' => $products->id]
                        );
                    }
                }
            }

            //***carga de imagen***//
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $products->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/productos', $imageNameToStore);
                    //dd($path);
                    $products->file = $imageNameToStore;
                    $products->save();
                } else {
                    $imageNameToStore = 'no_image.jpg';
                }
            }
            //***carga de imagen***//

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@index')
            ->with('datosEliminados', 'Registro modificado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            if ($product->active == 1) {
                $product->where('id', $id)->update(['active' => 0]);
            } else {
                $product->where('id', $id)->update(['active' => 1]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@index');
    }
    public function getProduct($id)
    {
        /*  $user = auth()->user()->id;
        if (isset($user)) { */
        $product = Product::find($id);
        if (!isset($product)) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Producto inexistente'
            ];
        } else {
            $data = [
                'code' => 200,
                'status' => 'success',
                'stock' => $product->stock,
                'price' => $product->price
            ];
        }
        /*  } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Usuario no identificado'
            ];
        } */

        return response()->json($data, $data['code']);
    }
}
