<?php

namespace App\Http\Controllers;

use App\PaymentSuscription;
use App\Suscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class PaymentSuscriptions extends Controller
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

            $suscription = Suscription::with('user')->find($request->suscription_id);
            /* Traigo el id de la suscripción guardada en el pago */
            if ($payment->suscription_time >= 1) {
                /* Si el tiempo es mayor a 1 pone mi active a 1 */
                $suscription->active = 1;
                if (!is_null($suscription->user->history_company_id)) {
                    /* dd($suscription->user->history_company_id, $suscription->user->company_id); */
                    $suscription->user->company_id = $suscription->user->history_company_id;
                    $suscription->user->history_company_id = null;
                    $suscription->user->save();
                }
                if (!is_null($suscription->user->history_role_id)) {
                    $role = Role::find($suscription->user->history_role_id);
                    $suscription->user->role_id = $suscription->user->history_role_id;
                    $suscription->user->syncRoles($role);
                    $suscription->user->history_role_id = null;
                    $suscription->user->save();
                }
            } elseif ($payment->suscription_time <= 0) {
                /* Si no lo deja en 0 */
                $suscription->active = 0;
            }

            $suscription->type_plan = $request->type_plan;

            /* Multiplico el tiempo de suscripción por los 30 días mensuales y lo guardo en la variable temporal*/
            $temporal = $request->suscription_time * 30;
            /* La variable temporal llevará el resultado y serán los días a agregar en la fecha */
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
