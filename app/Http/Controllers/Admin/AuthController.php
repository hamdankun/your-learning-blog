<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * The name route login for redirect
     */
    CONST ROUTE_LOGIN = 'admin.login.index';

    /**
     * Show page login
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.login.index');
    }

    /**
     * Authenticate user
     * @return \Illuminate\Http\Response
     */
    public function attempt(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $this->setNotification('success', trans('auth.success'));
            return $this->toRoute('admin.dashboard');
        }

        $this->setNotification('error', trans('auth.failed'));
        return $this->toRoute(static::ROUTE_LOGIN)->withInput();
    }

    /**
     * Logout User
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        return $this->toRoute(static::ROUTE_LOGIN);
    }
}
