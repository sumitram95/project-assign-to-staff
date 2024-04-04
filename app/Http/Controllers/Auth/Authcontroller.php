<?php

namespace App\Http\Controllers\Auth;

use App\Constant\Status;
use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
// use GeoIP2\Database\Reader;
use MaxMind\Db\Reader;

class Authcontroller extends Controller
{

    // login view page
    public function loginPage(Request $request)
    {
        try {
            return view('auth.pages.login');
        } catch (\Throwable $th) {
            echo $th;
        }

    }

    // loggeIn when loginCheck() return true
    public function loggedIn(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();

            //check email and password inside  $this->loginCheck($validated['email'], $validated['password'])
            return $this->loginCheck($validated['email'], $validated['password']);

        } catch (\Throwable $th) {

            echo $th;
        }

    }

    // email and password check after logingged in
    public function loginCheck($email, $password)
    {
        try {

            if (Auth::attempt(['email' => $email, 'password' => $password])) {

                return redirect()->route('dashboard.index');
            }

            return redirect()->back()->with('error', 'Invalid Email and Password');

        } catch (\Exception $e) {
            // Handle the exception

            // You can log the exception
            Log::error('Error occurred: ' . $e->getMessage());

            return $e->getMessage();
            // You can return a response to the user
            // return response()->json(['error' => 'Something went wrong'], 500);
        }

    }

    // ------ logout
    public function logOut()
    {
        try {
            Auth::logout();
            Auth::guard('web')->logout();
            Session::flush();

            return redirect()->route('login')->with('success', 'Succefuly logout');

        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
