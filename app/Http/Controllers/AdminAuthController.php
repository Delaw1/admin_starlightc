<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workerstat;
use App\Cart;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminauth'); 
    }

    public function adminLogin(Request $request)
    {
        return view('admin.login');
    }

    public function adminRegister(Request $request)
    {
        $depts = Department::all();
        return view('admin.register', ['depts' => $depts]);
    }

    public function adminRegisterPost(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            // return $validate->errors()->first();
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $input = $request->all();
        $password = $input['password'];
        $input['password'] = bcrypt($request->password);
        $input['role'] = "writer";
        $user = User::create($input);

        if ($user) {
            Workerstat::create([
                'user_id' => $user->id,
                'department_id' => $user->department_id
            ]);
            $subject = "Welcome to " . env('APP_NAME');
            $view = 'emails.welcome';
            $mail = new MyMail($subject, $user, $view);
            Mail::to($user->email)->send($mail);
            return redirect()->back()->with('success', 'Account successfully created, await approval by admin');
        }
        // Auth::attempt(['email' => $input['email'], 'password' => $password]);
        // if (Auth::check()) {
        //     return redirect('/admin');
        // }
        return redirect()->back()->with('error', 'Failed Registration');
    }

    public function adminLoginPost(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::User()->role == 'user') {
                Auth::logout();
                return redirect('/');
            } else if (Auth::User()->role == 'writer' && Auth::User()->approved == 0) {
                Auth::logout();
                return redirect()->back()->with('error', 'Writers request not yet approved');
            }
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }
}
