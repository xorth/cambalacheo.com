<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $redirectPath = '/panel';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'edit', 'update']]);
        $this->middleware('auth', ['only' => ['edit', 'update']]);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id']
        ]);
    }

    /**
     * Edit a user
     */
    public function edit()
    {
        $user_id = \Auth::user()->id;

        $user = User::find($user_id);

        $states = \App\State::lists('name', 'id');

        $cities = \App\City::where('state_id', $user->state_id)->lists('name', 'id');

        return view('auth.edit', compact('user', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $messages = [
            'required'     => 'Este campo es requerido.',
            'confirmed'    => 'La contraseña no coincide',
            'password.min' => 'No debe ser menor a :min caracteres.',
        ];

        $rules = [
            'name'     => 'required|min:3|max:255',
            'email'    => 'required|email',
            'state_id' => 'required',
            'city_id'  => 'required',
        ];

        if (!empty($request->password)) {
            $rules['password'] = 'required|confirmed|min:6';
        }

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('panel/profile')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $user = \App\User::find($id);
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->state_id = $request->state_id;
            $user->city_id  = $request->city_id;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect('/panel/profile');
        }
    }

    // Override
    public function getRegister()
    {
        $states = \App\State::lists('name', 'id');

        return view('auth.register', compact('states'));
    }
}
