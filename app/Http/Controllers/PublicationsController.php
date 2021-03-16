<?php

namespace App\Http\Controllers;

use App\Adds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //vista de administrador
    {
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        //Vista Administrador
        $records = Adds::all();
        return view('Publications.preview', ['records' => $records]);
    }

    public function viewPublication() //vista publica
    {
        // Vista ususarios
        $records = Adds::all();
        return view('Publications.index', ['records' => $records]);
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
            'title' => 'required',
            'description' => 'required',
            'file' => 'image',

        ]);
        DB::beginTransaction();
        try {

            $add = new Adds;
            $add->title = $request->title;
            $add->description = $request->description;
            $add->link = $request->link;
            $add->save();


            //***carga de imagen***//
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $imageNameToStore = $add->id . '.' . $extension;
                // Upload file //***nombre de carpeta para almacenar**
                $path = $request->file('file')->storeAs('public/adds', $imageNameToStore);
                //dd($path);
                $add->file = $imageNameToStore;
                $add->save();
            } else {
                $imageNameToStore = 'no_image.jpg';
            }
            //***carga de imagen***//
        } catch (\Illuminate\Database\QueryException $e) {

            DB::rollback();
            // dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('PublicationsController@index')
            ->with('Mensaje', 'Se creo con exito la publicacion');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Adds::findOrFail($id);
        return view('Publications.edit', ['records' => $records]);
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
            'title' => 'required',
            'description' => 'required',
            'file' => 'image',
        ]);
        DB::beginTransaction();
        try {
            $adds = Adds::findOrFail($id);
            $adds->title = $request->title;
            $adds->description = $request->description;
            $adds->link = $request->link;


            $adds->save();

            //***carga de imagen***//
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $adds->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/adds', $imageNameToStore);
                    //dd($path);
                    $adds->file = $imageNameToStore;
                    $adds->save();
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
        return redirect()->action('PublicationsController@index')
            ->with('Mensaje', 'Registro modificado');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
