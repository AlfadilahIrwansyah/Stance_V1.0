<?php

namespace App\Http\Controllers\Auth;

use App\Models\RefUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'role' => ['required', 'integer'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ref_user'],
        ]);
        return $validator;


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\RefUser
     */
    protected function create(array $data, $tempPass)
    {

        return RefUser::create([
            'name' => $data['name'],
            'ref_role_id' => $data['role'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($tempPass,
            'is_activated' => 0
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
            'email' => 'required|string|email|max:255|unique:ref_user',
            'phone_number' => 'required|string',
            'role' => 'required|integer',
            'password' => 'required|string|min:8',
        ];

        $messages = [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email harus diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'phone_number.required' => 'Nomor telepon harus diisi.',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',

            'role.required' => 'Peran harus diisi.',
            'role.integer' => 'Peran harus berupa angka.',

            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
        ];

        $validator = Validator::make(
            [$field => $value],
            [$field => $rules[$field]],
            $messages
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->get($field)]);
        }

        return response()->json(['valid' => true]);
    }
}
