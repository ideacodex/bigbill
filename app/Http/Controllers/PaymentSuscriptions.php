<?php

namespace App\Http\Controllers;

use App\PaymentSuscription;
use App\Suscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentSuscriptions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'suscription_id' => 'required',
            'comments',
            'amount' => 'required',
            'suscription_time' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $payment = new PaymentSuscription();
            $payment->suscription_id = $request->suscription_id;
            $payment->comments = $request->comments;
            $payment->amount = $request->amount;
            $payment->suscription_time = $request->suscription_time;
            $payment->save();

            $suscription = Suscription::find($request->suscription_id);
            if ($payment->suscription_time > 1) {
                $suscription->active = 1;
            } elseif ($payment->suscription_time <= 0) {
                $suscription->active = 0;
            }
            $temporal = $request->suscription_time * 30;
            $suscription->date_expiration = Carbon::parse($suscription->date_expiration->addDays($temporal)->format('Y-m-d'));
            $suscription->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('UsuarioEmpresaController@index')
            ->with('datosAgregados', 'Registro de pago exitoso');
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
