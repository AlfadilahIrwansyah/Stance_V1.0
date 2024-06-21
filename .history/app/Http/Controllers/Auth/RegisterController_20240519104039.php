<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RefUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.regiser');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'ref_role_id' => ['required','integer'],
            'phone_number' => ['required','integer', 'min:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ref_user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        return $validator;


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\RefUser
     */
    protected function create(array $data)
    {

        return RefUser::create([
            'name' => $data['name'],
            'ref_role_id' => $data['ref_role_id'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateField(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'ref_role_id' => 'required|integer',
            'phone_number' =>
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make(
            [$field => $value],
            [$field => $rules[$field]]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->get($field)]);
        }

        return response()->json(['valid' => true]);
    }
}
