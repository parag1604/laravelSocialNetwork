<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name_register' => 'required|max:120',
            'password_register' => 'required|min:4'
            // 'password' => 'required|confirmed|min:8'
        ]);

        $email = $request->email;
        $first_name = $request->first_name_register;
        $password = bcrypt($request->password_register);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;

        if($user->save()){
            Auth::login($user);

            return redirect()->to('dashboard')->with([
                'status' => 'success',
                'message' => 'The user was created successfully, and you have been logged in'
            ]);
        } else {
            return redirect()->route('login')->with([
                'status' => 'faliure',
                'message' => 'Something went wrong, please try again'
            ]);
        }
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email_login' => 'required|email',
            // 'email_login' => 'required|email|exists:users',
            'password_login' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email_login, 'password' => $request->password_login])) {
            return redirect()->to('dashboard')->with([
                'status' => 'success',
                'message' => 'You have been logged in successfully']);
        } else {
            return redirect()->route('login')->with([
                'status' => 'faliure',
                'message' => 'The email or password you entered was incorrect, try again...',
                'link' => 'forgot'
            ]);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user() ]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required'
        ]);

        $message = "";

        $user = Auth::user();
        if($user->first_name != $request->first_name) {
            $user->first_name = $request->first_name;
            if (!$user->update()){
                return redirect()->route('account')->with(['status' => 'success', 'message' => "Something went wrong, username could not be updated"]);
            }
            $message = $message . "User name updated successfully.";
        }
        $file = $request->file('image');
        $filename = $user->id . '.jpg';
        if ($file) {
            if (!Storage::disk('local')->put($filename, File::get($file))) {
                return redirect()->route('account')->with(['status' => 'success', 'message' => "Something went wrong, profile picture could not be updated"]);
            }
            $message = $message . "Profile picture updated successfully.";
        }

        return redirect()->route('account')->with(['status' => 'success', 'message' => $message]);

    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}