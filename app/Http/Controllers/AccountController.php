<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AccountController extends Controller
{
    // This method is called to show registration page
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // This method will register a user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string|min:3',
            'email' =>'required|string|email|min:10|unique:users|regex:/(.+)@(.+)\..+/',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.register')->withInput()->withErrors($validator);
        }

        // Now register the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Auth::login($user);

        return redirect()->route('auth.login')->with('success', 'You have successfully registered');
    }


    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($credentials->fails()) {
            // access errors
            $error = $credentials->errors();
            // redirect with errors
            return redirect()->route('auth.login')->withInput()->withErrors($error);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('auth.profileView')->with('success', 'You have successfully logged in');
            }
            return redirect()->route('welcome')->with('success', 'You have successfully logged in');
        } else {
            return redirect()->route('auth.login')->with('error', 'Either email or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'You have successfully logged out');
    }

    // this method will show user information about profile
    public function ProfileView()
    {
        $user = User::find(Auth::user()->id);
        //dd($user);

        return view('auth.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'name' =>'required|string|min:3',
            'email' =>'required|string|email|min:10|unique:users,email, '.Auth::user()->id.',id|regex:/(.+)@(.+)\..+/',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:8192';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('auth.profileView')->withInput()->withErrors($validator)->with('error', $validator);
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;


        // Here will upload the image
        if ($request->hasFile('image')) {
            // Delete old image
            if (!empty($user->image)) {
                File::delete([
                    public_path('storage/uploads/profile/thumb/' . $user->image),
                    public_path('storage/uploads/profile/' . $user->image)
                ]);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/profile', $name, 'public');

            // Créer une miniature
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($request->file('image')->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('storage/uploads/profile/thumb/'.$name));

            $user->image = $name;
        }

        $user->save();

        return redirect()->route('auth.profileView')->with('success', 'You have successfully updated your profile');
    }

    public function showChangePasswordForm() {
        return view('auth.edit-password');
    }

    public function updatePassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        // Vérifier si le mot de passe actuel correspond
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'Le mot de passe actuel est incorrect');
        }

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // Mettre à jour le mot de passe
        User::find(auth()->user()->password)->update(['password' => Hash::make($request->new_password)]);;

        return back()->with('success', 'Mot de passe mis à jour avec succès');
    }
}
