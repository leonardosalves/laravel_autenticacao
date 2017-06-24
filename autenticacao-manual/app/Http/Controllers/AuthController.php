<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login ()
    {
        return view('auth.login');
    }
    public function register ()
    {
        return view('auth.register');
    }

    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => ['required','max:255'],
                'email' => ['required', 'max:255', 'email', 'unique:users'],
                'password' => ['required', 'min:6', 'max:255', 'confirmed']
            ]
        );
        $credentials = array_merge(
            $request->all(),
            ['password' => bcrypt($request->input('password'))]
        );
        User::create($credentials);

        return redirect('auth/login');
    }

    public function attempt(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => ['required', 'max:255', 'email'],
                'password' => ['required', 'min:6', 'max:255']
            ]
        );
        $credentials = $request->only(['email','password']);
        $remenber = $request->has('remenber');

        if (! Auth::attempt($credentials, $remenber))
        {
            return redirect()->back()
            ->with('fail', 'Credentials does not match')
            ->withInput();
        }
        return redirect('dashboard');
    }

    public function passwordRequest(){
        return view('auth.passwords.reset');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
