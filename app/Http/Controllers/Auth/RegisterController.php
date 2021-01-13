<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       DB::beginTransaction();
       try{
          if (!Role::find(1)){
              $roleSuper = Role::create(['name' => 'Usuario']);
              $roleAdmin = Role::create(['name' => 'Vendedor']);
              $roleSeller = Role::create(['name' => 'Contador']);
              $roleFinal = Role::create(['name' => 'Gerente']);
          }
          $request = new Request($data);
       }catch(\Illuminate\Database\QueryException $e){
           DB::rollback();
           abort(500, $e->errorInfo[2]);
           return response()->json($response, 500);
       }
       DB::commit();

       $user = new User();
       $user->name = $data['name'];
       $user->lastname = $data['lastname'];
       $user->email = $data['email'];
       $user->password = Hash::make($data['password']);
       $user->phone = $data['phone'];
       $user->nit = $data['nit'];
       $user->address = $data['address'];
       $user->role_id = 4;
       $user->save();

       return $user;
    }
}
