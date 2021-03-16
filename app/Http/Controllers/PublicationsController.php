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
    public function index()
    {
        //Vista Administrador
        $records = Adds::all();
        return view('Publications.preview', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Vista ususarios
        return view('Publications.index');
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
                $path = $request->file('file')->storeAs('public/addS', $imageNameToStore);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
